<?php $video__id = get_field('video__id'); ?>
<figure <?php post_class(); ?>>
	<?php if ($video__id) {?>
		<div class="multimedia--1__video">
			<iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo $video__id; ?>" frameborder="0" allowfullscreen></iframe>
		</div>
	<?php } ?>

	<figcaption class="multimedia--1__caption">
		<h3 class="multimedia--1__caption__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php get_template_part('templates/entry-meta'); ?>
		<?php the_content(); ?>
	</figcaption>
</figure>