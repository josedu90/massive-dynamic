<?php
/**
 * Pixflow
 */



/*-----------------------------------------------------------------------------------*/
/*  Icon
/*-----------------------------------------------------------------------------------*/
global $separatorCounter;
pixflow_map(
    array(
        "name" => "Icon",
        "base" => "md_icon",
        "category" => esc_attr__('Basic','massive-dynamic'),
        "allowed_container_element" => 'vc_row',
        'show_settings_on_create' => false,
        "params" => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Source", 'massive-dynamic'),
                "param_name" => "source_group",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Icon Source", 'massive-dynamic'),
                "param_name" => "icon_source",
                "admin_label" => false,
                "value" => array(
                    esc_attr__("MD Icons", 'massive-dynamic') => "massive_dynamic",
                    esc_attr__("Custom Icon", 'massive-dynamic') => "custom",
                ),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "icon_color_separator_" . ++$separatorCounter,
                "admin_label" => false,
            ),
            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
                "param_name" => "icon_icon",
                "value" => "icon-diamond",
                "admin_label" => false,
                "dependency" => array(
                    'element' => "icon_source",
                    'value' => array('massive_dynamic')
                )
            ),

            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("SVG URL", 'massive-dynamic'),
                "param_name" => "icon_url",
                "value" => "http://",
                "admin_label" => false,
                'dependency' => array(
                    'element' => "icon_source",
                    'value' => array('custom')
                )
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Colors", 'massive-dynamic'),
                "param_name" => "category_group",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Icon", 'massive-dynamic'),
                "param_name" => "icon_color",
                "opacity" => true,
                "value" => "#5f5f5f",
                "admin_label" => false,
                'dependency' => array(
                    'element' => "icon_source",
                    'value' => array('massive_dynamic')
                )
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Icon Fill", 'massive-dynamic'),
                "param_name" => "icon_fill_color",
                "opacity" => true,
                "value" => "rgba(0,0,0,1)",
                "admin_label" => false,
                'dependency' => array(
                    'element' => "icon_source",
                    'value' => array('custom')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "icon_separator_" . ++$separatorCounter,
                "admin_label" => false,
                'dependency' => array(
                    'element' => "icon_source",
                    'value' => array('custom')
                )
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Icon Stroke", 'massive-dynamic'),
                "param_name" => "icon_stroke_color",
                "opacity" => true,
                "value" => "rgba(0,0,0,1)",
                "admin_label" => false,
                'dependency' => array(
                    'element' => "icon_source",
                    'value' => array('custom')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "icon_color_separator_" . ++$separatorCounter,
                "admin_label" => false,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Hover Color", 'massive-dynamic'),
                "param_name" => "icon_hover_color",
                "opacity" => true,
                "value" => "#b6b6b6",
                "admin_label" => false,
                'dependency' => array(
                    'element' => "icon_source",
                    'value' => array('massive_dynamic')
                )
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Hover Fill Color", 'massive-dynamic'),
                "param_name" => "icon_hover_fill_color",
                "opacity" => true,
                "value" => "rgba(100,100,100,1)",
                "admin_label" => false,
                'dependency' => array(
                    'element' => "icon_source",
                    'value' => array('custom')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "icon_color_separator_" . ++$separatorCounter,
                "admin_label" => false,
                'dependency' => array(
                    'element' => "icon_source",
                    'value' => array('custom')
                )
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Hover Stroke Color", 'massive-dynamic'),
                "param_name" => "icon_hover_stroke_color",
                "opacity" => true,
                "value" => "rgba(100,100,100,1)",
                "admin_label" => false,
                'dependency' => array(
                    'element' => "icon_source",
                    'value' => array('custom')
                )
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Sizing", 'massive-dynamic'),
                "param_name" => "category_group",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "first glue last",
                'heading' => esc_attr__('Size', 'massive-dynamic'),
                'param_name' => 'icon_size',
                'value' => '153',
                'defaultSetting' => array(
                    "min" => "10",
                    "max" => "300",
                    "prefix" => " px",
                    "step" => "1",
                )
            ),
            array(
                "type" => "md_vc_checkbox",
                "edit_field_class" => $filedClass . "glue first last",
                "param_name" => "icon_use_link",
                "heading" => esc_attr__('Set Link', 'massive-dynamic'),
                'value' => array(esc_attr__('No', 'massive-dynamic') => 'no'),
                'checked' => false,
            ),
            array(
                'type' => 'textfield',
                "edit_field_class" => $filedClass . "first glue",
                'heading' => esc_attr__('Link URL', 'massive-dynamic'),
                'param_name' => 'icon_link',
                'value' => 'http://',
                'dependency' => array(
                    'element' => 'icon_use_link',
                    'value' => array('yes')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "icon_link_separator_" . ++$separatorCounter,
                "admin_label" => false,
                'dependency' => array(
                    'element' => 'icon_use_link',
                    'value' => array('yes')
                )
            ),
            array(
                'type' => 'dropdown',
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Open in", 'massive-dynamic'),
                "param_name" => "icon_link_target",
                "admin_label" => false,
                "value" => array(
                    esc_attr__("New Tab", 'massive-dynamic') => "_blank",
                    esc_attr__("This Window", 'massive-dynamic') => "_self",
                ),
                'dependency' => array(
                    'element' => 'icon_use_link',
                    'value' => array('yes')
                )
            )
        )
    )
);

pixflow_add_params('md_icon', pixflow_addAnimationTab('md_icon'));
