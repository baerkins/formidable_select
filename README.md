# ACF Formidable Forms Select Field

SHORT_DESCRIPTION

-----------------------

### Description

Creates a select field to allow users to choose a specific Formidable Form from a list. 

Returns form id.

### Example Usage

```php
<?php
    
    $form = get_field('formidable_select'); // or whatever your field is named

    // Echo the form
    // see https://formidableforms.com/knowledgebase/publish-a-form/)
    echo FrmFormsController::get_form_shortcode( array( 
        'id' => $form, 
        'title' => false, 
        'description' => false 
    ) );
?>
```

### Compatibility

This ACF field type is compatible with:
* ACF 5
* ACF 4

The [Formidable Forms](https://formidableforms.com/) plugin must be installed and activated.

### Installation

1. Copy the `acf-formidable_select` folder into your `wp-content/plugins` folder
2. Activate the Formidable Forms plugin via the plugins admin page
3. Create a new field via ACF and select the Formidable Forms type
4. Please refer to the description for more info regarding the field type settings

### Props

This plugin is really just a mashup of these two things:

`nicmare` and @welaika in ACF Support Forums on this thread:
https://support.advancedcustomfields.com/forums/topic/trick-retrieve-formidable-pro-forms-in-acf/

@stormuk who built a Gravity Forms select plugin (this is basically a fork of that)
https://github.com/stormuk/Gravity-Forms-ACF-Field
