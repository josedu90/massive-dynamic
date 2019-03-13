<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Pixflow Price Table
/*-----------------------------------------------------------------------------------*/
global $separatorCounter;
$separatorCounter = 1;
pixflow_map(
    array(
        'base' => 'md_price_table',
        'name' => esc_attr__('Pixflow Price Table', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__('Commerce', 'massive-dynamic'),
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
                "edit_field_class" => $filedClass . "first glue last textNsize-text",
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "param_name" => "title",
                "value" => 'Personal Plan',
                "admin_label" => false,
                "color_picker" => "title_color",
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue textNsize-size",
                "heading" => esc_attr__("Title Color", 'massive-dynamic'),
                "param_name" => "title_color",
                "admin_label" => false,
                "value" => "#623e95",
                "inline_color_picker" => true,
            ),
            array(
                "type" => "textarea",
                "edit_field_class" => $filedClass . "glue first last",
                "heading" => esc_attr__("Description", 'massive-dynamic'),
                "param_name" => "description",
                "admin_label" => false,
                "value" =>
                    "Mobile-Optimized
Powerful Metrics
Free Domain
Annual Purchase
24/7 Support",
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("pricing", 'massive-dynamic'),
                "param_name" => "content_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Price", 'massive-dynamic'),
                "param_name" => "price",
                "description" => esc_attr__("Type your price", 'massive-dynamic'),
                "admin_label" => false,
                "value" => '50',
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator" . ++$separatorCounter,
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Currency", 'massive-dynamic'),
                "param_name" => "currency",
                "admin_label" => false,
                "value" => array(
                    esc_attr__('Dollar', 'massive-dynamic') => '$',
                    esc_attr__('Euro', 'massive-dynamic') => '&euro;',
                    esc_attr__('Pound', 'massive-dynamic') => '&pound;'
                )
            ),

            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Colors", 'massive-dynamic'),
                "param_name" => "content_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("General Color", 'massive-dynamic'),
                "param_name" => "general_color",
                "admin_label" => false,
                "value" => "#898989",
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator". ++$separatorCounter ,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Background Color", 'massive-dynamic'),
                "param_name" => "bg_color",
                "admin_label" => false,
                "value" => "#fff",
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "first glue last",
                'heading' => esc_attr__('Active', 'massive-dynamic'),
                'param_name' => 'use_button',
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
                'checked' => true,
                "group" => esc_attr__("Button", 'massive-dynamic'),
            ),//add btn
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "separator". ++$separatorCounter,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "admin_label" => false,
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),//separator
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",
                "separate" => true,
                "heading" => esc_attr__("Button Style", 'massive-dynamic'),
                "param_name" => "button_style",
                "admin_label" => false,
                "value" => array(
                    esc_attr__("Fill Oval", 'massive-dynamic') => "fill-oval",
                    esc_attr__("Fade Oval", 'massive-dynamic') => "fade-oval",
                    esc_attr__("Fade Square", 'massive-dynamic') => "fade-square",
                    esc_attr__("Slide", 'massive-dynamic') => "slide",
                    esc_attr__("Fill Slide", 'massive-dynamic') => "come-in",
                    esc_attr__("Animation", 'massive-dynamic') => "animation",
                    esc_attr__("Flash Animate", 'massive-dynamic') => "flash-animate",
                    esc_attr__("Fill Rectangle", 'massive-dynamic') => "fill-rectangle"
                ),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),//btn kind
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Text", 'massive-dynamic'),
                "param_name" => "button_text",
                "admin_label" => false,
                "value" => 'PURCHASE',
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),//btn text
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator". ++$separatorCounter ,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),//separator
            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
                "param_name" => "button_icon_class",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "admin_label" => false,
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                ),
                'value' => 'icon-empty'
            ),//btn icon
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue first last",
                "heading" => esc_attr__("General Color", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "param_name" => "button_color",
                "admin_label" => false,
                "opacity" => true,
                "value" => "#b3b3b3",
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),//btn general color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator". ++$separatorCounter,
                "edit_field_class" => $filedClass . "stick-to-top",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "button_style",
                    'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
                ),
            ),//separator
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue ",
                "heading" => esc_attr__("Text Color", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "param_name" => "button_text_color",
                "admin_label" => false,
                "opacity" => true,
                "value" => "#fff",
                "dependency" => array(
                    'element' => "button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),//btn text color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator". ++$separatorCounter,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),//separator
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Bg Hover Color", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "param_name" => "button_bg_hover_color",
                "admin_label" => false,
                "value" => "#623e95",
                "dependency" => array(
                    'element' => "button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),

            ),//btn bg hover color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator". ++$separatorCounter,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "button_style",
                    'value' => array('fill-oval', 'fill-rectangle')
                )
            ),//separator
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Text Hover Color", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "param_name" => "button_hover_color",
                "admin_label" => false,
                "value" => "#fff",
                "dependency" => array(
                    'element' => "button_style",
                    'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
                ),

            ),//btn text hover color
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Button size", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "param_name" => "button_size",
                "admin_label" => false,
                "value" => array(
                    esc_attr__("Standard", 'massive-dynamic') => "standard",
                    esc_attr__("Small", 'massive-dynamic') => "small"
                ),
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),//btn size
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator". ++$separatorCounter,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),//separator
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Button Padding', 'massive-dynamic'),
                'param_name' => 'button_padding',
                'value' => '30',
                "group" => esc_attr__("Button", 'massive-dynamic'),
                'defaultSetting' => array(
                    "min" => "0",
                    "max" => "300",
                    "prefix" => " px",
                    "step" => "1",
                ),
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),//spacing
            array(
                "type" => "textfield",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Link URL", 'massive-dynamic'),
                "param_name" => "button_url",
                "admin_label" => false,
                "value" => "#",
                "description" => esc_attr__("Button destination URL", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),//btn url
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator". ++$separatorCounter,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),//separator
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Link's target", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "param_name" => "button_target",
                "admin_label" => false,
                "value" => array(
                    esc_attr__("Open in same window", 'massive-dynamic') => "_self",
                    esc_attr__("Open in new window", 'massive-dynamic') => "_blank"
                ),
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),//btn target
        )
    )
);

pixflow_add_params('md_price_table', pixflow_addAnimationTab('md_price_table'));
