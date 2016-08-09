<?php use Roots\Sage\Titles; ?>

<div class="page-header">
	<?php if (function_exists('custom_breadcrumbs')) { custom_breadcrumbs(); } ?>
	<?php if ( is_page('Contacto') ) {?>
	<?php } else if ( get_post_type() != 'post' || is_404() || is_search() ) {?>
  		<h1><?= Titles\title(); ?></h1>
  	<?php }else { ?>
  		<h1><a href="<?php echo bloginfo( 'url' ); ?>/noticias">Noticias<small><a href="<?php bloginfo('rss2_url'); ?>"><i class="fa fa-rss-square"></i> RSS de las noticias</a></small></h1>
	<?php }?>
</div>