<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Quote
/*-----------------------------------------------------------------------------------*/

function pixflow_quote()
{

    $filedClass = 'vc_col-sm-12 vc_column ';
    $separatorCounter = 0;

    $param = array(
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Content", 'massive-dynamic'),
            "param_name" => "content_group",
            "edit_field_class" => $filedClass . "glue first last"
        ),
        array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue first",
            "heading" => esc_attr__("Title", 'massive-dynamic'),
            "param_name" => "quote_title",
            "description" => esc_attr__("Quote heading text", 'massive-dynamic'),
            "admin_label" => false,
            "value" => "Scarlet Snow"
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "quote_title_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),

        array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Job Title", 'massive-dynamic'),
            "param_name" => "quote_job_title",
            "description" => esc_attr__("Quote job title text", 'massive-dynamic'),
            "admin_label" => false,
            "value" => "Sat Manager"
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "quote_job_title_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),

        array(
            "type" => "textarea",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Description", 'massive-dynamic'),
            "param_name" => "quote_description",
            "description" => esc_attr__("Quote description text", 'massive-dynamic'),
            "admin_label" => false,
            "value" => esc_attr__("Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, sunt explicabo.", 'massive-dynamic'),
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "quote_description_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),
        array(
            "type" => "attach_image",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Image", 'massive-dynamic'),
            "param_name" => "quote_background_image",
            "admin_label" => false,
            "description" => esc_attr__("Choose background image", 'massive-dynamic')
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "quote_image_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Colors", 'massive-dynamic'),
            "param_name" => "colors_group",
            "edit_field_class" => $filedClass . "glue first last"
        ),
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Text Color", 'massive-dynamic'),
            "param_name" => "quote_text_color",
            "admin_label" => false,
            "description" => esc_attr__("Choose color", 'massive-dynamic'),
            "value" => 'rgb(24,24,24)',
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "quote_text_color_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),

        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Background Color", 'massive-dynamic'),
            "param_name" => "quote_background_color",
            "admin_label" => false,
            "description" => esc_attr__("Choose background color", 'massive-dynamic'),
            "value" => 'rgb(243,243,243)',
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "quote_background_color_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),

        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Icon Color", 'massive-dynamic'),
            "param_name" => "quote_icon_color",
            "admin_label" => false,
            "description" => esc_attr__("Choose icon color", 'massive-dynamic'),
            "value" => 'rgb(150,223,92)',
        ),

    );
    return $param;
}

//Register "container" content element. It will hold all your inner (child) content elements
pixflow_map(array(
    "name" => esc_attr__("Quote", 'massive-dynamic'),
    "base" => "md_quote",
    "show_settings_on_create" => false,
    "category" => esc_attr__('Business','massive-dynamic'),
    "params" => pixflow_quote()
));

pixflow_add_params('md_quote', pixflow_addAnimationTab('md_quote'));
