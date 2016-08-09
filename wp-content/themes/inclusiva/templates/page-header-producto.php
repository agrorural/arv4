<?php use Roots\Sage\Titles; ?>
	<div class="page-header">
		<?php if (function_exists('custom_breadcrumbs')) { custom_breadcrumbs(); } ?>
		<h1 class=""><a href="<?php echo get_post_type_archive_link( 'producto'); ?>">Productos</a></h1>
	</div>