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
    <script>
      window.twttr = (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0],
      t = window.twttr || {};
      if (d.getElementById(id)) return t;
      js = d.createElement(s);
      js.id = id;
      js.src = "https://platform.twitter.com/widgets.js";
      fjs.parentNode.insertBefore(js, fjs);

      t._e = [];
      t.ready = function(f) {
      t._e.push(f);
      };

      return t;
      }(document, "script", "twitter-wjs"));
    </script>
    <?php
      do_action('get_header');
      get_template_part('templates/header');

      $pry__tag = get_field('pry__tag'); 
      $tag_by_ID = get_term_by('id', $pry__tag, 'post_tag');
      $tag__slug = $tag_by_ID->slug;
      
      // echo '<pre>';
      // var_dump($tag__slug);
      // echo '</pre>';
    ?>
    <?php
      if( $pry__tag ){
        get_template_part('templates/masshead-'.$tag__slug); 
      } else {
        get_template_part('templates/masshead');       
      }
    ?>
    <div class="wrap container" role="document">
      <div class="content row">
        <main class="main" role="main">
            <div class="row">
                <section class="noticias col-sm-4">
                    <?php 
                    // the query
                    $the_query = new WP_Query( array( 'tag' => $tag__slug, 'posts_per_page' => 5 )); ?>

                    <?php if ( $the_query->have_posts() ) : ?>

                        <!-- pagination here -->
                        <div class="page-header">
                            <h3><a href="<?php echo bloginfo('url'); ?>/etiqueta/reconstruccion/">Noticias</a></h3>
                            <span class="line"></span>
                        </div>
                        <!-- the loop -->
                        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                            <?php get_template_part('templates/content', 'home-news-list'); ?>
                        <?php endwhile; ?>
                        <!-- end of the loop -->

                        <!-- pagination here -->

                        <?php wp_reset_postdata(); ?>

                    <?php else : ?>
                        <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
                    <?php endif; ?>
                </section>
                <section class="facebook col-sm-4">
                    <div class="page-header">
                        <h3>Facebook</h3>
                        <span class="line"></span>
                    </div>
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FAgroRuralFans%2F&tabs=timeline&width=340&height=500&small_header=true&adapt_container_width=true&hide_cover=true&show_facepile=true&appId=485149758350535" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                </section>
                <section class="twitter col-sm-4">
                    <div class="page-header">
                        <h3>Twitter</h3>
                        <span class="line"></span>
                    </div>
                    <a class="twitter-timeline"  href="https://twitter.com/agrorural" data-widget-id="669274423590014976">Tweets por el @agrorural.</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </section>
            </div>
        </main><!-- /.main -->
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <section class="banners">
        <div class="container">
            <?php
                $args = array(
                    'post_type' => 'banners',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'posiciones',
                            'field'    => 'slug',
                            'terms'    => array( $tag__slug ),
                        )
                    ),
                    'posts_per_page' => -1
                );
            ?>

            <?php 
            // the query
            $the_query = new WP_Query( $args ); ?>

            <?php if ( $the_query->have_posts() ) : ?>
                <div class="page-header">
                <h3>Links de interés</h3>
                    <span class="line"></span>
                </div>
                <!-- pagination here -->
                <div class="link-slider swiper-container">
                  <div class="swiper-wrapper">
                    <!-- the loop -->
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <?php // ACF 
                            $banner__url = get_field('banner__url');
                            $banner__pop = get_field('banner__pop');
                            //var_dump($banner__pop);
                            $hoy = date( 'Ymd', current_time( 'timestamp', 1 ));
                            $banner__vig = get_field('banner__vig');
                            $content = esc_attr(get_the_content());

                            if ( $banner__vig && (intval ( $banner__vig ) < intval( $hoy )) ){
                                change_post_status( $post->ID, 'draft' ); 
                            } 
                        ?>
                        <div class="swiper-slide">
                            <a href="<?php if ($banner__url) { echo $banner__url; } else { echo bloginfo( 'url' ); } ?>">
                                <?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumb-category-bn', array ( 'class' => 'img-responsive' ) ); } ?>
                            </a>
                        </div>
                    <?php endwhile; ?>
                    <!-- end of the loop -->
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                  </div>
                <!-- pagination here -->

                <?php wp_reset_postdata(); ?>

            <?php else : ?>
                <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
            <?php endif; ?>
        </div>
    </section>
    <section class="videos">
        <div class="container">
            <?php
                $args = array(
                    'post_type' => 'post',
                    'tag' => $tag__slug,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field'    => 'slug',
                            'terms'    => array( 'post-format-video' ),
                        )
                    ),
                    'posts_per_page' => -1
                );
            ?>

            <?php 
            // the query
            $the_query = new WP_Query( $args );
            
            // echo '<pre>';
            // var_dump($the_query);
            // echo '</pre>';
            
            ?>

            <?php if ( $the_query->have_posts() ) : ?>
                <div class="page-header">
                    <h3>Videos</h3>
                    <span class="line"></span>
                </div>
                <!-- pagination here -->
                  <!-- Swiper -->
                    <div class="video-slider swiper-container">
                      <div class="swiper-wrapper">
                        <!-- the loop -->
                        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                          <div class="swiper-slide" style="background-image:url(<?php the_post_thumbnail_url(); ?>); background-position: center;background-size: cover;width: 300px;height: 200px;">
                          <a href="<?php the_permalink(); ?>"><i class="fa fa-play"></i></a>
                          </div>
                        <?php endwhile; ?>
                        <!-- end of the loop -->
                      </div>
                      <!-- Add Pagination -->
                      <div class="swiper-pagination"></div>
                    </div>
                <!-- pagination here -->

                <?php wp_reset_postdata(); ?>

            <?php else : ?>
                <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
            <?php endif; ?>
        </div>
    </section>
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
