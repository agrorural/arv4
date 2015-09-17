<?php while (have_posts()) : the_post(); ?>
	<?php if ( is_page('gobierno-abierto') ){ ?>
  		<?php get_template_part('templates/content', 'page-gobierno-abierto'); ?>
  	<?php }else{ ?>
  		<?php get_template_part('templates/content', 'page'); ?>
  	<?php } ?>
<?php endwhile; ?>
