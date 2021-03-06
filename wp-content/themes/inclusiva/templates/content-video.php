<figure <?php post_class(); ?>>
	<a href="<?php the_permalink(); ?>">
		<div class="media-img">
			<i class="fa fa-play"></i>
			<?php if ( has_post_thumbnail() ){?>
				<?php the_post_thumbnail('thumb-videos', array('class' => 'img-responsive')); ?>
			<?php } ?>
		</div>
		<figcaption>
			<?php get_template_part('templates/entry-meta'); ?>
			<h3 class="multimedia--2__caption__title"><?php the_title(); ?></h3>
		</figcaption>
	</a>
</figure>
