<?php if (is_post_type_archive('producto')) {?>
	<section class="section clasificacion">
			<?php 
			$args = array(
					'taxonomy'	=> 'clasificacion',
					'orderby'	=> 'count',
					'order' 	=>	'DESC',
					'number'	=>	3,
	    			'hide_empty' => false,
			);
			$clasificaciones = get_terms( $args ); 
		?>
			<?php 
				//echo '<pre>';
				//	var_dump($clasificaciones);
				//echo '</pre>';

				if ( ! empty( $clasificaciones ) && ! is_wp_error( $clasificaciones ) ){
			
				    foreach ( $clasificaciones as $clasificacion ) {
				    	$term_link = get_term_link( $clasificacion );
				    	if ( is_wp_error( $term_link ) ) {
					        continue;
					    }
				        echo '<section class="thumbnail col-sm-4"><a href="' . esc_url( $term_link ) . '">' . $clasificacion->name . ' <span>('. $clasificacion->count .')</span></a></section>';
				    }
				}
			?>
	</section>
<?php } ?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'producto'); ?>
<?php endwhile; ?>