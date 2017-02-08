<?php

namespace Roots\Sage\Init;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');
  
  // Enable custom logo support
  add_theme_support( 'custom-logo' );


  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage'),
    'primary_nav_left' => __('Primary Navigation Left', 'sage'),
    'primary_nav_right' => __('Primary Navigation Right', 'sage'),
    'links_navigation' => __('Links Navigation', 'sage'),
    'social_navigation' => __('Social Navigation', 'sage'),
    'quienes_somos_navigation' => __('Quiénes Somos Navigation', 'sage'),
    'publicaciones_navigation' => __('Publicaciones Navigation', 'sage'),
    'of_imagen_navigation' => __('Oficina de Imagen Navigation', 'sage'),
    'transparencia_navigation' => __('Transparencia Navigation', 'sage'),
    'multimedia_navigation' => __('Multimedia Navigation', 'sage'),
    'participa_navigation' => __('Participa Navigation', 'sage'),
    'colabora_navigation' => __('Colabora Navigation', 'sage'),
    'desarrolla_navigation' => __('Desarrolla Navigation', 'sage'),

    // Proyectos
    'pry_pssa_navigation' => __('Proyecto PSSA Navigation', 'sage'), //PSSA
      'pry_pssa_cmp_navigation' => __('Componentes Proyecto PSSA Navigation', 'sage'), //PSSA - Componentes
    
    'pry_aliados-ii_navigation' => __('Proyecto Aliados II Navigation', 'sage'), //Aliados II
    'pry_sierra-sur-ii_navigation' => __('Proyecto Sierra Sur II Navigation', 'sage'), //PSSA
    'pry_aiaf_navigation' => __('Proyecto AIAF Navigation', 'sage'), //AIAF
    'pry_csst_navigation' => __('Proyecto CSST Navigation', 'sage'), //CSST
    
    // Resoluciones
    'doc_rde_navigation' => __('Documentos: RDE Navigation', 'sage'), //RDE
    'doc_rda_navigation' => __('Documentos: RDA Navigation', 'sage'), //RDE
    'doc_directivas_navigation' => __('Documentos: Directivas Navigation', 'sage'), //Directivas
    'doc_pac_navigation' => __('Documentos: PAC Navigation', 'sage'), //PAC
    'doc_convenios_navigation' => __('Documentos: Convenios Navigation', 'sage'), //Convenios
    'doc_rd_navigation' => __('Documentos: RD Navigation', 'sage'), //RD

    // Convocatorias
    'cnv_cas_navigation' => __('Convocatorias CAS Navigation', 'sage'), //CAS
    'cnv_cap_navigation' => __('Convocatorias CAP Navigation', 'sage'), //CAP

    // Servicios
    'servicios_navigation' => __('Servicios Navigation', 'sage'), //RDE
      // Sidebar Servicios
      'servicios_sidebar_navigation' => __('Servicios Sidebar Navigation', 'sage'), //RDE

    // Productos
    'producto_clasificacion_navigation' => __('Clasificación de Productos Navigation', 'sage'), //RDE

    // Sistema de Control Interno
    'sci_navigation' => __('SCI Navigation', 'sage') // SCI

  ]);

  // Add post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');
  add_image_size( 'thumb-noticias', 330, 220, true );
  add_image_size( 'thumb-videos', 400, 230, true );
  add_image_size( 'thumb-category-bn', 750, 825, true );
  add_image_size( 'thumb-news-list', 125, 85, array( 'left', 'top' ) );
  add_image_size( 'thumb-clasificaciones', 400, 195, array( 'left', 'top' ) );
  add_image_size( 'thumb-productos', 185, 205, array( 'left', 'top' ) );
  add_image_size( 'thumb-vendi-way', 250, 64, array( 'center', 'top' ) );
  add_image_size( 'thumb-72', 72, 80, array( 'center', 'top' ) );

  // Add post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Add HTML5 markup for captions
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list']);

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style(Assets\asset_path('styles/editor-style.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Eventos', 'sage'),
    'id'            => 'sidebar-events',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('BuddyPress Top', 'sage'),
    'id'            => 'sidebar-buddypress-top',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '',
    'after_title'   => ''
  ]);

  register_sidebar([
    'name'          => __('BuddyPress', 'sage'),
    'id'            => 'sidebar-buddypress',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Pie de página 2', 'sage'),
    'id'            => 'sidebar-footer-2',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Pie de página 3', 'sage'),
    'id'            => 'sidebar-footer-3',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Pie de página 4', 'sage'),
    'id'            => 'sidebar-footer-4',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');
