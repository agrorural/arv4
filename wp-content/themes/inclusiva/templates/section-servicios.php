<?php 
$args = array(
	'post_type' => 'servicios',
	'tax_query' => array(
		array(
			'taxonomy' => 'condiciones',
			'field'    => 'slug',
			'terms'    => 'serviagro',
		),
	),
	'orderby'	=> 'title',
	'order'		=>	'ASC',
	'posts_per_page' => -1
);

// the query
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>

	<!-- pagination here -->
	<div class="wrapper">
		<!-- the loop -->
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php get_template_part('templates/content', 'servicios'); ?>
		<?php endwhile; ?>
		<!-- end of the loop -->
	</div>
	<!-- pagination here -->

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>