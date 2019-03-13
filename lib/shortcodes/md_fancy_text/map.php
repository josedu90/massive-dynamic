<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Fancy Text
/*-----------------------------------------------------------------------------------*/

pixflow_map(
    array(
        "name" => "Fancy Text",
        "base" => "md_fancy_text",
        "category" => esc_attr__('Media','massive-dynamic'),
        "allowed_container_element" => 'vc_row',
        'show_settings_on_create' => false,
        "params" => array(
             array(
                "type" => "md_group_title",
                "heading" => esc_attr__("title", 'massive-dynamic'),
                "param_name" => "title_group",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                'type' => 'textfield',
                "edit_field_class" => $filedClass . "first glue",
                'heading' => esc_attr__('Title', 'massive-dynamic'),
                'param_name' => 'fancy_text_title',
                'value' => 'Fancy Text',
                "color_picker" => "fancy_text_title_color",
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "fancy_text_separator" . ++$separatorCounter,
                "admin_label" => false,
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Title size", 'massive-dynamic'),
                "param_name" => "fancy_text_heading",
                "description" => esc_attr__("Choose your heading", 'massive-dynamic'),
                "admin_label" => false,
                "value" => array(
                    "H5" => "h5",
                    "H1" => "h1",
                    "H2" => "h2",
                    "H3" => "h3",
                    "H4" => "h4",
                    "H6" => "h6"
                ),
            ),
             array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Description", 'massive-dynamic'),
                "param_name" => "desc_group",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "fancy_text_separator" . ++$separatorCounter,
                "admin_label" => false,
            ),
            array(
                'type' => 'textarea',
                "edit_field_class" => $filedClass . " glue last",
                'heading' => esc_attr__('Text', 'massive-dynamic'),
                'param_name' => 'fancy_text_text',
                'value' => 'Massive Dynamic has over 10 years of experience in Design. We take pride in delivering Intelligent Designs and Engaging Experiences for clients all over the World.',
                "color_picker" => "fancy_text_text_color",
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Bacground", 'massive-dynamic'),
                "param_name" => "title_group",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Type", 'massive-dynamic'),
                "param_name" => "fancy_text_bg_type",
                "admin_label" => false,
                "value" => array(
                    esc_attr__("Icon", 'massive-dynamic') => "icon",
                    esc_attr__("Text", 'massive-dynamic') => "text",
                ),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "fancy_text_separator" . ++$separatorCounter,
                "admin_label" => false,

            ),
            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
                "param_name" => "fancy_text_icon",
                "value" => "icon-MusicalNote",
                "admin_label" => false,
                "dependency" => array(
                    'element' => "fancy_text_bg_type",
                    'value' => array('icon')
                )
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Background Text", 'massive-dynamic'),
                "param_name" => "fancy_text_bg_text",
                "value" => "01",
                "admin_label" => false,
                'dependency' => array(
                    'element' => "fancy_text_bg_type",
                    'value' => array('text')
                )
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Title Color", 'massive-dynamic'),
                "param_name" => "fancy_text_title_color",
                "opacity" => true,
                "value" => "rgba(55,55,55,1)",
                "admin_label" => false,
                "inline_color_picker" => true
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "fancy_text_separator" . ++$separatorCounter,
                "admin_label" => false,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . " glue",
                "heading" => esc_attr__("Text Color", 'massive-dynamic'),
                "param_name" => "fancy_text_text_color",
                "opacity" => true,
                "value" => "rgba(55,55,55,1)",
                "admin_label" => false,
                "inline_color_picker" => true
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "fancy_text_separator" . ++$separatorCounter,
                "admin_label" => false,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "last glue",
                "heading" => esc_attr__("Color", 'massive-dynamic'),
                "param_name" => "fancy_text_bg_color",
                "opacity" => true,
                "value" => "rgba(7, 0, 255, 0.15)",
                "admin_label" => false,
            ),

        )
    )
);

pixflow_add_params('md_fancy_text', pixflow_addAnimationTab('md_fancy_text'));
