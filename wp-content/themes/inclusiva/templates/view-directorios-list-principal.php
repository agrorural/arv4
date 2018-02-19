<?php
	global $paged;
	global $wp_query;
	$temp = $wp_query; 
	$wp_query = null; 
	$wp_query = new WP_Query();
	$args = array( 
		'post_type' => 'directorios',
		'posts_per_page' => -1,
		'orderby' => 'menu_order title',
		'order' => 'ASC',
		'paged' => $paged
	);
	$wp_query->query($args);
	$group = "";
	while ($wp_query->have_posts()) : $wp_query->the_post();
?>

<?php
	$terms = wp_get_object_terms($post->ID, 'grupos');
	if(!empty($terms)){
		$loopTerm = $terms[0]->name;

	  if( $group !== $loopTerm ){
		echo '<h3 class="ap__list__title">'. $loopTerm .'</h3>';
	
		$group = $loopTerm;
	  }
	}
?>

<?php get_template_part('templates/content', 'directorios-list'); ?>

<?php endwhile; ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp; 
?>