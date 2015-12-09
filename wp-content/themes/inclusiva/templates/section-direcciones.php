<section class="src__detalles">
<?php while (have_posts()) : the_post(); ?>
  	<div class="page-header">
	  <h1>Sobre la Dirección</h1>
	</div>
  	<?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
</section>

<section class="pry__news">
	<div class="page-header">
		<h3>Noticias de la Dirección</h3>
	</div>
	<?php get_template_part('templates/view', 'direcciones-news-list'); ?>
</section>