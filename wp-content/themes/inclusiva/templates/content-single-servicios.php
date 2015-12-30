<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header class="col-sm-10">
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php if( $post->post_excerpt ) { ?>
        <div class="entry-summary">
          <p class="entry-summary"><?php echo $post->post_excerpt; ?></p>  
        </div>
      <?php } ?>
    </header>
    <div class="entry-content">    
      <div class="entry-content__article">
      <?php if ( has_post_thumbnail() ) { the_post_thumbnail('full', array('class' => 'img-responsive')); } ?>
        <?php the_content(); ?>
        <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
      </div>
              <div class="entry-content__share">
        <h5 style="margin-top:0">Compartir</h5>
        <div class="sharing-list">
          <ul class="list-unstyled">
            <li id="fb"><a class="btn btn-block" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook"></i>Facebook</a></li>
            <li id="tw"><a class="btn btn-block" href="https://twitter.com/home?status=<?php the_permalink(); ?>"><i class="fa fa-twitter"></i>Twitter</a></li>
            <li id="gp"><a class="btn btn-block" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i>Google +</a></li>
          </ul>
        </div>
      </div>
    </div>
  </article>
<?php endwhile; ?>
