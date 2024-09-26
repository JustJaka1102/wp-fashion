<?php
//this file locate the template for chossen category
function load_custom_category_template($template) {
    // Get the current category object
    $category = get_queried_object();

    // Check if it's the 'news' category
    if ( $category->slug == 'news' ) {
        // Look for the template in the 'template' folder
        $new_template = locate_template( 'template/category-template/category-news.php' );
        if ( !empty( $new_template ) ) {
            return $new_template;
        }
    }

    // Check if it's the 'events' category
    if ( $category->slug == 'events' ) {
        // Look for the template in the 'template' folder
        $new_template = locate_template( 'template/category-template/category-events.php' );
        if ( !empty( $new_template ) ) {
            return $new_template;
        }
    }

    // Return the default template if no custom template is found
    return $template;
}
add_filter( 'category_template', 'load_custom_category_template' );