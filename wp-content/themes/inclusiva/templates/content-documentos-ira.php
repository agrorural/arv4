<?php
  $rde_link = get_field('rde_link');

  $dateformat = "d/m/Y";

  $pa__fec_inicio = get_field('pa__fec_inicio');
  $pa__fec_inicio = new DateTime($pa__fec_inicio);

  $pa__fec_fin = get_field('pa__fec_fin');
  $pa__fec_fin = new DateTime($pa__fec_fin);

  $upload_dir = wp_upload_dir();
  $dir = $upload_dir["baseurl"];
  $term_list = wp_get_post_terms($post->ID, 'tipos', array("fields" => "all"));
  $post__slug = $post->post_name;
  $post__slug__up = strtoupper($post__slug);

?>
<article <?php post_class('panel panel-default'); ?>>
  <header class="panel-heading">
   <a href="<?php the_permalink(); ?>">
    <?php the_title(); ?>
   </a>
  </header>
  <!-- Table -->
<table class="table table-hover table-condensed">
  <thead></thead>
  <tbody>
    <tr rowspan="2">
      <th scope="row">
        <strong>Inicio de Seguimiento</strong>
        <br>
          <?php if ($pa__fec_inicio) : ?>
            <?php echo '<span>' . $pa__fec_inicio->format('d/m/Y') . '</span>'; ?>
          <?php else : ?>
            No disponible
          <?php endif; ?>
      </th>
      <th scope="row">
        <strong>Fin de Seguimiento</strong>
        <br>
          <?php if ($pa__fec_fin) : ?>
            <?php echo '<span>' . $pa__fec_fin->format('d/m/Y') . '</span>'; ?>
          <?php else : ?>
            No disponible
          <?php endif; ?>
      </th>
    </tr>
  </tbody>
</table>
  <div class="panel-footer">
    <?php if($rde_link == 'Publicado') {?>
      <a class="cta__link" href="<?php echo $dir.'/transparencia/documentos/'.$term_list[0]->slug.'/'.$post__slug__up.'.PDF'; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Descargar informe</a>
    <?php }else{ ?>
      <button type="button" class="cta__link" disabled="disabled">No Disponible</button>
    <?php } ?>
    <?php /* get_template_part('templates/sharing'); */ ?>
  </div>
</article>
