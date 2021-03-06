<?php

namespace Roots\Sage\Assets;

/**
 * Scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/dist/styles/main.css
 *
 * Enqueue scripts in the following order:
 * 1. /theme/dist/scripts/modernizr.js
 * 2. /theme/dist/scripts/main.js
 */

class JsonManifest {
  private $manifest;

  public function __construct($manifest_path) {
    if (file_exists($manifest_path)) {
      $this->manifest = json_decode(file_get_contents($manifest_path), true);
    } else {
      $this->manifest = [];
    }
  }

  public function get() {
    return $this->manifest;
  }

  public function getPath($key = '', $default = null) {
    $collection = $this->manifest;
    if (is_null($key)) {
      return $collection;
    }
    if (isset($collection[$key])) {
      return $collection[$key];
    }
    foreach (explode('.', $key) as $segment) {
      if (!isset($collection[$segment])) {
        return $default;
      } else {
        $collection = $collection[$segment];
      }
    }
    return $collection;
  }
}

function asset_path($filename) {
  $dist_path = get_template_directory_uri() . DIST_DIR;
  $directory = dirname($filename) . '/';
  $file = basename($filename);
  static $manifest;

  if (empty($manifest)) {
    $manifest_path = get_template_directory() . DIST_DIR . 'assets.json';
    $manifest = new JsonManifest($manifest_path);
  }

  if (array_key_exists($file, $manifest->get())) {
    return $dist_path . $directory . $manifest->get()[$file];
  } else {
    return $dist_path . $directory . $file;
  }
}

function assets() {
  wp_enqueue_style('sage_css', asset_path('styles/main.css'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  //wp_enqueue_script('modernizr', asset_path('scripts/modernizr.js'), [], null, true);
    wp_enqueue_script('sage_js', asset_path('scripts/main.js'), ['jquery'], null, true);
    if ( is_page_template( 'template-documentos.php' ) ) {
        $array_is = array(
          'ajax_url' => admin_url('admin-ajax.php'),
          'pt'  => is_page_template(),
          'term' => get_term( get_field('doc__tipo'), '', ARRAY_A),
          'upload_dir' => wp_upload_dir()
        );
        wp_enqueue_script('insta_search', asset_path('scripts/is.js'), ['jquery'], null, true);
        wp_localize_script('insta_search', 'ajax_is', $array_is);
    }
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);


//
// JS para admin
//

function admin_assets() {
  wp_enqueue_script('admin_scripts_js', asset_path('scripts/admin-script.js'), ['jquery'], null, true);
}

add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\\admin_assets', 100);


// add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\\enqueue_my_admin_scripts', 100 );

// function enqueue_my_admin_scripts(){
//     //enqueing my script on gravity form pages
//     wp_enqueue_script('admin_js', get_template_directory_uri() . '/dist/scripts/admin-script.js', false, '1.0.0' );
// }

add_filter('gform_noconflict_scripts', __NAMESPACE__ . '\\register_safe_script' );

function register_safe_script( $scripts ){
    //registering my script with Gravity Forms so that it gets enqueued when running on no-conflict mode
    $scripts[] = "admin_scripts_js";
    return $scripts;
}
