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
  'lib/ctp_roles.php',
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