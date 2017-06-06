<?php if (has_nav_menu('servicios_navigation')) { ?>
	<section class="widget">
		<h3>Servicios</h3>
		<?php wp_nav_menu(['theme_location' => 'servicios_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']); ?>
	</section>
<?php } ?>
