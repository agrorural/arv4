<?php

use Roots\Sage\Config;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class('special-header'); ?>>
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
	
    <?php if (has_nav_menu('producto_navigation')){ ?>
          <?php get_template_part('templates/nav', 'producto' ); ?>
    <?php } ?>

    <div class="wrap container" role="document">
      <div class="content row">
        <main class="main" role="main">
           <?php get_template_part('templates/content', 'single-producto'); ?>
        </main><!-- /.main -->
        <?php if (Config\display_sidebar()) : ?>
          <aside class="sidebar" role="complementary">
            <?php get_template_part('templates/sidebar', 'producto'); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <!-- Modal -->
	<div class="modal fade" id="productoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Consulta a Productores</h4>
	      </div>
	      <div class="modal-body">
		      <?php 
		      	$productores__terms = get_the_terms( get_the_ID(), 'productor');
		      	if( !empty($productores__terms) ) {
					
					$produ__term = array_pop($productores__terms);
					$produ__correo = get_field('produ__correo', $produ__term );
				}
		      ?>
	        <?php 
	        	if(isset($produ__correo)){
	        		gravity_form( 'Consulta a Productores', false, false, true, false, true, '', true ); 
	        	}else{
	        		//var_dump($produ__correo);
	        		echo '<p>Lo sentimos, el productor aún no ha habilitado un buzón para recepcionar consultas.</p>';
	        	}
	        ?>

	      </div>
	    </div>
	  </div>
	</div>
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>