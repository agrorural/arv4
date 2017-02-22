<?php

use Roots\Sage\Config;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
  <?php get_template_part('lib/ga'); ?>
    <!--[if lt IE 9]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php if(is_page('redes-sociales')) {?>
      <div id="fb-root"></div>
      <!--script para Facebook -->
      <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.5";
      fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Twitter -->
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

      <!-- Google + -->
      <script src="https://apis.google.com/js/platform.js" async defer></script>
    <?php } ?>
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <?php  global $post; ?>
    <?php get_template_part('templates/masshead'); ?>

    <div class="wrap container" role="document">
      <div class="content row">
        <main class="main" role="main">
        <div class="wrapper">
          <?php if (is_page('pack-anticorrupcion')){ ?>
            <?php
            $pages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );
            foreach( $pages as $page ) {    
              $content = $page->post_content;
              if ( ! $content ) // Check for empty page
                continue;

              $content = apply_filters( 'the_content', $content );
            ?>
            <div class="inner">
               <article>
                  <h2><a href="<?php echo get_page_link( $page->ID ); ?>"><?php echo $page->post_title; ?></a></h2>
                  <div class="entry">
                    <?php echo $content; ?>
                  </div>
                </article> 
            </div>
              
            <?php
            } 
          ?>
        </div>
        <?php }else { ?>
          <?php include Wrapper\template_path(); ?>
        <?php } ?>
        </main><!-- /.main -->
        <?php if (Config\display_sidebar()) : ?>
          <aside class="sidebar" role="complementary">
          <?php if ( is_singular('tribe_events') ) { ?>
            <?php get_template_part('templates/sidebar', 'singular'); ?>
          <?php }else if ( is_page( array( 'sistema-de-control-interno', 'normativa', 'integrantes', 'actividades', 'acta-de-compromiso', 'galeria-acta', 'acta-de-reunion', 'actas-de-reunion', 'diagnostico', 'planificacion' ) ) ){ ?>
            <?php get_template_part('templates/sidebar', 'sci'); ?>
          <?php }else{ ?>
            <?php get_template_part('templates/sidebar', 'page'); ?>
          <?php } ?>

            
          </aside><!-- /.sidebar -->
        <?php endif; ?>
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
