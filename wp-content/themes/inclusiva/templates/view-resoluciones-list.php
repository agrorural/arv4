<?php
	// ACF Archive Page
	$res__tipo = get_field('res__tipo');
	$term = get_term( $res__tipo, 'tipos' );
	$term__name = $term->name;

	global $paged;
	global $wp_query;
	$temp = $wp_query; 
	$wp_query = null; 
	$wp_query = new WP_Query(); 
	$wp_query->query('post_type=resoluciones&posts_per_page=10&tipos='. $term__name .'&paged='.$paged);
	while ($wp_query->have_posts()) : $wp_query->the_post(); 
?>

<?php get_template_part('templates/content', 'resoluciones-list'); ?>

<?php endwhile; ?>

    <?php wp_pagenavi(); ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp; 
?>