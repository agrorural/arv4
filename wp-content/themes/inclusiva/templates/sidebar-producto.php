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

    <?php

    $vendi_way_exists = term_exists( 'Vendi Way', 'clasificacion' );

    if ($vendi_way_exists) {
    	$vendi_way_ID = $vendi_way_exists ['term_id'];
    	$vendi_way = get_term_by('id', $vendi_way_ID, 'clasificacion');
    	$vendi_way_link = get_term_link( $vendi_way ); 
    	$clas__img = get_field('clas__img', $vendi_way->taxonomy.'_'.$vendi_way_ID);
    	$clas__img_url = $clas__img['url'];
    	echo '<a href="' . $vendi_way_link . '">';
    		echo '<img src="' . $clas__img_url . '" class="img-responsive" />';
    	echo '</a>';
    }
    
    ?>