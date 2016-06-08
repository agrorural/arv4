<?php

add_filter( 'gform_field_value_num_reclamacion', 'populate_num_reclamacion' );
function populate_num_reclamacion( $value ) {
    $year = date("Y");

    $form_count = RGFormsModel::get_form_counts(7);

    $unique = $form_count['total'] + 1;
    $unique = str_pad($unique, 3, '0', STR_PAD_LEFT);
    $unique = $unique . '-' . $year;

    return $unique;
}

add_filter( 'gform_field_value_fec_reclamacion', 'populate_fec_reclamacion' );
function populate_fec_reclamacion( $value ) {
    
    $gf_date = date_i18n('d/m/Y', time());
    
    return $gf_date;
}

add_filter( 'gform_field_value_gf__produ__correo', 'populate_gf__produ__correo' );
function populate_gf__produ__correo( $value ) {
	global $post;
	$productores__terms = get_the_terms( get_the_ID($post->ID), 'productor');
	
	if( !empty($productores__terms) ) {
		$produ__term = array_pop($productores__terms);
		$produ__correo = get_field('produ__correo', $produ__term );
		return $produ__correo;
	}
}