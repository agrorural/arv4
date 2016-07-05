<form role="search" method="get" class="" id="searchform-advanced" action="<?php echo home_url( '/' ); ?>">
	<?php $query_types = get_query_var('post_type'); $query_types = array($query_types); //var_dump($query_types);?>
		<div class="input-group input-group-lg">
			<label class="sr-only"><?php _e('Search for:', 'sage'); ?></label>
			<input type="text" name="s" id="sa" value="<?= get_search_query(); ?>" class="search-field form-control" placeholder="Ingrese su búsqueda" />			
			<span class="input-group-btn">
				<input type="submit" class="btn btn-default" id="searchsubmit_a" value="Buscar" />
			</span>
		</div>
	<div class="checkbox">
		<label class="cba__post" for="cba__post"><input id="cba__post" type="checkbox" name="post_type[]" value="post" <?php if (in_array('post', $query_types, false) || is_page_template('template-noticias.php') || is_singular( 'post' )) { echo 'checked'; } ?> /> Noticias</label>
		<label class="cba__documentos" for="cba__documentos"><input id="cba__documentos" type="checkbox" name="post_type[]" value="documentos" <?php if (in_array('documentos', $query_types, false) ||  is_page_template('template-documentos.php') ) { echo 'checked'; } ?> /> Documentos</label>
		<label class="cba__convocatorias" for="cba__convocatorias"><input id="cba__convocatorias" type="checkbox" name="post_type[]" value="convocatorias" <?php if (in_array('convocatorias', $query_types, false) || is_page_template('template-convocatorias-cas.php') || is_page_template('template-convocatorias-cap.php') || is_page_template('template-convocatorias-practicas.php') ) { echo 'checked'; } ?> /> Convocatorias</label>  
		<label class="cba__servicios" for="cba__servicios"><input id="cba__servicios" type="checkbox" name="post_type[]" value="servicios" <?php if (in_array('servicios', $query_types, false) || is_page_template('template-servicios.php')) { echo 'checked'; } ?> /> Servicios</label>
		<label class="cba__producto" for="cba__producto"><input id="cba__producto" type="checkbox" name="post_type[]" value="producto" <?php if (in_array('producto', $query_types, false) || is_page_template('template-producto.php')) { echo 'checked'; } ?> /> Productos</label>
		<label class="cba__tribe_events" for="cba__tribe_events"><input id="cba__tribe_events" type="checkbox" name="post_type[]" value="tribe_events" <?php if (in_array('tribe_events', $query_types, false) ) { echo 'checked'; } ?> /> Eventos</label>  
	</div>
</form>   