<?php if ( is_page( array ( 'gobierno-abierto' ) ) ) { ?>
<section class="widget">
	<h3>Gobierno Abierto</h3>
    <?php
	if (has_nav_menu('transparencia_navigation')) :
		wp_nav_menu(['theme_location' => 'transparencia_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']);
	endif;
	?>
</section>
<?php } elseif ( is_page( array ( 'agro-rural', 'que-es-agro-rural', 'antecedentes', 'mision-y-vision', 'organigrama', 'directorio' ) ) ) {?>
<section class="widget">
	<h3>Quiénes Somos</h3>
    <?php
	if (has_nav_menu('quienes_somos_navigation')) :
		wp_nav_menu(['theme_location' => 'quienes_somos_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']);
	endif;
	?>
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
<?php } else {?>
	<?php dynamic_sidebar('sidebar-primary'); ?>
<?php } ?>