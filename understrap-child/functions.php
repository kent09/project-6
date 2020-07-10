<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


require_once "inc/wp-breadcrumb-function.php";
require_once "inc/woocommerce.php";

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

function admin_style() {
  wp_enqueue_style('custom-admin-styles', get_stylesheet_directory_uri().'/css/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');


add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );

    wp_enqueue_style( 'owl-carousel-styles', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), $the_theme->get( 'Version' ) );

    wp_enqueue_style( 'owl-theme-carousel-styles', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', array(), $the_theme->get( 'Version' ) );
    
    wp_enqueue_style( 'global-styles', get_stylesheet_directory_uri() . '/css/global.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_style( 'custom-styles', get_stylesheet_directory_uri() . '/css/custom.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_style( 'media-styles', get_stylesheet_directory_uri() . '/css/media.css', array(), $the_theme->get( 'Version' ) );

    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );

    wp_enqueue_script( 'owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array(), $the_theme->get( 'Version' ), true );

    wp_enqueue_script( 'mansory-scripts', get_stylesheet_directory_uri() . '/js/mansory.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'custom-scripts', get_stylesheet_directory_uri() . '/js/custom.js', array(), $the_theme->get( 'Version' ), true );


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );


if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Site Wide Settings',
        'menu_title'    => 'Site Wide Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

}

// Register Sidebars
function footer_sidebar() {

    $args = array(
        'id'            => 'footer-sidebar',
        'name'          => __( 'Footer Menu Area'),
        'description'   => __( 'Appears on posts and pages in the footer.'),
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
    );
    register_sidebar( $args );

}
add_action( 'widgets_init', 'footer_sidebar' );

// Woocommerce sidebar
function woocommerce_sidebar() {

    $args = array(
        'id'            => 'woocommerce-sidebar',
        'name'          => __( 'Woocommerce Widget'),
        'description'   => __( 'Woocommerce Sidebar Widgets.'),
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
    );
    register_sidebar( $args );

}
add_action( 'widgets_init', 'woocommerce_sidebar' );

/**
 * Change several of the breadcrumb defaults
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'hg_woocommerce_breadcrumbs' );
function hg_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => ' > ',
            'wrap_before' => '<ul class="woocommerce-breadcrumb" itemprop="breadcrumb">',
            'wrap_after'  => '</ul>',
            'before'      => '<li>',
            'after'       => '</li>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}


add_filter('woocommerce_catalog_orderby', 'wc_customize_product_sorting');
function wc_customize_product_sorting($sorting_options){
    $sorting_options = array(
        'menu_order' => __( 'Sort by', 'woocommerce' ),
        'popularity' => __( 'Sort by popularity', 'woocommerce' ),
        'rating'     => __( 'Sort by average rating', 'woocommerce' ),
        'date'       => __( 'Sort by newness', 'woocommerce' ),
        'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
        'price-desc' => __( 'Sort by price: high to low', 'woocommerce' ),
    );

    return $sorting_options;
}

