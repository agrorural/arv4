<?php

add_filter( 'gform_field_value_num_reclamacion', 'populate_num_reclamacion' );
function populate_num_reclamacion( $value ) {
    $year = date("Y");

    $form_count = RGFormsModel::get_form_counts(7);

    $unique = $form_count['total'];
    $unique = str_pad($unique, 3, '0', STR_PAD_LEFT);
    $unique = $unique . '-' . $year;

    return $unique;
}