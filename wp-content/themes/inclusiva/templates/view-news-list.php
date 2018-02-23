<?php
$args = array(
	'post_type' => 'post',
	'posts_per_page' => 4,
	'tag__not_in'=>array('47', '196', '150') //Oculta las entradas del AIAF, CSST, Aliados II
	);
// the query
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>

	<!-- pagination here -->

	<!-- the loop -->
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<?php get_template_part('templates/content', 'home-news-list'); ?>
	<?php endwhile; ?>
	<!-- end of the loop -->
	<!-- pagination here -->

	<?php wp_reset_postdata(); ?>
<?php else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
