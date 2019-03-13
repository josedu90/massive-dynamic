<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------*/
/*  Call to action
/*-----------------------------------------------------------------------------------*/

pixflow_map(
    array(
        "name" => "Call To Action",
        "show_settings_on_create" => false,
        "base" => "md_call_to_action",
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
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "param_name" => "call_to_action_title",
                "description" => esc_attr__("Call to action heading text", 'massive-dynamic'),
                "admin_label" => false,
                "value" => "Are you looking for job?",
                "color_picker" => "call_to_action_heading_color"
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "call_to_action_title_separator" . ++$separatorCounter,
            ),

            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Title Color", 'massive-dynamic'),
                "param_name" => "call_to_action_heading_color",
                "admin_label" => false,
                "inline_color_picker" => true,
                "description" => esc_attr__("Choose title color", 'massive-dynamic'),
                "value" => 'rgb(255,255,255)',
            ),

            array(
                "type" => "textarea",
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Description", 'massive-dynamic'),
                "param_name" => "call_to_action_description",
                "admin_label" => false,
                "value" => esc_attr__("We are a fairly small, flexible design studio that designs for print and web. We work flexibly with Send us your resume and portfolio", 'massive-dynamic'),
                "color_picker" => 'call_to_action_description_color',
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "call_to_action_title_separator" . ++$separatorCounter,
                "admin_label" => false,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Description Color", 'massive-dynamic'),
                "param_name" => "call_to_action_description_color",
                "admin_label" => false,
                "inline_color_picker" => true,
                "value" => 'rgb(255,255,255)',
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Typography", 'massive-dynamic'),
                "param_name" => "typo_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue first last",
                "heading" => esc_attr__("Title size", 'massive-dynamic'),
                "param_name" => "call_to_action_heading",
                "description" => esc_attr__("Choose your heading", 'massive-dynamic'),
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
                "heading" => esc_attr__("Background", 'massive-dynamic'),
                "param_name" => "bg_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue first last",
                "heading" => esc_attr__("Background Type", 'massive-dynamic'),
                "param_name" => "call_to_action_background_type",
                "description" => esc_attr__("Choose between color or image background", 'massive-dynamic'),
                "admin_label" => false,
                "value" => array(
                    esc_attr__("Color", 'massive-dynamic') => "color_background",
                    esc_attr__("Image", 'massive-dynamic') => "image_background",
                    esc_attr__("Transparent", 'massive-dynamic') => "transparent",
                ),
            ),
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "call_to_action_bg_separator" . ++$separatorCounter,
                "admin_label" => false,
                "dependency" => array(
                    'element' => "call_to_action_background_type",
                    'value' => array('color_background', 'image_background')
                )
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Background Color", 'massive-dynamic'),
                "param_name" => "call_to_action_background_color",
                "admin_label" => false,
                "value" => 'rgb(37,37,37)',
                "dependency" => array(
                    'element' => "call_to_action_background_type",
                    'value' => array('color_background')
                )
            ),
            array(
                "type" => "attach_image",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Background Image", 'massive-dynamic'),
                "param_name" => "call_to_action_background_image",
                "admin_label" => false,
                "dependency" => Array(
                    'element' => "call_to_action_background_type",
                    'value' => array('image_background')
                )
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Style", 'massive-dynamic'),
                "param_name" => "btn_style_group",
                "group" => esc_attr__('Button', 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue first",
                "separate" => true,
                "heading" => esc_attr__("Style", 'massive-dynamic'),
                "param_name" => "call_to_action_button_style",
                "description" => esc_attr__("Choose between five button style", 'massive-dynamic'),
                "admin_label" => false,
                "group" => esc_attr__('Button', 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Animation", 'massive-dynamic') => "animation",
                    esc_attr__("Fade Square", 'massive-dynamic') => "fade-square",
                    esc_attr__("Fade Oval", 'massive-dynamic') => "fade-oval",
                    esc_attr__("Slide", 'massive-dynamic') => "slide",
                    esc_attr__("Fill Slide", 'massive-dynamic') => "come-in",
                    esc_attr__("Flash Animate", 'massive-dynamic') => "flash-animate",
                    esc_attr__("Fill Rectangle", 'massive-dynamic') => "fill-rectangle",
                    esc_attr__("Fill Oval", 'massive-dynamic') => "fill-oval"
                ),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "call_to_action_title_separator" . ++$separatorCounter,
                "group" => esc_attr__('Button', 'massive-dynamic'),
                "admin_label" => false,
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Size", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "param_name" => "call_to_action_button_size",
                "admin_label" => false,
                "description" => esc_attr__("Choose size of your button", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Standard", 'massive-dynamic') => "standard",
                    esc_attr__("Small", 'massive-dynamic') => "small"
                ),
            ),
            array(
                "type" => 'md_vc_separator',
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "param_name" => "call_to_action_title_separator" . ++$separatorCounter,
                "admin_label" => false,
            ),
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Padding', 'massive-dynamic'),
                'param_name' => 'call_to_action_left_right_padding',
                'value' => '0',
                "group" => esc_attr__("Button", 'massive-dynamic'),
                'defaultSetting' => array(
                    "min" => "0",
                    "max" => "300",
                    "prefix" => " px",
                    "step" => "1",
                ),
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Content", 'massive-dynamic'),
                "param_name" => "btn_content_group",
                "group" => esc_attr__('Button', 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Text", 'massive-dynamic'),
                "param_name" => "call_to_action_button_text",
                "description" => esc_attr__("Button text", 'massive-dynamic'),
                "group" => esc_attr__('Button', 'massive-dynamic'),
                "admin_label" => false,
                "value" => "READ MORE",
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "call_to_action_title_separator" . ++$separatorCounter,
                "group" => esc_attr__('Button', 'massive-dynamic'),
                "admin_label" => false,
            ),
            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
                "param_name" => "call_to_action_button_icon_class",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "admin_label" => false,
                "description" => esc_attr__("Select an icon that shown before text", 'massive-dynamic'),
                'value' => 'icon-chevron-right'
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "btn_app_group",
                "edit_field_class" => $filedClass . "glue first last",
                "group" => esc_attr__('Button', 'massive-dynamic')
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue first last",
                "heading" => esc_attr__("Button Color", 'massive-dynamic'),
                "param_name" => "call_to_action_button_color",
                "admin_label" => false,
                "opacity" => false,
                "value" => 'rgb(255,255,255)',
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "description" => esc_attr__("Choose background color", 'massive-dynamic')
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "button_hover_color_separator" . ++$separatorCounter,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "stick-to-top",
                "dependency" => array(
                    'element' => "call_to_action_button_style",
                    'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
                ),
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Text Color", 'massive-dynamic'),
                "param_name" => "call_to_action_button_text_color",
                "admin_label" => false,
                "opacity" => true,
                "description" => esc_attr__("Enter optional button's color", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                'value' => '#fff',
                "dependency" => array(
                    'element' => "call_to_action_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "button_hover_color_separator" . ++$separatorCounter,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "call_to_action_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Bg Hover Color", 'massive-dynamic'),
                "param_name" => "call_to_action_button_bg_hover_color",
                "admin_label" => false,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "call_to_action_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
                'value' => '#9b9b9b'
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "button_hover_color_separator" . ++$separatorCounter,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "call_to_action_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Text Hover Color", 'massive-dynamic'),
                "param_name" => "call_to_action_button_hover_color",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "admin_label" => false,
                "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "call_to_action_button_style",
                    'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
                ),
                'value' => '#FFF'
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Link", 'massive-dynamic'),
                "param_name" => "btn_link_group",
                "edit_field_class" => $filedClass . "glue first last",
                "group" => esc_attr__("Button", 'massive-dynamic'),
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("URL", 'massive-dynamic'),
                "param_name" => "call_to_action_button_url",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "admin_label" => false,
                "value" => "#",
                "description" => esc_attr__("Button destination URL", 'massive-dynamic'),
            ),
            array(
                "type" => 'md_vc_separator',
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "param_name" => "call_to_action_title_separator" . ++$separatorCounter,
                "admin_label" => false,
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Target", 'massive-dynamic'),
                "param_name" => "call_to_action_button_target",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "admin_label" => false,
                "description" => esc_attr__("Open the link in the same tab or a blank browser tab", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Open in same window", 'massive-dynamic') => "_self",
                    esc_attr__("Open in new window", 'massive-dynamic') => "_blank"
                ),
            ),
        )
    )
);

pixflow_add_params('md_call_to_action', pixflow_addAnimationTab('md_call_to_action'));