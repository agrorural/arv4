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

add_filter('the_content', __NAMESPACE__.'\\verify_post_format');

function verify_post_format($content){
  global $post;
  
  $post_slug=$post->post_name;
  $permalink = get_permalink($post);
  $count = json_decode(file_get_contents("https://api.facebook.com/method/fql.query?format=json&query=SELECT+url,normalized_url,total_count,share_count,comment_count,like_count,click_count,commentsbox_count+FROM+link_stat+WHERE+url+%3D+%27http://www.agrorural.gob.pe/".$post_slug."/%27"),true);
  $share_count = $count[0]['share_count'];
  
  if ($share_count > 0) {
    $show_share = '<span class="badge">'.$share_count.'</span>';
  }else{
    $show_share = '';
  }
  if (is_single()){
  $content = $content . 
    '<hr /><div class="sharing-list">
      <ul class="list-inline">
        <li id="fb">
          <a href="https://www.facebook.com/sharer/sharer.php?u='.$permalink.'">
            <span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>'
              .$show_share.
            '</span>
          </a>
        </li>
        <li id="tw">
          <a href="https://twitter.com/home?status='.$permalink.'">
            <span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
            </span>
          </a>
        </li>
        <li id="gp">
          <a href="https://plus.google.com/share?url='.$permalink.'">
            <span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
            </span>
          </a>
        </li>
      </ul>
    </div><hr />';
  }
  
  return $content;
}


function wpa54064_inspect_scripts() {
    global $wp_scripts;
    foreach( $wp_scripts->queue as $handle ) :
        //echo '<li>' .$handle. '</li>';
    endforeach;
}
add_action( 'wp_print_scripts', __NAMESPACE__ . '\\wpa54064_inspect_scripts' );