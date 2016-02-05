<?php 
// Argumentos
$args  = array(
	'post_type' => 'Banners', 
	'posiciones' => 'Sidebar AIAF',
	'post_per_page' => -1
);
// the query
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>

	<!-- pagination here -->

	<!-- the loop -->
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<figure class="widget archives-2 widget_archive">
			<?php if ( has_post_thumbnail() ){?>
				<?php the_post_thumbnail('thumb-videos', array('class' => 'img-responsive')); ?>
			<?php } ?>
		<figcaption class="textwidget">
			<h3 class="tab-title"><?php the_title(); ?></h3>
			<?php the_content(); ?>
		</figcaption>
		</figure>
	<?php endwhile; ?>
	<!-- end of the loop -->

	<!-- pagination here -->

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>