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
    <?php get_template_part('templates/masshead'); ?>
    <div class="wrap container" role="document">
      <div class="content row">
        <main class="main" role="main">
          <section class="videos">
            <div id="videosReconstruccion" class="owl-carousel owl-theme">
              <div class="item-video" data-merge="3"><a class="owl-video" href="https://vimeo.com/23924346"></a></div>
              <div class="item-video" data-merge="1"><a class="owl-video" href="https://www.youtube.com/watch?v=JpxsRwnRwCQ"></a></div>
              <div class="item-video" data-merge="2"><a class="owl-video" href="https://www.youtube.com/watch?v=FBu_jxT1PkA"></a></div>
              <div class="item-video" data-merge="1"><a class="owl-video" href="https://www.youtube.com/watch?v=oy18DJwy5lI"></a></div>
              <div class="item-video" data-merge="2"><a class="owl-video" href="https://www.youtube.com/watch?v=H3jLkJrhHKQ"></a></div>
              <div class="item-video" data-merge="3"><a class="owl-video" href="https://www.youtube.com/watch?v=g3J4VxWIM6s"></a></div>
              <div class="item-video" data-merge="1"><a class="owl-video" href="https://www.youtube.com/watch?v=0fhoIate4qI"></a></div>
              <div class="item-video" data-merge="2"><a class="owl-video" href="https://www.youtube.com/watch?v=EF_kj2ojZaE"></a></div>
          </div>
          </section>
        </main><!-- /.main -->
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
