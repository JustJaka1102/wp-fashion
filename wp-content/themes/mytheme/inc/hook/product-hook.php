<?php
function get_new_single_template( $single_template ) {
    global $post;
      $single_template = get_stylesheet_directory() . '/template/single-product.php';
    return $single_template;
  }
  add_filter( 'single_template', 'get_new_single_template' );