<?php 
	$dir_responsable = get_field('dir_responsable');
	$dir_cargo = get_field('dir_cargo');
	$dir_direccion = get_field('dir_direccion');
	$dir_telefono = get_field('dir_telefono');
	$dir_correo = get_field('dir_correo');
	$dir_situacion = get_field('dir_situacion');
	$dir_resolucion = get_field('dir_resolucion');
	$dir_cv = get_field('dir_cv');
	$dir_dji = get_field('dir_dji');

	$upload_dir = wp_upload_dir();
	$dir = $upload_dir["baseurl"];
	
	$term_list = wp_get_post_terms($post->ID, 'tipos', array("fields" => "all")); 
  	$post__slug = $post->post_name;
  	$post__slug__up = strtoupper($post__slug);
  	//var_dump($post);
?>
<article <?php post_class('panel panel-default panel-success'); ?>>
  <header class="panel-heading">
	 <?php the_title(); ?> <?php if ( $dir_situacion && $dir_situacion != 'Designado' ) echo '<span class="tip" title="Encargado">(E)</span>'; ?>
  </header>
      <!-- Table -->
  <table class="table table-ćondensed">
    <tbody>
		<tr>
			<td>
				<?php if ( $dir_responsable ) echo $dir_responsable; ?>
				<ul class="list-inline">
					<?php if ( $dir_cv ) echo '<li><a href="'.$dir_cv.'"><small>Curriculum vitae</small></a></li>'; ?>
					<?php if ( $dir_dji ) echo '<li><a href="'.$dir_dji.'"><small>DD. JJ. de Incompatibilidades</small></a></li>'; ?>
				</ul>
			</td>
			<td>
				<?php if ( $dir_cargo ) echo $dir_cargo; ?>
				<ul class="list-inline">
					<?php if ( $dir_resolucion ) echo '<li><a href="'.$dir_resolucion.'"><small>Resolución</small></a></li>'; ?>
				</ul>
			</td>
			<td>
				<p>
					<?php if ( $dir_telefono ) echo $dir_telefono; ?><br />
				</p>
			</td>
			<td>
				<p>
					<a href="mailto:<?php if ( $dir_correo ) echo $dir_correo; ?>"><?php if ( $dir_correo ) echo $dir_correo; ?></a><br /><br />
					<?php if ( $dir_direccion ) echo '<i class="fa fa-map-marker"></i> '.$dir_direccion; ?>
				</p>
			</td>
		</tr>
    </tbody>
  </table>
</article>