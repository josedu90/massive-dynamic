<?php
/**
 * Pixflow
 */


/*******************************************************************
 *                  Skill Piechart 2
 ******************************************************************/
pixflow_map(
    array(
        'base' => 'md_pie_chart2',
        'name' => esc_attr__('Skill Pie Chart 2', 'massive-dynamic'),
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
                "param_name" => "pie_chart2_title",
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "value" => 'Animation',
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "pie_chart2_title_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue",
                "param_name" => "pie_chart2_bottom_title",
                "heading" => esc_attr__("Bottom Title", 'massive-dynamic'),
                "value" => '',
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "pie_chart2_title_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
                "param_name" => "pie_chart2_icon",
                "value" => "icon-cog",
                "admin_label" => false,
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Percent", 'massive-dynamic'),
                "param_name" => "percent_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . " first  glue",
                'heading' => esc_attr__('Percent', 'massive-dynamic'),
                'param_name' => 'pie_chart2_percent',
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
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Show Percentage', 'massive-dynamic'),
                'param_name' => 'pie_chart_2_show_type',
                'value' => array(esc_attr__('No', 'massive-dynamic') => 'no'),
                'checked' => false,
            ),//Show PErcentage
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Animation", 'massive-dynamic'),
                "param_name" => "p_animation_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                'type' => 'dropdown',
                "edit_field_class" => $filedClass . "glue first",
                'heading' => esc_attr__('Animation Easing', 'massive-dynamic'),
                'param_name' => 'pie_chart2_animation',
                'checked' => true,
                "value" => array(
                    "easeInOutQuart" => "easeInOutQuart",
                    "easeOutBack" => "easeOutBack",
                    "easeOutBounce" => "easeOutBounce",
                    "easeOutElastic" => "easeOutElastic",
                ),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "pie_chart2_title_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "last glue ",
                "param_name" => "pie_chart2_animation_delay",
                "heading" => esc_attr__("Delay", 'massive-dynamic'),
                "value" => '',
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "app_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "glue first",
                'heading' => esc_attr__('Thickness', 'massive-dynamic'),
                'param_name' => 'pie_chart_2_line_width',
                'value' => '9',
                'defaultSetting' => array(
                    "min" => "1",
                    "max" => "40",
                    "step" => "1",
                ),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "pie_chart2_percent_separator" . ++$separatorCounter,
            ),

            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Chart Color", 'massive-dynamic'),
                "param_name" => "pie_chart2_percent_color",
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
                "param_name" => "pie_chart2_text_color",
                "value" => 'rgb(0,0,0)',
                "admin_label" => false,
                "opacity" => false,
            ),
        )
    )
);

pixflow_add_params('md_pie_chart2', pixflow_addAnimationTab('md_pie_chart2'));
