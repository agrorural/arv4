<?php
/**
 * Template Name: Template Media
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>

<?php
	/*Datos del parent page*/
	$parent = array_reverse(get_post_ancestors($post->ID));
	$first_parent = get_page($parent[1]);
	$parent_page_ID = $first_parent->ID;
	$pry__tag = get_field('pry__tag', $parent_page_ID);
	$tag_by_ID = get_term_by('id', $pry__tag, 'post_tag');
	$tag__slug = $tag_by_ID->slug;

	$med__tipo = get_field( "med__tipo" );

	if ($med__tipo == 'Fotos') {
		$med__tipo = 'post-format-gallery';
	}else{
		$med__tipo = 'post-format-video';
	}
?>


<?php
	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

	$args = array(
		'post_type' => 'post',
		'tax_query' => array(
			array(
				'taxonomy' => 'post_format',
				'field'    => 'slug',
				'terms'    => array( $med__tipo ),
			)
		),
    'tag' => $tag__slug,
		'posts_per_page' => 10,
		'paged' => $paged

	);
?>

<?php
// the query
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>

	<!-- pagination here -->
	<div class="multimedia">
		<!-- the loop -->
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php get_template_part('templates/content', get_post_format()); ?>
		<?php endwhile; ?>
		<!-- end of the loop -->
	</div>
	<?php wp_pagenavi(); ?>
	<!-- pagination here -->

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
