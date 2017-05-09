<?php

namespace GFPDF\Helper\Fields;

use GFPDF\Helper\Helper_Abstract_Form;
use GFPDF\Helper\Helper_Misc;
use GFPDF\Helper\Helper_Abstract_Fields;

use GFFormsModel;
use GF_Field_Radio;
use GFCommon;

use Exception;

/**
 * Gravity Forms Field
 *
 * @package     Gravity PDF
 * @copyright   Copyright (c) 2016, Blue Liquid Designs
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       4.0
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
    This file is part of Gravity PDF.

    Gravity PDF – Copyright (C) 2016, Blue Liquid Designs

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/**
 * Controls the display and output of a Gravity Form field
 *
 * @since 4.0
 */
class Field_Radio extends Helper_Abstract_Fields {

	/**
	 * Check the appropriate variables are parsed in send to the parent construct
	 *
	 * @param object                             $field The GF_Field_* Object
	 * @param array                              $entry The Gravity Forms Entry
	 *
	 * @param \GFPDF\Helper\Helper_Abstract_Form $gform
	 * @param \GFPDF\Helper\Helper_Misc          $misc
	 *
	 * @throws Exception
	 *
	 * @since 4.0
	 */
	public function __construct( $field, $entry, Helper_Abstract_Form $gform, Helper_Misc $misc ) {

		if ( ! is_object( $field ) || ! $field instanceof GF_Field_Radio ) {
			throw new Exception( '$field needs to be in instance of GF_Field_Radio' );
		}

		/* call our parent method */
		parent::__construct( $field, $entry, $gform, $misc );
	}

	/**
	 * Display the HTML version of this field
	 *
	 * @param string $value
	 * @param bool   $label
	 *
	 * @return string
	 * @since 4.0
	 */
	public function html( $value = '', $label = true ) {
		$data   = $this->value();

		$value = apply_filters( 'gfpdf_show_field_value', false ); /* Set to `true` to show a field's value instead of the label */
		$output = ( $value ) ? $data['value'] : $data['label'];

		return parent::html( $output );
	}

	/**
	 * Checks if the selected Radio button value is defined by the site owner (standard radio options)
	 * or by the end user (through the "other" option).
	 *
	 * @param string $value The user-selected radio button value
	 *
	 * @return bool Returns true if value is user-defined, or false otherwise
	 *
	 * @since 4.0.1
	 */
	protected function is_user_defined_value( $value ) {

		/* Check if the field has the "Other" choice enabled */
		if ( ! isset( $this->field->enableOtherChoice ) || true !== $this->field->enableOtherChoice ) {
			return false;
		}

		/* Loop through the values and check if we have a match */
		foreach ( $this->field->choices as $item ) {
			if ( wp_specialchars_decode( $value, ENT_QUOTES ) === $item['value'] ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Return the HTML form data
	 *
	 * @return array
	 *
	 * @since 4.0
	 */
	public function form_data() {

		$value = $this->value();
		$label = GFFormsModel::get_label( $this->field );
		$data  = [];

		/* Standadised Format */
		$data['field'][ $this->field->id . '.' . $label ] = $value['value'];
		$data['field'][ $this->field->id ]                = $value['value'];
		$data['field'][ $label ]                          = $value['value'];

		/* Name Format */
		$data['field'][ $this->field->id . '.' . $label . '_name' ] = $value['label'];
		$data['field'][ $this->field->id . '_name' ]                = $value['label'];
		$data['field'][ $label . '_name' ]                          = $value['label'];

		return $data;
	}

	/**
	 * Get the standard GF value of this field
	 *
	 * @return array
	 *
	 * @since 4.0
	 */
	public function value() {
		if ( $this->has_cache() ) {
			return $this->cache();
		}

		$label = esc_html( GFCommon::selection_display( $this->get_value(), $this->field, '', true ) );
		$value = esc_html( GFCommon::selection_display( $this->get_value(), $this->field ) );

		/* Allow HTML if the radio value isn't the "other" option */
		if ( ! $this->is_user_defined_value( $value ) ) {
			$value = wp_kses_post( wp_specialchars_decode( $value, ENT_QUOTES ) );
			$label = wp_kses_post( wp_specialchars_decode( $label, ENT_QUOTES ) );
		}


		/* return value / label as an array */
		$this->cache( [
			'value' => $value,
			'label' => $label,
		] );

		return $this->cache();
	}
}
