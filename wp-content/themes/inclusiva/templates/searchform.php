<form role="search" method="get" class="" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<?php $query_types = get_query_var('post_type'); $query_types = array($query_types); //var_dump($query_types);?>
		<div class="input-group input-group-lg">
			<label class="sr-only"><?php _e('Search for:', 'sage'); ?></label>
			<input type="text" name="s" id="s" value="<?= get_search_query(); ?>" class="search-field form-control" placeholder="Ingrese su búsqueda" />			
			<span class="input-group-btn">
				<input type="submit" class="btn btn-default" id="searchsubmit" value="Buscar" />
			</span>
		</div>
	<div class="checkbox">
		<label class="" for="cb__post"><input id="cb__post" type="checkbox" name="post_type[]" value="post" <?php if (in_array('post', $query_types, false) || is_front_page() || is_page_template('template-noticias.php') || is_single()) { echo 'checked'; } ?> /> Noticias</label>
		<label class="" for="cb__documentos"><input id="cb__documentos" type="checkbox" name="post_type[]" value="documentos" <?php if (in_array('documentos', $query_types, false) || is_front_page() ||  is_page_template('template-documentos.php') ) { echo 'checked'; } ?> /> Documentos</label>
		<label class="" for="cb__convocatorias"><input id="cb__convocatorias" type="checkbox" name="post_type[]" value="convocatorias" <?php if (in_array('convocatorias', $query_types, false) || is_front_page() || is_page_template('template-convocatorias-cas.php') || is_page_template('template-convocatorias-cap.php') || is_page_template('template-convocatorias-practicas.php') ) { echo 'checked'; } ?> /> Convocatorias</label>  
		<label class="" for="cb__servicios"><input id="cb__servicios" type="checkbox" name="post_type[]" value="servicios" <?php if (in_array('servicios', $query_types, false) || is_front_page() || is_page_template('template-servicios.php')) { echo 'checked'; } ?> /> Servicios</label>
		<label class="" for="cb__productos"><input id="cb__productos" type="checkbox" name="post_type[]" value="productos" <?php if (in_array('productos', $query_types, false) || is_front_page() || is_page_template('template-productos.php')) { echo 'checked'; } ?> /> Productos</label>
		<label class="" for="cb__tribe_events"><input id="cb__tribe_events" type="checkbox" name="post_type[]" value="tribe_events" <?php if (in_array('tribe_events', $query_types, false) || is_front_page() ) { echo 'checked'; } ?> /> Eventos</label>  
	</div>
</form>