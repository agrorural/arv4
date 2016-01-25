<?php if (has_nav_menu('sci_navigation')) { ?>
<section class="widget">
	<h3>SCI</h3>
	<?php wp_nav_menu(['theme_location' => 'sci_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']); ?>
</section>
<?php } ?>