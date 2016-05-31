<?php 
	global $post; 
	$term_list = wp_get_post_terms($post->ID, 'tipos', array("fields" => "all")); 
	$term__slug = $term_list[0]->slug; 
	//echo $term__slug;
?>
	<section class="widget">
		<h3>Búsqueda</h3>
		<?php get_search_form(); ?>
	</section>
    <?php if (has_nav_menu('doc_'.$term__slug.'_navigation')) { ?>
    <section class="widget">
		<h3>Archivo por años</h3>
		<?php wp_nav_menu(['theme_location' => 'doc_'.$term__slug.'_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']); ?>
	</section>
	<?php } ?>