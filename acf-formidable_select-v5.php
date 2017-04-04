<?php

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


// check if class already exists
if( !class_exists('acf_field_formidable_select') ) :


class acf_field_formidable_select extends acf_field {


	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/

	function __construct( $settings ) {

		/*
		*  name (string) Single word, no spaces. Underscores allowed
		*/

		$this->name = 'formidable_select';


		/*
		*  label (string) Multiple words, can include spaces, visible when selecting a field type
		*/

		$this->label = __('Formidable Forms', 'acf-formidable_select');


		/*
		*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
		*/

		$this->category = 'relational';


		/*
		*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
		*/

		$this->defaults = array(
      'allow_null' => 0
    );


		/*
		*  settings (array) Store plugin settings (url, path, version) as a reference for later use with assets
		*/
		$this->settings = $settings;


		// do not delete!
    	parent::__construct();

	}


  /*
  *  render_field_settings()
  *
  *  Create extra settings for your field. These are visible when editing a field
  *
  *  @type  action
  *  @since 3.6
  *  @date  23/01/13
  *
  *  @param $field (array) the $field being edited
  *  @return  n/a
  */

  function render_field_settings( $field ) {

    /*
    *  acf_render_field_setting
    *
    *  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
    *  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
    *
    *  More than one setting can be added by copy/paste the above code.
    *  Please note that you must also have a matching $defaults value for the field name (font_size)
    */

    acf_render_field_setting( $field, array(
      'label' => 'Allow Null?',
      'type'  =>  'radio',
      'name'  =>  'allow_null',
      'choices' =>  array(
        1 =>  __("Yes",'acf'),
        0 =>  __("No",'acf'),
      ),
      'layout'  =>  'horizontal'
    ));

  }

  /*
  *  render_field()
  *
  *  Create the HTML interface for your field
  *
  *  @param $field (array) the $field being rendered
  *
  *  @type  action
  *  @since 3.6
  *  @date  23/01/13
  *
  *  @param $field (array) the $field being edited
  *  @return  n/a
  */

  function render_field( $field ) {

    /*
    *  Review the data of $field.
    *  This will show what data is available
    *
    */

    // vars
    $field   = array_merge( $this->defaults, $field );
    $choices = array();

    /*
     * Show notice if Formidable Forms is not activated
     *
     */
    if ( class_exists( 'FrmForm' ) ) {

      $forms = FrmForm::get_published_forms();

    } else {
      echo "<font style='color:red;font-weight:bold;'>Warning: Formidable Forms is not installed or activated. This field does not function without Formidable Forms!</font>";
    }

    /*
     * Prevent undefined variable notice
     *
     */
    if ( isset( $forms ) ) {

      foreach ( $forms as $form ) {

        $choices[ intval($form->id) ] = ucfirst($form->name);

      }

    }

    /*
     * Override field settings and render
     *
     */
    $field['choices'] = $choices;
    $field['type']    = 'select';

    ?>
    <select id="<?php echo str_replace(array('[',']'), array('-',''), $field['name']);?>" name="<?php echo $field['name']; ?>">
      <?php
        if ( $field['allow_null'] )
          echo '<option value="">- Select -</option>';

        foreach ( $field['choices'] as $key => $value ) {
          $selected = '';

          if ( ( is_array( $field['value'] ) && in_array( $key, $field['value'] ) ) || $field['value'] == $key )
            $selected = ' selected="selected"';
          ?>
          <option value="<?php echo $key; ?>"<?php echo $selected;?>><?php echo $value; ?></option>
          <?php
        }
      ?>
    </select>
    <?php
  }
}


// initialize
new acf_field_formidable_select( $this->settings );


// class_exists check
endif;

?>