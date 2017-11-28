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
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <?php get_template_part('templates/masshead', 'page-reconstruccion'); ?>
    <section class="comunicados">
         <div class="container">
            <div id="sl__comunicados" class="owl-carousel owl-theme">
                <div class="item"><h4><i class="fa fa-bullhorn" aria-hidden="true"></i> <a href="#">En respuesta a la publicación de El Comercio el 21/11/2017</a></h4></div>
                <div class="item"><h4><i class="fa fa-bullhorn" aria-hidden="true"></i> <a href="#">Comunicado sobre la nota de prensa publicada en el diario Correo</a></h4></div>
            </div>
        </div>
    </section>
    <div class="wrap container" role="document">
      <div class="content row">
        <main class="main" role="main">
            <div class="row">
                <section class="noticias ">
                    <?php 
                    // the query
                    $the_query = new WP_Query( array( 'tag' => 'reconstruccion', 'posts_per_page' => 5 )); ?>

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
                <section class="facebook">
                    <div class="page-header">
                        <h3>Facebook</h3>
                        <span class="line"></span>
                    </div>
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FAgroRuralFans%2F&tabs=timeline&width=340&height=500&small_header=true&adapt_container_width=true&hide_cover=true&show_facepile=true&appId=485149758350535" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                </section>
                <section class="twitter">
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
            <div class="page-header">
                <h3>Links de interés</h3>
                <span class="line"></span>
            </div>
             <div id="sl__banners" class="owl-carousel owl-theme">
                <div class="item"><img class="owl-lazy" data-src="https://placehold.it/200x115&text=1"></div>
                <div class="item"><img class="owl-lazy" data-src="https://placehold.it/200x115&text=2"></div>
                <div class="item"><img class="owl-lazy" data-src="https://placehold.it/200x115&text=3"></div>
                <div class="item"><img class="owl-lazy" data-src="https://placehold.it/200x115&text=4"></div>
                <div class="item"><img class="owl-lazy" data-src="https://placehold.it/200x115&text=5"></div>
            </div>
        </div>
    </section>
    <section class="videos">
        <div class="container">
            <?php
                $args = array(
                    'post_type' => 'post',
                    'tag' => 'reconstruccion',
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
            $the_query = new WP_Query( $args ); ?>

            <?php if ( $the_query->have_posts() ) : ?>
                <div class="page-header">
                    <h3>Videos</h3>
                    <span class="line"></span>
                </div>
                <!-- pagination here -->
                <div id="sl__reconstruccion" class="owl-carousel owl-theme">
                    <!-- the loop -->
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <?php $video__id = get_field('video__id'); //echo $video__id; ?>
                        <div class="item-video"><a class="owl-video" href="<?php echo 'https://www.youtube.com/watch?v='.$video__id;?>"></a></div>
                    <?php endwhile; ?>
                    <!-- end of the loop -->
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
