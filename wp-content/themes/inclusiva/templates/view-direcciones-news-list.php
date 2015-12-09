<?php
	// ACF Format Link 
	$the_title = get_the_title();
	$cat_ID = get_cat_ID( $the_title );

	global $paged;
	global $wp_query;
	$temp = $wp_query; 
	$wp_query = null; 
	$wp_query = new WP_Query(); 
	$wp_query->query('posts_per_page=5&post_type=post&cat='.$cat_ID.'&paged='.$paged);
	while ($wp_query->have_posts()) : $wp_query->the_post(); 
?>

<?php get_template_part('templates/content', 'news-list'); ?>

<?php endwhile; ?>

    <?php wp_pagenavi(); ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp; 
?>