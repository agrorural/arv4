<?php the_content(); ?>
<hr />
<div class="wrapper">
	<div class="inner">
		<div class="thumbnail">
			<?php
				$the_ID = 11201; 
				if ( has_post_thumbnail( $the_ID ) ) {
		        echo '<a href="' . get_permalink( $the_ID ) . '" title="Transparencia">';
		        echo get_the_post_thumbnail( $the_ID, array(500, 290) );
		        echo '</a>';
		    	}
			?>	  
			
			<div class="caption">
				<h3>De las Publicaciones</h3>
				<p>Las últimas actualizaciones del sector</p>
				<?php
				if (has_nav_menu('publicaciones_navigation')) :
				wp_nav_menu(['theme_location' => 'publicaciones_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']);
				endif;
				?>
		  </div>
		</div>
	</div>	

<div class="inner">
		<div class="thumbnail">
			<?php
				$the_ID = 11201; 
				if ( has_post_thumbnail( $the_ID ) ) {
		        echo '<a href="' . get_permalink( $the_ID ) . '" title="Transparencia">';
		        echo get_the_post_thumbnail( $the_ID, array(500, 290) );
		        echo '</a>';
		    	}
			?>	  
			
			<div class="caption">
				<h3>Oficina de Imagen</h3>
				<p>Actualizaciones de la Oficna de Imagen</p>
				<?php
				if (has_nav_menu('of_imagen_navigation')) :
				wp_nav_menu(['theme_location' => 'of_imagen_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']);
				endif;
				?>
		  </div>
		</div>
	</div>	
</div>