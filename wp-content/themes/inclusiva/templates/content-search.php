<article <?php post_class(); ?>>
	<?php 
		global $post;
		$format = get_post_format();
		$has__format = has_post_format($format,$post->post_id);
		$format__link = get_post_format_link( $format );

		$post_type = get_post_type( get_the_ID());

		switch ($post_type) {
			case 'post':
				$post_type__icon = 'glyphicon-bookmark';
				$post_type__name = 'Noticia';
				break;

			case 'page':
				$post_type__icon = 'glyphicon-book';
				$post_type__name = 'Página';
				break;

			case 'productos':
				$post_type__icon = 'glyphicon-shopping-cart';
				$post_type__name = 'Producto';
				break;

			case 'documentos':
				$post_type__icon = 'glyphicon-duplicate';
				$post_type__name = 'Documento';
				break;

			case 'convocatorias':
				$post_type__icon = 'glyphicon-briefcase';
				$post_type__name = 'Convocatorias';
				break;

			case 'servicios':
				$post_type__icon = 'glyphicon-user';
				$post_type__name = 'Servicios';
				break;

			case 'tribe_events':
				$post_type__icon = 'glyphicon-calendar';
				$post_type__name = 'Eventos';
				break;
			
			default:
				$post_type__icon = 'glyphicon-file';
				$post_type__name = 'Noticia';
				break;
		}

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
    <span class="tip glyphicon <?php echo $post_type__icon; ?> pull-right" aria-hidden="true" title="<?php echo $post_type__name; ?>"></span>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
</article>