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


<?php
	global $paged;
	global $wp_query;
	$temp = $wp_query; 
	$wp_query = null; 
	$wp_query = new WP_Query(); 
	$wp_query->query('post_type=producto&posts_per_page=12&paged='.$paged);
	while ($wp_query->have_posts()) : $wp_query->the_post(); 
?>
  <?php get_template_part('templates/content', 'producto'); ?>
<?php endwhile; ?>

<?php wp_pagenavi(); ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp; 
?>