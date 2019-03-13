<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Feature Image
/*-----------------------------------------------------------------------------------*/


function pixflow_feature_image()
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
            "type" => "attach_image",
            "edit_field_class" => $filedClass . "glue first",
            "heading" => esc_attr__("Image", 'massive-dynamic'),
            "param_name" => "feature_image_background_image",
            "admin_label" => false,
            "description" => esc_attr__("Choose background image", 'massive-dynamic')
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "feature_image_image_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),

        array(
            "type" => "md_vc_iconpicker",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
            "param_name" => "feature_image_icon_class",
            "admin_label" => false,
            "description" => esc_attr__("Select an icon", 'massive-dynamic'),
            'value' => 'icon-romance-love-target'
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "feature_image_icon_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),

        array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Title", 'massive-dynamic'),
            "param_name" => "feature_image_title",
            "description" => esc_attr__("feature image heading text", 'massive-dynamic'),
            "admin_label" => false,
            "value" => "Imagine & Create"
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "feature_image_title_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),

        array(
            "type" => "textarea",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Description", 'massive-dynamic'),
            "param_name" => "feature_image_description",
            "description" => esc_attr__("feature image description text", 'massive-dynamic'),
            "admin_label" => false,
            "value" => esc_attr__("Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque", 'massive-dynamic'),
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "feature_image_description_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Appearance", 'massive-dynamic'),
            "param_name" => "app_group",
            "edit_field_class" => $filedClass . "glue first last"
        ),
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Background Color", 'massive-dynamic'),
            "param_name" => "feature_image_background_color",
            "admin_label" => false,
            "description" => esc_attr__("Choose background color", 'massive-dynamic'),
            "value" => 'rgb(255,255,255)',
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "feature_image_background_color_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),

        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Foreground Color", 'massive-dynamic'),
            "param_name" => "feature_image_foreground_color",
            "admin_label" => false,
            "description" => esc_attr__("Choose foreground color", 'massive-dynamic'),
            "value" => 'rgb(24,24,24)',
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "feature_image_foreground_color_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),

        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Hover Color", 'massive-dynamic'),
            "param_name" => "feature_image_hover_color",
            "admin_label" => false,
            "description" => esc_attr__("Choose hover color", 'massive-dynamic'),
            "value" => 'rgb(26,192,182)',
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "feature_image_hover_color_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),

        array(
            'type' => 'md_vc_slider',
            "edit_field_class" => $filedClass . "glue last",
            'heading' => esc_attr__('Image Height', 'massive-dynamic'),
            'param_name' => 'feature_image_height_slider',
            'value' => '300',
            'defaultSetting' => array(
                "min" => "100",
                "max" => "1000",
                "prefix" => " px",
                "step" => "10",
            ),
        ),



    );
    return $param;
}

//Register "container" content element. It will hold all your inner (child) content elements
pixflow_map(array(
    "name" => esc_attr__("Feature Image", 'massive-dynamic'),
    "base" => "md_feature_image",
    "show_settings_on_create" => false,
    "category" => esc_attr__('Business','massive-dynamic'),
    "params" => pixflow_feature_image()
));

pixflow_add_params('md_feature_image', pixflow_addAnimationTab('md_feature_image'));
