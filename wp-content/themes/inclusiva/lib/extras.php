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
  //wp_dequeue_style('bp-legacy-css');
  //wp_dequeue_style( 'tribe-events-full-calendar-style' );
  //wp_dequeue_style( 'tribe-events-calendar-style' );
  //wp_dequeue_style( 'tribe-events-calendar-full-mobile-style' );
  //wp_dequeue_style( 'tribe-events-calendar-mobile-style' );
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\remove_unwanted_plugins_assets', 100);

add_filter('the_title', __NAMESPACE__.'\\custom_post_type_archive_title');
function custom_post_type_archive_title ($title){
  $post__types = array('producto');

  if (strlen($title) > 30 && is_post_type_archive($post__types) && in_the_loop() ) {
     $title = substr($title,0,30) . '&#8230;';
  }
  return $title;
}

function wpa54064_inspect_scripts() {
    global $wp_scripts;
    foreach( $wp_scripts->queue as $handle ) :
        //echo '<li>' .$handle. '</li>';
    endforeach;
}
add_action( 'wp_print_scripts', __NAMESPACE__ . '\\wpa54064_inspect_scripts' );

function agro_url_shortcode() {
return get_bloginfo('url');
}
add_shortcode('url', __NAMESPACE__ . '\\agro_url_shortcode');

add_filter('widget_text', 'do_shortcode');

//Buscador en ajax
function insta_search(){
    ob_start();
    ?>
    <div id="insta-search">
        <form class="form-inline" action="" method="GET">
            <div class="form-group">
                <?php $currentYear = date('Y'); ?>

                <label for="txtKeyword">Palabra</label>
                <input type="text" id="txtKeyword" class="form-control" name="txtKeyword">

                <label for="optMonth">Mes</label>
                <select id="optMonth" class="form-control" name="optMonth">
                    <option value="">Todos</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Setiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>

                <label for="optYear">Año</label>
                <select id="optYear" class="form-control" name="optYear">
                    <option value="<?php echo $currentYear; ?>"><?php echo $currentYear; ?></option>
                    <?php
                        for ($i = $currentYear -1; $i >= 2009; $i--) {
                            echo ' <option value="' . $i .'">' . $i . '</option>';
                        }
                    ?>
                </select>

                <label for="optPerPage">Listar</label>
                <select id="optPerPage" class="form-control" name="optPerPage">
                    <option value="20">20</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>

            <button id="btnDocumento" type="submit" class="btn btn-default">Buscar</button>
        </form>
        <div class="wp-pagenavi"></div>
        <div class="search-result"></div>
        <div class="wp-pagenavi"></div>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode('instasearch', __NAMESPACE__ . '\\insta_search');

// Quita el menu de comentarios al rol Contributor
function comments_menu_removing() {
  if( !current_user_can( 'edit_others_pages' ) ){
        remove_menu_page( 'edit-comments.php' );          //Comments
    }
}

// Imposibilita la lectura de posts que no son suyos al rol Contributor
add_action( 'admin_menu', __NAMESPACE__ . '\\comments_menu_removing' );

function posts_for_current_contributor() {
    global $user_ID;

    if ( current_user_can( 'contributor' ) ) {
       if ( ! isset( $_GET['author'] ) ) {
          wp_redirect( add_query_arg( 'author', $user_ID ) );
          exit;
       }
   }

}

add_action( 'load-edit.php', __NAMESPACE__ . '\\posts_for_current_contributor' );