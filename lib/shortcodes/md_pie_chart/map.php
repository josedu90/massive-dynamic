<?php
/**
 * Pixflow
 */


/*******************************************************************
 *                  Skill Piechart
 ******************************************************************/
pixflow_map(
    array(
        'base' => 'md_pie_chart',
        'name' => esc_attr__('Skill Pie Chart', 'massive-dynamic'),
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
                "edit_field_class" => $filedClass . "first glue ",
                "param_name" => "pie_chart_title",
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "value" => 'Animation',
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "pie_chart_title_separator" . ++$separatorCounter,
            ),
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "glue ",
                'heading' => esc_attr__('Percent', 'massive-dynamic'),
                'param_name' => 'pie_chart_percent',
                'value' => '70',
                'defaultSetting' => array(
                    "min" => "0",
                    "max" => "100",
                    "step" => "1",
                ),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "pie_chart_percent_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "appearance_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Chart Color", 'massive-dynamic'),
                "param_name" => "pie_chart_percent_color",
                "value" => 'rgb(34,188,168)',
                "admin_label" => false,
                "opacity" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "pie_chart_percent_color_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "last glue",
                "heading" => esc_attr__("Text Color", 'massive-dynamic'),
                "param_name" => "pie_chart_text_color",
                "value" => 'rgb(0,0,0)',
                "admin_label" => false,
                "opacity" => false,
            ),
        )
    )
);

pixflow_add_params('md_pie_chart', pixflow_addAnimationTab('md_pie_chart'));
