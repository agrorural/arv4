<?php
	global $post;
	$term_list = wp_get_post_terms($post->ID, 'tipos', array("fields" => "all"));
	if($term_list){
			$term__slug = $term_list[0]->slug;
	}
	// echo '<pre>';
	// var_dump($term__list);
	// echo '</pre>';
?>
<?php if( $term_list ) : ?>
	<?php if (has_nav_menu('doc_'.$term__slug.'_navigation')) { ?>
		<section class="widget">
		<h3>Archivo por años</h3>
		<?php wp_nav_menu(['theme_location' => 'doc_'.$term__slug.'_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']); ?>
		</section>
	<?php } ?>
<?php endif; ?>

<?php if( is_page (
									array(
													'rendicion-de-cuentas'
												)
									)
				) :
?>

	<?php if (has_nav_menu('doc_pack_navigation')) { ?>
		<section class="widget">
		<h3>Pack Anticorrupción</h3>
		<?php wp_nav_menu(['theme_location' => 'doc_pack_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']); ?>
		</section>
	<?php } ?>

<?php endif; ?>
