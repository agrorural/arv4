	<section class="widget">
		<h3>Búsqueda</h3>
		<?php get_search_form(); ?>
	</section>
<?php if (has_nav_menu('cnv_cap_navigation')) { ?>
<section class="widget">
	<h3>Archivo por años</h3>
	<?php wp_nav_menu(['theme_location' => 'cnv_cap_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']); ?>
</section>
<?php } ?>