<?php
  $rde_link = get_field('rde_link');

  $dateformat = "d/m/Y";

  $pa__titular = get_field('pa__titular');
  $pa__rt = get_field('pa__rt');
  $pa__rt__rde = get_field('pa__rt__rde');

  $pa__fec_inicio = get_field('pa__fec_inicio');
  if ($pa__fec_inicio) {$pa__fec_inicio = new DateTime($pa__fec_inicio);}

  $pa__fec_fin = get_field('pa__fec_fin');
  if ($pa__fec_fin) {$pa__fec_fin = new DateTime($pa__fec_fin);}

  $upload_dir = wp_upload_dir();
  $dir = $upload_dir["baseurl"];
  $term_list = wp_get_post_terms($post->ID, 'tipos', array("fields" => "all"));
  $post__slug = $post->post_name;
  $post__slug__up = strtoupper($post__slug);

  $count = 0;
  $pa__at__1 = get_field('pa__at__1');
  $pa__at__2 = get_field('pa__at__2');
  $pa__at__3 = get_field('pa__at__3');
  $pa__at__3_1 = get_field('pa__at__3_1');
  $pa__at__4 = get_field('pa__at__4');
  $pa__at__5 = get_field('pa__at__5');
  $pa__at__6 = get_field('pa__at__6');
  $pa__at__7 = get_field('pa__at__7');
  $pa__at__8 = get_field('pa__at__8');
  $pa__at__9 = get_field('pa__at__9');
  $pa__at__10 = get_field('pa__at__10');
  $pa__at__10_1 = get_field('pa__at__10_1');
  $pa__at__10_2 = get_field('pa__at__10_2');
  $pa__at__10_3 = get_field('pa__at__10_3');
  $pa__at__10_4 = get_field('pa__at__10_4');
  $pa__at__10_5 = get_field('pa__at__10_5');
  $pa__at__11 = get_field('pa__at__11');
  $pa__at__11_1 = get_field('pa__at__11_1');
  $pa__at__11_2 = get_field('pa__at__11_2');
  $pa__at__11_3 = get_field('pa__at__11_3');
  $pa__at__12 = get_field('pa__at__12');
  $pa__at__13 = get_field('pa__at__13');
  $pa__at__14 = get_field('pa__at__14');
  $pa__at__14_1 = get_field('pa__at__14_1');
  $pa__at__14_2 = get_field('pa__at__14_2');
  $pa__at__15 = get_field('pa__at__15');
  $pa__at__15_1 = get_field('pa__at__15_1');
  $pa__at__16 = get_field('pa__at__16');
  $pa__at__16_1 = get_field('pa__at__16_1');
  $pa__at__17 = get_field('pa__at__17');
  $pa__at__18 = get_field('pa__at__18');
  $pa__at__18_1 = get_field('pa__at__18_1');
  $pa__at__19 = get_field('pa__at__19');
  $pa__at__19_1 = get_field('pa__at__19_1');
  $pa__at__20 = get_field('pa__at__20');
  $pa__at__20_1 = get_field('pa__at__20_1');
  $pa__at__21 = get_field('pa__at__21');

  if ($pa__at__1 == true){ $count += 2.5;}
  if ($pa__at__2 == true){$count += 2.5;}
  if ($pa__at__3 == true){
    $count += 2;
  }
  if($pa__at__3_1){
    for ($i=0; $i < count($pa__at__3_1); $i++) {
      $count++;
    }
  }
  if ($pa__at__4 == true){$count += 5;}
  if ($pa__at__5 == true){$count += 5;}
  if ($pa__at__6 == true){$count += 5;}
  if ($pa__at__7 == true){$count += 5;}
  if ($pa__at__8 == true){$count += 5;}
  if ($pa__at__9){
    for ($i=0; $i < count($pa__at__9); $i++) {
      $count++;
    }
  }
  if ($pa__at__10){$count += 3;}
  if($pa__at__10_1){
    for ($i=0; $i < count($pa__at__10_1); $i++) {
      $count+= 0.2;
    }
  }
  if($pa__at__10_2){
    for ($i=0; $i < count($pa__at__10_2); $i++) {
      $count+= 0.2;
    }
  }
  if($pa__at__10_3){
    for ($i=0; $i < count($pa__at__10_3); $i++) {
      $count+= 0.2;
    }
  }
  if($pa__at__10_4){
    for ($i=0; $i < count($pa__at__10_4); $i++) {
      $count+= 0.2;
    }
  }
  if($pa__at__10_5){
    for ($i=0; $i < count($pa__at__10_5); $i++) {
      $count+= 0.2;
    }
  }
  if ($pa__at__11 == true){$count += 2;}
  if($pa__at__11_1){
    for ($i=0; $i < count($pa__at__11_1); $i++) {
      $count += 0.25;
    }
  }
  if($pa__at__11_2){
    for ($i=0; $i < count($pa__at__11_2); $i++) {
      $count += 0.25;
    }
  }
  if($pa__at__11_3){
    for ($i=0; $i < count($pa__at__11_3); $i++) {
      $count += 0.25;
    }
  }
  if ($pa__at__12 == true){$count += 5;}
  if ($pa__at__13 == true){$count += 5;}
  if ($pa__at__14 == true){$count += 2;}
  if($pa__at__14_1){
    for ($i=0; $i < count($pa__at__14_1); $i++) {
      $count+= 0.5;
    }
  }
  if($pa__at__14_2){
    for ($i=0; $i < count($pa__at__14_2); $i++) {
      $count+= 0.5;
    }
  }
  if ($pa__at__15 == true){$count += 2;}
  if($pa__at__15_1){
    for ($i=0; $i < count($pa__at__15_1); $i++) {
      $count+= 0.2;
    }
  }
  if ($pa__at__16 == true){$count += 3;}
  if($pa__at__16_1){
      $count += 2;
  }
  if ($pa__at__17 == true){$count += 5;}
  if ($pa__at__18 == true){$count += 2;}
  if($pa__at__18_1){
    for ($i=0; $i < count($pa__at__18_1); $i++) {
      $count+= 0.5;
    }
  }
  if ($pa__at__19 == true){$count += 2;}
  if($pa__at__19_1){
    for ($i=0; $i < count($pa__at__19_1); $i++) {
      $count++;
    }
  }
  if ($pa__at__20 == true){$count += 2;}
  if($pa__at__20_1){
    for ($i=0; $i < count($pa__at__20_1); $i++) {
      $count+= 0.5;
    }
  }
  if ($pa__at__21 == true){$count += 5;}

  if ($count >= 0 && $count <= 24) {
    $status = 'danger';
  }elseif ($count >= 25 && $count <= 50) {
    $status = 'warning';
  }else {
		$status = 'success';
  }
?>

<article <?php post_class('panel panel-default'); ?>>
  <header class="panel-heading">
   <a href="<?php the_permalink(); ?>">
    <?php the_title(); ?>
   </a>
  </header>
  <div class="entry-summary panel-body">
    Según la presente autoevaluación del cumplimiento de publicaciones en el Portal de Transparencia Estándar se ha logrado cumplir con el <strong><?php echo $count; ?>%</strong> de la meta.
  </div>
  <div class="progress tip" title="<?php echo $count.'% completado'; ?>">
	  <div class="progress-bar progress-bar-<?php echo $status; ?>" role="progressbar" aria-valuenow="<?php echo $count; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $count; ?>%">
	    <span class="sr-only"><?php echo $count.'% completado'; ?></span>
	  </div>
	</div>
  <!-- Table -->
<table class="table table-hover table-condensed">
  <thead></thead>
  <tbody>
    <tr>
      <th>Titular de la Entidad</th>
      <td><?php if($pa__titular) echo $pa__titular; else echo 'No Disponible'; ?></td>
    </tr>
    <tr>
      <th>Reponsable de Transparencia</th>
      <td>
        <?php if($pa__rt) echo $pa__rt; else echo 'No Disponible'; ?><br />
        <small>
          <?php if($pa__rt__rde) echo '<a href="' . $pa__rt__rde . '">Resolución</a>'; else echo 'No Disponible'; ?>
        </small>
      </td>
    </tr>
    <tr rowspan="2">
      <th scope="row">
        <strong>Inicio de Seguimiento</strong>
        <br>
          <span>
            <?php if ($pa__fec_inicio) : ?>
              <?php echo $pa__fec_inicio->format('d/m/Y'); ?>
              <?php else : ?>
                No disponible
            <?php endif; ?>
          </span>
      </th>
      <th scope="row">
        <strong>Fin de Seguimiento</strong>
        <br>
          <span>
            <?php if ($pa__fec_fin) : ?>
              <?php echo $pa__fec_fin->format('d/m/Y'); ?>
              <?php else : ?>
                No disponible
              <?php endif; ?>
          </span>
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
