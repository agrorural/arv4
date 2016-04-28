<?php 
  $rde_link = get_field('rde_link');
  $upload_dir = wp_upload_dir();
  $dir = $upload_dir["baseurl"];
  $doc_ane__nom = get_field('doc_ane__nom');
  $doc_ane__desc = get_field('doc_ane__desc');
  
  $term_list = wp_get_post_terms($post->ID, 'tipos', array("fields" => "all")); 
  $post__slug = $post->post_name;
  $post__slug__up = strtoupper($post__slug);
?>
<article <?php post_class('panel panel-default'); ?>>
  <header class="panel-heading">
   <a href="<?php the_permalink(); ?>">
   <?php if($doc_ane__nom){?>
    <?php echo $doc_ane__nom; ?>
   <?php }else { ?>
    <?php the_title(); ?>
   <?php } ?>
   </a>
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
    <?php if($doc_ane__desc){?>
    <?php echo $doc_ane__desc; ?>
   <?php }else { ?>
      <?php the_content(); ?>
    <?php } ?>
  </div>
  <div class="panel-footer">
    <?php if($rde_link == 'Publicado') {?>
      <a class="cta__link" href="<?php echo $dir.'/transparencia/documentos/rde/'.$post__slug__up.'.PDF'; ?>" target="_blank"><i class="fa fa-file-o"></i> Descargar archivo</a>
    <?php }else{ ?>
      <p>No Disponible</p>
    <?php } ?>

    <?php get_template_part('templates/sharing', 'list'); ?>
  </div>
</article>