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
			<div class="well">
				<h4>Intranet <br /><small>Gestión de Control QR</small></h4>
				<form>
					<ul class="list-inline">
						<li>
							<div class="form-group">
								<label for="exampleInputEmail1">Usuario</label>
								<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Ingrese su usuario">
							</div>
						</li>
						<li>
							<div class="form-group">
								<label for="exampleInputPassword1">Contraseña</label>
								<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Ingrese su clave">
							</div>
						</li>
					</ul>
					<button type="submit" class="btn btn-default">Ingresar a la Intranet</button>
				</form>
			</div>	
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
