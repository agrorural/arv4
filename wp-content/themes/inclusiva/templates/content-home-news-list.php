<article <?php post_class('media'); ?>>
	<?php 
		global $post;
		$format = get_post_format();
		$has__format = has_post_format($format,$post->post_id);
		$format__link = get_post_format_link( $format );
	?>
	<div class="media-left">
		<a href="<?php the_permalink(); ?>">
			<?php if ( has_post_thumbnail() ) { ?>
				<?php the_post_thumbnail('thumb-news-list'); ?>
			<?php }else { ?>
				<?php echo  '<img src="'.default_thumb('', 'news-feed-thumb').'" width="84" height="84" />'; ?>
			<?php } ?>
		</a>
		<?php if ($format) {?>
			<div class="icon-format">
				<a class="" href="<?php echo $format__link; ?>" title=""><i class="icon <?php echo $format; ?>"></i></a>
			</div>
		<?php } ?>
	</div> 
	<header class="media-body">
			<h4 class="media-heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<?php get_template_part('templates/entry-meta'); ?>
	</header>
</article>
