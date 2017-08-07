<?php if ( is_page( array ( 'gobierno-abierto' ) ) ) { ?>
<section class="widget">
	<h3>Gobierno Abierto</h3>
    <?php
	if (has_nav_menu('transparencia_navigation')) :
		wp_nav_menu(['theme_location' => 'transparencia_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']);
	endif;
	?>
</section>
<?php } else if ( is_page( array ( 'agro-rural', 'la-institucion', 'antecedentes', 'mision-y-vision', 'organigrama', 'directorio', 'preguntas-frecuentes' ) ) ) {?>
<section class="widget">
	<h3>Quiénes Somos</h3>
    <?php
	if (has_nav_menu('quienes_somos_navigation')) :
		wp_nav_menu(['theme_location' => 'quienes_somos_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']);
	endif;
	?>
</section>
<?php } else if ( is_page( array ( 'Proceso de Elecciones' ) ) ) {?>
	<?php if ( is_user_logged_in() ) {
		echo '<section class="widget text-2 widget_text"><h3>Bienvenido</h3>';
			$current_user = wp_get_current_user();
        	printf( '<p class="textwidget">Hola, %s', esc_html( $current_user->user_firstname ), '</p>' );
        	echo '<p class="textwidget"><a href="' . wp_logout_url() . '">Cerrar Sesión</a></p>';
		echo '</section>';
	}else{
		echo '<section class="widget text-2 widget_text"><h3>Inicia Sesión</h3>';
			wp_login_form();
		echo '</section>';
	}
	?>
<?php } else if ( is_page( array ( 'Contacto'))){ ?>

<section class="widget text-2 widget_text">
	<h3>Sedes</h3>	
	<div class="textwidget">
		<?php
			global $paged;
			global $wp_query;
			$temp = $wp_query; 
			$wp_query = null; 
			$wp_query = new WP_Query(); 
			$wp_query->query('post_type=directorios&posts_per_page=1&grupos=organos-de-direccion&paged='.$paged);
			while ($wp_query->have_posts()) : $wp_query->the_post(); 

			$dir_direccion = get_field('dir_direccion'); 
			
		?>

		<address>
			<strong>Sede Central</strong><br>
			<a href="https://www.google.com.pe/maps/place/AGRO+RURAL/@-12.0796521,-77.0425728,15z/data=!4m2!3m1!1s0x0:0x6f311078be8946fa"><?php echo $dir_direccion; ?></a><br>
			<abbr title="Teléfono">T:</abbr> (511) 205-8030 
		</address>

		<?php endwhile; ?>

		<?php 
		  $wp_query = null; 
		  $wp_query = $temp; 
		?>

		<?php
		global $paged;
		global $wp_query;
		$temp = $wp_query; 
		$wp_query = null; 
		$wp_query = new WP_Query(); 
		$wp_query->query('post_type=directorios&posts_per_page=-1&grupos=organos-desconcentrados&paged='.$paged);
		while ($wp_query->have_posts()) : $wp_query->the_post(); 

		$dir_direccion = get_field('dir_direccion'); 
		$dir_telefono = get_field('dir_telefono');
	?>

		<address>
			<strong>Sede <?php echo the_title(); ?></strong><br>
			<?php echo $dir_direccion; ?><br>
			<abbr title="Teléfono">T:</abbr> <?php echo $dir_telefono; ?>
		</address>

	<?php endwhile; ?>

	<?php 
	  $wp_query = null; 
	  $wp_query = $temp; 
	?>

	</div>
</section>

<?php } elseif ( is_page( array (
									'objetivos',
									'el-proyecto',
									'ambito-de-intervencion-y-grupo-objetivo',
									'componentes',
									'componente-1',
									'componente-2',
									'componente-3',
									'componente-4'
								)
						)
				)
{?>
    	<?php get_template_part('templates/sidebar', 'proyecto-pssa'); ?>
		<?php } elseif ( is_page( array (
											'formulario-de-solicitud-de-acceso-a-la-informacion-publica'
										)
								)
						)
		{?>
			<section class="widget">
				<h3>Sobre este formulario</h3>
				<div class="textwidget">
					<p>Este formulario está disponible en días laborables desde las 8:30 a.m. hasta las 4:30 p.m. Cualquier envío posterior se contabilizará la atención desde las 8:30 a.m. del siguiente día laborable.</p>
				</div>
			</section>
			<section class="widget">
				<h3>Recuerde que...</h3>
				<div class="textwidget">
					<p>También puede presentar este formulario a través de mesa de partes de forma física descargando el formato desde el <a href="<?php echo bloginfo('url'); ?>/wp-content/uploads/transparencia/oaj/SolicituddeAcceso.doc">siguiente link</a>.</p>
				</div>
			</section>
<?php } else {?>
	<?php dynamic_sidebar('sidebar-primary'); ?>
<?php } ?>
