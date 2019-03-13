<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Client Normal
/*-----------------------------------------------------------------------------------*/
global $separatorCounter;
$separatorCounter = 1;
pixflow_map(
    array(
        'base' => 'md_client_normal',
        'name' => esc_attr__('Client Normal', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "allowed_container_element" => 'vc_row',
        "category" => esc_attr__('Business', 'massive-dynamic'),
        "params" => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Content", 'massive-dynamic'),
                "param_name" => "app_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                'type' => 'attach_image',
                "edit_field_class" => $filedClass . "glue first last",
                'heading' => esc_attr__('Logo', 'massive-dynamic'),
                'param_name' => 'md_client_logo',
                'value' => PIXFLOW_THEME_IMAGES_URI . "/logo.png",
            ),
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . " first glue",
                "heading" => esc_attr__("Text Color", 'massive-dynamic'),
                "param_name" => "md_client_text_color",
                "value" => 'rgb(240,240,240)',
                "admin_label" => false,
                "opacity" => true,
                "inline_color_picker" => true,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "md_client_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "textarea",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Text", 'massive-dynamic'),
                "param_name" => "md_client_text",
                "admin_label" => false,
                "value" => "Creative Digital Agency",
                "color_picker" => "md_client_text_color",
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Link", 'massive-dynamic'),
                "param_name" => "md_client_link",
                "admin_label" => false,
                "value" => '#',
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "md_client_separator" . ++$separatorCounter,
            ),
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "glue ",
                'heading' => esc_attr__('Height', 'massive-dynamic'),
                'param_name' => 'md_client_height',
                'value' => '300',
                'defaultSetting' => array(
                    "min" => "300",
                    "max" => "800",
                    "prefix" => " px",
                    "step" => "10",
                ),
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "md_client_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Background", 'massive-dynamic'),
                "param_name" => "bg_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue ",
                "heading" => esc_attr__("Type", 'massive-dynamic'),
                "param_name" => "md_client_bg_type",
                "admin_label" => false,
                "value" => array(
                    esc_attr__("Color", 'massive-dynamic') => "color",
                    esc_attr__("Image", 'massive-dynamic') => "image"
                ),
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "md_client_separator". ++$separatorCounter ,
            ),



            array(
                'type' => 'attach_image',
                "edit_field_class" => $filedClass . "glue",
                'heading' => esc_attr__('Image', 'massive-dynamic'),
                'param_name' => 'md_client_bg_img',
                'dependency' => array(
                    'element' => 'md_client_bg_type',
                    'value' => 'image'
                ),
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "md_client_separator". ++$separatorCounter ,
                'dependency' => array(
                    'element' => 'md_client_bg_type',
                    'value' => 'image'
                ),
            ),

            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Overlay Color", 'massive-dynamic'),
                "param_name" => "md_client_overlay_color",
                "value" => 'rgb(0,0,0)',
                "admin_label" => false,
                "opacity" => false,
                'dependency' => array(
                    'element' => 'md_client_bg_type',
                    'value' => 'image'
                ),
            ),

            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Color", 'massive-dynamic'),
                "param_name" => "md_client_bg_color",
                "value" => 'rgb(0,0,0)',
                "admin_label" => false,
                "opacity" => false,
                'dependency' => array(
                    'element' => 'md_client_bg_type',
                    'value' => 'color'
                ),
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "md_client_separator" . ++$separatorCounter,
                'dependency' => array(
                    'element' => 'md_client_bg_type',
                    'value' => 'color'
                ),
            ),

            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Hover Color", 'massive-dynamic'),
                "param_name" => "md_client_hover_color",
                "value" => 'rgb(0,0,0)',
                "admin_label" => false,
                "opacity" => false,
                'dependency' => array(
                    'element' => 'md_client_bg_type',
                    'value' => 'color'
                ),
            ),





        )
    )
);

pixflow_add_params('md_client_normal', pixflow_addAnimationTab('md_client_normal'));
