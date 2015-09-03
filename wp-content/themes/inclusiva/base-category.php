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
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <?php 
	    $cat = get_query_var('cat'); $get_cat = get_category ($cat); 
	    $category_id = get_cat_ID( $get_cat->name );
		$category_link = get_category_link( $category_id );
	?>

    <div class="masshead">
	    <div class="container">
	    	<div class="page-header">
		  		<h1>
		  			<a href="<?php echo $category_link; ?>">
		  			<?php if ( ! is_category( 'agrorural' ) ) { echo 'Dirección Zonal'; } ?>
		  				<?php echo $get_cat->name; ?>
		  					<small><a href="<?php echo $category_link; ?>/feed"><i class="fa fa-rss-square"></i> RSS de las noticias</a>
		  					</small>
		  			</a>
		  		</h1>
		  		<p><?php echo category_description( $category_id ); ?> </p>
	  		</div>
		</div>
    </div>

    <div class="wrap container" role="document">
      <div class="content row">
        <main class="main" role="main">
          <?php get_template_part('templates/section', 'category'); ?>
        </main><!-- /.main -->
        <?php if (Config\display_sidebar()) : ?>
          <aside class="sidebar" role="complementary">
            <?php include Wrapper\sidebar_path(); ?>
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
