<?php 
$args = array(
	'post_type' => 'post',
	'posts_per_page' => 5
	);
// the query
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>

	<!-- pagination here -->

	<!-- the loop -->
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<?php get_template_part('templates/content', 'news-list'); ?>
	<?php endwhile; ?>
	<!-- end of the loop -->
	<p><a href="<?php echo bloginfo( 'url' ); ?>/noticias" class="cta__link">Ver todo</a></p>
	<!-- pagination here -->

	<?php wp_reset_postdata(); ?>
<?php else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>