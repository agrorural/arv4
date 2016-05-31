<?php 
	global $post; 
	$term_list = wp_get_post_terms($post->ID, 'tipos', array("fields" => "all")); 
	$term__slug = $term_list[0]->slug; 
	//echo $term__slug;
?>
	<section class="widget">
	<h3>Búsqueda</h3>
		<form role="search" method="get" class="sidebar-search-form" action="<?= esc_url(home_url('/')); ?>">
		<input type="hidden" name="post_type" value="documentos" />
	  	<label class="sr-only"><?php _e('Search for:', 'sage'); ?></label>
	    <input type="search" value="<?= get_search_query(); ?>" name="s" class="search-field form-control" placeholder="Busque su documento" required>
		</form>
	</section>
    <?php if (has_nav_menu('doc_'.$term__slug.'_navigation')) { ?>
    <section class="widget">
		<h3>Archivo por años</h3>
		<?php wp_nav_menu(['theme_location' => 'doc_'.$term__slug.'_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']); ?>
	</section>
	<?php } ?>