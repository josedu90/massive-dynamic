<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------*/
/*  Icon Box Top
/*-----------------------------------------------------------------------------------*/
global $separatorCounter;
$separatorCounter = 1;
pixflow_map(
    array(
        "name" => "Icon Box Top",
        "base" => "md_iconbox_top",
        "category" => esc_attr__("more", 'massive-dynamic'),
        "allowed_container_element" => 'vc_row',
        'show_settings_on_create' => false,
        "params" => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Content", 'massive-dynamic'),
                "param_name" => "line_height_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filedClass . "first glue last",
                "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
                "param_name" => "iconbox_icon",
                "value" => "icon-diamond",
                "admin_label" => false,
                "description" => esc_attr__("Select an icon", 'massive-dynamic')
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . " glue last first ",
                'heading' => esc_attr__('Active', 'massive-dynamic'),
                'param_name' => 'iconbox_button',
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
                "group" => esc_attr__('Button', 'massive-dynamic'),
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "param_name" => "iconbox_title",
                "value" => "Figure it out",
                "description" => esc_attr__("Iconbox heading text", 'massive-dynamic'),
                "admin_label" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "iconbox_title_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "textarea",
                "edit_field_class" => $filedClass . " glue last",
                "heading" => esc_attr__("Description", 'massive-dynamic'),
                "param_name" => "iconbox_description",
                "value" => "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable",
                "description" => esc_attr__("Iconbox description text", 'massive-dynamic'),
                "admin_label" => false,
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "line_height_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "first glue last",
                "heading" => esc_attr__("Title size", 'massive-dynamic'),
                "param_name" => "iconbox_heading",
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
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "first glue last",
                "heading" => esc_attr__("Alignment", 'massive-dynamic'),
                "param_name" => "iconbox_alignment",
                "description" => esc_attr__("Choose icnobox alignment", 'massive-dynamic'),
                "admin_label" => false,
                "value" => array(
                    esc_attr__("Center", 'massive-dynamic') => "center",
                    esc_attr__("Left", 'massive-dynamic') => "left",
                    esc_attr__("Right", 'massive-dynamic') => "right"
                ),
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "first glue last",
                "heading" => esc_attr__("General Color", 'massive-dynamic'),
                "param_name" => "iconbox_general_color",
                "value" => "#5e5e5e",
                "admin_label" => false,
                "description" => esc_attr__("Choose general color", 'massive-dynamic'),
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "first glue last",
                "heading" => esc_attr__("Icon Color", 'massive-dynamic'),
                "param_name" => "iconbox_icon_color",
                "value" => "rgb(0,0,0)",
                "admin_label" => false,
                "description" => esc_attr__("Choose icon color", 'massive-dynamic'),
            ),

            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "iconbox_use_button" . ++$separatorCounter,
                "group" => esc_attr__('Button', 'massive-dynamic'),
                "admin_label" => false,
                "dependency" => array(
                    'element' => "iconbox_button",
                    'value' => array('yes')
                )
            ),//separator
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",
                "separate" => true,
                "heading" => esc_attr__("Button Style", 'massive-dynamic'),
                "param_name" => "button_style",
                "description" => esc_attr__("Choose between five button style", 'massive-dynamic'),
                "admin_label" => false,
                "value" => array(
                    esc_attr__("Fade Square", 'massive-dynamic') => "fade-square",
                    esc_attr__("Fade Oval", 'massive-dynamic') => "fade-oval",
                    esc_attr__("Slide", 'massive-dynamic') => "slide",
                    esc_attr__("Fill Slide", 'massive-dynamic') => "come-in",
                    esc_attr__("Animation", 'massive-dynamic') => "animation",
                    esc_attr__("Flash Animate", 'massive-dynamic') => "flash-animate",
                    esc_attr__("Fill Rectangle", 'massive-dynamic') => "fill-rectangle",
                    esc_attr__("Fill Oval", 'massive-dynamic') => "fill-oval"
                ),
                'dependency' => array(
                    'element' => "iconbox_button",
                    'value' => array('yes')
                ),
                "group" => esc_attr__('Button', 'massive-dynamic'),
            ),//iconbox top btn kind
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Button Text", 'massive-dynamic'),
                "param_name" => "iconbox_button_text",
                "value" => "Read more",
                "description" => esc_attr__("Button text", 'massive-dynamic'),
                "admin_label" => false,
                'dependency' => array(
                    'element' => "iconbox_button",
                    'value' => array('yes')
                ),
                "group" => esc_attr__('Button', 'massive-dynamic'),
            ),//iconbox top btn text
            array(
                "type" => 'md_vc_separator',
                "param_name" => "iconbox_button_text_separator" . ++$separatorCounter,
                "admin_label" => false,
                'dependency' => array(
                    'element' => "iconbox_button",
                    'value' => array('yes')
                ),
                "group" => esc_attr__('Button', 'massive-dynamic'),
            ),//iconbox top separator
            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
                "param_name" => "button_icon_class",
                "admin_label" => false,
                "description" => esc_attr__("Select an icon that shown before text", 'massive-dynamic'),
                'value' => 'icon-snowflake2',
                'dependency' => array(
                    'element' => "iconbox_button",
                    'value' => array('yes')
                ),
                "group" => esc_attr__('Button', 'massive-dynamic'),
            ),//iconbox top btn icon
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue first last",
                "heading" => esc_attr__("Button Color", 'massive-dynamic'),
                "param_name" => "iconbox_top_button_color",
                "admin_label" => false,
                "opacity" => false,
                "value" => '#5e5e5e',
                "group" => esc_attr__('Button', 'massive-dynamic'),
                "description" => esc_attr__("Choose background color", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "iconbox_button",
                    'value' => array('yes')
                ),
            ),//iconbox top btn general color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "iconbox_color_separator" . ++$separatorCounter,
                "group" => esc_attr__('Button', 'massive-dynamic'),
                "edit_field_class" => $filedClass . "stick-to-top",
                "dependency" => array(
                    'element' => "button_style",
                    'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
                ),
            ),//iconbox top btn separator
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Text Color", 'massive-dynamic'),
                "param_name" => "iconbox_button_text_color",
                "admin_label" => false,
                "opacity" => true,
                "description" => esc_attr__("Enter optional button's color", 'massive-dynamic'),
                'value' => '#fff',
                "group" => esc_attr__('Button', 'massive-dynamic'),
                "dependency" => array(
                    'element' => "button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),//iconbox top btn text color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "button_hover_color_separator" . ++$separatorCounter,
                "dependency" => array(
                    'element' => "button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
                "group" => esc_attr__('Button', 'massive-dynamic'),
            ),//iconbox top btn separator
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Bg Hover Color", 'massive-dynamic'),
                "param_name" => "button_bg_hover_color",
                "admin_label" => false,
                "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
                "group" => esc_attr__('Button', 'massive-dynamic'),
                "dependency" => array(
                    'element' => "button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
                'value' => '#9b9b9b'
            ),//iconbox top btn bg hover color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "button_hover_color_separator" . ++$separatorCounter,
                "group" => esc_attr__('Button', 'massive-dynamic'),
                "dependency" => array(
                    'element' => "button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),//iconbox top btn separator
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Text Hover Color", 'massive-dynamic'),
                "param_name" => "button_hover_color",
                "admin_label" => false,
                "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
                'value' => '#FFF',
                "dependency" => array(
                    'element' => "button_style",
                    'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
                ),
                "group" => esc_attr__('Button', 'massive-dynamic'),
            ),//iconbox top btn text hover color
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue first",

                "heading" => esc_attr__("Button Size", 'massive-dynamic'),
                "param_name" => "iconbox_button_size",
                "admin_label" => false,
                "description" => esc_attr__("Choose size of your button", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Standard", 'massive-dynamic') => "standard",
                    esc_attr__("Small", 'massive-dynamic') => "small"
                ),
                'dependency' => array(
                    'element' => "iconbox_button",
                    'value' => array('yes')
                ),
                "group" => esc_attr__('Button', 'massive-dynamic'),
            ),//iconbox top btn  btn size
            array(
                "type" => 'md_vc_separator',
                "param_name" => "iconbox_button_size_separator" . ++$separatorCounter,
                "admin_label" => false,
                'dependency' => array(
                    'element' => "iconbox_button",
                    'value' => array('yes')
                ),
                "group" => esc_attr__('Button', 'massive-dynamic'),
            ),//iconbox top btn separator
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Button Padding', 'massive-dynamic'),
                'param_name' => 'left_right_padding',
                'value' => '0',
                'defaultSetting' => array(
                    "min" => "0",
                    "max" => "300",
                    "prefix" => " px",
                    "step" => "1",
                ),
                'dependency' => array(
                    'element' => "iconbox_button",
                    'value' => array('yes')
                ),
                "group" => esc_attr__('Button', 'massive-dynamic'),
            ),//iconbox top btn space
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Button Link", 'massive-dynamic'),
                "param_name" => "iconbox_button_url",
                "value" => "#",
                "admin_label" => false,
                "description" => esc_attr__("Button destination URL", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "iconbox_button",
                    'value' => array('yes')
                ),
                "group" => esc_attr__('Button', 'massive-dynamic'),
            ),//iconbox top btn url
            array(
                "type" => 'md_vc_separator',
                "param_name" => "iconbox_button_url_separator" . ++$separatorCounter,
                "admin_label" => false,
                'dependency' => array(
                    'element' => "iconbox_button",
                    'value' => array('yes')
                ),
                "group" => esc_attr__('Button', 'massive-dynamic'),
            ),//iconbox top btn separator
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Link's target", 'massive-dynamic'),
                "param_name" => "iconbox_button_target",
                "admin_label" => false,
                "description" => esc_attr__("Open the link in the same tab or a blank browser tab", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Open in same window", 'massive-dynamic') => "_self",
                    esc_attr__("Open in new window", 'massive-dynamic') => "_blank"
                ),
                'dependency' => array(
                    'element' => "iconbox_button",
                    'value' => array('yes')
                ),
                "group" => esc_attr__('Button', 'massive-dynamic'),
            ),//iconbox top btn target
        )
    )
);

pixflow_add_params('md_iconbox_top', pixflow_addAnimationTab('md_iconbox_top'));
