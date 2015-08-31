<article <?php post_class('multimedia just-video'); ?>>
	<?php if ( has_post_thumbnail() ){ ?>
		<figure>
			<?php if ( has_post_thumbnail() ){?>
				<?php the_post_thumbnail('thumb-videos', array('class' => 'img-responsive')); ?>
			<?php } else { ?>
				<img src="http://lorempixel.com/400/230/sports/1/" class="img-responsive" />
			<?php } ?>
			
			<figcaption>	
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	    		<?php get_template_part('templates/entry-meta'); ?>
			</figcaption>
		</figure>
	<?php }; ?>
</article>