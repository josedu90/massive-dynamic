<?php
/**
 * Pixflow
 */



/*******************************************************************
 *                  Count Box
 ******************************************************************/
global $separatorCounter;
$separatorCounter = 1;
pixflow_map(
    array(
        'base' => 'md_countbox',
        'name' => esc_attr__('Count Box', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__('Business', 'massive-dynamic'),
        "allowed_container_element" => 'vc_row',
        "params" => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Content", 'massive-dynamic'),
                "param_name" => "content_group",
                "group" => esc_attr__("General", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue last",
                "param_name" => "countbox_to",
                "heading" => esc_attr__("Count To", 'massive-dynamic'),
                "value" => '46',
                "group" => esc_attr__("General", 'massive-dynamic'),
//                "color_picker" => 'countbox_number_color'
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "param_name" => "countbox_title",
                "admin_label" => false,
                "value" => "YEARS OF MY EXPERIENCE",
                "group" => esc_attr__("General", 'massive-dynamic'),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "countbox_title_separator". ++$separatorCounter,
                "group" => esc_attr__("General", 'massive-dynamic'),
            ),
            array(
                "type" => "textarea",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Description", 'massive-dynamic'),
                "param_name" => "countbox_desc",
                "admin_label" => false,
                "value" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porta, mi ut facilisis ullamcorper, magna risus vehicula augue, eget faucibus magna massa at justo.",
                "group" => esc_attr__("General", 'massive-dynamic'),
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "app_group",
                "group" => esc_attr__("General", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("General Color", 'massive-dynamic'),
                "param_name" => "countbox_general_color",
                "value" => 'rgb(0,0,0)',
                "admin_label" => false,
                "opacity" => false,
                "group" => esc_attr__("General", 'massive-dynamic'),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "countbox_general_color_separator". ++$separatorCounter ,
                "group" => esc_attr__("General", 'massive-dynamic'),
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "last glue",
                "heading" => esc_attr__("Number Color", 'massive-dynamic'),
                "param_name" => "countbox_number_color",
                "value" => 'rgb(255,54,116)',
                "admin_label" => false,
                "opacity" => false,
                "group" => esc_attr__("General", 'massive-dynamic'),
//                "inline_color_picker" => true,
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "first glue last",
                'heading' => esc_attr__('Activate', 'massive-dynamic'),
                'param_name' => 'countbox_use_button',
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
                'checked' => false,
                "group" => esc_attr__("Button", 'massive-dynamic'),
            ),//add btn
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "countbox_use_button". ++$separatorCounter,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "admin_label" => false,
                "dependency" => array(
                    'element' => "countbox_use_button",
                    'value' => array('yes')
                )
            ),//separator
            array(
                "type" => "md_group_title",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "heading" => esc_attr__("Style", 'massive-dynamic'),
                "param_name" => "btn_style_group",
                "edit_field_class" => $filedClass . "glue first last",
                "dependency" => array(
                    'element' => "countbox_use_button",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",
                "separate" => true,
                "heading" => esc_attr__("Style", 'massive-dynamic'),
                "param_name" => "countbox_button_style",
                "description" => esc_attr__("Choose between five button style", 'massive-dynamic'),
                "admin_label" => false,
                "value" => array(
                    esc_attr__("Fill Slide", 'massive-dynamic') => "come-in",
                    esc_attr__("Flash Animate", 'massive-dynamic') => "flash-animate",
                    esc_attr__("Fade Oval", 'massive-dynamic') => "fade-oval",
                    esc_attr__("Fade Square", 'massive-dynamic') => "fade-square",
                    esc_attr__("Slide", 'massive-dynamic') => "slide",
                    esc_attr__("Animation", 'massive-dynamic') => "animation",
                    esc_attr__("Fill Rectangle", 'massive-dynamic') => "fill-rectangle",
                    esc_attr__("Fill Oval", 'massive-dynamic') => "fill-oval"
                ),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "countbox_use_button",
                    'value' => array('yes')
                )
            ),//btn kind
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "last glue first",
                "heading" => esc_attr__("Button size", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "param_name" => "countbox_button_size",
                "admin_label" => false,
                "description" => esc_attr__("Choose between three button sizes", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Standard", 'massive-dynamic') => "standard",
                    esc_attr__("Small", 'massive-dynamic') => "small"
                ),
                "dependency" => array(
                    'element' => "countbox_use_button",
                    'value' => array('yes')
                )
            ),//btn size

            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "first glue last",
                'heading' => esc_attr__('Padding', 'massive-dynamic'),
                'param_name' => 'left_right_padding',
                'value' => '0',
                "group" => esc_attr__("Button", 'massive-dynamic'),
                'defaultSetting' => array(
                    "min" => "0",
                    "max" => "300",
                    "prefix" => " px",
                    "step" => "1",
                ),
                "dependency" => array(
                    'element' => "countbox_use_button",
                    'value' => array('yes')
                )
            ),//spacing
            array(
                "type" => "md_group_title",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "heading" => esc_attr__("Content", 'massive-dynamic'),
                "param_name" => "btn_content_group",
                "edit_field_class" => $filedClass . "glue first last",
                "dependency" => array(
                    'element' => "countbox_use_button",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Text", 'massive-dynamic'),
                "param_name" => "countbox_button_text",
                "description" => esc_attr__("Button text", 'massive-dynamic'),
                "admin_label" => false,
                "value" => 'READ MORE',
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "countbox_use_button",
                    'value' => array('yes')
                )
            ),//btn text
            array(
                "type" => 'md_vc_separator',
                "param_name" => "countbox_button_text_separator". ++$separatorCounter ,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "countbox_use_button",
                    'value' => array('yes')
                )
            ),//separator
            array(
                "type" => "md_vc_iconpicker",

                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
                "param_name" => "countbox_button_icon_class",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "admin_label" => false,
                "description" => esc_attr__("Select an icon that shown before text", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "countbox_use_button",
                    'value' => array('yes')
                ),
                'value' => 'icon-angle-right'
            ),//btn icon
            array(
                "type" => "md_group_title",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "btn_app_group",
                "edit_field_class" => $filedClass . "glue first last",
                "dependency" => array(
                    'element' => "countbox_use_button",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue first last",
                "heading" => esc_attr__("General Color", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "param_name" => "countbox_button_color",
                "admin_label" => false,
                "opacity" => true,
                "value" => "rgba(0,0,0,1)",
                "description" => esc_attr__("Enter optional button's color", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "countbox_use_button",
                    'value' => array('yes')
                )
            ),//btn general color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "countbox_button_color_separator". ++$separatorCounter,
                "edit_field_class" => $filedClass . "stick-to-top",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "countbox_button_style",
                    'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
                ),
            ),//separator
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue ",
                "heading" => esc_attr__("Text Color", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "param_name" => "countbox_button_text_color",
                "admin_label" => false,
                "opacity" => true,
                "value" => "rgba(255,255,255,1)",
                "description" => esc_attr__("Enter optional button's color", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "countbox_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),//btn text color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "countbox_button_color_separator". ++$separatorCounter ,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "countbox_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),//separator
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Bg Hover Color", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "param_name" => "countbox_button_bg_hover_color",
                "admin_label" => false,
                "value" => "rgb(0,0,0)",
                "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "countbox_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),

            ),//btn bg hover color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "countbox_button_color_separator". ++$separatorCounter ,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "countbox_button_style",
                    'value' => array('fill-oval', 'fill-rectangle')
                )
            ),//separator
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Text Hover Color", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "param_name" => "countbox_button_hover_color",
                "admin_label" => false,
                "value" => "rgb(255,255,255)",
                "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "countbox_button_style",
                    'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
                ),

            ),//btn text hover color


            array(
                "type" => "textfield",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("URL", 'massive-dynamic'),
                "param_name" => "countbox_button_url",
                "admin_label" => false,
                "value" => "#",
                "description" => esc_attr__("Button destination URL", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "countbox_use_button",
                    'value' => array('yes')
                )
            ),//btn url
            array(
                "type" => 'md_vc_separator',
                "param_name" => "countbox_button_linkr_separator" . ++$separatorCounter,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "countbox_use_button",
                    'value' => array('yes')
                )
            ),//separator
            array(
                "type" => "dropdown",

                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Target", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "param_name" => "countbox_button_target",
                "admin_label" => false,
                "description" => esc_attr__("Open the link in the same tab or a blank browser tab", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Open in same window", 'massive-dynamic') => "_self",
                    esc_attr__("Open in new window", 'massive-dynamic') => "_blank"
                ),
                "dependency" => array(
                    'element' => "countbox_use_button",
                    'value' => array('yes')
                )
            ),//btn target
        )
    )
);

pixflow_add_params('md_countbox', pixflow_addAnimationTab('md_countbox'));
