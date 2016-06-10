	<section class="widget">
		<h3>Búsqueda</h3>
		<?php get_search_form(); ?>
	</section>

	<?php if (has_nav_menu('producto_clasificacion_navigation')){ ?>
          <section class="widget">
          	<h3>Categorías</h3>
          	<nav class="nav nav-sidebar" role="navigation">
		      <?php wp_nav_menu(['theme_location' => 'producto_clasificacion_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']); ?>
		    </nav>
          </section>
    <?php } ?>