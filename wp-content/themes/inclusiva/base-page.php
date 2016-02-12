<?php

use Roots\Sage\Config;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if lt IE 9]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php if(is_page('redes-sociales')) {?>
      <div id="fb-root"></div>
      <!--script para Facebook -->
      <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.5";
      fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Twitter -->
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

      <!-- Google + -->
      <script src="https://apis.google.com/js/platform.js" async defer></script>
    <?php } ?>
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <?php  global $post; ?>
    <?php if (has_post_thumbnail( $post->ID ) ){ ?>
        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false ); ?>
      	<div class="masshead" style="background: url('<?php echo $image[0]; ?>')  no-repeat top left; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
    <?php } else if( is_page ( 'Contacto' ) ) { ?>
        <div class="masshead">
          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15605.896965231093!2d-77.0425728!3d-12.0796521!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6f311078be8946fa!2sAGRO+RURAL!5e0!3m2!1ses-419!2spe!4v1443559449840" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
    <?php } else { ?>
      	<div class="masshead">
    <?php } ?>
      </div>

    <div class="wrap container" role="document">
    <?php if ( is_post_type_archive('tribe_events') || is_singular('tribe_events') ){ ?>
      <?php get_template_part('templates/page', 'header-events'); ?>
    <?php } else { ?>
      <?php get_template_part('templates/page', 'header'); ?>
    <?php } ?>
      <div class="content row">
        <main class="main" role="main">
          <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->
        <?php if (Config\display_sidebar()) : ?>
          <aside class="sidebar" role="complementary">
          <?php if ( is_singular('tribe_events') ) { ?>
            <?php get_template_part('templates/sidebar', 'singular'); ?>
          <?php }else if ( is_page( array( 'sistema-de-control-interno', 'normativa', 'integrantes', 'actividades', 'acta-de-compromiso', 'galeria-acta', 'acta-de-reunion', 'actas-de-reunion', 'diagnostico', 'planificacion' ) ) ){ ?>
            <?php get_template_part('templates/sidebar', 'sci'); ?>
          <?php }else{ ?>
            <?php get_template_part('templates/sidebar', 'page'); ?>
          <?php } ?>

            
          </aside><!-- /.sidebar -->
        <?php endif; ?>
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
