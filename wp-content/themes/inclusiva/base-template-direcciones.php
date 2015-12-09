<?php

use Roots\Sage\Config;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class('special-header'); ?>>
    <!--[if lt IE 9]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <?php  
		global $post; 
		$page__title = get_the_title();
		$page = get_page_by_title( $page__title , OBJECT, 'directorios' );
		
		$dir_responsable = get_field('dir_responsable', $page->ID);

    ?>

    <?php if (has_post_thumbnail( $post->ID ) ){ ?>
        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false ); ?>
      	<div class="masshead" style="background: url('<?php echo $image[0]; ?>')  no-repeat top left; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
    <?php } else { ?>
      	<div class="masshead">
    <?php } ?>
			  <?php get_template_part('templates/page', 'header-direcciones'); ?>
		</div>
    <?php if ($tag__slug && has_nav_menu('pry_'.$tag__slug.'_navigation')){ ?>
          <?php get_template_part('templates/nav', 'direcciones' ); ?>
    <?php } ?>

    <div class="wrap container" role="document">
      <div class="content row">
        <main class="main" role="main">
          <?php get_template_part('templates/section', 'direcciones'); ?>
        </main><!-- /.main -->
        <aside class="sidebar" role="complementary">
          <?php get_template_part('templates/sidebar', 'direcciones'); ?>
        </aside><!-- /.sidebar -->
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
