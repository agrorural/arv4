	<section class="widget">
		<?php $category_list_args = array(
			'show_option_all'    => 'Seleccionar',
			'show_option_none'   => '',
			'option_none_value'  => '-1',
			'orderby'            => 'ID', 
			'order'              => 'ASC',
			'show_count'         => 0,
			'hide_empty'         => 1, 
			'child_of'           => 0,
			'exclude'            => $category_id_agro_rural,
			'echo'               => 1,
			'selected'           => 0,
			'hierarchical'       => 0, 
			'name'               => 'cat',
			'id'                 => '',
			'class'              => 'postform form-control',
			'depth'              => 0,
			'tab_index'          => 0,
			'taxonomy'           => 'category',
			'hide_if_empty'      => false,
			'value_field'	     => 'term_id',	
		); ?>
		<h3><?php _e( 'Sedes' ); ?></h3>
		
		<form id="category-select" class="category-select" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
			<div class="input-group">
				<?php wp_dropdown_categories( $category_list_args ); ?> 
				<span class="input-group-btn">
					<input type="submit" class="btn btn-default" name="submit" value="Ir" />
				</span>
			</div>
		</form>
	</section>