<div id="directorio-search">
	<form id="directorio" class="form-inline" action="" method="GET">
	  <div class="form-group">
	    <select id="optSede" class="form-control">
	    <option value="">Todos</option>
			<?php $terms = get_terms( 'grupos' );
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
					foreach ( $terms as $term ) {
						//var_dump($term);
					    echo ' <option value="' . $term->slug .'">' . $term->name . '</option>';
					}
				}
			?>
		</select>
	  </div>

	  <button type="submit" class="btn btn-default">Buscar</button>
	</form>

	<div id="directoryContent">
		Contenido del directorio
	</div>
</div>