<?php if (has_nav_menu('cnv_cas_navigation')) { ?>
<section class="widget">
	<h3>Archivo por años</h3>
	<?php wp_nav_menu(['theme_location' => 'cnv_cas_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']); ?>
</section>
<?php } ?>