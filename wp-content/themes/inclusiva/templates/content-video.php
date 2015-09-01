<figure <?php post_class(); ?>>
	<a href="<?php the_permalink(); ?>" class="multimedia--2__icon"><i class="fa fa-youtube-play"></i></a>
		<?php if ( has_post_thumbnail() ){?>
			<?php the_post_thumbnail('thumb-videos', array('class' => 'img-responsive')); ?>
		<?php } else { ?>
			<img src="http://lorempixel.com/400/230/sports/1/" class="img-responsive" />
		<?php } ?>
	<figcaption class="multimedia--2__caption">
		<?php get_template_part('templates/entry-meta'); ?>
		<h3 class="multimedia--2__caption__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	</figcaption>
</figure>