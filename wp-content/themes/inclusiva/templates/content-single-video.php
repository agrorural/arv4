<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <?php $video__id = get_field('video__id'); ?>
    <?php if ($video__id) {?>
      <div class="multimedia--1__video">
        <iframe width="100%" height="415" src="https://www.youtube.com/embed/<?php echo $video__id; ?>" frameborder="0" allowfullscreen></iframe>
      </div>
    <?php } ?>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php get_template_part('templates/sharing'); ?>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
