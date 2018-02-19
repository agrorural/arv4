<?php // ACF Directorios List
	$dir_base = get_field('dir_base');
	// echo $dir_base;
?>
<section class="ap__list panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<?php if ( $dir_base && $dir_base == 'principal' ) {?>
		<?php get_template_part('templates/view', 'directorios-list-principal'); ?>
	<?php } else { ?>
		<?php get_template_part('templates/view', 'directorios-list'); ?>
	<?php } ?>
</section>