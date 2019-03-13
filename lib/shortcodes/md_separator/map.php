<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Separator
/*-----------------------------------------------------------------------------------*/
global $separatorCounter;
$separatorCounter = 1;
pixflow_map(
    array(
        'base' => 'md_separator',
        'name' => esc_attr__('Separator', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__("Structure", 'massive-dynamic'),
        "params" => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Style", 'massive-dynamic'),
                "param_name" => "style_group",
                "group" => esc_attr__("General", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_attr__('Type', 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first ",
                'param_name' => 'separator_style',
                "group" => esc_attr__("General", 'massive-dynamic'),
                'value' => array(
                    esc_attr__("Line", 'massive-dynamic') => "line",
                    esc_attr__("Shadow", 'massive-dynamic') => "shadow",
                ),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator_separator" . ++$separatorCounter,
                "group" => esc_attr__("General", 'massive-dynamic'),
                'dependency' => array(
                    'element' => 'separator_style',
                    'value' => array('line')
                )
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Color", 'massive-dynamic'),
                "group" => esc_attr__("General", 'massive-dynamic'),
                "param_name" => "separator_color",
                "value" => '#cccccc',
                "admin_label" => false,
                "opacity" => false,
                'dependency' => array(
                    'element' => 'separator_style',
                    'value' => array('line')
                )
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Sizing", 'massive-dynamic'),
                "param_name" => "sizing_group",
                "group" => esc_attr__("General", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last",
                'dependency' => array(
                    'element' => 'separator_style',
                    'value' => array('line')
                )
                ),
            array(
                "type" => 'md_vc_slider',
                "heading" => esc_attr__("Height", 'massive-dynamic'),
                "group" => esc_attr__("General", 'massive-dynamic'),
                "param_name" => "separator_size",
                "value" => "5",
                "edit_field_class" => $filedClass . "glue first",
                'defaultSetting' => array(
                    "min" => "1",
                    "max" => "10",
                    "prefix" => "px",
                    "step" => '1',
                ),
                'dependency' => array(
                    'element' => 'separator_style',
                    'value' => array('line')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator_separator" . ++$separatorCounter,
                "group" => esc_attr__("General", 'massive-dynamic'),
                'dependency' => array(
                    'element' => 'separator_style',
                    'value' => array('line')
                )
            ),
            array(
                "type" => 'md_vc_slider',
                "heading" => esc_attr__("Width", 'massive-dynamic'),
                "param_name" => "separator_width",
                "group" => esc_attr__("General", 'massive-dynamic'),
                "value" => "70",
                "edit_field_class" => $filedClass . "glue last",
                'defaultSetting' => array(
                    "min" => "1",
                    "max" => "100",
                    "prefix" => "%",
                    "step" => '1',
                ),
                'dependency' => array(
                    'element' => 'separator_style',
                    'value' => array('line')
                )
            )

        )
    )
);

pixflow_add_params('md_separator', pixflow_addAnimationTab('md_separator'));
