<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Counter
/*-----------------------------------------------------------------------------------*/

pixflow_map(
    array(
        'base' => 'md_counter',
        'name' => esc_attr__('Counter', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__('Business', 'massive-dynamic'),
        "allowed_container_element" => 'vc_row',
        "params" => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Count", 'massive-dynamic'),
                "param_name" => "count_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                'type' => 'textfield',
                'edit_field_class' => $filedClass . "first glue",
                'param_name' => 'counter_from',
                'heading' => esc_attr__("From", 'massive-dynamic'),
                'value' => '0',
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "counter_from_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue last",
                "param_name" => "counter_to",
                "heading" => esc_attr__("To", 'massive-dynamic'),
                "value" => '46',
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Content", 'massive-dynamic'),
                "param_name" => "content_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => 'textfield',
                "edit_field_class" => $filedClass . "first glue",
                "param_name" => 'counter_title',
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "value" => 'Documents',
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "counter_title_separator" . ++$separatorCounter,
            ),

            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filedClass . "glue ",
                "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
                "param_name" => "counter_icon_class",
                "admin_label" => false,
                'value' => 'icon-Diamond',
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "counter_icon_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "app_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . " glue",
                "heading" => esc_attr__("General Color", 'massive-dynamic'),
                "param_name" => "counter_title_color",
                "value" => 'rgb(0,0,0)',
                "admin_label" => false,
                "opacity" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "counter_icon_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "last glue",
                "heading" => esc_attr__("Icon Color", 'massive-dynamic'),
                "param_name" => "counter_icon_color",
                "value" => 'rgb(132,206,27)',
                "admin_label" => false,
                "opacity" => false,
            ),

        )
    )
);

pixflow_add_params('md_counter', pixflow_addAnimationTab('md_counter'));
