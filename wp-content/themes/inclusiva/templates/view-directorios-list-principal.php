<h3>Órganos de Dirección</h3>

<?php
	global $paged;
	global $wp_query;
	$temp = $wp_query; 
	$wp_query = null; 
	$wp_query = new WP_Query(); 
	$wp_query->query('post_type=directorios&posts_per_page=-1&grupos=organos-de-direccion&paged='.$paged);
	while ($wp_query->have_posts()) : $wp_query->the_post(); 
?>

<?php get_template_part('templates/content', 'directorios-list'); ?>

<?php endwhile; ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp; 
?>

<h3>Órgano de Control</h3>

<?php
	global $paged;
	global $wp_query;
	$temp = $wp_query; 
	$wp_query = null; 
	$wp_query = new WP_Query(); 
	$wp_query->query('post_type=directorios&posts_per_page=-1&grupos=organo-de-control&paged='.$paged);
	while ($wp_query->have_posts()) : $wp_query->the_post(); 
?>

<?php get_template_part('templates/content', 'directorios-list'); ?>

<?php endwhile; ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp; 
?>

<h3>Órganos de Apoyo</h3>

<?php
	global $paged;
	global $wp_query;
	$temp = $wp_query; 
	$wp_query = null; 
	$wp_query = new WP_Query(); 
	$wp_query->query('post_type=directorios&posts_per_page=-1&grupos=organos-de-apoyo&paged='.$paged);
	while ($wp_query->have_posts()) : $wp_query->the_post(); 
?>

<?php get_template_part('templates/content', 'directorios-list'); ?>

<?php endwhile; ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp; 
?>

<h3>Órganos de Asesoramiento</h3>

<?php
	global $paged;
	global $wp_query;
	$temp = $wp_query; 
	$wp_query = null; 
	$wp_query = new WP_Query(); 
	$wp_query->query('post_type=directorios&posts_per_page=-1&grupos=organos-de-asesoramiento&paged='.$paged);
	while ($wp_query->have_posts()) : $wp_query->the_post(); 
?>

<?php get_template_part('templates/content', 'directorios-list'); ?>

<?php endwhile; ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp; 
?>

<h3>Órganos de Línea</h3>

<?php
	global $paged;
	global $wp_query;
	$temp = $wp_query; 
	$wp_query = null; 
	$wp_query = new WP_Query(); 
	$wp_query->query('post_type=directorios&posts_per_page=-1&grupos=organos-de-linea&paged='.$paged);
	while ($wp_query->have_posts()) : $wp_query->the_post(); 
?>

<?php get_template_part('templates/content', 'directorios-list'); ?>

<?php endwhile; ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp; 
?>

<h3>Órganos de Desconcentrados</h3>

<?php
	global $paged;
	global $wp_query;
	$temp = $wp_query; 
	$wp_query = null; 
	$wp_query = new WP_Query(); 
	$wp_query->query('post_type=directorios&posts_per_page=-1&grupos=organos-desconcentrados&paged='.$paged);
	while ($wp_query->have_posts()) : $wp_query->the_post(); 
?>

<?php get_template_part('templates/content', 'directorios-list'); ?>

<?php endwhile; ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp; 
?>