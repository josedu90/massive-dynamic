<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------*/
/*  Subscribe
/*-----------------------------------------------------------------------------------*/

pixflow_map(
    array(
        'base' => 'md_subscribe',
        'name' => esc_attr__('Subscribe', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__('Business', 'massive-dynamic'),
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
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "param_name" => "subscribe_title",
                "value" => 'SUBSCRIBE',
                "admin_label" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "subscribe_sep" . ++$separatorCounter,
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . " glue last",
                "heading" => esc_attr__("Subtitle", 'massive-dynamic'),
                "param_name" => "subscribe_sub_title",
                "value" => 'Sign up to receive news and updates',
                "admin_label" => false,
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
                "param_name" => "subscribe_bgcolor",
                "value" => '#ebebeb',
                "admin_label" => false,
                "opacity" => true,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "subscribe_sep" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . " last glue",
                "heading" => esc_attr__("Title Color", 'massive-dynamic'),
                "param_name" => "subscribe_textcolor",
                "value" => '#000',
                "admin_label" => false,
                "opacity" => true,
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Input", 'massive-dynamic'),
                "param_name" => "input_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_attr__("Style", 'massive-dynamic'),
                "param_name" => "subscribe_input_style",
                "edit_field_class" => $filedClass . "first glue",
                "value" => array(
                    esc_attr__("Fill", 'massive-dynamic') => "fill",
                    esc_attr__("Stroke", 'massive-dynamic') => "stroke",
                ),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => ++$separatorCounter,
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_attr__("Skin", 'massive-dynamic'),
                "param_name" => "subscribe_input_skin",
                "edit_field_class" => $filedClass . " glue",
                "value" => array(
                    esc_attr__("Light", 'massive-dynamic') => "light",
                    esc_attr__("Dark", 'massive-dynamic') => "dark",
                ),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => ++$separatorCounter,
            ),
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . " glue",
                'heading' => esc_attr__('Radius', 'massive-dynamic'),
                'param_name' => 'subscribe_input_radius',
                'value' => '35',
                'defaultSetting' => array(
                    "min" => "0",
                    "max" => "35",
                    "prefix" => " px",
                    "step" => "1",
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "subscribe_sep" . ++$separatorCounter,
            ),
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Opacity', 'massive-dynamic'),
                'param_name' => 'subscribe_input_opacity',
                'value' => '100',
                'defaultSetting' => array(
                    "min" => "0",
                    "max" => "100",
                    "prefix" => " %",
                    "step" => "1",
                )
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Button", 'massive-dynamic'),
                "param_name" => "btn_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . " first glue",
                "heading" => esc_attr__("Background Color", 'massive-dynamic'),
                "param_name" => "subscribe_button_bgcolor",
                "value" => '#c7b299',
                "admin_label" => false,
                "opacity" => true,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . " last glue",
                "heading" => esc_attr__("Text Color", 'massive-dynamic'),
                "param_name" => "subscribe_button_textcolor",
                "value" => '#FFF',
                "admin_label" => false,
                "opacity" => true,
            ),
            array(
                "type" => "md_vc_description",
                "param_name" => "pstep_description",
                "admin_label" => false,
                "value" => '<ul><li>' . __('You must install and configure "MailChimp for WordPress Lite" plugin before using this shortcode.', 'massive-dynamic') . '</li></ul>',
            ),
        )
    )
);

pixflow_add_params('md_subscribe', pixflow_addAnimationTab('md_subscribe'));
