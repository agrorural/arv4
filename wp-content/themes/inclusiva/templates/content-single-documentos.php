<?php while (have_posts()) : the_post(); ?>
	<?php
		$rde_link = get_field('rde_link');
		$upload_dir = wp_upload_dir();
		$dir = $upload_dir["baseurl"];

		$term_list = wp_get_post_terms($post->ID, 'tipos', array("fields" => "all"));
		$post__slug = $post->post_name;
		$post__slug__up = strtoupper($post__slug);

    $count = count($term_list);
	?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
      <hr />
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php if($rde_link == 'Publicado') {?>
        <?php if ( $count > 1 ) { ?>
          <a class="cta__link" href="<?php echo $dir.'/transparencia/documentos/rde/'.$post__slug__up.'.PDF'; ?>"><i class="fa fa-file-o"></i> Descargar archivo</a>
        <?php }else{ ?>
          <a class="cta__link" href="<?php echo $dir.'/transparencia/documentos/'.$term_list[0]->slug.'/'.$post__slug__up.'.PDF'; ?>"><i class="fa fa-file-o"></i> Descargar archivo</a>
        <?php } ?>
      <?php }else{ ?>
        <p>No Disponible</p>
      <?php } ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
