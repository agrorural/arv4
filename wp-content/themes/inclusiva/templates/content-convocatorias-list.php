<?php 
	$upload_dir = wp_upload_dir();
	$dir = $upload_dir["baseurl"];

	// Variables de ACF Convocatorias
	$dfs = 'j \d\e F';
	$hoy = date( 'Ymd', current_time( 'timestamp', 1 ));
	$ev_curricular = get_field('ev_curricular');
	$ev_curricular_fec = get_field('ev_curricular_fec');
	$ev_curricular_fec_uts = strtotime( $ev_curricular_fec );
	
	$ev_psicologica_fec = get_field('ev_psicologica_fec');	
	$ev_psicologica_fec_uts = strtotime( $ev_psicologica_fec );
	$ev_psicologica = get_field('ev_psicologica');

	$en_personal_fec = get_field('en_personal_fec');
	$en_personal_fec_uts = strtotime( $en_personal_fec );
	$en_personal = get_field('en_personal');

	$re_final_fec = get_field('re_final_fec');
	$re_final_fec_uts = strtotime( $re_final_fec );
	$re_final = get_field('re_final');
	
	$cat__list = wp_get_post_terms($post->ID, 'cat-convocatorias', array("fields" => "all")); 
	$cat__list_slug_1 = $cat__list[0]->slug; //CAS o CAP
	$cat__list_slug_up_1 = strtoupper($cat__list_slug_1);
	
	$cat__list_slug_2 = $cat__list[1]->slug; 
	$cat__list_slug_up_2 = strtoupper($cat__list_slug_2);

	$est__list = wp_get_post_terms($post->ID, 'est-convocatorias', array("fields" => "all")); 
	$est__list_name = $est__list[0]->name;
	$est__list_slug = $est__list[0]->slug; 

	$post__slug = $post->post_name;
	$post__slug__up = strtoupper($post__slug);

	$estado__cnv = get_term_link( $est__list_slug, 'est-convocatorias' );
	$estado__cnv__default = get_term_link( 'en-espera', 'est-convocatorias' );
?>	

	<?php if( $est__list_name == 'Finalizada' )
	{
		$progress = '100';
		$status = 'default';
	} else if ( $est__list_name == 'Cancelada' ){
		$progress = '100';
		$status = 'danger';
	} else if ( $est__list_name == 'Desierta' ){
		$progress = '100';
		$status = 'warning';
	} else if ( $est__list_name == 'En Proceso' ){
		$progress = '66.6';
		$status = 'info';
	} else if ( $est__list_name == 'Abierta' ){
		$progress = '33.3';
		$status = 'success';
	}else{
		$progress = '0';
		$status = 'default';
	}
	?>

<article <?php post_class('panel panel-default'); ?>>
  <header class="panel-heading">
	 <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><a class="label label-<?php echo $status; ?> pull-right" href="<?php if($est__list_name){echo $estado__cnv;}else{echo $estado__cnv__default;} ?>"><?php if ($est__list_name){echo $est__list_name; }else{ echo 'En Espera'; } ?></a>
  </header>
  <div class="entry-summary panel-body">
    <?php the_content(); ?>
  </div>
	<div class="progress tip" title="<?php echo $progress.'% completado'; ?>">
	  <div class="progress-bar progress-bar-<?php echo $status; ?>" role="progressbar" aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%">
	    <span class="sr-only"><?php echo $progress.'% completado'; ?></span>
	  </div>
	</div>  
  <!-- Table -->
	<table class="table table-condensed">
		<thead>
	      <tr>
	        <th>Evaluación Curricular</th>
	        <?php if( $cat__list_slug_1 == 'cap' ){ ?>
	        	<th>Evaluación Psicológica</th>
	        <?php } ?>
	        <th>Aptos para Entrevista Personal</th>
	        <th>Resultado Final</th>
	      </tr>
	    </thead>
		<tbody>
		      <tr>

		        	<td>
		        		<p>
		        		<?php if( $cat__list_slug_1 == 'cas' ){ ?>
		        			<a tabindex="0" class="over" role="button" data-toggle="popover" data-trigger="focus" title="Formatos" data-content='<ul class="fa-ul">
<li><a href="http://www.agrorural.gob.pe/wp-content/uploads/convocatorias/cv-2015.pdf" target="_blank"><i class="fa-li fa fa-check-square"></i>Formato 07:  FORMULARIO DE CURRICULUM VITAE</a></li>
<li><a href="http://www.agrorural.gob.pe/wp-content/uploads/convocatorias/declaracion-jurada-2015.pdf" target="_blank"><i class="fa-li fa fa-check-square"></i>Formato 08: Formato de Declaración Jurada (en original) debidamente suscrito </a></li>
<li><a href="http://www.agrorural.gob.pe/wp-content/uploads/convocatorias/etiqueta-2015.pdf" target="_blank"><i class="fa-li fa fa-check-square"></i>Etiqueta para la presentación de sobres </a></li>
<li><i class="fa-li fa fa-check-square"></i>Copia Simple del DNI o Carné de Extranjería, de ser el caso (vigente y legible)</li>
</ul>'>Formatos</a> 
		        		<?php } else { ?>
		        			<a tabindex="0" class="over" role="button" data-toggle="popover" data-trigger="focus" title="Formatos" data-content='<ul class="fa-ul">
<li><a href="http://www.agrorural.gob.pe/wp-content/uploads/convocatorias/cv-cap--2015.doc" target="_blank"><i class="fa-li fa fa-check-square"></i>Anexo Nº 1. Ficha Curricular </a></li>
<li><a href="http://www.agrorural.gob.pe/wp-content/uploads/convocatorias/declaracion-jurada-cap--2015.doc" target="_blank"><i class="fa-li fa fa-check-square"></i>Anexo Nº 2. Declaración Jurada </a></li>
<li><a href="http://www.agrorural.gob.pe/wp-content/uploads/convocatorias/etiqueta-cap.pdf" target="_blank"><i class="fa-li fa fa-check-square"></i>Etiqueta para la presentación de sobres </a></li>
<li><i class="fa-li fa fa-check-square"></i>Copia Simple del DNI o Carné de Extranjería, de ser el caso (vigente y legible)</li>
</ul>'>Formatos </a>
		        		<?php } ?>
			        		<?php if(  $ev_curricular_fec && intval( $hoy ) <= intval ( $ev_curricular_fec ) ){ ?>
			            		<?php echo '<br />(hasta el '. date_i18n($dfs, $ev_curricular_fec_uts) .
			            		' de 8:30 a 13:00 y de 14:00 a 16:30 hrs)'; ?>
			            	<?php } ?>
		            	</p>
		        	</td>


		        <?php if( $cat__list_slug_1 == 'cap' ){ ?>
		            <?php if( $ev_psicologica == 'Publicado' ){ ?>
		            	<td><a href="<?php echo $dir.'/transparencia/convocatorias/P-'.$post__slug__up.'-'.$cat__list_slug_up_2.'.pdf'; ?>">Descargar archivo</a></td>
		            <?php } else { ?>
		            	<?php if( $ev_psicologica_fec ){ ?>
		            		<td><p><?php echo date_i18n($dfs, $ev_psicologica_fec_uts); ?></p></td>
		            	<?php } else { ?>
		            		<td><p>No publicado</p></td>
		            	<?php } ?>
		            <?php } ?>
		        <?php } ?>
		        
		        <?php if($en_personal == 'Publicado'){ ?>
		        	<td><a href="<?php echo $dir.'/transparencia/convocatorias/E-'.$post__slug__up.'-'.$cat__list_slug_up_2.'.pdf'; ?>">Descargar archivo</a></td>
		        <?php } else { ?>
		        	<?php if( $en_personal_fec ){ ?>
		        		<td><p><?php echo date_i18n($dfs, $en_personal_fec_uts); ?></p></td>
		        	<?php } else { ?>
		        		<td><p>No publicado</p></td>
		        	<?php } ?>
		        <?php } ?>

		        <?php if($re_final == 'Publicado'){ ?>
		        	<td><a href="<?php echo $dir.'/transparencia/convocatorias/R-'.$post__slug__up.'-'.$cat__list_slug_up_2.'.pdf'; ?>">Descargar archivo</a></td>
		        <?php } else { ?>
		        	<?php if( $re_final_fec ){ ?>
		        		<td><p><?php echo date_i18n($dfs, $re_final_fec_uts); ?></p></td>
		        	<?php } else { ?>
		        		<td><p>No publicado</p></td>
		        	<?php } ?>
		        <?php } ?>
		      </tr>
		</tbody>
	</table>
  <div class="panel-footer">

    <?php if( $ev_curricular == 'Publicado' ){ ?>
    	<a class="cta__link" href="<?php echo $dir.'/transparencia/convocatorias/C-'.$post__slug__up.'-'.$cat__list_slug_up_2.'.pdf'; ?>">Bases, requisitos y cronograma</a>
    <?php }else{ ?>
    	No se ha publicado
    <?php } ?>
    <div class="pull-right">
      <?php get_template_part('templates/sharing', 'list'); ?>
    </div>
  </div>
</article>