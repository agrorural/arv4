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