<?php 

// Argumentos
$args  = array(
	'post_type' => 'Banners', 
	'posiciones' => 'Slider Footer',
	'post_per_page' => -1
);
// the query
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>
	<div class="owl-carousel sl__footer">

	<!-- pagination here -->

	<!-- the loop -->
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<?php // ACF 
			$banner__url = get_field('banner__url'); 
		?>
		<div class="item">
			<a href="<?php if ($banner__url) { echo $banner__url; } else { echo bloginfo( 'url' ); } ?>" target="_blank">
				<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
			</a>
		</div>
	<?php endwhile; ?>
	<!-- end of the loop -->

	<!-- pagination here -->

	<?php wp_reset_postdata(); ?>
	</div>
<?php else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>