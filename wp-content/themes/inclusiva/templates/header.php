<?php
  // This file assumes that you have included the nav walker from https://github.com/twittem/wp-bootstrap-navwalker
  // somewhere in your theme.
?>
<header class="super-header">
  <div class="container">
   <nav class="collapse" role="navigation"> 
      <ul class="nav navbar-nav navbar-date">
        <li><p class="navbar-brand"><?php echo date_i18n('l, j \d\e F \d\e Y', time()); ?></p></li>
      </ul>

      <div class="navbar-form navbar-right navbar-search"><?php get_search_form(); ?></div>
      
       <?php
      if (has_nav_menu('social_navigation')) :
        wp_nav_menu(['theme_location' => 'social_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav navbar-right navbar-social']);
      endif;
      ?>
    
      <?php
      if (has_nav_menu('links_navigation')) :
        wp_nav_menu(['theme_location' => 'links_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav navbar-right navbar-links']);
      endif;
      ?>

</nav>
  </div>
</header>

<header class="banner navbar navbar-default navbar-static-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button> 
      <h1 class="navbar-brand agrorural"><a href="<?= esc_url(home_url('/')); ?>"><span><?php bloginfo('name'); ?></span></a></h1>
      <h1 class="navbar-brand minagri"><a href="http://www.minagri.gob.pe"><span>Minagri</span></a></h1>
    </div>

    <nav class="collapse navbar-collapse" role="navigation">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav navbar-right']);
      endif;
      ?>
    </nav>
  </div>
</header>
