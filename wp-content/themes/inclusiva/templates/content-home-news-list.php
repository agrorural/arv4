<article <?php post_class(); ?>>
	<?php 
		global $post;
		$format = get_post_format();
		$has__format = has_post_format($format,$post->post_id);
		$format__link = get_post_format_link( $format );
	?>
	<?php if ( has_post_thumbnail() ){ ?>
		<figure>
			<?php if ( $has__format ){ ?>
				<a title="<?php echo 'Contiene '.$format; ?>" href="<?php the_permalink(); ?>" class="format-icon tip">
					<i class="fa fa-<?php echo $format; ?>"></i>
				</a>
			<?php } ?>
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('thumb-news-list', array('class' => 'img-responsive')); ?>
			</a>
		</figure>
	<?php } ?>
  <header>
  	<?php get_template_part('templates/entry-meta'); ?>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  </header>
</article>
