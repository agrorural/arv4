<?php 
$args = array(
	'post_type' => 'servicios',
	'tax_query' => array(
		array(
			'taxonomy' => 'condiciones',
			'field'    => 'slug',
			'terms'    => 'en-linea',
		),
	),
	'posts_per_page' => 4
);

// the query
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>

	<!-- pagination here -->
	<div class="wrapper">
		<!-- the loop -->
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php get_template_part('templates/content', 'page-servicios-en-linea'); ?>
		<?php endwhile; ?>
		<!-- end of the loop -->
	</div>
	<!-- pagination here -->

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>