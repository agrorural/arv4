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
		$pry__logo = get_field('pry__logo');
		$pry__tag = get_field('pry__tag'); 
		$tag_by_ID = get_term_by('id', $pry__tag, 'post_tag');
    $tag__slug = $tag_by_ID->slug;
    ?>

    <?php if (has_post_thumbnail( $post->ID ) ){ ?>
        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false ); ?>
      	<div class="masshead" style="background: url('<?php echo $image[0]; ?>')  no-repeat top left; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
    <?php } else { ?>
      	<div class="masshead">
    <?php } ?>
			  <?php get_template_part('templates/page', 'header-proyectos'); ?>
		</div>
    <?php if ($tag__slug && has_nav_menu('pry_'.$tag__slug.'_navigation')){ ?>
          <?php get_template_part('templates/nav', 'proyecto-'.$tag__slug ); ?>
    <?php } ?>

    <div class="wrap container" role="document">
      <div class="content row">
        <main class="main" role="main">
          <?php get_template_part('templates/section', 'proyectos'); ?>
        </main><!-- /.main -->
        <aside class="sidebar" role="complementary">
        <?php if ($tag__slug){ ?>
          <?php get_template_part('templates/sidebar', 'proyecto-'.$tag__slug ); ?>
        <?php }else{ ?>
          <?php include Wrapper\sidebar_path(); ?>
        <?php } ?>
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
