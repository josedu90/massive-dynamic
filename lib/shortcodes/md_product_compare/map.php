<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Product Compare
/*-----------------------------------------------------------------------------------*/
global $separatorCounter;
$separatorCounter = 1;
pixflow_map(
    array(
        "name" => "Product Compare",
        "base" => "md_product_compare",
        "category" => esc_attr__("Commerce", 'massive-dynamic'),
        "allowed_container_element" => 'vc_row',
        'show_settings_on_create' => false,
        "params" => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Pricing", 'massive-dynamic'),
                "param_name" => "pricing_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue",

                "heading" => esc_attr__("Price", 'massive-dynamic'),
                "param_name" => "product_compare_price",
                "description" => esc_attr__("Type your price", 'massive-dynamic'),
                "admin_label" => false,
                "value" => '150',
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "product_compare_price_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",

                "heading" => esc_attr__("Currency", 'massive-dynamic'),
                "param_name" => "product_compare_currency",
                "admin_label" => false,
                "description" => esc_attr__("Choose currency", 'massive-dynamic'),
                "value" => array(
                    esc_attr__('Dollar', 'massive-dynamic') => '$',
                    esc_attr__('Euro', 'massive-dynamic') => '&euro;',
                    esc_attr__('Pound', 'massive-dynamic') => '&pound;'
                )
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Content", 'massive-dynamic'),
                "param_name" => "pricing_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue",

                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "param_name" => "product_compare_title",
                "value" => 'GENERAL',
                "description" => esc_attr__("Price table heading text", 'massive-dynamic'),
                "admin_label" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "product_compare_title_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue",

                "heading" => esc_attr__("Title size", 'massive-dynamic'),
                "param_name" => "product_compare_heading",
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
                "type" => 'md_vc_separator',
                "param_name" => "product_compare_heading_separator" . ++$separatorCounter,
            ),

            array(
                "type" => "textarea",
                "edit_field_class" => $filedClass . "glue last",

                "heading" => esc_attr__("Product Summery", 'massive-dynamic'),
                "param_name" => "product_compare_text",
                "value" => "Show your work & create impassive portfolios without knowing any HTML or how to code.",
                "description" => esc_attr__("Text", 'massive-dynamic'),
                "admin_label" => false,
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Color", 'massive-dynamic'),
                "param_name" => "pricing_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "first glue last",

                "heading" => esc_attr__("General Color", 'massive-dynamic'),
                "param_name" => "product_compare_general_color",
                "value" => '#000000',
                "admin_label" => false
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "first glue last",
                'heading' => esc_attr__('Use Image', 'massive-dynamic'),
                'param_name' => 'product_compare_add_image',
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
                'checked' => true,
                "group" => esc_attr__("Product Image", 'massive-dynamic'),
            ),
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "product_compare_add_image_separator" . ++$separatorCounter,
                "admin_label" => false,
                "group" => esc_attr__("Product Image", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "product_compare_add_image",
                    'value' => array('yes')
                )
            ),
            array(
                'type' => 'attach_image',
                "edit_field_class" => $filedClass . "glue last",

                'heading' => esc_attr__('Choose Image', 'massive-dynamic'),
                'param_name' => 'product_compare_image',
                "group" => esc_attr__("Product Image", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "product_compare_add_image",
                    'value' => array('yes')
                )
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "first glue last",
                'heading' => esc_attr__('Active', 'massive-dynamic'),
                'param_name' => 'product_compare_button',
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
                'checked' => true,
                "group" => esc_attr__("Button", 'massive-dynamic')
            ),//add btn
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "product_compare_button_separator" . ++$separatorCounter,
                "admin_label" => false,
                "group" => esc_attr__('Button', 'massive-dynamic'),
                'dependency' => array(
                    'element' => "product_compare_button",
                    'value' => array('yes')
                )
            ),//separator
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",
                "separate" => true,
                "heading" => esc_attr__("Button Style", 'massive-dynamic'),
                "param_name" => "product_compare_button_style",
                "description" => esc_attr__("Choose between five button style", 'massive-dynamic'),
                "admin_label" => false,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Fade Oval", 'massive-dynamic') => "fade-oval",
                    esc_attr__("Fade Square", 'massive-dynamic') => "fade-square",
                    esc_attr__("Slide", 'massive-dynamic') => "slide",
                    esc_attr__("Fill Slide", 'massive-dynamic') => "come-in",
                    esc_attr__("Animation", 'massive-dynamic') => "animation",
                    esc_attr__("Flash Animate", 'massive-dynamic') => "flash-animate",
                    esc_attr__("Fill Rectangle", 'massive-dynamic') => "fill-rectangle",
                    esc_attr__("Fill Oval", 'massive-dynamic') => "fill-oval"

                ),
            ),//btn kind
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue first",

                "heading" => esc_attr__("Button Text", 'massive-dynamic'),
                "param_name" => "product_compare_button_text",
                "description" => esc_attr__("Button text", 'massive-dynamic'),
                "admin_label" => false,
                "value" => "BUY IT",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "product_compare_button",
                    'value' => array('yes')
                ),

            ),//text
            array(
                "type" => 'md_vc_separator',
                "param_name" => "product_compare_button_text_separator" . ++$separatorCounter,
                "admin_label" => false,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "product_compare_button",
                    'value' => array('yes')
                ),

            ),//separator
            array(
                "type" => "md_vc_iconpicker",

                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Button Icon", 'massive-dynamic'),
                "param_name" => "product_compare_icon_class",
                "value" => "icon-shopcart",
                "admin_label" => false,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => Array(
                    'element' => "product_compare_button",
                    'value' => array('yes')
                ),

            ),//icon
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue first last",

                "heading" => esc_attr__("Button Color", 'massive-dynamic'),
                "param_name" => "product_compare_button_color",
                "admin_label" => false,
                "opacity" => false,
                "value" => '#000',
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => Array(
                    'element' => "product_compare_button",
                    'value' => array('yes')
                ),
                "description" => esc_attr__("Choose background color", 'massive-dynamic')
            ),//btn general color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "button_hover_color_separator". ++$separatorCounter,
                "edit_field_class" => $filedClass . "stick-to-top",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "product_compare_button_style",
                    'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
                ),
            ),//separator
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Text Color", 'massive-dynamic'),
                "param_name" => "product_compare_button_text_color",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "admin_label" => false,
                "opacity" => true,
                "description" => esc_attr__("Enter optional button's color", 'massive-dynamic'),
                'value' => '#fff',
                "dependency" => array(
                    'element' => "product_compare_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),//text color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "button_hover_color_separator". ++$separatorCounter,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "product_compare_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),//separator
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Bg Hover Color", 'massive-dynamic'),
                "param_name" => "product_compare_button_bg_hover_color",
                "admin_label" => false,
                "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "product_compare_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
                'value' => '#9b9b9b'
            ),//bg hover color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "button_hover_color_separator". ++$separatorCounter,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "product_compare_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),//separator
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",

                "heading" => esc_attr__("Button Hover Color", 'massive-dynamic'),
                "param_name" => "product_compare_hover_color",
                "admin_label" => false,
                "value" => '#ffffff',
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "product_compare_button_style",
                    'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
                ),
            ),//btn hover color
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue first",

                "heading" => esc_attr__("Button Size", 'massive-dynamic'),
                "param_name" => "product_compare_button_size",
                "admin_label" => false,
                "description" => esc_attr__("Choose size of your button", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Standard", 'massive-dynamic') => "standard",
                    esc_attr__("Small", 'massive-dynamic') => "small"
                ),
                'dependency' => array(
                    'element' => "product_compare_button",
                    'value' => array('yes')
                ),

            ),//size
            array(
                "type" => 'md_vc_separator',
                "param_name" => "product_compare_button_size_separator" . ++$separatorCounter,
                "admin_label" => false,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "product_compare_button",
                    'value' => array('yes')
                ),

            ),//separator
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Button Padding', 'massive-dynamic'),
                'param_name' => 'product_compare_left_right_padding',
                "group" => esc_attr__("Button", 'massive-dynamic'),
                'value' => '0',
                'defaultSetting' => array(
                    "min" => "0",
                    "max" => "300",
                    "prefix" => " px",
                    "step" => "1",
                ),
                'dependency' => array(
                    'element' => "product_compare_button",
                    'value' => array('yes')
                ),
            ),//space
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue first",

                "heading" => esc_attr__("Button Link", 'massive-dynamic'),
                "param_name" => "product_compare_button_url",
                "admin_label" => false,
                "value" => "#",
                "description" => esc_attr__("Button destination URL", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "product_compare_button",
                    'value' => array('yes')
                ),

            ),//link
            array(
                "type" => 'md_vc_separator',
                "param_name" => "product_compare_button_url_separator" . ++$separatorCounter,
                "admin_label" => false,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "product_compare_button",
                    'value' => array('yes')
                ),
            ),//separator
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",

                "heading" => esc_attr__("Link's target", 'massive-dynamic'),
                "param_name" => "product_compare_button_target",
                "admin_label" => false,
                "description" => esc_attr__("Open the link in the same tab or a blank browser tab", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Open in same window", 'massive-dynamic') => "_self",
                    esc_attr__("Open in new window", 'massive-dynamic') => "_blank"
                ),
                'dependency' => array(
                    'element' => "product_compare_button",
                    'value' => array('yes')
                ),

            ),//target

        )
    )
);

pixflow_add_params('md_product_compare', pixflow_addAnimationTab('md_product_compare'));

