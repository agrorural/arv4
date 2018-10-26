<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/utils.php',                 // Utility functions
  'lib/init.php',                  // Initial theme setup and constants
  'lib/wrapper.php',               // Theme wrapper class
  'lib/conditional-tag-check.php', // ConditionalTagCheck class
  'lib/config.php',                // Configuration
  'lib/assets.php',                // Scripts and stylesheets
  'lib/titles.php',                // Page titles
  'lib/extras.php',                // Custom functions
  'lib/wp_bootstrap_navwalker.php',    // Register Custom Navigation Walker
  'lib/gf_snippets.php',    // Gravity Forms Snippet
  'lib/cpt.php', // Custom Post Types
  'lib/cpt_roles.php',
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

/* Personalizaci{on del Login */
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/login/styles/style-login.css' );
    wp_enqueue_script( 'custom-login', get_template_directory_uri() . '/login/scripts/style-login.js' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );
function my_login_logo_url_title() {
    return 'Ir a AGRO RURAL';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
add_filter( 'bp_login_redirect', 'bpdev_redirect_to_profile', 11, 3 );

function bpdev_redirect_to_profile( $redirect_to_calculated, $redirect_url_specified, $user ){
 
    if( empty( $redirect_to_calculated ) )
        $redirect_to_calculated = admin_url();
 
    //if the user is not site admin,redirect to his/her profile
 
    if( isset( $user->ID) && ! is_super_admin( $user->ID ) && is_author( $user->ID ) )
        return bp_core_get_user_domain( $user->ID );
    else
        return $redirect_to_calculated; /*if site admin or not logged in, do not do anything much*/
 
}

function change_post_status($post_id,$status){
    $current_post = get_post( $post_id, 'ARRAY_A' );
    $current_post['post_status'] = $status;
    wp_update_post($current_post);
}

// Breadcrumbs
function custom_breadcrumbs() {
    // Settings
    $breadcrums_id = 'breadcrumb';
    $breadcrums_class = 'breadcrumb';
    $home_title = 'Inicio';
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy = 'product_cat';

    // Get the query & post information
    global $post,$wp_query;

    // Do not display on the homepage
    if ( !is_front_page() ) {

      // Build the breadcrums
      echo '<ol id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';

        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';

        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
          $prefix = '';
          echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {

          // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if($post_type != 'post') {
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
              }

            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
          } else if ( is_single() ) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if($post_type != 'post') {
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
              }

            // Get post category info
            $category = get_the_category();

            if(!empty($category)) {

                // Get last category post is in
                $last_category_one = array_values($category);
                $last_category = end($last_category_one);

                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);

                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                }
              }

              // If it's a custom post type within a custom taxonomy
              $taxonomy_exists = taxonomy_exists($custom_taxonomy);
              if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id  = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
              }

              // Check if the post is in a category
              if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

                // Else if post is in a custom taxonomy
              } else if(!empty($cat_id)) {
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
              } else {
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
              }
            } else if ( is_category() ) {
              // Category page
              echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
            } else if ( is_page() ) {

              // Standard page
              if( $post->post_parent ){
                // If child page, get parents
                $anc = get_post_ancestors( $post->ID );

                // Get parents in the right order
                $anc = array_reverse($anc);

                // Parent page loop
                foreach ( $anc as $ancestor ) {
                  $parents = '';
                  $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                }

                // Display parent pages
                echo $parents;

                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';

              } else {

                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
              }

            } else if ( is_tag() ) {

              // Tag page

              // Get tag information
              $term_id = get_query_var('tag_id');
              $taxonomy= 'post_tag';
              $args = 'include=' . $term_id;
              $terms = get_terms( $taxonomy, $args );
              $get_term_id = $terms[0]->term_id;
              $get_term_slug = $terms[0]->slug;
              $get_term_name = $terms[0]->name;

              // Display the tag name
              echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';

            } elseif ( is_day() ) {

              // Day archive

              // Year link
              echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';

              // Month link
              echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';

              // Day display
              echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
            } else if ( is_month() ) {

              // Month Archive

              // Year link
              echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';

              // Month display
              echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';

            } else if ( is_year() ) {

              // Display year archive

              echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';

            } else if ( is_author() ) {

              // Auhor archive

              // Get the author information

              global $author;
              $userdata = get_userdata( $author );

              // Display author name
              echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';

            } else if ( get_query_var('paged') ) {

              // Paginated archives
              echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';

            } else if ( is_search() ) {

              // Search results page
              echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';

            } elseif ( is_404() ) {

              // 404 page
              echo '<li>' . 'Error 404' . '</li>';
            }

            echo '</ol>';
          }
        }

    //function to call first uploaded image in functions file
    function default_thumb($size = 'full', $image = 'news-thumb') {
        global $post, $posts;
        $image_url = '';
        ob_start();
        ob_end_clean();

        if(preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches))
            $image_url = $matches[1][0];
        else
            $image_url = get_bloginfo('template_url') . "/dist/images/". $image .".jpg";
        return $image_url;

    }

    // Ajax para busqueda de documentos
    add_action('wp_ajax_insta_search', 'insta_search_callback');
    add_action('wp_ajax_nopriv_insta_search', 'insta_search_callback');

    function insta_search_callback(){
        header('Content-Type:application/json');

        class objectToSend
        {
            var $action;
            var $postType;
            var $postTax;
            var $postTerm;
            var $txtKeyword;
            var $optMonth;
            var $optYear;
            var $optPerPage;
            var $max_num_pages; 
            var $response;
            var $bError;
            var $vMensaje;
            var $paged;

            function __construct($action, $postType, $postTax, $postTerm, $txtKeyword, $optMonth, $optYear, $optPerPage, $max_num_pages, $response, $bError, $vMensaje, $paged) {
               $this->action = $action; 
               $this->postType = $postType; 
               $this->postTax = $postTax; 
               $this->postTerm = $postTerm; 
               $this->txtKeyword = $txtKeyword; 
               $this->optMonth = $optMonth; 
               $this->optYear = $optYear; 
               $this->optPerPage = $optPerPage; 
               $this->max_num_pages = $max_num_pages; 
               $this->response = $response; 
               $this->bError = $bError; 
               $this->vMensaje = $vMensaje; 
               $this->paged = $paged; 
              }
        }

        $objectToSend = new objectToSend(
          'insta_search',
          isset($_GET['postType'])?sanitize_text_field( $_GET['postType'] ) :'',
          isset($_GET['postTax'])?sanitize_text_field( $_GET['postTax'] ) :'',
          isset($_GET['postTerm'])?sanitize_text_field( $_GET['postTerm'] ) :'', 
          isset($_GET['txtKeyword'])?sanitize_text_field( $_GET['txtKeyword'] ):'', 
          isset($_GET['optMonth'])?intval( sanitize_text_field( $_GET['optMonth'] ) ):0, 
          isset($_GET['optYear'])?intval( sanitize_text_field( $_GET['optYear'] ) ):0, 
          isset($_GET['optPerPage'])?intval( sanitize_text_field( $_GET['optPerPage'] ) ):10, 
          isset($_GET['max_num_pages'])?intval( sanitize_text_field( $_GET['max_num_pages'] ) ):0, 
          array(),
          false,
          '',
          isset($_GET['paged'])?intval( sanitize_text_field( $_GET['paged'] ) ):1
        );

        $args = array(
            "post_type" => $objectToSend->postType,
            'tax_query' => array(
              array(
                'taxonomy' => $objectToSend->postTax,
                'field'    => 'slug',
                'terms'    => $objectToSend->postTerm,
              ),
            ),
            "posts_per_page" => $objectToSend->optPerPage,
            "s" => $objectToSend->txtKeyword,
            'paged' => $objectToSend->paged,
            'post_status'=> 'publish',
            'date_query' => array(
                array(
                    'year'  => $objectToSend->optYear,
                    'month' => $objectToSend->optMonth
                ),
            ),
        );

        $the_query = new WP_Query( $args );

        // The Loop
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                
                $objectToSend->response[] = array(
                    "id"              =>  get_the_ID(),
                    "title"           => get_the_title(),
                    "slug"            =>  get_post_field( 'post_name', get_post() ),
                    "permalink"       => get_permalink(),
                    "content"         => get_the_content(),
                    "date"            => get_the_date(),
                    "doc_link"        => get_field('rde_link'),
                    "doc_ane__nom"    => get_field('doc_ane__nom'),
                    "doc_ane__desc"   => get_field('doc_ane__desc'),
                    "agregar_documentos"   => get_field('agregar_documentos'),
                    "html"            => ''
                );

            }

            $objectToSend->bError = false;
            $objectToSend->vMensaje = $the_query;
            $objectToSend->max_num_pages = $the_query->max_num_pages;

            echo json_encode($objectToSend);

            /* Restore original Post Data */
            wp_reset_postdata();
        } else {
            $objectToSend->bError = true;
            $objectToSend->vMensaje = 'No se encontraron resultados';
            //$objectToSend->vMensaje = $the_query;

            echo json_encode($objectToSend);
            wp_reset_postdata();
        }

        //var_dump($the_query);
        wp_die();
    }