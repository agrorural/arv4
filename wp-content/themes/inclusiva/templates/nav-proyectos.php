<?php	
	global $post; 
	$parent = array_reverse(get_post_ancestors($post->ID));
	$parent_ID = isset($parent[1]) ? $parent[1] : null;
	$first_parent = get_page($parent_ID);
	$parent_page_ID = $first_parent->ID;

	$pry__tag = get_field('pry__tag', $parent_page_ID); 
	$tag_by_ID = get_term_by('id', $pry__tag, 'post_tag');
	$tag__slug = $tag_by_ID->slug;
?>

<header class="banner navbar navbar-default navbar-sub" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="<?php echo '.'.$tag__slug.'-nav'; ?>">
        <span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <nav class="<?php echo 'collapse navbar-collapse '.$tag__slug.'-nav'; ?>" role="navigation">
      <?php
      if (has_nav_menu('pry_'.$tag__slug.'_navigation')) :
        wp_nav_menu(['theme_location' => 'pry_'.$tag__slug.'_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-justified']);
      endif;
      ?>
    </nav>
  </div>
</header>