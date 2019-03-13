<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------*/
/*  Contact Form
/*-----------------------------------------------------------------------------------*/

// Load Created Contact Forms form contact Form7
$cf7 = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');
$contact_forms = array();
if ($cf7) {
    foreach ($cf7 as $cform) {
        $contact_forms[$cform->post_title] = $cform->ID;
    }
} else {
    $contact_forms[esc_attr__('No contact forms found', 'massive-dynamic')] = 0;
}
pixflow_map(array(
    'base' => 'md_contactform',
    'name' => esc_attr__('Contact', 'massive-dynamic'),
    "category" => esc_attr__('Basic', 'massive-dynamic'),
    'show_settings_on_create' => false,
    'description' => esc_attr__('Place Contact Form', 'massive-dynamic'),
    'params' => array(
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Content", 'massive-dynamic'),
            "param_name" => "content_group",
            "edit_field_class" => $filedClass . "glue first last"
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_attr__('Select Form', 'massive-dynamic'),
            "edit_field_class" => $filedClass . "first glue last",
            'param_name' => 'contactform_id',
            'value' => $contact_forms,
        ),
        array(
            'type' => 'textfield',
            "edit_field_class" => $filedClass . "glue first",
            'heading' => esc_attr__('Title', 'massive-dynamic'),
            'param_name' => 'contactform_title',
            'admin_label' => false,
            "value" => "CONTACT FORM",
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "contactform_title_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),
        array(
            "type" => "textarea",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Description", 'massive-dynamic'),
            "param_name" => "contactform_description",
            "admin_label" => false,
            "value" => "We are a fairly small, flexible design studio that designs for print and web.",
        ),
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Appearance", 'massive-dynamic'),
            "param_name" => "app_group",
            "edit_field_class" => $filedClass . "glue first last"
        ),
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue first",
            "heading" => esc_attr__("General Color", 'massive-dynamic'),
            "param_name" => "contactform_general_color",
            "value" => 'rgb(0,0,0)',
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "contactform_general_color_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Field Background", 'massive-dynamic'),
            "param_name" => "contactform_field_color",
            "value" => 'rgb(255,255,255)',
            "opacity" => true,
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "contactform_general_color_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Button", 'massive-dynamic'),
            "param_name" => "btn_group",
            "edit_field_class" => $filedClass . "glue first last"
        ),
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Color", 'massive-dynamic'),
            "param_name" => "contactform_button_color",
            "value" => 'rgb(0,0,0)',
            "opacity" => true,
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "contactform_button_color_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Hover Color", 'massive-dynamic'),
            "param_name" => "contactform_button_hover",
            "value" => 'rgba(150,150,150,0.9)',
            "opacity" => true,
        ),
        array(
            'type' => 'md_vc_slider',
            "edit_field_class" => $filedClass . "first glue last",
            'heading' => esc_attr__('Padding', 'massive-dynamic'),
            'param_name' => 'left_right_padding',
            'value' => '12',
            'defaultSetting' => array(
                "min" => "0",
                "max" => "300",
                "prefix" => " px",
                "step" => "1",
            )
        ),
        array(
            "type" => "md_vc_description",
            "param_name" => "contactform_attention",
            "admin_label" => false,
            "value" => '<ul><li>' . esc_attr__('Please note that you can\'t see the process of contact form in the builder area. Also contact form colors will not work, unless you use our contact form styles.', 'massive-dynamic') . '</li><li>' . esc_attr__('To import our contact form styles, go to massive dynamic complete package files(you should download complete package from themeforest) and open Contact Form Templates, locate \'business contact form.txt\' or \'classic contact form.txt\', copy the text inside it, then go to WordPress dashboard > Contact > add new, give this form a name and replace the text in textarea with the text from text files, now press save. Now you can come back to contact form shortcode and choose the form you\'ve just created.', 'massive-dynamic') . '</li></ul>',
        ),

    )
));

pixflow_add_params('md_contactform', pixflow_addAnimationTab('md_contactform'));
