<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------*/
/*  Text Box
/*-----------------------------------------------------------------------------------*/
pixflow_map(
    array(
        'base' => 'md_text_box',
        'name' => esc_html__('Text Box', 'massive-dynamic'),
        "category" => esc_html__('Business', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "allowed_container_element" => 'vc_row',
        "params" => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Content", 'massive-dynamic'),
                "param_name" => "content_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_html__("Title", 'massive-dynamic'),
                "param_name" => "textbox_title",
                "value" => 'Tags & Models',
                "admin_label" => false,
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "textbox_title_separator" . ++$separatorCounter,
            ),

            array(
                "type" => "textarea",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_html__("Description", 'massive-dynamic'),
                "param_name" => "textbox_text",
                "admin_label" => false,
                "value" => "It is a long established fact that a reader will be dis",
            ),

            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filedClass . "first glue last",
                "heading" => esc_html__("Choose an icon", 'massive-dynamic'),
                "param_name" => "textbox_icon",
                "value" => "icon-PriceTag",
                "admin_label" => false
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "app_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_html__("Text Color", 'massive-dynamic'),
                "param_name" => "textbox_text_color",
                "value" => 'rgb(80,80,80)',
                "admin_label" => false,
                "opacity" => true,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "textbox_text_color_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_html__("Text Hover Color", 'massive-dynamic'),
                "param_name" => "textbox_text_hover_color",
                "value" => 'rgb(255,255,255)',
                "admin_label" => false,
                "opacity" => true,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "textbox_text_hover_color_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_html__("Background Color", 'massive-dynamic'),
                "param_name" => "textbox_background_color",
                "value" => 'rgb(230,231,237)',
                "admin_label" => false,
                "opacity" => true,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "textbox_background_color_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_html__("Background Hover Color", 'massive-dynamic'),
                "param_name" => "textbox_background_hover_color",
                "value" => 'rgb(255,0,84)',
                "admin_label" => false,
                "opacity" => true,
            ),
        )
    )
);

pixflow_add_params('md_text_box', pixflow_addAnimationTab('md_text_box'));
