<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Imagebox Full-Width
/*-----------------------------------------------------------------------------------*/
global $separatorCounter;
$separatorCounter = 1;
pixflow_map(
    array(
        "name" => "Image Box Full-Width",
        "base" => "md_imagebox_full",
        "category" => esc_attr__('Media','massive-dynamic'),
        'show_settings_on_create' => false,
        "allowed_container_element" => 'vc_row',
        'show_settings_on_create' => false,
        "params" => array(
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue first textNsize-text",

                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "value" => "Products that perform as good as they look",
                "param_name" => "imagebox_title",
                "group" => esc_attr__('General', 'massive-dynamic'),
                "description" => esc_attr__("Imagebox heading text", 'massive-dynamic'),
                "admin_label" => false,
            ),

            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last textNsize-size",

                "heading" => esc_attr__("Title size", 'massive-dynamic'),
                "param_name" => "imagebox_heading_size",
                "group" => esc_attr__('General', 'massive-dynamic'),
                "description" => esc_attr__("Choose your heading size", 'massive-dynamic'),
                "admin_label" => false,
                "value" => array(
                    "H3" => "h3",
                    "H1" => "h1",
                    "H2" => "h2",
                    "H4" => "h4",
                    "H5" => "h5",
                    "H6" => "h6"
                ),
            ),
            array(
                "type" => "textarea",
                "edit_field_class" => $filedClass . "glue first last",

                "heading" => esc_attr__("Description", 'massive-dynamic'),
                "param_name" => "imagebox_description",
                "value" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porta, mi ut facilisis ullamcorper, magna risus vehicula augue, eget faucibus magna massa at justo. Sed quis augue ut eros tincidunt hendrerit eu eget nisl. Duis malesuada vehicula massa...
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porta, mi ut facilisis ullamcorper, magna risus vehicula augue, eget faucibus magna massa at justo. Sed quis augue ut eros tincidunt hendrerit eu eget nisl.",
                "group" => esc_attr__('General', 'massive-dynamic'),
                "description" => esc_attr__("Imagebox description text", 'massive-dynamic'),
                "admin_label" => false,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue first last",

                "heading" => esc_attr__("General Color", 'massive-dynamic'),
                "param_name" => "imagebox_general_color",
                "value" => '#ffffff',
                "group" => esc_attr__('General', 'massive-dynamic'),
                "admin_label" => false,
                "description" => esc_attr__("Choose general color", 'massive-dynamic'),
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue first last",

                "heading" => esc_attr__("Height", 'massive-dynamic'),
                "value" => "300",
                "param_name" => "imagebox_text_height",
                "group" => esc_attr__('General', 'massive-dynamic'),
                "description" => esc_attr__("Imagebox text height", 'massive-dynamic'),
                "admin_label" => false,
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue first last",
                "heading" => esc_attr__("Alignment", 'massive-dynamic'),
                "param_name" => "imagebox_alignment",
                "admin_label" => false,
                "group" => esc_attr__('General', 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Left", 'massive-dynamic') => "left",
                    "Center" => "center"
                ),
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "first glue last",
                'heading' => esc_attr__('Use Background', 'massive-dynamic'),
                'param_name' => 'imagebox_use_background',
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
                'checked' => true,
                "group" => esc_attr__("Background", 'massive-dynamic'),
            ),
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "imagebox_use_background_separator" . ++$separatorCounter,
                "admin_label" => false,
                "group" => esc_attr__("Background", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "imagebox_use_background",
                    'value' => array('yes')
                )
            ),
            array(
                'type' => 'attach_image',
                "edit_field_class" => $filedClass . "glue",

                'heading' => esc_attr__('Choose Image', 'massive-dynamic'),
                'param_name' => 'imagebox_background',
                "group" => esc_attr__("Background", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "imagebox_use_background",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "imagebox_background_separator" . ++$separatorCounter,
                "admin_label" => false,
                "group" => esc_attr__("Background", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "imagebox_use_background",
                    'value' => array('yes')
                )
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Add overlay  ', 'massive-dynamic'),
                'param_name' => 'imagebox_overlay',
                "group" => esc_attr__("Background", 'massive-dynamic'),
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
                'checked' => true,
                'dependency' => array(
                    'element' => "imagebox_use_background",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "imagebox_overlay_separator" . ++$separatorCounter,
                "admin_label" => false,
                "group" => esc_attr__("Background", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "imagebox_overlay",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",

                "heading" => esc_attr__("Overlay Color", 'massive-dynamic'),
                "param_name" => "imagebox_overlay_color",
                "value" => 'rgba(90,31,136,0.5)',
                "opacity" => true,
                "group" => esc_attr__("Background", 'massive-dynamic'),
                "admin_label" => false,
                "description" => esc_attr__("Choose overlay color", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "imagebox_overlay",
                    'value' => array('yes')
                )
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "glue first last",
                'heading' => esc_attr__('Add button  ', 'massive-dynamic'),
                'param_name' => 'imagebox_button',
                "group" => esc_attr__('Button', 'massive-dynamic'),
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
                'checked' => true,
            ),//image box full add btn
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "imagebox_button_separator" . ++$separatorCounter,
                "admin_label" => false,
                "group" => esc_attr__('Button', 'massive-dynamic'),
                'dependency' => array(
                    'element' => "imagebox_button",
                    'value' => array('yes')
                )
            ),//image box full separator
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",
                "separate" => true,
                "heading" => esc_attr__("Button Style", 'massive-dynamic'),
                "param_name" => "imagebox_button_style",
                "description" => esc_attr__("Choose between five button style", 'massive-dynamic'),
                "admin_label" => false,
                "group" => esc_attr__('Button', 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Slide", 'massive-dynamic') => "slide",
                    esc_attr__("Fade Square", 'massive-dynamic') => "fade-square",
                    esc_attr__("Fade Oval", 'massive-dynamic') => "fade-oval",

                    esc_attr__("Fill Slide", 'massive-dynamic') => "come-in",
                    esc_attr__("Animation", 'massive-dynamic') => "animation",
                    esc_attr__("Flash Animate", 'massive-dynamic') => "flash-animate",
                    esc_attr__("Fill Rectangle", 'massive-dynamic') => "fill-rectangle",
                    esc_attr__("Fill Oval", 'massive-dynamic') => "fill-oval"
                ),
                'dependency' => array(
                    'element' => "imagebox_button",
                    'value' => array('yes')
                )
            ),//image box full btn kind
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue first",

                "heading" => esc_attr__("Button Text", 'massive-dynamic'),
                "param_name" => "imagebox_button_text",
                "value" => "Read more",
                "description" => esc_attr__("Button text", 'massive-dynamic'),
                "admin_label" => false,
                "group" => esc_attr__('Button', 'massive-dynamic'),
                'dependency' => array(
                    'element' => "imagebox_button",
                    'value' => array('yes')
                )
            ),//image box full btn text
            array(
                "type" => 'md_vc_separator',
                "param_name" => "imagebox_button_text_separator" . ++$separatorCounter,
                "admin_label" => false,
                "group" => esc_attr__('Button', 'massive-dynamic'),
                'dependency' => array(
                    'element' => "imagebox_button",
                    'value' => array('yes')
                )
            ),//image box full separator
            array(
                "type" => "md_vc_iconpicker",

                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
                "param_name" => "imagebox_button_icon",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "admin_label" => false,
                "description" => esc_attr__("Select an icon that shown before text", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "imagebox_button",
                    'value' => array('yes')
                ),
                'value' => 'icon-arrow-right4'
            ),//image box full btn icon
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue first last",

                "heading" => esc_attr__("Button Color", 'massive-dynamic'),
                "param_name" => "imagebox_button_color",
                "admin_label" => false,
                "opacity" => false,
                "value" => '#fff',
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => Array(
                    'element' => "imagebox_button",
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
                    'element' => "imagebox_button_style",
                    'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
                ),
            ),//separator
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Text Color", 'massive-dynamic'),
                "param_name" => "imagebox_button_text_color",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "admin_label" => false,
                "opacity" => true,
                "description" => esc_attr__("Enter optional button's color", 'massive-dynamic'),
                'value' => '#fff',
                "dependency" => array(
                    'element' => "imagebox_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),//text color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "button_hover_color_separator". ++$separatorCounter,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "imagebox_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),//separator
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Bg Hover Color", 'massive-dynamic'),
                "param_name" => "imagebox_button_bg_hover_color",
                "admin_label" => false,
                "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "imagebox_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
                'value' => '#9b9b9b'
            ),//bg hover color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "button_hover_color_separator". ++$separatorCounter,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "imagebox_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),//separator
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",

                "heading" => esc_attr__("Button Hover Color", 'massive-dynamic'),
                "param_name" => "imagebox_button_hover_color",
                "admin_label" => false,
                "value" => '#9b9b9b',
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "imagebox_button_style",
                    'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
                ),
            ),//btn hover color
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue first",

                "heading" => esc_attr__("Button Size", 'massive-dynamic'),
                "param_name" => "imagebox_button_size",
                "admin_label" => false,
                "description" => esc_attr__("Choose size of your button", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Standard", 'massive-dynamic') => "standard",
                    esc_attr__("Small", 'massive-dynamic') => "small"
                ),
                'dependency' => array(
                    'element' => "imagebox_button",
                    'value' => array('yes')
                ),

            ),//size
            array(
                "type" => 'md_vc_separator',
                "param_name" => "product_compare_button_size_separator". ++$separatorCounter,
                "admin_label" => false,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "imagebox_button",
                    'value' => array('yes')
                ),

            ),//separator
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Button Padding', 'massive-dynamic'),
                'param_name' => 'imagebox_left_right_padding',
                "group" => esc_attr__("Button", 'massive-dynamic'),
                'value' => '0',
                'defaultSetting' => array(
                    "min" => "0",
                    "max" => "300",
                    "prefix" => " px",
                    "step" => "1",
                ),
                'dependency' => array(
                    'element' => "imagebox_button",
                    'value' => array('yes')
                ),
            ),//space
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue first",

                "heading" => esc_attr__("Button Link", 'massive-dynamic'),
                "param_name" => "imagebox_button_url",
                "value" => "#",
                "admin_label" => false,
                "group" => esc_attr__('Button', 'massive-dynamic'),
                "description" => esc_attr__("Button destination URL", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "imagebox_button",
                    'value' => array('yes')
                )
            ),//image box full btn url
            array(
                "type" => 'md_vc_separator',
                "param_name" => "imagebox_button_url_separator" . ++$separatorCounter,
                "admin_label" => false,
                "group" => esc_attr__('Button', 'massive-dynamic'),
                'dependency' => array(
                    'element' => "imagebox_button",
                    'value' => array('yes')
                )
            ),//image box full separator
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",

                "heading" => esc_attr__("Link's target", 'massive-dynamic'),
                "param_name" => "imagebox_button_target",
                "admin_label" => false,
                "group" => esc_attr__('Button', 'massive-dynamic'),
                "description" => esc_attr__("Open the link in the same tab or a blank browser tab", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Open in same window", 'massive-dynamic') => "_self",
                    esc_attr__("Open in new window", 'massive-dynamic') => "_blank"
                ),
                'dependency' => array(
                    'element' => "imagebox_button",
                    'value' => array('yes')
                )
            ),////image box full btn target
            array(
                "type" => "md_vc_description",

                "group" => esc_attr__('General', 'massive-dynamic'),
                "param_name" => "imagebox_description_control",
                "admin_label" => false,
                "value" => "You can change description height to display background image better."
            ),


        )
    )
);

pixflow_add_params('md_imagebox_full', pixflow_addAnimationTab('md_imagebox_full'));
