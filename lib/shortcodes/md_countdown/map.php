<?php
/**
 * Pixflow
 */


/*******************************************************************
 *                  Count Down
 ******************************************************************/

pixflow_map(
    array(
        'base' => 'md_countdown',
        'name' => esc_attr__('Count Down', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__('Business', 'massive-dynamic'),
        "params" => array(
            array(
                "type" => "md_vc_datepicker",
                "edit_field_class" => $filedClass . "first glue last",
                "param_name" => "count_down",
                "heading" => esc_attr__("Count To", 'massive-dynamic'),
                "value" => '2020/10/9 20:30',
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
                "heading" => esc_attr__("General Color", 'massive-dynamic'),
                "param_name" => "count_down_general_color",
                "value" => '#727272',
                "admin_label" => false,
                "opacity" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "last glue",
                "heading" => esc_attr__("Seperator Color", 'massive-dynamic'),
                "param_name" => "count_down_sep_color",
                "value" => '#96df5c',
                "admin_label" => false,
                "opacity" => false,
            ),
            array(
                "type" => "md_vc_description",
                "param_name" => "md_count_down_description",
                "admin_label" => false,
                "value" => esc_attr__("The Count Down Shortcode Font Come From H3 Font Family.", 'massive-dynamic'),
            )
        )
    )
);

pixflow_add_params('md_countdown', pixflow_addAnimationTab('md_countdown'));