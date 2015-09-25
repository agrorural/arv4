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
				<p>AGRO RURAL da a conocer las acciones que realiza y como se utilizan los recursos públicos, a la vez que promueve la innovación, para lo cual publica la información y los datos que genera a través de herramientas como el Portal de Transparencia Estándar, Portal de Datos Abiertos, sistema de acceso a la información pública, etc.</p>
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
				<p>AGRO RURAL a través de las redes sociales y el uso de plataformas participativas busca implicar a la ciudadanía, servidores civiles, organizaciones de la sociedad civil y otras instituciones públicas para mejorar el diseño e implementación de las políticas públicas para el desarrollo agrario rural.</p>				<?php
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
		    	<p>AGRO RURAL promueve la colaboración activa con otras instituciones públicas, privadas, sociedad civil y ciudadanos a través de herramientas para mejorar los servicios que proporcionan a los pequeños y medianos agricultores en su ámbito de competencia.</p>
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
		    	<p>Compartimos las herramientas que necesitas para usar o reutilizar los datos, asimismo para que puedas poner a disposición de la comunidad tus contribuciones, sea para desarrollar servicios con fines sociales o comerciales.</p>
		    	<?php
				if (has_nav_menu('desarrolla_navigation')) :
				wp_nav_menu(['theme_location' => 'desarrolla_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']);
				endif;
				?>
		  	</div>
		</div>
	</div>					
</div>