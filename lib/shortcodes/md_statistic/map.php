<?php
/**
 * Pixflow
 */



/*******************************************************************
 *                  Statistic
 ******************************************************************/
pixflow_map(
    array(
        'base' => 'md_statistic',
        'name' => esc_attr__('Statistic', 'massive-dynamic'),
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
                "param_name" => "statistic_to",
                "heading" => esc_attr__("Count To", 'massive-dynamic'),
                "value" => '80',
            ),

            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Symbol ", 'massive-dynamic'),
                "param_name" => "statistic_symbol",
                "admin_label" => false,
                "value" => "%",
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator" . ++$separatorCounter,
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "param_name" => "statistic_title",
                "admin_label" => false,
                "value" => "Complete Projects",
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
                "heading" => esc_attr__("General  Color", 'massive-dynamic'),
                "param_name" => "statistic_general_color",
                "value" => 'rgb(0,0,0)',
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
                "heading" => esc_attr__("Symbol Color", 'massive-dynamic'),
                "param_name" => "statistic_symbol_color",
                "value" => 'rgb(150,223,92)',
                "admin_label" => false,
                "opacity" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Separator", 'massive-dynamic'),
                "param_name" => "sep_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Activate', 'massive-dynamic'),
                'param_name' => 'statistic_separatoe',
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
                'checked' => true,
            ),

        )
    )
);

pixflow_add_params('md_statistic', pixflow_addAnimationTab('md_statistic'));
