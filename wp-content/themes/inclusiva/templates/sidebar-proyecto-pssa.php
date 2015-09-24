<?php if (has_nav_menu('pry_pssa_navigation')) { ?>
	<section class="widget">
		<h3>Menú de Navegación</h3>
		<?php wp_nav_menu(['theme_location' => 'pry_pssa_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']); ?>
	</section>
<?php } ?>

<?php if (has_nav_menu('pry_pssa_cmp_navigation')) { ?>
	<section class="widget">
		<h3>Componentes</h3>
		<?php wp_nav_menu(['theme_location' => 'pry_pssa_cmp_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']); ?>
	</section>
<?php } ?>