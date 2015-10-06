<?php 
	$dir_responsable = get_field('dir_responsable');
	$dir_cargo = get_field('dir_cargo');
	$dir_direccion = get_field('dir_direccion');
	$dir_telefono = get_field('dir_telefono');
	$dir_correo = get_field('dir_correo');

	$upload_dir = wp_upload_dir();
	$dir = $upload_dir["baseurl"];
	
	$term_list = wp_get_post_terms($post->ID, 'tipos', array("fields" => "all")); 
  	$post__slug = $post->post_name;
  	$post__slug__up = strtoupper($post__slug);
?>
<article <?php post_class('panel panel-default panel-success'); ?>>
  <header class="panel-heading">
	 <?php the_title(); ?>
  </header>
      <!-- Table -->
  <table class="table table-ćondensed">
    <tbody>
		<tr>
			<td><?php if ( $dir_cargo ) echo $dir_cargo; ?></td>
			<td><?php if ( $dir_responsable ) echo $dir_responsable; ?></td>
			<td>
				<p>
					<?php if ( $dir_direccion ) echo $dir_direccion; ?><br />
					<?php if ( $dir_telefono ) echo $dir_telefono; ?><br />
					<a href="mailto:<?php if ( $dir_correo ) echo $dir_correo; ?>"><?php if ( $dir_correo ) echo $dir_correo; ?></a>
				</p>
			</td>
		</tr>
    </tbody>
  </table>
</article>