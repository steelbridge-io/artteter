<?php
/*
 * artteeter.com
 */

//* Start the engine
include_once( get_template_directory() . '/lib/init.php');
include_once 'lib/fishing-reports-cpt.php';

add_action( 'Genesis_setup', 'custom_setup');
load_child_theme_textdomain( 'custom' );
function custom_setup(){
    //* Child theme (do not remove)
    define( 'CHILD_THEME_NAME', 'Art Teter' );
    define( 'CHILD_THEME_URL', 'http://steelbridge.io/' );
    define( 'CHILD_THEME_VERSION', '2.0.1' );
}

//* Enqueue Lato Google font and fontawesome
add_action( 'wp_enqueue_scripts', 'art_teter_enqueue_scripts_styles', 20 );
function art_teter_enqueue_scripts_styles() {
    wp_register_style( 'font-awesome-artteter', get_stylesheet_directory_uri() . '/assets/fontawesome/css/all.css' );
    wp_enqueue_style('font-awesome-artteter');
    wp_enqueue_style( 'google-font-lato', '//fonts.googleapis.com/css?family=Lato:300,700' );

    /* Scripts */
    /*wp_enqueue_script('enqueue_fouc', get_stylesheet_directory_uri() . '/js/page-loader-init.js', array
    ('jquery'), '20190905', false );*/
    wp_register_script( 'load_instafeed_js', get_stylesheet_directory_uri() . '/instafeed/js/instafeed.min.js', array
    ('jquery'), '20180816', false );
    wp_enqueue_script( 'load_instafeed_js' );

    wp_register_script( 'load_instafeed_setup', get_stylesheet_directory_uri() . '/instafeed/js/instafeed-setup.js',
        array('jquery'), '20180816', false );
    wp_enqueue_script( 'load_instafeed_setup' );
}
//* Remove default style
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
//* Add and Enqueue default style at end
add_action( 'wp_enqueue_scripts', 'genesis_enqueue_main_stylesheet', 80 ); // Load priority

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption'  ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'Genesis-responsive-viewport' );

// Add theme support for accessibility.
add_theme_support( 'Genesis-accessibility', array(
    '404-page',
    'drop-down-menu',
    'headings',
    'rems',
    'search-form',
    'skip-links',
) );

add_image_size('feature', 523, 174, true);

/**
 * Filter the genesis_seo_site_title function to use an image for the logo instead of a background image
 *
 * The genesis_seo_site_title function is located in genesis/lib/structure/header.php
 * @link http://blackhillswebworks.com/?p=4144
 *
 */

add_filter( 'genesis_seo_title', 'bhww_filter_genesis_seo_site_title', 10, 2 );

function bhww_filter_genesis_seo_site_title( $title, $inside ){

    //	$child_inside = sprintf( '<a href="%s" title="%s"><img src="'. get_stylesheet_directory_uri() .'/images/logo.png" class="logo-image" title="%s" alt="%s"/></a>', trailingslashit( home_url() ), esc_attr( get_bloginfo( 'name' ) ), esc_attr( get_bloginfo( 'name' ) ), esc_attr( get_bloginfo( 'name' ) ) );

    $title = str_replace( $inside, $title );

    return $title;

}

genesis_register_sidebar ( array(
    'id' => 'genesis_after_menu',
    'name' => 'After Menu Image',
    'description' => 'After Menu Image',
));


add_action( 'genesis_after_header', 'child_after_header' );
/** Loads a new sidebar after the content */
function child_after_header() {

    echo '<div class="after-menu-image">';
    dynamic_sidebar( 'after-menu-image' );
    echo '</div>';

}


// Add new featured widgets


// Home page widgets
genesis_register_sidebar( array(
    'id'			=> 'home-featured-full',
    'name'			=> __( 'Home Featured Full', 'CHILD_THEME_NAME' ),
    'description'	=> __( 'This is the featured area if you want full width.', 'CHILD_THEME_NAME' ),
) );
genesis_register_sidebar( array(
    'id'			=> 'home-featured-left',
    'name'			=> __( 'Home Featured Left', 'CHILD_THEME_NAME' ),
    'description'	=> __( 'This is the featured area left side.', 'CHILD_THEME_NAME' ),
) );
genesis_register_sidebar( array(
    'id'			=> 'home-featured-right',
    'name'			=> __( 'Home Featured Right', 'CHILD_THEME_NAME' ),
    'description'	=> __( 'This is the featured area right side.', 'CHILD_THEME_NAME' ),
) );
genesis_register_sidebar( array(
    'id'			=> 'home-middle-1',
    'name'			=> __( 'Home Middle 1', 'CHILD_THEME_NAME' ),
    'description'	=> __( 'This is the home middle left area.', 'CHILD_THEME_NAME' ),
) );
genesis_register_sidebar( array(
    'id'			=> 'home-middle-2',
    'name'			=> __( 'Home Middle 2', 'CHILD_THEME_NAME' ),
    'description'	=> __( 'This is the home middle center area.', 'CHILD_THEME_NAME' ),
) );
genesis_register_sidebar( array(
    'id'			=> 'home-middle-3',
    'name'			=> __( 'Home Middle 3', 'CHILD_THEME_NAME' ),
    'description'	=> __( 'This is the home middle right area.', 'CHILD_THEME_NAME' ),
) );
genesis_register_sidebar( array(
    'id'			=> 'home-bottom',
    'name'			=> __( 'Home Bottom', 'CHILD_THEME_NAME' ),
    'description'	=> __( 'This is the home bottom area.', 'CHILD_THEME_NAME' ),
) );

if(!is_admin()) {
    // Move all JS from header to footer
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
}

function arts_viewport_meta() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
}
add_action( 'wp_head', 'arts_viewport_meta');

// Add Read More
// Changing excerpt more
function new_excerpt_more($more) {
  global $post;
  return '… <a href="'. get_permalink($post->ID) . '">' . 'Read More &raquo;' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
