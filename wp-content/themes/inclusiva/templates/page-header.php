<?php use Roots\Sage\Titles; ?>

<div class="page-header">
	<?php if ( is_page('Contacto') ) {?>
		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15605.896965231093!2d-77.0425728!3d-12.0796521!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6f311078be8946fa!2sAGRO+RURAL!5e0!3m2!1ses-419!2spe!4v1443559449840" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
	<?php } else if ( get_post_type() != 'post' || is_404() ) {?>
  		<h1><?= Titles\title(); ?></h1>
  	<?php }else { ?>
  		<h1><a href="<?php echo bloginfo( 'url' ); ?>/noticias">Noticias<small><a href="<?php bloginfo('rss2_url'); ?>"><i class="fa fa-rss-square"></i> RSS de las noticias</a></small></h1>
	<?php }?>
</div>