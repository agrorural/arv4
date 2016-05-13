<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Config\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Removiendo Emojis
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Quitando estilos de plugins
 */
function remove_unwanted_plugins_assets() {
  wp_dequeue_style('bp-legacy-css');
  //wp_dequeue_style( 'tribe-events-full-calendar-style' );
  //wp_dequeue_style( 'tribe-events-calendar-style' );
  //wp_dequeue_style( 'tribe-events-calendar-full-mobile-style' );
  //wp_dequeue_style( 'tribe-events-calendar-mobile-style' );
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\remove_unwanted_plugins_assets', 100);

function wpa54064_inspect_scripts() {
    global $wp_scripts;
    foreach( $wp_scripts->queue as $handle ) :
        //echo '<li>' .$handle. '</li>';
    endforeach;
}
add_action( 'wp_print_scripts', __NAMESPACE__ . '\\wpa54064_inspect_scripts' );