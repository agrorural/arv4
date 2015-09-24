<?php
	// ACF Format Link 
	$pry__logo = get_field('pry__logo');
	$pry__tag = get_field('pry__tag'); 
	$tag_by_ID = get_term_by('id', $pry__tag, 'post_tag');
	$tag__name = $tag_by_ID->name; 

	global $paged;
	global $wp_query;
	$temp = $wp_query; 
	$wp_query = null; 
	$wp_query = new WP_Query(); 
	$wp_query->query('posts_per_page=5&post_type=post&tag='.$tag__name.'&paged='.$paged);
	while ($wp_query->have_posts()) : $wp_query->the_post(); 
?>

<?php get_template_part('templates/content', 'news-list'); ?>

<?php endwhile; ?>

    <?php wp_pagenavi(); ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp; 
?>