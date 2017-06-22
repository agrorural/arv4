<?php
	global $post;
	$format = get_post_format();
	$has__format = has_post_format($format,$post->post_id);
	$format__link = get_post_format_link( $format );

	switch ($format) {
	case "image":
			$format__text = "galería";
			$format__icon = "camera";
			break;
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
<article <?php post_class('article-list'); ?>>
	<div class="entry-container">
		<?php if ( has_post_thumbnail() ){ ?>
			<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false ); ?>
    	<header class="entry-left" style="">
    		<a href="<?php the_permalink(); ?>">
	    		<div class="entry-left-container" style="background-image: url('<?php echo $image[0]; ?>'); background-repeat:  no-repeat; background-position: top left; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
						<?php if ( $has__format ){ ?>			
							<i class="fa fa-<?php echo $format__icon; ?>"></i>
						<?php } ?>
	    		</div>
    		</a>
    	</header>
		<?php } ?>
		<div class="entry-body ">
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
			<?php get_template_part('templates/entry-meta'); ?>
			<div class="post-meta">
				<div class="post-date">
					<a href="<?php the_permalink(); ?>" class="">Seguir leyendo</a>
				</div>
				<div class="post-comments">
					<?php get_template_part('templates/sharing', 'v2'); ?>
				</div>
			</div>
	  </div>
	</div>
</article>
