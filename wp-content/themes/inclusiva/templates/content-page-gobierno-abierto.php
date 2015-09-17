<?php the_content(); ?>
<hr />
<div class="wrapper">
	<div class="inner">
		<div class="thumbnail">
			<?php
				$the_ID = 6174; 
				if ( has_post_thumbnail( $the_ID ) ) {
		        echo '<a href="' . get_permalink( $the_ID ) . '" title="Transparencia">';
		        echo get_the_post_thumbnail( $the_ID, array(500, 290) );
		        echo '</a>';
		    	}
			?>	  
			
			<div class="caption">
				<h3>Conoce</h3>
				<p>Información sobre lo que está haciendo, sobre nuestras políticas y planes.</p>
				<?php
				if (has_nav_menu('transparencia_navigation')) :
				wp_nav_menu(['theme_location' => 'transparencia_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']);
				endif;
				?>
		  </div>
		</div>
	</div>	

	<div class="inner">
		<div class="thumbnail">
			<?php
				$the_ID = 11237; 
				if ( has_post_thumbnail( $the_ID ) ) {
		        echo '<a href="' . get_permalink( $the_ID ) . '" title="Transparencia">';
		        echo get_the_post_thumbnail( $the_ID, array(500, 290) );
		        echo '</a>';
		    	}
			?>
			
			<div class="caption">
				<h3>Participa</h3>
				<p>Únete y haz sentir tu voz en nuestra comunidad.</p>
				<?php
				if (has_nav_menu('participa_navigation')) :
				wp_nav_menu(['theme_location' => 'participa_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']);
				endif;
				?>
			</div>
		</div>
	</div>	

	<div class="inner">
		<div class="thumbnail">
			<?php
				$the_ID = 11266; 
				if ( has_post_thumbnail( $the_ID ) ) {
		        echo '<a href="' . get_permalink( $the_ID ) . '" title="Colabora">';
		        echo get_the_post_thumbnail( $the_ID, array(500, 290) );
		        echo '</a>';
		    	}
			?>
			<div class="caption">
		   		<h3>Colabora</h3>
		    	<p>Contribuye con el esfuerzo por trabajar por mejorar el agro en el país.</p>
		    	<?php
				if (has_nav_menu('colabora_navigation')) :
				wp_nav_menu(['theme_location' => 'colabora_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']);
				endif;
				?>
		  	</div>
		</div>
	</div>	

	<div class="inner">
		<div class="thumbnail">
			<?php
				$the_ID = 11273; 
				if ( has_post_thumbnail( $the_ID ) ) {
		        echo '<a href="' . get_permalink( $the_ID ) . '" title="Herramientas">';
		        echo get_the_post_thumbnail( $the_ID, array(500, 290) );
		        echo '</a>';
		    	}
			?>
			<div class="caption">
		   		<h3>Desarrolla</h3>
		    	<p>Brindamos las herramientas que necesitas para abrir datos.</p>
		    	<?php
				if (has_nav_menu('desarrolla_navigation')) :
				wp_nav_menu(['theme_location' => 'desarrolla_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']);
				endif;
				?>
		  	</div>
		</div>
	</div>					
</div>