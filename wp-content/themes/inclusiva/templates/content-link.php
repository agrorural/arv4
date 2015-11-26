<?php // ACF Format Link 
	$lnk__medio = get_field('lnk__medio'); 
	$lnk__url = get_field('lnk__url');
?>
<article <?php post_class('article-list'); ?>>
	
			<?php if ( has_post_thumbnail() ){?>
				<figure>
					<a href="<?php if ($lnk__url) { echo $lnk__url; } else { echo bloginfo( 'url' ); } ?>" title="Abre en una ventana nueva" class="tip format-icon"><i class="fa fa-link"></i></a>
						<?php the_post_thumbnail('thumbnail', array('class' => 'img-responsive')); ?>
				</figure>
			<?php } ?>

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