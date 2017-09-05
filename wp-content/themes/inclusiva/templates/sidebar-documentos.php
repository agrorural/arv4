<?php
	global $post,  $wp_query;
	$page__ID = $wp_query->post->ID;
	$doc__tipo = get_field('doc__tipo', $page__ID);
	$term = get_term( $doc__tipo, 'tipos' );
	$term_list = wp_get_post_terms($post->ID, 'tipos', array("fields" => "all"));
	if (is_page()) {
		$term__slug = $term->slug;
		$term__name = $term->name;
	}else {
		if (count($term_list) > 1) {
			$term__slug = $term_list[1]->slug;
			$term__name = $term_list[1]->name;
		}else {
			$term__slug = $term_list[0]->slug;
			$term__name = $term_list[0]->name;
		}
	}
	//var_dump(is_page_template( 'template-documentos.php' ));
?>
<?php if( $term_list ) : ?>
	<?php if (has_nav_menu('doc_'.$term__slug.'_navigation')) { ?>
		<section class="widget">
		<h3><?php echo $term__name; ?> por años</h3>
		<?php wp_nav_menu(['theme_location' => 'doc_'.$term__slug.'_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']); ?>
		</section>
	<?php } ?>
<?php endif; ?>

<?php if( is_page ( array( 'rendicion-de-cuentas' ) ) ) :
?>

	<?php if (has_nav_menu('doc_pack_navigation')) { ?>
		<section class="widget">
		<h3>Pack Anticorrupción</h3>
		<?php wp_nav_menu(['theme_location' => 'doc_pack_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']); ?>
		</section>
	<?php } ?>

<?php endif; ?>

<?php if( is_page_template( 'template-documentos.php' ) ) : ?>
	<section class="widget">
		<h3>Documentos</h3>
	    <?php
		if (has_nav_menu('doc_navigation')) :
			wp_nav_menu(['theme_location' => 'doc_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']);
		endif;
		?>
	</section>
<?php endif; ?>