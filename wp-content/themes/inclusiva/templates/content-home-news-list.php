<article <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ){ ?>
		<figure>
			<?php the_post_thumbnail('thumb-news-list', array('class'=>'img-responsive')); ?>
		</figure>
	<?php } ?>
  <header>
  	<?php get_template_part('templates/entry-meta'); ?>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  </header>
</article>
