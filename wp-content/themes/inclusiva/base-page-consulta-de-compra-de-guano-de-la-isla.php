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
			<?php include Wrapper\template_path(); ?>
		</main><!-- /.main -->
		<aside class="sidebar" role="complementary">
			<a href="<?php bloginfo('url')?>/servicios/venta-de-guano-de-la-isla/reportes-2015-2016/"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/guano-reporte-2015-2016.jpg" class="img-responsive" alt=""></a>
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
