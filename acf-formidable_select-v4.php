<?php

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// check if class already exists
if ( ! class_exists( 'acf_field_formidable_select' ) ) :


class acf_field_formidable_select extends acf_field {

	// vars
	var $settings; // will hold info such as dir / path
	var $defaults; // will hold default field options


	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/

	function __construct( $settings )
	{
		// vars
		$this->name = 'formidable_select';
		$this->label = __('Formidable Forms');
		$this->category = __("Relational",'acf'); // Basic, Content, Choice, etc
		$this->defaults = array(
			'allow_null' => 0
		);


		// do not delete!
    	parent::__construct();


    	// settings
		$this->settings = $settings;

	}


	/*
	*  create_options()
	*
	*  Create extra options for your field. This is rendered when editing a field.
	*  The value of $field['name'] can be used (like below) to save extra data to the $field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field	- an array holding all the field's data
	*/

	function create_options( $field )
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/

		// key is needed in the field names to correctly save the data
		$key = $field['name'];


		// Create Field Options HTML
		?>
      <tr class="field_option field_option_<?php echo $this->name; ?>">
      	<td class="label">
      		<label><?php _e("Preview Size",'acf'); ?></label>
      		<p class="description"><?php _e("Thumbnail is advised",'acf'); ?></p>
      	</td>
      	<td>
      		<?php

      		do_action('acf/create_field', array(
            'type'  =>  'radio',
            'name'  =>  'fields['.$key.'][allow_null]',
            'value' =>  $field['allow_null'],
            'choices' =>  array(
              1 =>  __("Yes",'acf'),
              0 =>  __("No",'acf'),
            ),
            'layout'  =>  'horizontal',
          ));

      		?>
      	</td>
      </tr>
		<?php

	}


	/*
	*  create_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field - an array holding all the field's data
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function create_field( $field ) {

    $field = array_merge($this->defaults, $field);
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
    $field['type'] = 'select';

    do_action('acf/create_field', $field);
	}


}


// initialize
new acf_field_formidable_select( $this->settings );


// class_exists check
endif;

?>