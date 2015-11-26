<?php
/**
 * Template Name: Template Noticias
 */
?>

<?php query_posts('post_type=post&post_status=publish&posts_per_page=10&paged='. get_query_var('paged')); ?>

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
