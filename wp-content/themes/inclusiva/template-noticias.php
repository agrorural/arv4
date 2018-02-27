<?php
/**
 * Template Name: Template Noticias
 */
?>

<?php 
  $args = array( 
		'post_type' => 'post',
	'posts_per_page' => 4,
	'tag__not_in'=>array('47', '196', '150', '494'), //Oculta las entradas del AIAF, CSST, Aliados II, AgroTIC
		'paged' => get_query_var('paged')
	);
?>

<?php query_posts($args); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'news-list'); ?>
<?php endwhile; ?>

<?php /*the_posts_navigation(); */ ?>
<?php wp_pagenavi(); ?>
