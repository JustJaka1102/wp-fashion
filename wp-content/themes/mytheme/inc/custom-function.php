<?php
//this file hold all custom fuc for post and database
// excerpt limit fuction
function excerpt($limit) {
    // Get the excerpt and strip shortcodes or unwanted tags
    $excerpt = get_the_excerpt();
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt); // Remove shortcodes

    // Limit the excerpt to the specified number of characters
    if (strlen($excerpt) > $limit) {
        // Trim the excerpt to the limit and add ellipsis
        $excerpt = substr($excerpt, 0, $limit) . '...';
    }

    // Add the "Read more" link to the post
    $excerpt .= ' <a class="btn" href="' . get_permalink() . '" style="padding: 5px;border-radius: 20px;color: blue;"><-- Read more --></a>';
    return $excerpt;
}
// view count fuctions
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10);

// database time
function wp_create_payment_database() {
    global $wpdb;

    $table_name_1 = $wpdb->prefix . 'bill';
    $table_name_2 = $wpdb->prefix . 'product_in_bill';

    $charset_collate = $wpdb->get_charset_collate();
    //create table for bill
    $sql_1 = "CREATE TABLE $table_name_1 ( 
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        user_ID bigint(20) NOT NULL,
        name varchar(255),
        emailaddress varchar(255),
        phonenumber varchar(50),
        city varchar(255),
        state varchar(255),
        zipcode varchar(255),
        PRIMARY KEY  (id)
    ) $charset_collate;";
    //create table for item in bill
    $sql_2 = "CREATE TABLE $table_name_2 (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        invoice_id mediumint(9) NOT NULL,
        product_id mediumint(9) NOT NULL,
        quantity int(11) NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (invoice_id) REFERENCES $table_name_1(id) ON DELETE CASCADE
    ) $charset_collate;";
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql_1 );
    dbDelta( $sql_2 );
}
add_action( 'init', 'wp_create_payment_database' );
//save bill in db
function save_bill_with_items($information,$products) {
    global $wpdb;
    $table_name_1 = $wpdb->prefix . 'bill';
    $table_name_2 = $wpdb->prefix . 'product_in_bill';

    $result = $wpdb->insert(
        $table_name_1,
        array(
            'date' => current_time('mysql'),
            'user_ID' => get_current_user_id(),
            'name' => $information['name'],
            'emailaddress' => $information['emailaddress'],
            'phonenumber'=> $information['phonenumber'],
            'city'=> $information['city'],
            'state'=> $information['state'],
            'zipcode'=> $information['zipcode'],
        )
    );
    if ($result === false) {
        return false;
    }
    $bill_id = $wpdb->insert_id;
    foreach ($products as $product_id => $quantity) {
        $result = $wpdb->insert(
            $table_name_2,
            array(
                'invoice_id' => $bill_id,
                'product_id' => $product_id,
                'quantity' => $quantity
            )
        );
        decs_stock($quantity,$product_id);
    }
    if ($result === false) {
        return false;
    }
    return true;
}
//after successullfy check out (save in db), decs the stock with this fuc
function decs_stock($desc_quantity,$post_id){
    $new_quantity = get_field('quantity',$post_id) - $desc_quantity;
    update_field('quantity', $new_quantity, $post_id);
}