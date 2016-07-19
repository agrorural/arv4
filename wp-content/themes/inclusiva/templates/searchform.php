<?php
	global $post; 
	$query_types = get_query_var('post_type'); 
	$query_types = array($query_types);

	//var_dump($query_types);

	if( $query_types[0] != '' ){
		$query_types_value = $query_types[0];
	}else if (is_page_template('template-documentos.php')){
		$query_types_value = 'documentos';
	}else if (is_page_template('template-convocatorias-cas.php') || is_page_template('template-convocatorias-cap.php')){
		$query_types_value = 'convocatorias';
	}else{
		$query_types_value = 'default';
	}
?>


<form role="search" method="get" class="searchform_for_<?php echo $query_types_value; ?>" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<div class="input-group">
		<label class="sr-only"><?php _e('Search for:', 'sage'); ?></label>
		<input type="text" name="s" id="s" value="<?= get_search_query(); ?>" class="search-field form-control" placeholder="Ingrese su búsqueda" />			
		<span class="input-group-btn">
			<input type="submit" class="btn btn-default" id="searchsubmit" value="Buscar" />
		</span>
	</div>
	<div class="checkbox">
		<label class="cb__post" for="cb__post"><input id="cb__post" type="checkbox" name="post_type[]" value="post" <?php if (in_array('post', $query_types, false) || is_page_template('template-noticias.php') || is_singular( 'post' )) { echo 'checked'; } ?> /> Noticias</label>
		<label class="cb__documentos" for="cb__documentos"><input id="cb__documentos" type="checkbox" name="post_type[]" value="documentos" <?php if (in_array('documentos', $query_types, false) ||  is_page_template('template-documentos.php') ) { echo 'checked'; } ?> /> Documentos</label>
		<label class="cb__convocatorias" for="cb__convocatorias"><input id="cb__convocatorias" type="checkbox" name="post_type[]" value="convocatorias" <?php if (in_array('convocatorias', $query_types, false) || is_page_template('template-convocatorias-cas.php') || is_page_template('template-convocatorias-cap.php') || is_page_template('template-convocatorias-practicas.php') ) { echo 'checked'; } ?> /> Convocatorias</label>  
		<label class="cb__servicios" for="cb__servicios"><input id="cb__servicios" type="checkbox" name="post_type[]" value="servicios" <?php if (in_array('servicios', $query_types, false) || is_page_template('template-servicios.php')) { echo 'checked'; } ?> /> Servicios</label>
		<label class="cb__producto" for="cb__producto"><input id="cb__producto" type="checkbox" name="post_type[]" value="producto" <?php if (in_array('producto', $query_types, false) || is_post_type_archive('producto') || is_page_template('archive-producto.php') || is_tax( 'clasificacion' ) || is_tax( 'marca' ) || is_tax( 'productor' )) { echo 'checked'; } ?> /> Productos</label>
		<label class="cb__tribe_events" for="cb__tribe_events"><input id="cb__tribe_events" type="checkbox" name="post_type[]" value="tribe_events" <?php if (in_array('tribe_events', $query_types, false) ) { echo 'checked'; } ?> /> Eventos</label>  
	</div>
</form>