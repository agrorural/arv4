<article <?php post_class(); ?>>
	<?php 
		global $post;
		$format = get_post_format();
		$has__format = has_post_format($format,$post->post_id);
		$format__link = get_post_format_link( $format );

		switch ($format) {
		case "gallery":
		    $format__text = "galería";
		    $format__icon = "camera";
		    break;
		case "video":
		    $format__text = "video";
		    $format__icon = "play";
		    break;
		}
	?>
	<?php if ( has_post_thumbnail() ){ ?>
		<figure>
			<?php if ( $has__format ){ ?>
				<a title="<?php echo 'Contiene '.$format__text; ?>" href="<?php the_permalink(); ?>" class="format-icon tip">
					<span class="fa-stack fa-lg">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-<?php echo $format__icon; ?> fa-stack-1x fa-inverse"></i>
					</span>
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
