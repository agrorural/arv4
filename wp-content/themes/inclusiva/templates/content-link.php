<?php // ACF Format Link 
	$lnk__medio = get_field('lnk__medio'); 
	$lnk__url = get_field('lnk__url');
?>
<article <?php post_class('article-list'); ?>>
	<figure>
		<a href="<?php echo get_post_format_link('link'); ?>" class="format-icon"><i class="fa fa-link"></i></a>
			<?php if ( has_post_thumbnail() ){?>
				<?php the_post_thumbnail('thumbnail', array('class' => 'img-responsive')); ?>
			<?php } else { ?>
				<img src="http://lorempixel.com/400/230/sports/1/" class="img-responsive" />
			<?php } ?>
	</figure>
	<header>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php get_template_part('templates/entry-meta-link'); ?>
	</header>
	<div class="entry-summary">
		<?php the_content(); ?>
		<p>
			<a href="<?php if ($lnk__url) { echo $lnk__url; } else { echo bloginfo( 'url' ); } ?>" class="cta__link" target="_blank">Ver todo el artículo</a>
		</p>
	</div>
</article>