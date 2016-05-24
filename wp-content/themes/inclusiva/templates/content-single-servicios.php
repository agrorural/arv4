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
        <?php the_content(); ?>
        <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
      </div>
    </div>
  </article>
<?php endwhile; ?>
