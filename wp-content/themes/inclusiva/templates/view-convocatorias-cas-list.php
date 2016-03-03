<?php
	// Globals
	global $paged;
	global $wp_query;
	$post__date = mysql2date("Y", $post->post_date_gmt);

	$temp = $wp_query; 
	$wp_query = null; 
	$wp_query = new WP_Query(); 
	$wp_query->query('post_type=convocatorias&posts_per_page=20&cat-convocatorias=ar-1057&year='. $post__date .'&paged='.$paged);
	while ($wp_query->have_posts()) : $wp_query->the_post(); 
?>

<?php get_template_part('templates/content', 'convocatorias-list'); ?>

<?php endwhile; ?>

    <?php wp_pagenavi(); ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp; 
?>