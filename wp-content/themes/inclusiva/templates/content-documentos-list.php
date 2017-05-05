<?php
	$rde_link = get_field('rde_link');
	$upload_dir = wp_upload_dir();
	$dir = $upload_dir["baseurl"];

	$term_list = wp_get_post_terms($post->ID, 'tipos', array("fields" => "all"));
  $post__slug = $post->post_name;
  $post__slug__up = strtoupper($post__slug);
?>
<article <?php post_class('panel panel-default'); ?>>
  <header class="panel-heading">
	 <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
  </header>
      <!-- Table -->
  <table class="table">
    <tbody>
          <tr>
            <td><?php get_template_part('templates/entry-meta'); ?></td>
          </tr>
    </tbody>
  </table>
  <div class="entry-summary panel-body">
    <?php the_content(); ?>
  </div>
  <div class="panel-footer">
    <?php if($rde_link == 'Publicado') {?>
      <a class="cta__link" href="<?php echo $dir.'/transparencia/documentos/'.$term_list[0]->slug.'/'.$post__slug__up.'.PDF'; ?>" target="_blank"><i class="fa fa-file-o"></i> Descargar archivo</a>
    <?php }else{ ?>
      <button type="button" class="cta__link" disabled="disabled">No Disponible</button>
    <?php } ?>

    <?php get_template_part('templates/sharing'); ?>
  </div>
</article>
