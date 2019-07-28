<?php

/**
* Template Name: Landing Page
* Description: Used as a page template to show page contents, followed by a loop 
* through the "Ad Capmpaign Category" category
*/

add_filter( 'body_class', 'art_teter_landing_body_class');
function art_teter_landing_body_class( $classes ) {
  $classes [] = 'container-landing';
  return $classes;
}

remove_action ('genesis_header', 'genesis_do_header' );
remove_action ('genesis_before_header', 'genesis_do_nav' );
remove_action ( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action ('genesis_before_footer', 'genesis_footer_widget_areas' );

genesis();