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
<?php } else if ( is_page( array ( 'Contacto'))){ ?>

<section class="widget text-2 widget_text"><h3>La Institución</h3>			<div class="textwidget"><address>
  <strong><a href="//localhost:3000/portal">AGRO RURAL</a></strong><br>
<a href="https://www.google.com.pe/maps/place/AGRO+RURAL/@-12.0796521,-77.0425728,15z/data=!4m2!3m1!1s0x0:0x6f311078be8946fa">Av. Salaverry 1388,<br>
  Jesús María, Lima 11, PE</a><br>
  <abbr title="Teléfono">T:</abbr> (511) 205-8030
</address>

<address>
  <strong>Contacto</strong><br>
  <a href="mailto:webmaster@agrorural.gob.pe">webmaster@agrorural.gob.pe</a>
</address></div>
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
<?php } else if( is_page( array('Comité de Seguridad y Salud en el Trabajo de AGRO RURAL') ) ) {?>
<section class="widget">
	<h3>Documentos</h3>

<p>
<ul>
<li><a href="http://agrorural.dev/portal/wp-content/uploads/risst/REGLAMENTO INTERNO DE SEGURIDAD Y SALUD EN EL TRABAJO - AGRO RURAL.pdf"><i class="fa fa-file-pdf-o"></i> Reglamento Interno de Seguridad y Salud en el Trabajo</a></li>

<li><a href="http://agrorural.dev/portal/wp-content/uploads/risst/POLITICA_EN_SEGURIDAD_a4.pdf"><i class="fa fa-file-pdf-o"></i> Política en Seguridad</a></li>

<li><a href="http://agrorural.dev/portal/wp-content/uploads/risst/Reglamento_de_la_Ley_N_29783_ley_de_seguridad_y_salud_en_el_trabajo.pdf"><i class="fa fa-file-pdf-o"></i> Reglamento de la Ley N° 29783 Ley de Seguridad y Salud en el Trabajo</a></li>

<li><a href="http://agrorural.dev/portal/wp-content/uploads/risst/D.S. 002-2013-TR POLITICA NACIONAL DE SEGURIDAD Y SALUD EN EL TRABAJO.pdf"><i class="fa fa-file-pdf-o"></i> D.S. 002-2013-TR Política Nacional de Seguridad y Salud en el Trabajo</a></li>

<li><a href="http://agrorural.dev/portal/wp-content/uploads/risst/LEY SEGURIDAD Y SALUD LABORAL.pdf"><i class="fa fa-file-pdf-o"></i> Ley Seguridad y Salud Laboral</a></li>
</ul>
</section>
<?php } else {?>
	<?php dynamic_sidebar('sidebar-primary'); ?>
<?php } ?>