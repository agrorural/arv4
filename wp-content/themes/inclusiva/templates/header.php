<?php
  // This file assumes that you have included the nav walker from https://github.com/twittem/wp-bootstrap-navwalker
  // somewhere in your theme.
?>

<header class="super-header">
  <div class="container">
   <nav class="collapse" role="navigation">
      <?php
        if (has_nav_menu('links_nav_left')) :
          wp_nav_menu(['theme_location' => 'links_nav_left', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav navbar-left navbar-links']);
        endif;
      ?> 
      <?php
      if (has_nav_menu('links_nav_right')) :
        wp_nav_menu(['theme_location' => 'links_nav_right', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav navbar-right navbar-links']);
      endif;
      ?>

</nav>
  </div>
</header>

<header class="banner navbar navbar-default navbar-static-top navbar-branding" role="banner">
  <div class="container">
    <div class="navbar-header minagri">
      <h1 class="navbar-brand minagri">
        <a class="logo" href="http://www.minagri.gob.pe">
          <span>Minagri</span>
        </a>
      </h1>
    </div>

    <div class="navbar-header agrorural">
      <div class="wrapper">
        <?php
          if (has_nav_menu('social_navigation')) :
          wp_nav_menu(['theme_location' => 'social_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav navbar-left navbar-social']);
          endif;
        ?>
        <h1 class="navbar-brand agrorural">
          <a class="logo" href="<?= esc_url(home_url('/')); ?>">
            <span><?php bloginfo('name'); ?></span>
          </a>
        </h1>
        <div class="ht__brand">
          <a href="https://twitter.com/hashtag/AgroSomosTodos" target="_blank">#AgroSomosTodos</a>
        </div>
      </div>
    </div>

    <div class="navbar-form">
      <?php get_search_form(); ?>
    </div>
  </div>
</header>

<header class="banner navbar navbar-default navbar-static-top navbar-main" role="banner">
  <div class="container">
      <nav class="" role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav']);
        endif;
        ?>
        <?php
        if (has_nav_menu('primary_nav_left')) :
          wp_nav_menu(['theme_location' => 'primary_nav_left', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav']);
        endif;
        ?>
        <?php
        if (has_nav_menu('primary_nav_right')) :
          wp_nav_menu(['theme_location' => 'primary_nav_right', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav']);
        endif;
        ?>
      </nav>

  </div>
</header>