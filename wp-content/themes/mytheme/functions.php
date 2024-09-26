<?php


//turn on classic widget editor
add_filter('gutenberg_use_widgets_block_editor', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');



//add theme suport
function fashion_theme_support()
{
    add_theme_support("title-tag");
    add_theme_support('post-thumbnails');
}



//add enquere
add_action("after_setup_theme", "fashion_theme_support");
function fashion_register_style()
{
    //bootstrap
    wp_enqueue_style('fashion-bootstrap', get_template_directory_uri() . '/assets/bootstrap/bootstrap-5.3.3-dist/css/bootstrap.min.css', array(), "1.0", 'all');
    wp_enqueue_script('js-bootstrap', get_template_directory_uri() . '/assets/bootstrap/bootstrap-5.3.3-dist/js/bootstrap.min.js', array(), '', true);

    //slider (glide)
    wp_enqueue_style("slider-glide", get_template_directory_uri() . '/assets/css/glide.core.min.css', array(), "", 'all');
    wp_enqueue_style("slider-glide-theme", get_template_directory_uri() . '/assets/css/glide.theme.min.css', array(), "", 'all');
    wp_enqueue_script('js-slider-1', 'https://cdn.jsdelivr.net/npm/@glidejs/glide', array(), '', true);
    wp_enqueue_script('js-slider-2', 'https://unpkg.com/@glidejs/glide', array(), '', true);

    //font (popping)
    wp_enqueue_style('fashion-fontlink', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', array(), "1.0", 'all');
    wp_enqueue_script('fashion-icon', 'https://kit.fontawesome.com/bf18af2f62.js', array(), '1.0', true);

    //styles css file
    wp_enqueue_style("fashion-header", get_template_directory_uri() . '/assets/css/header.css', array(), "1.0", 'all');
    wp_enqueue_style("fashion-main", get_template_directory_uri() . '/assets/css/main.css', array(), "1.0", 'all');
    wp_enqueue_style("fashion-style", get_template_directory_uri() . '/assets/css/style.css', array(), "1.0", 'all');
    wp_enqueue_style("fashion-footer", get_template_directory_uri() . '/assets/css/footer.css', array(), "1.0", 'all');

    //scripts js file
    wp_enqueue_script('app-js', get_template_directory_uri().'/assets/js/app.js', array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'fashion_register_style');



// INC folder directory
define('INC_DIR', get_template_directory() . '/inc/');



// require php files
require INC_DIR . 'widget.php'; //custom-widget
require INC_DIR . 'codestar.php'; //Theme option from codestar framework
require INC_DIR . 'hook/product-hook.php';
require INC_DIR . 'hook/category-hook.php'; //load category template
require INC_DIR . 'custom-function.php'; //load custom func
require INC_DIR . 'cart-function.php'; //load custom func


//register menu
function fashion_menu()
{
    register_nav_menus(array(
        'primary' => esc_html__('Main Menu', 'fashion'),
        'footer1' => esc_html__('Footer Menu 1', 'fashion'),
        'footer2' => esc_html__('Footer Menu 2', 'fashion'),
        'footer3' => esc_html__('Footer Menu 3', 'fashion'),
    ));
}
add_action("init", "fashion_menu");



//widget init register
function register_footer_left()
{
    register_sidebar(array(
        'name' => 'Footer left',
        'id' => 'footer_left',
        'before_widget' => '',
        'after_widget' => '',
    ));
}
function register_footer_form()
{
    register_sidebar(array(
        'name' => 'Footer form',
        'id' => 'footer_form',
        'before_widget' => '',
        'after_widget' => '',
    ));
}
function register_footer_menu_1()
{
    register_sidebar(array(
        'name' => 'Footer menu 1',
        'id' => 'footer_menu_1',
        'before_widget' => '',
        'after_widget' => '',
    ));
}
function register_footer_menu_2()
{
    register_sidebar(array(
        'name' => 'Footer menu 2',
        'id' => 'footer_menu_2',
        'before_widget' => '',
        'after_widget' => '',
    ));
}
function register_footer_menu_3()
{
    register_sidebar(array(
        'name' => 'Footer menu 3',
        'id' => 'footer_menu_3',
        'before_widget' => '',
        'after_widget' => '',
    ));
}
add_action('widgets_init', 'register_footer_left');
add_action('widgets_init', 'register_footer_form');
add_action('widgets_init', 'register_footer_menu_1');
add_action('widgets_init', 'register_footer_menu_2');
add_action('widgets_init', 'register_footer_menu_3');

