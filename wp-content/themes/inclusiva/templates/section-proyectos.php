<section class="pry__detalles">
<?php while (have_posts()) : the_post(); ?>
  	<div class="page-header">
	  <h1>Sobre el Proyecto</h1>
	</div>
  	<?php get_template_part('templates/content', 'page'); ?>
  	<p><a href="<?php the_permalink(); ?>el-proyecto" class="cta__link">Más información</a></p>
<?php endwhile; ?>
</section>

<section class="pry__news">
	<div class="page-header">
		<h3>Noticias del Proyecto</h3>
	</div>
	<?php get_template_part('templates/view', 'proyectos-news-list'); ?>
</section>