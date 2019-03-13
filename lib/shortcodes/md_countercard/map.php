<?php
/**
 * Pixflow
 */


/*******************************************************************
 *                  Counter Card
 ******************************************************************/
pixflow_map(
    array(
        'base' => 'md_countercard',
        'name' => esc_attr__('Counter Card', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__('Business', 'massive-dynamic'),
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
                "edit_field_class" => $filedClass . "first glue last",
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "param_name" => "counter_title",
                "admin_label" => false,
                "value" => "Complete Projects",
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue ",
                "param_name" => "counter_to",
                "heading" => esc_attr__("Count To", 'massive-dynamic'),
                "value" => '560',
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
                "param_name" => "coutner_icon_class",
                "admin_label" => false,
                "description" => esc_attr__("Select an icon that shown before text", 'massive-dynamic'),
                'value' => 'icon-share3'
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
                "heading" => esc_attr__("Background Color", 'massive-dynamic'),
                "param_name" => "counter_bg_color",
                "value" => 'rgb(255,255,255)',
                "admin_label" => false,
                "opacity" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Text Color", 'massive-dynamic'),
                "param_name" => "counter_text_color",
                "value" => 'rgb(26,51,86)',
                "admin_label" => false,
                "opacity" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Icon Color", 'massive-dynamic'),
                "param_name" => "counter_icon_color",
                "value" => 'rgb(150,223,92)',
                "admin_label" => false,
                "opacity" => false,
            ),

        )
    )
);

pixflow_add_params('md_countercard', pixflow_addAnimationTab('md_countercard'));
