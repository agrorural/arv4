<?php use Roots\Sage\Titles; ?>

<div class="page-header">
	<?php if (function_exists('custom_breadcrumbs')) { custom_breadcrumbs(); } ?>
	<h1><a href="<?php echo bloginfo( 'url' ); ?>/noticias">Noticias</a><small><a href="<?php bloginfo('rss2_url'); ?>"><i class="fa fa-rss-square"></i> RSS de las noticias</a></small></h1>
</div>
