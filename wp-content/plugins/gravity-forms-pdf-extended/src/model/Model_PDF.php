<?php

namespace GFPDF\Model;

use GFPDF\Helper\Helper_Abstract_Model;
use GFPDF\Helper\Helper_PDF;

use GFPDF\Helper\Helper_Abstract_Fields;
use GFPDF\Helper\Helper_Abstract_Field_Products;
use GFPDF\Helper\Fields\Field_Default;
use GFPDF\Helper\Fields\Field_Products;

use GFPDF\Helper\Helper_Abstract_Form;
use GFPDF\Helper\Helper_Abstract_Options;
use GFPDF\Helper\Helper_Data;
use GFPDF\Helper\Helper_Misc;
use GFPDF\Helper\Helper_Notices;
use GFPDF\Helper\Helper_Templates;

use Psr\Log\LoggerInterface;

use GFFormsModel;
use GFCommon;
use GF_Field;
use GFQuiz;
use GFSurvey;
use GFPolls;
use GFResults;

use WP_Error;

use Exception;

/**
 * PDF Display Model, including the $form_data array
 *
 * @package     Gravity PDF
 * @copyright   Copyright (c) 2018, Blue Liquid Designs
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       4.0
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
    This file is part of Gravity PDF.

    Gravity PDF – Copyright (C) 2018, Blue Liquid Designs

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
 * Model_PDF
 *
 * Handles all the PDF display logic
 *
 * @since 4.0
 */
class Model_PDF extends Helper_Abstract_Model {

	/**
	 * Holds the abstracted Gravity Forms API specific to Gravity PDF
	 *
	 * @var \GFPDF\Helper\Helper_Form
	 *
	 * @since 4.0
	 */
	protected $gform;

	/**
	 * Holds our log class
	 *
	 * @var \Monolog\Logger|LoggerInterface
	 *
	 * @since 4.0
	 */
	protected $log;

	/**
	 * Holds our Helper_Abstract_Options / Helper_Options_Fields object
	 * Makes it easy to access global PDF settings and individual form PDF settings
	 *
	 * @var \GFPDF\Helper\Helper_Options_Fields
	 *
	 * @since 4.0
	 */
	protected $options;

	/**
	 * Holds our Helper_Data object
	 * which we can autoload with any data needed
	 *
	 * @var \GFPDF\Helper\Helper_Data
	 *
	 * @since 4.0
	 */
	protected $data;

	/**
	 * Holds our Helper_Misc object
	 * Makes it easy to access common methods throughout the plugin
	 *
	 * @var \GFPDF\Helper\Helper_Misc
	 *
	 * @since 4.0
	 */
	protected $misc;

	/**
	 * Holds our Helper_Notices object
	 * which we can use to queue up admin messages for the user
	 *
	 * @var \GFPDF\Helper\Helper_Notices
	 *
	 * @since 4.0
	 */
	protected $notices;

	/**
	 * Holds our Helper_Templates object
	 * used to ease access to our PDF templates
	 *
	 * @var \GFPDF\Helper\Helper_Templates
	 *
	 * @since 4.0
	 */
	protected $templates;

	/**
	 * Setup our view with the needed data and classes
	 *
	 * @param \GFPDF\Helper\Helper_Abstract_Form    $gform   Our abstracted Gravity Forms helper functions
	 * @param \Monolog\Logger|LoggerInterface       $log     Our logger class
	 * @param \GFPDF\Helper\Helper_Abstract_Options $options Our options class which allows us to access any settings
	 * @param \GFPDF\Helper\Helper_Data             $data    Our plugin data store
	 * @param \GFPDF\Helper\Helper_Misc             $misc    Our miscellaneous class
	 * @param \GFPDF\Helper\Helper_Notices          $notices Our notice class used to queue admin messages and errors
	 * @param \GFPDF\Helper\Helper_Templates        $templates
	 *
	 * @since 4.0
	 */
	public function __construct( Helper_Abstract_Form $gform, LoggerInterface $log, Helper_Abstract_Options $options, Helper_Data $data, Helper_Misc $misc, Helper_Notices $notices, Helper_Templates $templates ) {

		/* Assign our internal variables */
		$this->gform     = $gform;
		$this->log       = $log;
		$this->options   = $options;
		$this->data      = $data;
		$this->misc      = $misc;
		$this->notices   = $notices;
		$this->templates = $templates;
	}

	/**
	 * Our Middleware used to handle the authentication process
	 *
	 * @param  string  $pid    The Gravity Form PDF Settings ID
	 * @param  integer $lid    The Gravity Form Entry ID
	 * @param  string  $action Whether the PDF should be viewed or downloaded
	 *
	 * @since 4.0
	 *
	 * @return WP_Error
	 */
	public function process_pdf( $pid, $lid, $action = 'view' ) {

		/**
		 * Check if we have a valid Gravity Form Entry and PDF Settings ID
		 */
		$entry = $this->gform->get_entry( $lid );

		/* not a valid entry */
		if ( is_wp_error( $entry ) ) {
			$this->log->addError( 'Invalid Entry.', [
				'entry' => $entry,
			] );

			return $entry; /* return error */
		}

		$settings = $this->options->get_pdf( $entry['form_id'], $pid );

		/* Not valid settings */
		if ( is_wp_error( $settings ) ) {

			$this->log->addError( 'Invalid PDF Settings.', [
				'entry'            => $entry,
				'WP_Error_Message' => $settings->get_error_message(),
				'WP_Error_Code'    => $settings->get_error_code(),
			] );

			return $settings; /* return error */
		}

		/* Add our download setting */
		$settings['pdf_action'] = $action;

		/**
		 * Our middleware authenticator
		 * Allow users to tap into our middleware and add or remove additional authentication layers
		 *
		 * Default middleware includes 'middle_public_access', 'middle_active', 'middle_conditional', 'middle_owner_restriction', 'middle_logged_out_timeout', 'middle_auth_logged_out_user', 'middle_user_capability'
		 * If WP_Error is returned the PDF won't be parsed
		 *
		 * See https://gravitypdf.com/documentation/v4/gfpdf_pdf_middleware/ for more details about this filter
		 */
		$middleware = apply_filters( 'gfpdf_pdf_middleware', false, $entry, $settings );

		/* Throw error */
		if ( is_wp_error( $middleware ) ) {

			$this->log->addError( 'PDF Authentication Failure.', [
				'entry'            => $entry,
				'settings'         => $settings,
				'WP_Error_Message' => $middleware->get_error_message(),
				'WP_Error_Code'    => $middleware->get_error_code(),
			] );

			return $middleware;
		}

		/* Add backwards compatibility support for certain settings */
		$settings = $this->apply_backwards_compatibility_filters( $settings, $entry );

		/* Ensure Gravity Forms depedancy loaded */
		$this->misc->maybe_load_gf_entry_detail_class();

		/* If we are here we can generate our PDF */
		$controller = $this->getController();
		$controller->view->generate_pdf( $entry, $settings );

		return null;
	}

	/**
	 * Apply filters to particular settings to maintain backwards compatibility
	 * Note: If you want to modify the $settings array you should use the new "gfpdf_pdf_config" filter instead
	 *
	 * @param  array $settings The PDF settings array
	 * @param  array $entry
	 *
	 * @return array           The $settings array
	 *
	 * @since  4.0
	 */
	public function apply_backwards_compatibility_filters( $settings, $entry ) {

		$form = $this->gform->get_form( $entry['form_id'] );

		$settings['filename'] = $this->misc->remove_extension_from_string( apply_filters( 'gfpdfe_pdf_name', $settings['filename'], $form, $entry ) );
		$settings['template'] = $this->misc->remove_extension_from_string( apply_filters( 'gfpdfe_template', $settings['template'], $form, $entry ), '.php' );

		if ( isset( $settings['orientation'] ) ) {
			$settings['orientation'] = apply_filters( 'gfpdf_orientation', $settings['orientation'], $form, $entry );
		}

		if ( isset( $settings['security'] ) ) {
			$settings['security'] = $this->misc->update_deprecated_config( apply_filters( 'gfpdf_security', $settings['security'], $form, $entry ) );
		}

		if ( isset( $settings['privileges'] ) ) {
			$settings['privileges'] = apply_filters( 'gfpdf_privilages', $settings['privileges'], $form, $entry );
		}

		if ( isset( $settings['password'] ) ) {
			$settings['password'] = apply_filters( 'gfpdf_password', $settings['password'], $form, $entry );
		}

		if ( isset( $settings['master_password'] ) ) {
			$settings['master_password'] = apply_filters( 'gfpdf_master_password', $settings['master_password'], $form, $entry );
		}

		if ( isset( $settings['rtl'] ) ) {
			$settings['rtl'] = $this->misc->update_deprecated_config( apply_filters( 'gfpdf_rtl', $settings['rtl'], $form, $entry ) );
		}

		return $settings;
	}

	/**
	 * Check if the current PDF trying to be viewed has public access enabled
	 * If it does, we'll remove some of our middleware filters to allow this feature
	 *
	 * @param  boolean|object $action
	 * @param  array          $entry    The Gravity Forms Entry
	 * @param  array          $settings The Gravity Form PDF Settings
	 *
	 * @return boolean|object
	 *
	 * @since 4.0
	 */
	public function middle_public_access( $action, $entry, $settings ) {

		if ( isset( $settings['public_access'] ) && 'Yes' === $settings['public_access'] ) {
			remove_filter( 'gfpdf_pdf_middleware', [ $this, 'middle_owner_restriction' ], 40 );
			remove_filter( 'gfpdf_pdf_middleware', [ $this, 'middle_logged_out_timeout' ], 50 );
			remove_filter( 'gfpdf_pdf_middleware', [ $this, 'middle_auth_logged_out_user' ], 60 );
			remove_filter( 'gfpdf_pdf_middleware', [ $this, 'middle_user_capability' ], 70 );
		}

		return $action;
	}

	/**
	 * Check if the current PDF trying to be viewed is active
	 *
	 * @param  boolean|object $action
	 * @param  array          $entry    The Gravity Forms Entry
	 * @param  array          $settings The Gravity Form PDF Settings
	 *
	 * @return boolean|object
	 *
	 * @since 4.0
	 */
	public function middle_active( $action, $entry, $settings ) {

		if ( ! is_wp_error( $action ) ) {
			if ( $settings['active'] !== true ) {
				return new WP_Error( 'inactive', esc_html__( 'The PDF configuration is not currently active.', 'gravity-forms-pdf-extended' ) );
			}
		}

		return $action;
	}

	/**
	 * Check if the current PDF trying to be viewed has conditional logic which passes
	 *
	 * @param  boolean|object $action
	 * @param  array          $entry    The Gravity Forms Entry
	 * @param  array          $settings The Gravity Form PDF Settings
	 *
	 * @return boolean|object
	 *
	 * @since 4.0
	 */
	public function middle_conditional( $action, $entry, $settings ) {

		if ( ! is_wp_error( $action ) ) {
			if ( isset( $settings['conditionalLogic'] ) && ! $this->misc->evaluate_conditional_logic( $settings['conditionalLogic'], $entry ) ) {
				return new WP_Error( 'conditional_logic', esc_html__( 'PDF conditional logic requirements have not been met.', 'gravity-forms-pdf-extended' ) );
			}
		}

		return $action;
	}

	/**
	 * Check if the current user attempting to access is the PDF owner
	 *
	 * @param  array  $entry The Gravity Forms Entry
	 * @param  string $type  The authentication type we should use
	 *
	 * @return boolean
	 *
	 * @since 4.0
	 */
	public function is_current_pdf_owner( $entry, $type = 'all' ) {
		$owner = false;
		/* check if the user is logged in and the entry is assigned to them */
		if ( $type === 'all' || $type === 'logged_in' ) {
			if ( is_user_logged_in() && (int) $entry['created_by'] === get_current_user_id() ) {
				$owner = true;
			}
		}

		if ( $type === 'all' || $type === 'logged_out' ) {
			$user_ip = trim( GFFormsModel::get_ip() );
			if ( $entry['ip'] == $user_ip && $entry['ip'] !== '127.0.0.1' && strlen( $user_ip ) !== 0 ) { /* check if the user IP matches the entry IP */
				$owner = true;
			}
		}

		return $owner;
	}

	/**
	 * Check the "Restrict Logged Out User" global setting and validate it against the current user
	 *
	 * @param  boolean|object $action
	 * @param  array          $entry    The Gravity Forms Entry
	 * @param  array          $settings The Gravity Form PDF Settings
	 *
	 * @return boolean|object
	 *
	 * @since 4.0
	 */
	public function middle_owner_restriction( $action, $entry, $settings ) {

		/* ensure another middleware filter hasn't already done validation */
		if ( ! is_wp_error( $action ) ) {
			/* get the setting */
			$owner_restriction = ( isset( $settings['restrict_owner'] ) ) ? $settings['restrict_owner'] : 'No';

			if ( $owner_restriction === 'Yes' && ! is_user_logged_in() ) {

				$this->log->addNotice( 'Security – Owner Restrictions: Redirecting to Login.', [
					'entry'    => $entry,
					'settings' => $settings,
				] );

				/* prompt user to login */
				auth_redirect();
			}
		}

		return $action;
	}

	/**
	 * Check the "Logged Out Timeout" global setting and validate it against the current user
	 *
	 * @param  boolean|object $action
	 * @param  array          $entry    The Gravity Forms Entry
	 * @param  array          $settings The Gravity Form PDF Settings
	 *
	 * @return boolean|object
	 *
	 * @since 4.0
	 */
	public function middle_logged_out_timeout( $action, $entry, $settings ) {

		/* ensure another middleware filter hasn't already done validation */
		if ( ! is_wp_error( $action ) ) {

			/* only check if PDF timed out if our logged out restriction is not 'Yes' and the user is not logged in */
			if ( ! is_user_logged_in() && $this->is_current_pdf_owner( $entry, 'logged_out' ) === true ) {
				/* get the global PDF settings */
				$timeout = (int) $this->options->get_option( 'logged_out_timeout', '20' );

				/* if '0' there is no timeout, or if the logged out restrictions are enabled we'll ignore this */
				if ( $timeout !== 0 ) {

					$timeout_stamp   = 60 * $timeout; /* 60 seconds multiplied by number of minutes */
					$entry_created   = strtotime( $entry['date_created'] ); /* get entry timestamp */
					$timeout_expires = $entry_created + $timeout_stamp; /* get the timeout expiry based on the entry created time */

					/* compare our two timestamps and throw error if outside the timeout */
					if ( time() > $timeout_expires ) {

						/* if there is no user account assigned to this entry throw error */
						if ( empty( $entry['created_by'] ) ) {
							return new WP_Error( 'timeout_expired', esc_html__( 'Your PDF is no longer accessible.', 'gravity-forms-pdf-extended' ) );
						} else {

							$this->log->addNotice( 'Security – Logged Out Timeout: Redirecting to Login.', [
								'entry'    => $entry,
								'settings' => $settings,
							] );

							/* prompt to login */
							auth_redirect();
						}
					}
				}
			}
		}

		return $action;
	}

	/**
	 * Check if the user is logged out and authenticate as needed
	 *
	 * @param  boolean|object $action
	 * @param  array          $entry    The Gravity Forms Entry
	 * @param  array          $settings The Gravity Form PDF Settings
	 *
	 * @return boolean|object
	 *
	 * @since 4.0
	 */
	public function middle_auth_logged_out_user( $action, $entry, $settings ) {

		if ( ! is_wp_error( $action ) ) {

			/* check if the user is not the current entry owner */
			if ( ! is_user_logged_in() && $this->is_current_pdf_owner( $entry, 'logged_out' ) === false ) {
				/* check if there is actually a user who owns entry */
				if ( ! empty( $entry['created_by'] ) ) {

					$this->log->addNotice( 'Security – Auth Logged Out User: Redirecting to Login.', [
						'entry'    => $entry,
						'settings' => $settings,
					] );

					/* prompt user to login to get access */
					auth_redirect();
				} else {
					$this->log->addWarning( 'Access denied.', [
						'entry'    => $entry,
						'settings' => $settings,
						'SERVER'   => $_SERVER,
					] );

					/* there's no returning, throw generic error */
					return new WP_Error( 'access_denied', esc_html__( 'You do not have access to view this PDF.', 'gravity-forms-pdf-extended' ) );
				}
			}
		}

		return $action;
	}

	/**
	 * Check the "User Restriction" global setting and validate it against the current user
	 *
	 * @param  boolean|object $action
	 * @param  array          $entry    The Gravity Forms Entry
	 * @param  array          $settings The Gravity Form PDF Settings
	 *
	 * @return boolean|object
	 *
	 * @since 4.0
	 */
	public function middle_user_capability( $action, $entry, $settings ) {

		if ( ! is_wp_error( $action ) ) {
			/* check if the user is logged in but is not the current owner */
			if ( is_user_logged_in() &&
			     ( ( $this->options->get_option( 'limit_to_admin', 'No' ) == 'Yes' ) || ( $this->is_current_pdf_owner( $entry, 'logged_in' ) === false ) )
			) {

				/* Handle permissions checks */
				$admin_permissions = $this->options->get_option( 'admin_capabilities', [ 'gravityforms_view_entries' ] );

				/* loop through permissions and check if the current user has any of those capabilities */
				$access = false;
				foreach ( $admin_permissions as $permission ) {
					if ( $this->gform->has_capability( $permission ) ) {
						$access = true;
					}
				}

				/* throw error if no access granted */
				if ( ! $access ) {
					return new WP_Error( 'access_denied', esc_html__( 'You do not have access to view this PDF.', 'gravity-forms-pdf-extended' ) );
				}
			}
		}

		return $action;
	}

	/**
	 * Display PDF on Gravity Form entry list page
	 *
	 * @param  integer $form_id  Gravity Form ID
	 * @param  integer $field_id Current field ID
	 * @param  mixed   $value    Current value of field
	 * @param  array   $entry    Entry Information
	 *
	 * @return void
	 *
	 * @since 4.0
	 */
	public function view_pdf_entry_list( $form_id, $field_id, $value, $entry ) {

		$controller = $this->getController();
		$pdf_list   = $this->get_pdf_display_list( $entry );

		if ( ! empty( $pdf_list ) ) {

			if ( sizeof( $pdf_list ) > 1 ) {
				$args = [
					'pdfs' => $pdf_list,
					'view' => strtolower( $this->options->get_option( 'default_action' ) ),
				];

				$controller->view->entry_list_pdf_multiple( $args );
			} else {
				/* Only one PDF for this form so display a simple 'View PDF' link */
				$args = [
					'pdf'  => array_shift( $pdf_list ),
					'view' => strtolower( $this->options->get_option( 'default_action' ) ),
				];

				$controller->view->entry_list_pdf_single( $args );
			}
		}
	}

	/**
	 * Display the PDF links on the entry detailed section of the admin area
	 *
	 * @param  integer $form_id Gravity Form ID
	 * @param  array   $entry   The entry information
	 *
	 * @return void
	 *
	 * @since  4.0
	 */
	public function view_pdf_entry_detail( $form_id, $entry ) {

		$controller = $this->getController();
		$pdf_list   = $this->get_pdf_display_list( $entry );

		if ( ! empty( $pdf_list ) ) {
			$args = [
				'pdfs' => $pdf_list,
			];
			$controller->view->entry_detailed_pdf( $args );
		}
	}

	/**
	 * Get a preformatted list of active PDFs with name and URL
	 *
	 * @param array $entry
	 *
	 * @return array
	 *
	 * @since 4.0
	 */
	public function get_pdf_display_list( $entry ) {

		/* Stores our formatted PDFs */
		$args = [];

		/* Check if we have any PDFs */
		$form = $this->gform->get_form( $entry['form_id'] );
		$pdfs = ( isset( $form['gfpdf_form_settings'] ) ) ? $this->get_active_pdfs( $form['gfpdf_form_settings'], $entry ) : [];

		if ( ! empty( $pdfs ) ) {

			foreach ( $pdfs as $settings ) {

				$args[] = [
					'name'     => $this->get_pdf_name( $settings, $entry ),
					'view'     => $this->get_pdf_url( $settings['id'], $entry['id'], false ),
					'download' => $this->get_pdf_url( $settings['id'], $entry['id'], true ),
				];
			}
		}

		/**
		 * See https://gravitypdf.com/documentation/v4/gfpdf_get_pdf_display_list/ for usage
		 * @since 4.2
		 */
		return apply_filters( 'gfpdf_get_pdf_display_list', $args, $entry, $form );
	}

	/**
	 * Generate the PDF Name
	 *
	 * @param  array $settings The PDF Form Settings
	 * @param  array $entry    The Gravity Form entry details
	 *
	 * @return string      The PDF Name
	 *
	 * @since  4.0
	 */
	public function get_pdf_name( $settings, $entry ) {

		$form = $this->gform->get_form( $entry['form_id'] );
		$name = $this->gform->process_tags( $settings['filename'], $form, $entry );

		/* Decode HTML entities */
		$name = wp_specialchars_decode( $name, ENT_QUOTES );

		/*
		 * Add filter to modify PDF name
		 *
		 * See https://gravitypdf.com/documentation/v4/gfpdf_pdf_filename/ for more details about this filter
		 */
		$name = apply_filters( 'gfpdf_pdf_filename', $name, $form, $entry, $settings );

		/* Backwards compatible filter */
		$name = apply_filters( 'gfpdfe_pdf_filename', $name, $form, $entry, $settings );

		/* Remove any characters that cannot be present in a filename */
		$name = $this->misc->strip_invalid_characters( $name );

		return $name;
	}

	/**
	 * Create a PDF Link based on the current PDF settings and entry
	 *
	 * @param  integer $pid      The PDF Form Settings ID
	 * @param  integer $id       The Gravity Form entry ID
	 * @param  boolean $download Whether the PDF should be downloaded or not
	 * @param  boolean $print    Whether we should mark the PDF to be printed
	 * @param  boolean $esc      Whether to escape the URL or not
	 *
	 * @return string       Direct link to the PDF
	 *
	 * @since  4.0
	 */
	public function get_pdf_url( $pid, $id, $download = false, $print = false, $esc = true ) {
		global $wp_rewrite;

		/*
		 * Patch for WPML which can include the default language as a GET parameter
		 * See https://github.com/GravityPDF/gravity-pdf/issues/550
		 */
		$home_url = strtok( home_url(), '?' );

		/* Check if permalinks are enabled, otherwise fall back to our ugly link structure for 4.0 (not the same as our v3 links) */
		if ( $wp_rewrite->using_permalinks() ) {
			$url = $home_url . '/' . $wp_rewrite->root; /* Handle "almost pretty" permalinks - fix for IIS servers without modrewrite  */
			$url .= 'pdf/' . $pid . '/' . $id . '/';

			if ( $download ) {
				$url .= 'download/';
			}

			if ( $print ) {
				$url .= '?print=1';
			}
		} else {
			$url = $home_url . '/?gpdf=1&pid=' . $pid . '&lid=' . $id;

			if ( $download ) {
				$url .= '&action=download';
			}

			if ( $print ) {
				$url .= '&print=1';
			}
		}

		if ( $esc ) {
			$url = esc_url( $url );
		}

		/**
		 * @since 4.2
		 */
		return apply_filters( 'gfpdf_get_pdf_url', $url, $pid, $id, $download, $print, $esc );
	}

	/**
	 * Filter out inactive PDFs and those who don't meet the conditional logic
	 *
	 * @param  array $pdfs  The PDF settings array
	 * @param  array $entry The current entry information
	 *
	 * @return array       The filtered PDFs
	 *
	 * @since 4.0
	 */
	public function get_active_pdfs( $pdfs, $entry ) {

		$filtered = [];
		$form     = $this->gform->get_form( $entry['form_id'] );

		foreach ( $pdfs as $pdf ) {
			if ( $pdf['active'] && ( empty( $pdf['conditionalLogic'] ) || $this->misc->evaluate_conditional_logic( $pdf['conditionalLogic'], $entry ) ) ) {
				$filtered[ $pdf['id'] ] = $pdf;
			}
		}

		/**
		 * See https://gravitypdf.com/documentation/v4/gfpdf_get_active_pdfs/ for usage
		 * @since 4.2
		 */
		return apply_filters( 'gfpdf_get_active_pdfs', $filtered, $pdfs, $entry, $form );
	}

	/**
	 * Generate and save PDF to disk
	 *
	 * @param \GFPDF\Helper\Helper_PDF $pdf The Helper_PDF object
	 *
	 * @return boolean
	 *
	 * @since 4.0
	 */
	public function process_and_save_pdf( Helper_PDF $pdf ) {

		/**
		 * See https://gravitypdf.com/documentation/v4/gfpdf_override_pdf_bypass/ for usage
		 *
		 * @since 4.2
		 */
		$pdf_override = apply_filters( 'gfpdf_override_pdf_bypass', false, $pdf );

		/* Check that the PDF hasn't already been created this session */
		if ( $pdf_override || ! $this->does_pdf_exist( $pdf ) ) {

			/* Ensure Gravity Forms depedancy loaded */
			$this->misc->maybe_load_gf_entry_detail_class();

			/* Enable Multicurrency support */
			$this->misc->maybe_add_multicurrency_support();

			/* Get required parameters */
			$entry    = $pdf->get_entry();
			$settings = $pdf->get_settings();
			$form     = $this->gform->get_form( $entry['form_id'] );

			$args = $this->templates->get_template_arguments(
				$form,
				$this->misc->get_fields_sorted_by_id( $form['id'] ),
				$entry,
				$this->get_form_data( $entry ),
				$settings,
				$this->templates->get_config_class( $settings['template'] ),
				$this->misc->get_legacy_ids( $entry['id'], $settings )
			);

			/* Add backwards compatibility support */
			$GLOBALS['wp']->query_vars['pid'] = $settings['id'];
			$GLOBALS['wp']->query_vars['lid'] = $entry['id'];

			try {

				/* Initialise our PDF helper class */
				$pdf->init();
				$pdf->set_template();
				$pdf->set_output_type( 'save' );

				/* Increment our rudimentary PDF counter */
				$this->options->increment_pdf_count();

				/* Add Backwards compatibility support for our v3 Tier 2 Add-on */
				if ( isset( $settings['advanced_template'] ) && strtolower( $settings['advanced_template'] ) == 'yes' ) {

					/* Check if we should process this document using our legacy system */
					if ( $this->handle_legacy_tier_2_processing( $pdf, $entry, $settings, $args ) ) {
						return true;
					}
				}

				/* Render the PDF template HTML */
				$pdf->render_html( $args );

				/* Generate and save the PDF */
				$pdf->save_pdf( $pdf->generate() );

				return true;
			} catch ( Exception $e ) {

				$this->log->addError( 'PDF Generation Error', [
					'pdf'       => $pdf,
					'exception' => $e->getMessage(),
				] );

				return false;
			}
		}

		return true;
	}

	/**
	 * Handles the loading and running of our legacy Tier 2 PDF templates
	 *
	 * @param \GFPDF\Helper\Helper_PDF $pdf      The Helper_PDF object
	 * @param array                    $entry    The Gravity Forms raw entry data
	 * @param array                    $settings The Gravity PDF settings
	 * @param array                    $args     The data that should be passed directly to a PDF template
	 *
	 * @return bool
	 *
	 * @since 4.0
	 */
	public function handle_legacy_tier_2_processing( Helper_PDF $pdf, $entry, $settings, $args ) {

		$form = $this->gform->get_form( $entry['form_id'] );

		$prevent_main_pdf_loader = apply_filters( 'gfpdfe_pre_load_template',
			$form['id'],
			$entry['id'],
			basename( $pdf->get_template_path() ),
			$form['id'] . $entry['id'],
			$this->misc->backwards_compat_output( $pdf->get_output_type() ),
			$pdf->get_filename(),
			$this->misc->backwards_compat_conversion( $settings, $form, $entry ),
			$args
		); /* Backwards Compatibility */

		return ( $prevent_main_pdf_loader === true ) ? true : false;
	}

	/**
	 * Generate and save the PDF to disk
	 *
	 * @param  array $entry    The Gravity Form entry array (usually passed in as a filter or pulled using GFAPI::get_entry( $id ) )
	 * @param  array $settings The PDF configuration settings for the particular entry / form being processed
	 *
	 * @return string|WP_Error           Return the full path to the PDF, or a WP_Error on failure
	 *
	 * @since 4.0
	 */
	public function generate_and_save_pdf( $entry, $settings ) {

		$pdf_generator = new Helper_PDF( $entry, $settings, $this->gform, $this->data, $this->misc, $this->templates );
		$pdf_generator->set_filename( $this->get_pdf_name( $settings, $entry ) );
		$pdf_generator = apply_filters( 'gfpdf_pdf_generator_pre_processing', $pdf_generator );

		if ( $this->process_and_save_pdf( $pdf_generator ) ) {
			$pdf_path = $pdf_generator->get_full_pdf_path();

			if ( is_file( $pdf_path ) ) {

				/* Add appropriate filters so developers can access the PDF when it is generated */
				$form     = $this->gform->get_form( $entry['form_id'] );
				$filename = basename( $pdf_path );

				do_action( 'gfpdf_post_pdf_save', $form['id'], $entry['id'], $settings, $pdf_path ); /* Backwards compatibility */

				/* See https://gravitypdf.com/documentation/v4/gfpdf_post_save_pdf/ for more details about these actions */
				do_action( 'gfpdf_post_save_pdf', $pdf_path, $filename, $settings, $entry, $form );
				do_action( 'gfpdf_post_save_pdf_' . $form['id'], $pdf_path, $filename, $settings, $entry, $form );

				return $pdf_path;
			}
		}

		return new WP_Error( 'pdf_generation_failure', esc_html__( 'The PDF could not be saved.', 'gravity-forms-pdf-extended' ) );

	}

	/**
	 * Check if the form has any PDFs, generate them and attach to the notification
	 *
	 * @param  array $notifications Gravity Forms Notification Array
	 * @param  array $form
	 * @param  array $entry
	 *
	 * @return array
	 *
	 * @since 4.0
	 */
	public function notifications( $notifications, $form, $entry ) {

		/*
		 * Ensure our entry is stored in the database by checking it has an ID
		 * This resolves any issues with the "Save and Continue" feature
		 * See https://github.com/GravityPDF/gravity-pdf/issues/360
		 */
		if ( null === $entry['id'] ) {
			return $notifications;
		}

		$pdfs = ( isset( $form['gfpdf_form_settings'] ) ) ? $this->get_active_pdfs( $form['gfpdf_form_settings'], $entry ) : [];

		if ( sizeof( $pdfs ) > 0 ) {

			/* Ensure our notification has an array setup for the attachments key */
			$notifications['attachments'] = ( isset( $notifications['attachments'] ) ) ? $notifications['attachments'] : [];

			/* Loop through each PDF config and generate */
			foreach ( $pdfs as $settings ) {

				/* Reset the variables each loop */
				$filename = $tier_2_filename = '';

				if ( $this->maybe_attach_to_notification( $notifications, $settings, $entry, $form ) ) {

					/* Generate our PDF */
					$filename = $this->generate_and_save_pdf( $entry, $settings );

					if ( ! is_wp_error( $filename ) ) {
						$notifications['attachments'][] = $filename;
					}
				}
			}

			$this->log->addNotice( 'Gravity Forms Attachments', [
				'attachments'  => $notifications['attachments'],
				'notification' => $notifications,
			] );
		}

		return $notifications;
	}

	/**
	 * Determine if the PDF should be attached to the current notification
	 *
	 * @param  array $notification The Gravity Form Notification currently being processed
	 * @param  array $settings     The current Gravity PDF Settings
	 * @param  array $form         Added to 4.2
	 * @param  array $entry        Added to 4.2
	 *
	 * @return boolean
	 *
	 * @since 4.0
	 */
	public function maybe_attach_to_notification( $notification, $settings, $entry = [], $form = [] ) {

		$attach = false;
		if ( isset( $settings['notification'] ) && is_array( $settings['notification'] ) ) {
			if ( in_array( $notification['id'], $settings['notification'] ) ) {
				$attach = true;
			}
		}

		/**
		 * See https://gravitypdf.com/documentation/v4/gfpdf_maybe_attach_to_notification/ for usage
		 * @since 4.2
		 */
		return apply_filters( 'gfpdf_maybe_attach_to_notification', $attach, $notification, $settings, $entry, $form );
	}

	/**
	 * Determine if the PDF should be saved to disk
	 *
	 * @param  array $settings The current Gravity PDF Settings
	 *
	 * @return boolean
	 *
	 * @since 4.0
	 */
	public function maybe_always_save_pdf( $settings ) {

		$save = false;
		if ( isset( $settings['save'] ) && strtolower( $settings['save'] ) == 'yes' ) {
			$save = true;
		}

		/**
		 * @since 4.2
		 */
		return apply_filters( 'gfpdf_maybe_always_save_pdf', $save, $settings );
	}

	/**
	 * Creates a PDF on every submission, except when the PDF is already created during the notification hook
	 *
	 * @param  array $entry The GF Entry Details
	 * @param  array $form  The Gravity Form
	 *
	 * @return void
	 *
	 * @since 4.0
	 */
	public function maybe_save_pdf( $entry, $form ) {
		$pdfs = ( isset( $form['gfpdf_form_settings'] ) ) ? $this->get_active_pdfs( $form['gfpdf_form_settings'], $entry ) : [];

		if ( sizeof( $pdfs ) > 0 ) {

			/* Loop through each PDF config */
			foreach ( $pdfs as $pdf ) {
				$settings = $this->options->get_pdf( $entry['form_id'], $pdf['id'] );

				/* Only generate if the PDF wasn't created during the notification process */
				if ( ! is_wp_error( $settings ) && $this->maybe_always_save_pdf( $settings ) ) {
					$this->generate_and_save_pdf( $entry, $settings );
				}
			}
		}
	}

	/**
	 * Check if the current PDF to be processed already exists on disk
	 *
	 * @param  \GFPDF\Helper\Helper_PDF $pdf The Helper_PDF Object
	 *
	 * @return boolean
	 *
	 * @since  4.0
	 */
	public function does_pdf_exist( Helper_PDF $pdf ) {

		if ( is_file( $pdf->get_full_pdf_path() ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Clean-up our tmp directory every 24 hours
	 *
	 * @return void
	 *
	 * @since 4.0
	 */
	public function cleanup_tmp_dir() {
		$max_file_age  = time() - 24 * 3600; /* Max age is 24 hours old */
		$tmp_directory = $this->data->template_tmp_location;

		if ( is_dir( $tmp_directory ) ) {

			try {
				$directory_list = new \RecursiveIteratorIterator(
					new \RecursiveDirectoryIterator( $tmp_directory, \RecursiveDirectoryIterator::SKIP_DOTS ),
					\RecursiveIteratorIterator::CHILD_FIRST
				);

				foreach ( $directory_list as $file ) {
					if ( in_array( $file->getFilename(), [ '.htaccess', 'index.html' ] ) ) {
						continue;
					}

					if ( $file->isReadable() && $file->getMTime() < $max_file_age ) {
						( $file->isDir() ) ? $this->misc->rmdir( $file->getPathName() ) : unlink( $file->getPathName() );
					}
				}
			} catch ( Exception $e ) {
				$this->log->addError( 'Filesystem Delete Error', [
					'dir'       => $tmp_directory,
					'exception' => $e->getMessage(),
				] );
			}
		}
	}

	/**
	 * Remove the generated PDF from the server to save disk space
	 *
	 * @internal  In future we may give the option to cache PDFs to save on processing power
	 *
	 * @param  array $entry The GF Entry Data
	 * @param  array $form  The Gravity Form
	 *
	 * @return void
	 *
	 * @since     4.0
	 *
	 * @todo      Add PDF caching support to make software more performant. Need to review correct triggers for a cleanup (API-based, UI actions, 3rd-party add-on compatibility)
	 */
	public function cleanup_pdf( $entry, $form ) {

		$pdfs = ( isset( $form['gfpdf_form_settings'] ) ) ? $this->get_active_pdfs( $form['gfpdf_form_settings'], $entry ) : [];

		if ( sizeof( $pdfs ) > 0 ) {

			/* loop through each PDF config */
			foreach ( $pdfs as $pdf ) {
				$settings = $this->options->get_pdf( $entry['form_id'], $pdf['id'] );

				/* Only generate if the PDF wasn't during the notification process */
				if ( ! is_wp_error( $settings ) ) {

					$pdf_generator = new Helper_PDF( $entry, $settings, $this->gform, $this->data, $this->misc, $this->templates );
					$pdf_generator->set_filename( $this->get_pdf_name( $settings, $entry ) );

					if ( $this->does_pdf_exist( $pdf_generator ) ) {
						try {
							$this->misc->rmdir( $pdf_generator->get_path() );
						} catch ( Exception $e ) {

							$this->log->addError( 'Cleanup PDF Error', [
								'pdf'       => $pdf,
								'exception' => $e->getMessage(),
							] );
						}
					}
				}
			}
		}
	}

	/**
	 * Triggered after the Gravity Form entry is updated
	 *
	 * @param array $form
	 * @param int   $entry_id
	 */
	public function cleanup_pdf_after_submission( $form, $entry_id ) {
		$entry = $this->gform->get_entry( $entry_id );
		$this->cleanup_pdf( $entry, $form );
	}

	/**
	 * Clean-up any PDFs stored on disk before we resend any notifications
	 *
	 * @param array $form  The Gravity Forms object
	 * @param array $leads An array of Gravity Form entry IDs
	 *
	 * @since 4.0
	 *
	 * @return array We tapped into a filter so we need to return the form object
	 */
	public function resend_notification_pdf_cleanup( $form, $entries ) {
		foreach ( $entries as $entry_id ) {
			$entry = $this->gform->get_entry( $entry_id );
			$this->cleanup_pdf( $entry, $form );
		}

		return $form;
	}

	/**
	 * Changes mPDF's tmp folder
	 *
	 * @param  string $path The current path
	 *
	 * @return string       The new path
	 */
	public function mpdf_tmp_path( $path ) {
		return $this->data->template_tmp_location;
	}

	/**
	 * Changes mPDF's fontdata folders
	 *
	 * @param  string $path The current path
	 *
	 * @return string       The new path
	 */
	public function mpdf_tmp_font_path( $path ) {
		return $this->data->template_fontdata_location;
	}

	/**
	 * An mPDF filter that checks if mPDF has the font currently installed, otherwise
	 * will look in the Gravity PDF font folder for an alternative.
	 *
	 * @param string $path The current path to the font mPDF is trying to load
	 * @param string $font The current font name trying to be loaded
	 *
	 * @since 4.0
	 *
	 * @return string
	 */
	public function set_current_pdf_font( $path, $font ) {

		/* If the current font doesn't exist in mPDF core we'll look in our font folder */
		if ( ! is_file( $path ) && is_file( $this->data->template_font_location . $font ) ) {
			$path = $this->data->template_font_location . $font;
		}

		return $path;
	}

	/**
	 * An mPDF filter which will register our custom font data with mPDF
	 *
	 * @param array $fonts The registered fonts
	 *
	 * @since 4.0
	 *
	 * @return array
	 */
	public function register_custom_font_data_with_mPDF( $fonts ) {

		$custom_fonts = $this->options->get_custom_fonts();

		foreach ( $custom_fonts as $font ) {

			$fonts[ $font['shortname'] ] = array_filter( [
				'R'  => basename( $font['regular'] ),
				'B'  => basename( $font['bold'] ),
				'I'  => basename( $font['italics'] ),
				'BI' => basename( $font['bolditalics'] ),
			] );
		}

		return $fonts;
	}

	/**
	 * Read all fonts from our fonts directory and auto-load them into mPDF if they are not found
	 *
	 * @param array $fonts The registered fonts
	 *
	 * @since 4.0
	 *
	 * @return array
	 */
	public function add_unregistered_fonts_to_mPDF( $fonts ) {

		$user_fonts = glob( $this->data->template_font_location . '*.[tT][tT][fF]' );
		$user_fonts = ( is_array( $user_fonts ) ) ? $user_fonts : [];

		foreach ( $user_fonts as $font ) {

			/* Get font shortname */
			$font_name  = basename( $font );
			$short_name = $this->options->get_font_short_name( substr( $font_name, 0, -4 ) );

			/* Check if it exists already, otherwise add it */
			if ( ! isset( $fonts[ $short_name ] ) && ! $this->misc->in_array( $font_name, $fonts ) ) {
				$fonts[ $short_name ] = [
					'R' => $font_name,
				];
			}
		}

		return $fonts;
	}

	/**
	 * Generates our $data array
	 *
	 * @param  array $entry The Gravity Form Entry
	 *
	 * @return array        The $data array
	 *
	 * @since 4.0
	 */
	public function get_form_data( $entry ) {

		$entry = apply_filters( 'gfpdf_entry_pre_form_data', $entry );

		if ( ! isset( $entry['form_id'] ) ) {
			return [];
		}

		$form = $this->gform->get_form( $entry['form_id'] );

		if ( ! is_array( $form ) ) {
			return [];
		}

		/* Setup our basic structure */
		$data = [
			'misc'               => [],
			'field'              => [],
			'field_descriptions' => [],
		];

		/**
		 * Create a product class for use
		 *
		 * @var Field_Products
		 */
		$products = new Field_Products( new GF_Field(), $entry, $this->gform, $this->misc );

		/* Get the form details */
		$form_meta = $this->get_form_data_meta( $form, $entry );

		/* Get the survey, quiz and poll data if applicable */
		$quiz   = $this->get_quiz_results( $form, $entry );
		$survey = $this->get_survey_results( $form, $entry );
		$poll   = $this->get_poll_results( $form, $entry );

		/* Merge in the meta data and survey, quiz and poll data */
		$data = array_replace_recursive( $data, $form_meta, $quiz, $survey, $poll );

		/*
		 * Loop through the form data, call the correct field object and
		 * save the data to our $data array
		 */
		if ( isset( $form['fields'] ) ) {
			foreach ( $form['fields'] as $field ) {

				/* Skip over captcha, password and page fields */
				$fields_to_skip = apply_filters( 'gfpdf_form_data_skip_fields', [
					'captcha',
					'password',
					'page',
				] );

				if ( in_array( $field->type, $fields_to_skip ) ) {
					continue;
				}

				/* Include any field descriptions */
				$data['field_descriptions'][ $field->id ] = ( ! empty( $field->description ) ) ? $field->description : '';

				/* Get our field object */
				$class = $this->get_field_class( $field, $form, $entry, $products );

				/* Merge in the field object form_data() results */
				$data = array_replace_recursive( $data, $class->form_data() );
			}
		}

		/* Load our product array if products exist */
		if ( ! $products->is_empty() ) {
			$data = array_replace_recursive( $data, $products->form_data() );
		}

		/* Re-order the array keys to make it more readable */
		$order = apply_filters( 'gfpdf_form_data_key_order', [
			'misc',
			'field',
			'list',
			'signature_details_id',
			'products',
			'products_totals',
			'poll',
			'survey',
			'quiz',
			'pages',
			'html_id',
			'section_break',
			'field_descriptions',
			'signature',
			'signature_details',
			'html',
		] );

		foreach ( $order as $key ) {

			/* If item exists pop it onto the end of the array */
			if ( isset( $data[ $key ] ) ) {
				$item = $data[ $key ];
				unset( $data[ $key ] );
				$data[ $key ] = $item;
			}
		}

		/**
		 * See https://gravitypdf.com/documentation/v4/gfpdf_form_data/ for usage
		 * @since 4.2
		 */
		return apply_filters( 'gfpdf_form_data', $data, $entry, $form );
	}

	/**
	 * Return our general $data information
	 *
	 * @param  array $form  The Gravity Form
	 * @param  array $entry The Gravity Form Entry
	 *
	 * @return array        The $data array
	 *
	 * @since 4.0
	 */
	public function get_form_data_meta( $form, $entry ) {
		$data = [];

		/* Add form_id and entry_id for convinience */
		$data['form_id']  = $entry['form_id'];
		$data['entry_id'] = $entry['id'];

		/* Set title and dates (both US and international) */
		$data['form_title'] = ( isset( $form['title'] ) ) ? $form['title'] : '';

		$data['form_description'] = ( isset( $form['description'] ) ) ? $form['description'] : '';
		$data['date_created']     = GFCommon::format_date( $entry['date_created'], false, 'j/n/Y', false );
		$data['date_created_usa'] = GFCommon::format_date( $entry['date_created'], false, 'n/j/Y', false );

		/* Include page names */
		$data['pages'] = ( isset( $form['pagination']['pages'] ) ? $form['pagination']['pages'] : [] );

		/* Add misc fields */
		$data['misc']['date_time'] = GFCommon::format_date( $entry['date_created'], false, 'Y-m-d H:i:s', false );
		$data['misc']['time_24hr'] = GFCommon::format_date( $entry['date_created'], false, 'H:i', false );
		$data['misc']['time_12hr'] = GFCommon::format_date( $entry['date_created'], false, 'g:ia', false );

		$include = [
			'is_starred',
			'is_read',
			'ip',
			'source_url',
			'post_id',
			'currency',
			'payment_status',
			'payment_date',
			'transaction_id',
			'payment_amount',
			'is_fulfilled',
			'created_by',
			'transaction_type',
			'user_agent',
			'status',
		];

		foreach ( $include as $item ) {
			$data['misc'][ $item ] = ( isset( $entry[ $item ] ) ) ? $entry[ $item ] : '';
		}

		return $data;
	}

	/**
	 * Pull the Survey Results into the $form_data array
	 *
	 * @param  array $form  The Gravity Form
	 * @param  array $entry The Gravity Form Entry
	 *
	 * @return array        The results
	 *
	 * @since  4.0
	 */
	public function get_survey_results( $form, $entry ) {

		$data = [];

		if ( class_exists( 'GFSurvey' ) && $this->check_field_exists( 'survey', $form ) ) {

			/* Get survey fields */
			$fields = GFCommon::get_fields_by_type( $form, [ 'survey' ] );

			/* Include the survey score, if any */
			if ( isset( $entry['gsurvey_score'] ) ) {
				$data['survey']['score'] = $entry['gsurvey_score'];
			}

			$results = $this->get_addon_global_data( $form, [], $fields );

			/* Loop through the global survey data and convert information correctly */
			foreach ( $fields as $field ) {

				/* Check if we have a multifield likert and replace the row key */
				if ( isset( $field['gsurveyLikertEnableMultipleRows'] ) && $field['gsurveyLikertEnableMultipleRows'] == 1 ) {

					foreach ( $field['gsurveyLikertRows'] as $row ) {

						$results['field_data'][ $field->id ] = $this->replace_key( $results['field_data'][ $field->id ], $row['value'], $row['text'] );

						if ( isset( $field->choices ) && is_array( $field->choices ) ) {
							foreach ( $field->choices as $choice ) {
								$results['field_data'][ $field->id ][ $row['text'] ] = $this->replace_key( $results['field_data'][ $field->id ][ $row['text'] ], $choice['value'], $choice['text'] );
							}
						}
					}
				}

				/* Replace the standard row data */
				if ( isset( $field->choices ) && is_array( $field->choices ) ) {
					foreach ( $field->choices as $choice ) {
						$results['field_data'][ $field->id ] = $this->replace_key( $results['field_data'][ $field->id ], $choice['value'], $choice['text'] );
					}
				}
			}

			$data['survey']['global'] = $results;
		}

		return $data;
	}

	/**
	 * Pull the Quiz Results into the $form_data array
	 *
	 * @param  array $form  The Gravity Form
	 * @param  array $entry The Gravity Form Entry
	 *
	 * @return array        The results
	 *
	 * @since  4.0
	 */
	public function get_quiz_results( $form, $entry ) {

		$data = [];

		if ( class_exists( 'GFQuiz' ) && $this->check_field_exists( 'quiz', $form ) ) {

			/* Get quiz fields */
			$fields = GFCommon::get_fields_by_type( $form, [ 'quiz' ] );

			/* Store the quiz pass configuration */
			$data['quiz']['config']['grading']     = ( isset( $form['gravityformsquiz']['grading'] ) ) ? $form['gravityformsquiz']['grading'] : '';
			$data['quiz']['config']['passPercent'] = ( isset( $form['gravityformsquiz']['passPercent'] ) ) ? $form['gravityformsquiz']['passPercent'] : '';
			$data['quiz']['config']['grades']      = ( isset( $form['gravityformsquiz']['grades'] ) ) ? $form['gravityformsquiz']['grades'] : '';

			/* Store the user's quiz results */
			$data['quiz']['results']['score']   = rgar( $entry, 'gquiz_score' );
			$data['quiz']['results']['percent'] = rgar( $entry, 'gquiz_percent' );
			$data['quiz']['results']['is_pass'] = rgar( $entry, 'gquiz_is_pass' );
			$data['quiz']['results']['grade']   = rgar( $entry, 'gquiz_grade' );

			/* Poll for the global quiz overall results */
			$data['quiz']['global'] = $this->get_quiz_overall_data( $form, $fields );

		}

		return $data;
	}

	/**
	 * Pull the Poll Results into the $form_data array
	 *
	 * @param  array $form  The Gravity Form
	 * @param  array $entry The Gravity Form Entry
	 *
	 * @return array        The results
	 *
	 * @since  4.0
	 */
	public function get_poll_results( $form, $entry ) {

		$data = [];

		if ( class_exists( 'GFPolls' ) && $this->check_field_exists( 'poll', $form ) ) {

			/* Get poll fields and the overall results */
			$fields  = GFCommon::get_fields_by_type( $form, [ 'poll' ] );
			$results = $this->get_addon_global_data( $form, [], $fields );

			/* Loop through our fields and update the results as needed */
			foreach ( $fields as $field ) {

				/* Add the field name to a new 'misc' array key */
				$results['field_data'][ $field->id ]['misc']['label'] = $field->label;

				/* Loop through the field choices */
				foreach ( $field->choices as $choice ) {
					$results['field_data'][ $field->id ] = $this->replace_key( $results['field_data'][ $field->id ], $choice['value'], $choice['text'] );
				}
			}

			$data['poll']['global'] = $results;
		}

		return $data;
	}

	/**
	 * Parse the Quiz Overall Results
	 *
	 * @param  array $form   The Gravity Form
	 * @param  array $fields The quiz fields
	 *
	 * @return array         The parsed results
	 *
	 * @since 4.0
	 */
	public function get_quiz_overall_data( $form, $fields ) {

		if ( ! class_exists( 'GFQuiz' ) ) {
			return [];
		}

		/* GFQuiz is a singleton. Get the instance */
		$quiz = GFQuiz::get_instance();

		/* Create our callback to add additional data to the array specific to the quiz plugin */
		$options['callbacks']['calculation'] = [
			$quiz,
			'results_calculation',
		];

		$results = $this->get_addon_global_data( $form, $options, $fields );

		/* Loop through our fields and update our global results */
		foreach ( $fields as $field ) {

			/* Replace ['totals'] key with ['misc'] key */
			$results['field_data'][ $field->id ] = $this->replace_key( $results['field_data'][ $field->id ], 'totals', 'misc' );

			/* Add the field name to the ['misc'] key */
			$results['field_data'][ $field->id ]['misc']['label'] = $field->label;

			/* Loop through the field choices */
			if ( is_array( $field->choices ) ) {
				foreach ( $field->choices as $choice ) {
					$results['field_data'][ $field->id ] = $this->replace_key( $results['field_data'][ $field->id ], $choice['value'], $choice['text'] );

					/* Check if this is the correct field */
					if ( isset( $choice['gquizIsCorrect'] ) && $choice['gquizIsCorrect'] == 1 ) {
						$results['field_data'][ $field->id ]['misc']['correct_option_name'][] = esc_html( $choice['text'] );
					}
				}
			}
		}

		return $results;
	}

	/**
	 * Pull Gravity Forms global results Data
	 *
	 * @param  array $form    The Gravity Form array
	 * @param  array $options The global query options
	 * @param  array $fields  The field array to use in our query
	 *
	 * @return array          The results
	 *
	 * @since 4.0
	 */
	private function get_addon_global_data( $form, $options, $fields ) {
		/* If the results class isn't loaded, load it */
		if ( ! class_exists( 'GFResults' ) ) {
			require_once( GFCommon::get_base_path() . '/includes/addon/class-gf-results.php' );
		}

		$form_id = $form['id'];

		/* Add form filter to keep in line with GF standard */
		$form = apply_filters( 'gform_form_pre_results', $form );
		$form = apply_filters( 'gform_form_pre_results_' . $form_id, $form );

		/* Initiate the results class */
		$gf_results = new GFResults( '', $options );

		/* Ensure that only active leads are queried */
		$search = [
			'field_filters' => [ 'mode' => '' ],
			'status'        => 'active',
		];

		/* Get the results */
		$data = $gf_results->get_results_data( $form, $fields, $search );

		/* Unset some array keys we don't need */
		unset( $data['status'] );
		unset( $data['timestamp'] );

		return $data;
	}

	/**
	 * Sniff the form fields and determine if there are any of the $type available
	 *
	 * @param  string $type the field type we are looking for
	 * @param  array  $form the form array
	 *
	 * @return boolean       Whether there is a match or not
	 *
	 * @since 4.0
	 */
	public function check_field_exists( $type, $form ) {

		if ( isset( $form['fields'] ) ) {
			foreach ( $form['fields'] as $field ) {
				if ( $field['type'] == $type ) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Swap out the array key
	 *
	 * @param  array  $array           The array to be modified
	 * @param  string $key             The key to remove
	 * @param  string $replacement_key The new array key
	 *
	 * @return array        The modified array
	 *
	 * @since 4.0
	 */
	public function replace_key( $array, $key, $replacement_key ) {
		if ( $key !== $replacement_key && isset( $array[ $key ] ) ) {

			/* Replace the array key with the actual field name */
			$array[ $replacement_key ] = $array[ $key ];
			unset( $array[ $key ] );
		}

		return $array;
	}

	/**
	 * Pass in a Gravity Form Field Object and get back a Gravity PDF Field Object
	 *
	 * @param  object                              $field    Gravity Form Field Object
	 * @param  array                               $form     The Gravity Form Array
	 * @param  array                               $entry    The Gravity Form Entry
	 * @param  \GFPDF\Helper\Fields\Field_Products $products A Field_Products Object
	 *
	 * @return object        Gravity PDF Field Object
	 *
	 * @since 4.0
	 */
	public function get_field_class( $field, $form, $entry, Field_Products $products ) {

		$class_name = $this->misc->get_field_class( $field->type );

		try {
			/* if we have a valid class name... */
			if ( class_exists( $class_name ) ) {

				/**
				 * Developer Note
				 *
				 * We've purposefully not added any filters to the Field_* child classes directly.
				 * Instead, if you want to change how one of the fields are displayed or output (without effecting Gravity Forms itself) you should tap
				 * into one of the filters below and override or extend the entire class.
				 *
				 * Your class MUST extend the \GFPDF\Helper\Helper_Abstract_Fields abstract class - either directly or by extending an existing \GFPDF\Helper\Fields class.
				 * eg. class Fields_New_Text extends \GFPDF\Helper\Helper_Abstract_Fields or Fields_New_Text extends \GFPDF\Helper\Fields\Field_Text
				 *
				 * To make your life more simple you should either use the same namespace as the field classes (\GFPDF\Helper\Fields) or import the class directly (use \GFPDF\Helper\Fields\Field_Text)
				 * We've tried to make the fields as modular as possible. If you have any feedback about this approach please submit a ticket on GitHub (https://github.com/GravityPDF/gravity-pdf/issues)
				 */

				$class = new $class_name( $field, $entry, $this->gform, $this->misc );

				if ( $class instanceof Helper_Abstract_Field_Products ) {
					$class->set_products( $products );
				}

				/*
				 * See https://gravitypdf.com/documentation/v4/gfpdf_field_class/ for more details about these filters
				 */
				$class = apply_filters( 'gfpdf_field_class', $class, $field, $entry, $form );
				$class = apply_filters( 'gfpdf_field_class_' . $field->type, $class, $field, $entry, $form );
			}

			if ( empty( $class ) || ! ( $class instanceof Helper_Abstract_Fields ) ) {
				throw new Exception( 'Class not found' );
			}
		} catch ( Exception $e ) {

			$this->log->addError( 'Invalid Field Class.', [
				'exception' => $e->getMessage(),
				'field'     => $field,
				'form_id'   => $form['id'],
				'entry'     => $entry,
			] );

			/* Exception thrown. Load generic field loader */
			$class = apply_filters( 'gfpdf_field_default_class', new Field_Default( $field, $entry, $this->gform, $this->misc ), $field, $entry, $form );
		}

		return $class;
	}

	/**
	 * Attempts to find a configuration which matches the legacy routing method
	 *
	 * @param  array $config
	 *
	 * @return mixed
	 *
	 * @since  4.0
	 */
	public function get_legacy_config( $config ) {

		/* Get the form settings */
		$pdfs = $this->options->get_form_pdfs( $config['fid'] );

		if ( is_wp_error( $pdfs ) ) {
			return $pdfs;
		}

		/* Reindex the $pdfs keys */
		$pdfs = array_values( $pdfs );

		/* Use the legacy aid to determine which PDF to load */
		if ( isset( $config['aid'] ) && $config['aid'] !== false ) {
			$selector = $config['aid'] - 1;

			if ( isset( $pdfs[ $selector ] ) && $pdfs[ $selector ]['template'] == $config['template'] ) {
				return $pdfs[ $selector ]['id'];
			}
		}

		/* The aid method failed so lets load the first matching configuration */
		foreach ( $pdfs as $pdf ) {
			if ( $pdf['active'] === true && $pdf['template'] == $config['template'] ) {
				return $pdf['id'];
			}
		}

		return new WP_Error( 'pdf_configuration_error', esc_html__( 'Could not find PDF configuration requested', 'gravity-forms-pdf-extended' ) );
	}

	/**
	 * Do any preprocessing to our arguments before they are sent to the template
	 *
	 * @param  array $args
	 *
	 * @return array
	 *
	 * @since  4.0
	 */
	public function preprocess_template_arguments( $args ) {

		if ( isset( $args['settings']['header'] ) ) {
			$args['settings']['header'] = $this->gform->process_tags( $args['settings']['header'], $args['form'], $args['entry'] );
			$args['settings']['header'] = $this->misc->fix_header_footer( $args['settings']['header'] );
		}

		if ( isset( $args['settings']['first_header'] ) ) {
			$args['settings']['first_header'] = $this->gform->process_tags( $args['settings']['first_header'], $args['form'], $args['entry'] );
			$args['settings']['first_header'] = $this->misc->fix_header_footer( $args['settings']['first_header'] );
		}

		if ( isset( $args['settings']['footer'] ) ) {
			$args['settings']['footer'] = $this->gform->process_tags( $args['settings']['footer'], $args['form'], $args['entry'] );
			$args['settings']['footer'] = $this->misc->fix_header_footer( $args['settings']['footer'] );
		}

		if ( isset( $args['settings']['first_footer'] ) ) {
			$args['settings']['first_footer'] = $this->gform->process_tags( $args['settings']['first_footer'], $args['form'], $args['entry'] );
			$args['settings']['first_footer'] = $this->misc->fix_header_footer( $args['settings']['first_footer'] );
		}

		/**
		 * @since 4.2
		 */
		return apply_filters( 'gfpdf_preprocess_template_arguments', $args );
	}

	/**
	 * Skip over any fields with a class of "exclude"
	 *
	 * @param bool     $action
	 * @param GF_Field $field
	 * @param array    $entry
	 * @param array    $form
	 * @param array    $config
	 *
	 * @return bool
	 *
	 * @since 4.2
	 */
	public function field_middle_exclude( $action, $field, $entry, $form, $config ) {
		if ( $action === false ) {
			$skip_marked_fields = ( isset( $config['meta']['exclude'] ) ) ? $config['meta']['exclude'] : true;

			if ( $skip_marked_fields !== false && strpos( $field->cssClass, 'exclude' ) !== false ) {
				return true;
			}
		}

		return $action;
	}

	/**
	 * Determine if we should skip fields hidden with conditional logic
	 *
	 * @param bool     $action
	 * @param GF_Field $field
	 * @param array    $entry
	 * @param array    $form
	 * @param array    $config
	 *
	 * @return bool
	 *
	 * @since 4.2
	 */
	public function field_middle_conditional_fields( $action, $field, $entry, $form, $config ) {
		if ( $action === false ) {
			$skip_conditional_fields = ( isset( $config['meta']['conditional'] ) ) ? $config['meta']['conditional'] : true;
			if ( $skip_conditional_fields === true && GFFormsModel::is_field_hidden( $form, $field, [], $entry ) ) {
				return true;
			}
		}

		return $action;
	}

	/**
	 * Determine if we should skip product fields (by default they are grouped at the end of the form)
	 *
	 * @param bool     $action
	 * @param GF_Field $field
	 * @param array    $entry
	 * @param array    $form
	 * @param array    $config
	 *
	 * @return bool
	 *
	 * @since 4.2
	 */
	public function field_middle_product_fields( $action, $field, $entry, $form, $config ) {
		if ( $action === false ) {
			$show_individual_product_fields = ( isset( $config['meta']['individual_products'] ) ) ? $config['meta']['individual_products'] : false;
			if ( $show_individual_product_fields === false && GFCommon::is_product_field( $field->type ) ) {
				return true;
			}
		}

		return $action;
	}

	/**
	 * Determine if we should skip HTML fields
	 *
	 * @param bool     $action
	 * @param GF_Field $field
	 * @param array    $entry
	 * @param array    $form
	 * @param array    $config
	 *
	 * @return bool
	 *
	 * @since 4.2
	 */
	public function field_middle_html_fields( $action, $field, $entry, $form, $config ) {
		if ( $action === false ) {
			$show_html_fields = ( isset( $config['meta']['html_field'] ) ) ? $config['meta']['html_field'] : false;
			if ( $show_html_fields === false && $field->type == 'html' ) {
				return true;
			}
		}

		return $action;
	}

	/**
	 * Check if the field is on our blacklist and skip
	 *
	 * @param bool           $action
	 * @param GF_Field       $field
	 * @param array          $entry
	 * @param array          $form
	 * @param array          $config
	 * @param Field_Products $products
	 * @param array          $blacklisted
	 *
	 * @return bool
	 *
	 * @since 4.2
	 */
	public function field_middle_blacklist( $action, $field, $entry, $form, $config, $products, $blacklisted ) {
		if ( $action === false ) {
			if ( in_array( $field->get_input_type(), $blacklisted ) ) {
				return true;
			}
		}

		return $action;
	}

	/**
	 * @param array $ignored
	 *
	 * @since 4.2
	 */
	public function fix_gravityview_frontpage_conflict( $ignored ) {
		$ignored[] = 'lid';
		$ignored[] = 'action';

		return $ignored;
	}

	/**
	 * Set the watermark font to the current PDF font
	 *
	 * @param Mpdf  $mpdf
	 * @param array $form
	 * @param array $entry
	 * @param array $settings
	 *
	 * @return Mpdf
	 *
	 * @since 5.0
	 */
	public function set_watermark_font( $mpdf, $form, $entry, $settings ) {
		$mpdf->watermark_font = ( isset( $settings['watermark_font'] ) ) ? $settings['watermark_font'] : $settings['font'];

		return $mpdf;
	}
}
