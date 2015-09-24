<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/view', 'page-servicios-en-linea'); ?>
<?php endwhile; ?>
