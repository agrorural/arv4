<?php
	// ACF Archive Page
	$cnv__year = get_field('cnv__year');
	global $paged;
	global $wp_query;
?>

<?php
	$temp = $wp_query; 
	$wp_query = null; 
	$wp_query = new WP_Query(); 
	$wp_query->query('post_type=convocatorias&posts_per_page=5&cat-convocatorias=ar-aliados-2&year='. $cnv__year .'&paged='.$paged);
	while ($wp_query->have_posts()) : $wp_query->the_post(); 
?>

<?php get_template_part('templates/content', 'convocatorias-list'); ?>

<?php endwhile; ?>

    <?php wp_pagenavi(); ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp; 
?>

<?php
	$temp = $wp_query; 
	$wp_query = null; 
	$wp_query = new WP_Query(); 
	$wp_query->query('post_type=convocatorias&posts_per_page=5&cat-convocatorias=ar-pipmirs&year='. $cnv__year .'&paged='.$paged);
	while ($wp_query->have_posts()) : $wp_query->the_post(); 
?>

<?php get_template_part('templates/content', 'convocatorias-list'); ?>

<?php endwhile; ?>

    <?php wp_pagenavi(); ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp; 
?>

<?php
	$temp = $wp_query; 
	$wp_query = null; 
	$wp_query = new WP_Query(); 
	$wp_query->query('post_type=convocatorias&posts_per_page=5&cat-convocatorias=ar-pssa&year='. $cnv__year .'&paged='.$paged);
	while ($wp_query->have_posts()) : $wp_query->the_post(); 
?>

<?php get_template_part('templates/content', 'convocatorias-list'); ?>

<?php endwhile; ?>

    <?php wp_pagenavi(); ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp; 
?>

<?php
	$temp = $wp_query; 
	$wp_query = null; 
	$wp_query = new WP_Query(); 
	$wp_query->query('post_type=convocatorias&posts_per_page=5&cat-convocatorias=ar-cap&year='. $cnv__year .'&paged='.$paged);
	while ($wp_query->have_posts()) : $wp_query->the_post(); 
?>

<?php get_template_part('templates/content', 'convocatorias-list'); ?>

<?php endwhile; ?>

    <?php wp_pagenavi(); ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp; 
?>