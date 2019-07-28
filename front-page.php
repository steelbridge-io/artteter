<?php
/**
 * Custom Front Page
 *
 * @author Chris Parsons
 * @link http://steelbridgemedia.com
 *
 */


// Execute custom home page. If no widgets active, then loop
add_action( 'genesis_meta', 'sc_custom_home_loop' );

function sc_custom_home_loop() {
    if ( is_active_sidebar( 'home-featured-full' ) || is_active_sidebar( 'home-featured-left' ) || is_active_sidebar( 'home-featured-right' ) || is_active_sidebar( 'home-middle-1' ) || is_active_sidebar( 'home-middle-2' ) || is_active_sidebar( 'home-middle-3' ) || is_active_sidebar( 'home-bottom' ) ) {

        remove_action( 'genesis_loop', 'genesis_do_loop' );
        add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
        add_action( 'genesis_before_content', 'at_instafeed_action' );
        add_action( 'genesis_before_content', 'sc_home_do_featured' );
        add_action( 'genesis_before_content', 'sc_home_do_middle' );
        add_action( 'genesis_before_content', 'sc_home_do_bottom' );
    }
}



// Home feature widget section
function sc_home_do_featured() {

    if ( is_active_sidebar( 'home-featured-full' ) || is_active_sidebar( 'home-featured-left' ) || is_active_sidebar( 'home-featured-right' ) ) {

        echo '<section id="home-featured" class="clearfix"><div class="wrap">';

        genesis_widget_area( 'home-featured-full', array(
            'before' => '<main class="home-featured-full">',
            'after' => '</main>',
        ) );

        echo '<section id="home-featured-halves">';

        genesis_widget_area( 'home-featured-left', array(
            'before' => '<aside class="home-featured-left one-half first">',
            'after' => '</aside>',
        ) );

        genesis_widget_area( 'home-featured-right', array(
            'before' => '<aside class="home-featured-right one-half">',
            'after' => '</aside>',
        ) );

        echo '</section><!-- end home-featured-halves --></div><!-- end wrap --></section><!-- end home-featured -->';
    }
}

// Home middle widget section

function sc_home_do_middle() {

    if ( is_active_sidebar( 'home-middle-1' ) || is_active_sidebar( 'home-middle-2' ) || is_active_sidebar( 'home-middle-3' )  ) {

        echo '<section id="home-middle" class="clearfix"><div class="wrap">';

        genesis_widget_area( 'home-middle-1', array(
            'before' => '<aside class="home-middle-1 widget-area one-third first">',
            'after' => '</aside>',
        ) );

        genesis_widget_area( 'home-middle-2', array(
            'before' => '<aside class="home-middle-2 widget-area one-third">',
            'after' => '</aside>',
        ) );

        genesis_widget_area( 'home-middle-3', array(
            'before' => '<aside class="home-middle-3 widget-area one-third">',
            'after' => '</aside>',

        ) );

        echo '</div><!-- end wrap --></section><!-- end home-middle -->';
    }
}

// Home bottom widget section

function sc_home_do_bottom() {

    if ( is_active_sidebar( 'home-bottom' ) ) {

        echo '<section id="home-bottom" class="clearfix"><div class="wrap">';

        genesis_widget_area( 'home-bottom', array(
            'before' => '<aside class="home-bottom">',
        ) );

        echo '</div><!-- end .wrap --></section><!-- end #home-bottom -->';
    }
}

function at_instafeed_action() {

    echo '<div class="topiecha-grid">' .
        '<h2 class="insta-title">Art Teter&#39;s Instagram Feed&nbsp;<i class="fab fa-instagram"></i></h2>' .
        '<ul id="instafeed"></ul>' .
        '</div>';
}

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

genesis();


?>