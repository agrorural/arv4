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
	$dir_imagen = get_field('dir_imagen');

	$upload_dir = wp_upload_dir();
	$dir = $upload_dir["baseurl"];
	
	$term_list = wp_get_post_terms($post->ID, 'tipos', array("fields" => "all")); 
  	$post__slug = $post->post_name;
  	$post__slug__up = strtoupper($post__slug);
  	//var_dump($post);
?>
<article <?php post_class('panel panel-default panel-success'); ?>>
  <header class="panel-heading">
	 <?php the_title(); ?>
  </header>
      <!-- Table -->

		<?php /*
			<td>
				<?php echo get_avatar($dir_correo, 64); ?><?php if ( $dir_responsable ) echo $dir_responsable; ?>
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
			*/ ?>
			
				<div class="media">
				<div class="media-left">
				<?php if ( $dir_correo ) { ?>
					<?php if($dir_imagen){ ?>
						<img src="<?php echo $dir_imagen['sizes']['thumb-72']; ?>" alt="" width="72" height="72" />
					<?php }else{ ?>
						<?php echo get_avatar($dir_correo, 72); ?>
					<?php } ?>
				<?php } ?>
				</div>
				<div class="media-body">
					<section class="media-intro">
						<?php if ( $dir_cargo ) echo '<small>' . $dir_cargo . '</small>'; ?> <?php if ( $dir_situacion && $dir_situacion != 'Designado' ) echo '<small><span class="tip" title="Encargado">(E)</span></small>'; ?>
						<?php if ( $dir_responsable ) echo '<h4 class="media-heading">' . $dir_responsable . '</h4>'; ?>
						<ul class="list-inline">
							<?php if ( $dir_resolucion ) echo '<li><a href="'.$dir_resolucion.'"><small>Resolución</small></a></li>'; ?>
							<?php if ( $dir_cv ) echo '<li><a href="'.$dir_cv.'" target="_blank"><small class="tip" title="Curriculum vitae">C. V</small></a></li>'; ?>
							<?php if ( $dir_dji ) echo '<li><a href="'.$dir_dji.'" target="_blank"><small class="tip" title="Declaración Jurada de Incompatibilidades">DD. JJ. II</small></a></li>'; ?>
						</ul>
					</section>

					<ul class="list-unstyled">
						<?php if ( $dir_telefono ) echo '<li>' . $dir_telefono . '</li>'; ?>
						<li><a href="mailto:<?php if ( $dir_correo ) echo $dir_correo; ?>"><?php if ( $dir_correo ) echo $dir_correo; ?></a></li>
						<?php if ( $dir_direccion ) echo '<li>'.$dir_direccion . '</li>'; ?>
					</ul>
				</div>
				</div>
			
	
</article>