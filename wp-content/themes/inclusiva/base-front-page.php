<?php

use Roots\Sage\Config;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
  <?php get_template_part('lib/ga'); ?>
    <!--[if lt IE 9]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <?php get_template_part('templates/slider', 'home'); ?>
    <?php get_template_part('templates/section', 'multimedia'); ?>
    <?php get_template_part('templates/section', 'newsfeed'); ?>
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>

  <?php
    // Argumentos
    $args  = array(
      'post_type' => 'Banners',
      'posiciones' => 'Modal Home',
      'post_per_page' => 5
    );

    // the query
    $the_query = new WP_Query( $args ); ?>

    <?php if ( $the_query->have_posts() ) : ?>

    <!-- pagination here -->
    <div class="modal fade" id="fontPageModal" tabindex="-1" role="dialog" aria-labelledby="fontPageModalLabel">
      <div class="modal-dialog" role="document">
        <div class="owl-carousel sl__modal-home">
          <!-- the loop -->
          <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="item modal-content">
              <?php get_template_part('templates/modal', 'home'); ?>
            </div>
          <?php endwhile; ?>
          <!-- end of the loop -->
        </div>
      </div>
    </div>
    <?php wp_reset_postdata(); ?>

    <?php endif; ?>

  </body>
</html>
