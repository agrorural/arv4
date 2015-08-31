<?php $video__id = get_field('video__id'); ?>
<article <?php post_class('video-one multimedia'); ?>>
	<?php if ($video__id) {?>
	<div class="multimedia-video">
		<iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo $video__id; ?>" frameborder="0" allowfullscreen></iframe>
	</div>
	<?php } ?>

	<div class="multimedia-content">
		<h2 class="multimedia-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php get_template_part('templates/entry-meta'); ?>
		<?php the_content(); ?>
	</div>
</article>