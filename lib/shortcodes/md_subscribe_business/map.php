<?php
/**
 * Pixflow
 */



/*-----------------------------------------------------------------------------------*/
/*  Subscribe Business
/*-----------------------------------------------------------------------------------*/

pixflow_map(
    array(
        'base' => 'md_subscribe_business',
        'name' => esc_attr__('Business Subscribe', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__('Business', 'massive-dynamic'),
        "params" => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Icon", 'massive-dynamic'),
                "param_name" => "icon_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
                "param_name" => "button_icon_class",
                "admin_label" => false,
                "description" => esc_attr__("Select an icon that shown before text", 'massive-dynamic'),
                'value' => 'icon-Mail'
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator" . ++$separatorCounter,
            ),//separator
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Colors", 'massive-dynamic'),
                "param_name" => "colors_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . " glue",
                "heading" => esc_attr__("General", 'massive-dynamic'),
                "param_name" => "general_color",
                "value" => 'rgb(35,58,91)',
                "admin_label" => false,
                "opacity" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator" . ++$separatorCounter,
            ),//separator

            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Button Text", 'massive-dynamic'),
                "param_name" => "button_text_color",
                "value" => 'rgb(255,255,255)',
                "admin_label" => false,
                "opacity" => false,
            )
        )
    )
);

pixflow_add_params('md_subscribe_business', pixflow_addAnimationTab('md_subscribe_business'));
