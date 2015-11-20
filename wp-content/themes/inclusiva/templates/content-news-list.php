<article <?php post_class('article-list'); ?>>
<?php 
	global $post;
	$format = get_post_format();
	$format__link = get_post_format_link( $format );
?>

<?php $has__format = has_post_format($format,$post->post_id); ?>
	<figure>
	<?php if ( $has__format ){ ?>
		<a title="<?php echo $format; ?>" href="<?php echo $format__link;?>" class="format-icon tip">
			<i class="fa fa-<?php echo $format; ?>"></i>
		</a>
	<?php } ?>
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
		<?php the_excerpt(); ?>
	</div>
</article>