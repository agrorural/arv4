<header class="banner navbar navbar-default navbar-sub" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".servicios-nav">
        <span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <nav class="<?php echo 'collapse navbar-collapse servicios-nav'; ?>" role="navigation">
      <?php wp_nav_menu(['theme_location' => 'servicios_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-justified']); ?>
    </nav>
  </div>
</header>