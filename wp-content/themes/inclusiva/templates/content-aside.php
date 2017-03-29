<article <?php post_class('item'); ?>>
  <?php /*
  <header>
  	the_tags( '<span class="label">', '</span><span class="label">', '</span>' ); 
  </header>
  */?>
  <div class="entry-content">
  	<h2 class="entry-title"><?php get_template_part('templates/entry-meta-alerts'); ?> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  </div>
</article>