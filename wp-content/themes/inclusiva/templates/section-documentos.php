<?php
	$doc__tipo = get_field('doc__tipo');
	$term = get_term( $doc__tipo, 'tipos' );
	$term__slug = $term->slug;
?>

<section class="ap__list">
	<?php if ( $term__slug && $term__slug == 'rdc' || $term__slug && $term__slug == 'ira' || $term__slug && $term__slug == 'add' || $term__slug && $term__slug == 'at' ){ ?>
		<?php get_template_part('templates/view', 'documentos-pack-list'); ?>
	<?php }else{ ?>
		<?php get_template_part('templates/view', 'documentos-list'); ?>
	<?php } ?>
</section>
