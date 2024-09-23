<?php
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
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);