<header class="banner navbar navbar-default navbar-sub" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".nav-pssa">
        <span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <nav class="collapse navbar-collapse nav-pssa" role="navigation">
      <?php
      if (has_nav_menu('pry_pssa_navigation')) :
        wp_nav_menu(['theme_location' => 'pry_pssa_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-justified']);
      endif;
      ?>
    </nav>
  </div>
</header>