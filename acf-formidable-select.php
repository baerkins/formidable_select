<?php

/*
Plugin Name: Advanced Custom Fields: Formidable Forms
Plugin URI: https://github.com/iamhexcoder/formidable_select
Description: Creates a select field to allow users to choose a Formidable Form. Returns form id.
Version: 1.0.0
Author: Shaun M. Baer
Author URI: https://github.com/iamhexcoder
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/**
 * @props
 * ======
 *
 * @nicmare and @welaika in ACF Support Forums
 * https://support.advancedcustomfields.com/forums/topic/trick-retrieve-formidable-pro-forms-in-acf/
 *
 * @stormuk for Gravity Forms select plugin
 * https://github.com/stormuk/Gravity-Forms-ACF-Field
 *
 * This plugin is really just a mashup of those two things.
 *
 */

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


// check if class already exists
if( !class_exists('acf_plugin_formidable_select') ) :

class acf_plugin_formidable_select {

	/*
	*  __construct
	*
	*  This function will setup the class functionality
	*
	*  @type	function
	*  @date	17/02/2016
	*  @since	1.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/

	function __construct() {

		// vars
		$this->settings = array(
			'version'	=> '1.0.0',
			'url'		=> plugin_dir_url( __FILE__ ),
			'path'		=> plugin_dir_path( __FILE__ )
		);


		// include field
		add_action('acf/include_field_types', 	array($this, 'include_field_types')); // v5
		add_action('acf/register_fields', 		array($this, 'include_field_types')); // v4

	}


	/*
	*  include_field_types
	*
	*  This function will include the field type class
	*
	*  @type	function
	*  @date	17/02/2016
	*  @since	1.0.0
	*
	*  @param	$version (int) major ACF version. Defaults to false
	*  @return	n/a
	*/

	function include_field_types( $version = false ) {

		// support empty $version
		if ( ! $version ) $version = 4;


		// include
		include_once('acf-formidable_select-v' . $version . '.php');

	}

}


// initialize
new acf_plugin_formidable_select();


// class_exists check
endif;

?>