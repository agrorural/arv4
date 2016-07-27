<section class="section clasificaciones">
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
	<?php if ( ! empty( $clasificaciones ) && ! is_wp_error( $clasificaciones ) ) : ?>
		<?php foreach ( $clasificaciones as $clasificacion ) : ?>
			<?php 
				$term_link = get_term_link( $clasificacion ); 
				$taxonomy = $clasificacion->taxonomy; $term_id = strval($clasificacion->term_id);
				$clas__img = get_field('clas__img', $taxonomy.'_'.$term_id);

				if ( is_wp_error( $term_link ) ) { continue; }
			?>
			<section class="wrapper">
				<div class="thumbnail">
					<a href="<?php if($term_link){ echo esc_url( $term_link ); } else { echo bloginfo(url); }; ?>">
						<?php if ($clas__img) { ?>
							<?php echo '<img src="'.$clas__img['sizes']['thumb-clasificaciones'].'" />'; ?>
						<?php }else {?>
							<img src="<?php echo get_template_directory_uri(); ?>/dist/images/clasificacion--default.jpg" width="600px" height="350px" class="img-responsive" />
						<?php } ?>
					</a>
				      <div class="caption">
				        <h3><a href="<?php if($term_link){ echo esc_url( $term_link ); } else { echo bloginfo(url); }; ?>"><?php echo $clasificacion->name; ?></a></h3>
				        <p><?php echo $clasificacion->count; ?> productos</p>			
						<?php //var_dump( $clas__img ); ?>
				      </div>
				</div>
			</section>
		<?php endforeach; ?>
	<?php endif; ?>
</section>
