<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------*/
/*  Text in Box
/*-----------------------------------------------------------------------------------*/

pixflow_map(
    array(
        "name" => "Text in Box",
        "base" => "md_textbox",
        "category" => esc_attr__('Business', 'massive-dynamic'),
        "allowed_container_element" => 'vc_row',
        'show_settings_on_create' => false,
        "params" => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Content", 'massive-dynamic'),
                "param_name" => "content_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filedClass . "first glue last",
                "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
                "param_name" => "textbox_icon",
                "value" => "icon-diamond",
                "admin_label" => false
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "param_name" => "textbox_title",
                "value" => "Figure it out",
                "description" => esc_attr__("Iconbox heading text", 'massive-dynamic'),
                "admin_label" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => ++$separatorCounter,
                "admin_label" => false
            ),

            array(
                "type" => "textarea",
                "edit_field_class" => $filedClass . "glue ",
                "heading" => esc_attr__("Description", 'massive-dynamic'),
                "param_name" => "textbox_description",
                "value" => "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable",
                "admin_label" => false
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => ++$separatorCounter,
                "admin_label" => false
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Title size", 'massive-dynamic'),
                "param_name" => "textbox_heading",
                "admin_label" => false,
                "value" => array(
                    "H1" => "h1",
                    "H2" => "h2",
                    "H3" => "h3",
                    "H4" => "h4",
                    "H5" => "h5",
                    "H6" => "h6"
                ),
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
                "param_name" => "textbox_bg_color",
                "value" => "#FFF",
                "admin_label" => false
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => ++$separatorCounter,
                "admin_label" => false
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Icon Color", 'massive-dynamic'),
                "param_name" => "textbox_icon_color",
                "value" => "#01b1ae",
                "admin_label" => false
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => ++$separatorCounter,
                "admin_label" => false
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Content Color", 'massive-dynamic'),
                "param_name" => "textbox_content_color",
                "value" => "#5e5e5e",
                "admin_label" => false
            )
        )
    )
);

pixflow_add_params('md_textbox', pixflow_addAnimationTab('md_textbox'));
