<?php while (have_posts()) : the_post(); ?>
<?php // ACF Format Link 
	$lnk__medio = get_field('lnk__medio'); 
	$lnk__url = get_field('lnk__url');
?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta-link'); ?>
    </header>
    <div class="entry-content">
      <?php if ( has_post_thumbnail() ) { the_post_thumbnail('full', array('class' => 'img-responsive')); } ?>
      
      <?php the_content(); ?>
      <p><a href="<?php if ($lnk__url) { echo $lnk__url; } else { echo bloginfo( 'url' ); } ?>" class="cta__link" target="_blank">Ver todo el artículo</a></p>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
