<?php
/**
 * Pixflow
 */


/*******************************************************************
 *                  Split Box
 ******************************************************************/
global $separatorCounter;
$separatorCounter = 1;
pixflow_map(
    array(
        'base' => 'md_splitBox',
        'name' => esc_attr__('Split Box', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__('Business', 'massive-dynamic'),
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
                "edit_field_class" => $filedClass . "first glue",
                "param_name" => "sb_title",
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "value" => 'Super Flexible',
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "sb_title_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Subtitle", 'massive-dynamic'),
                "param_name" => "sb_subtitle",
                "admin_label" => false,
                "value" => "OBJECT",
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "sb_subtitle_separator" . ++$separatorCounter,
            ),

            array(
                "type" => "textarea",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_html__("Description", 'massive-dynamic'),
                "param_name" => "sb_desc",
                "admin_label" => false,
                "value" => "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.",
            ),
            array(
                "type" => "attach_image",
                "edit_field_class" => $filedClass . "first glue last",
                "heading" => esc_attr__("Image", 'massive-dynamic'),
                "param_name" => "sb_image",
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
                "param_name" => "sb_bg_color",
                "value" => 'rgb(233,233,233)',
                "admin_label" => false,
                "opacity" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "sb_bg_color_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Text Color", 'massive-dynamic'),
                "param_name" => "sb_text_color",
                "value" => 'rgb(0,0,0)',
                "admin_label" => false,
                "opacity" => false,
            ),

            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "first glue last",
                "heading" => esc_attr__("Alignment", 'massive-dynamic'),
                "param_name" => "sb_alignment",
                "admin_label" => false,
                "value" => array(
                    "Left" => "sb-left",
                    "Right" => "sb-right"
                ),
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Title size", 'massive-dynamic'),
                "param_name" => "sb_title_size",
                "description" => esc_attr__("Choose your heading", 'massive-dynamic'),
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
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "first glue last",
                'heading' => esc_attr__('Split Box Height', 'massive-dynamic'),
                'param_name' => "sb_height",
                'value' => '470',
                'defaultSetting' => array(
                    "min" => "300",
                    "max" => "900",
                    "prefix" => " px",
                    "step" => "1",
                )
            ),
            //btn tab
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "first glue last",
                'heading' => esc_attr__('Activate', 'massive-dynamic'),
                'param_name' => 'use_button',
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
                'checked' => false,
                "group" => esc_attr__("Button", 'massive-dynamic'),
            ),//add btn
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "use_button". ++$separatorCounter,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "admin_label" => false,
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),//separator
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Style", 'massive-dynamic'),
                "param_name" => "btn_style_group",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last",
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",
                "separate" => true,
                "heading" => esc_attr__("Style", 'massive-dynamic'),
                "param_name" => "button_style",
                "description" => esc_attr__("Choose between five button style", 'massive-dynamic'),
                "admin_label" => false,
                "value" => array(
                    esc_attr__("Fill Rectangle", 'massive-dynamic') => "fill-rectangle",
                    esc_attr__("Fade Square", 'massive-dynamic') => "fade-square",
                    esc_attr__("Fade Oval", 'massive-dynamic') => "fade-oval",
                    esc_attr__("Slide", 'massive-dynamic') => "slide",
                    esc_attr__("Fill Slide", 'massive-dynamic') => "come-in",
                    esc_attr__("Animation", 'massive-dynamic') => "animation",
                    esc_attr__("Flash Animate", 'massive-dynamic') => "flash-animate",
                    esc_attr__("Fill Oval", 'massive-dynamic') => "fill-oval"
                ),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),//btn kind
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Size", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "param_name" => "button_size",
                "admin_label" => false,
                "description" => esc_attr__("Choose between three button sizes", 'massive-dynamic'),
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
                "param_name" => "button_size_separator". ++$separatorCounter,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),//separator
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "glue last",
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
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),//spacing
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Content", 'massive-dynamic'),
                "param_name" => "btn_content_group",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last",
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Text", 'massive-dynamic'),
                "param_name" => "button_text",
                "description" => esc_attr__("Button text", 'massive-dynamic'),
                "admin_label" => false,
                "value" => 'VIEW MORE',
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),//btn text
            array(
                "type" => 'md_vc_separator',
                "param_name" => "button_text_separator". ++$separatorCounter,
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
                "description" => esc_attr__("Select an icon that shown before text", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                ),
                'value' => 'icon-angle-right'
            ),//btn icon
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "btn_app_group",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last",
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue first last",
                "heading" => esc_attr__("General Color", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "param_name" => "button_color",
                "admin_label" => false,
                "opacity" => true,
                "value" => "rgba(255,255,255,1)",
                "description" => esc_attr__("Enter optional button's color", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),//btn general color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "md_text_button_color_separator". ++$separatorCounter,
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
                "value" => "rgba(126,126,126,1)",
                "description" => esc_attr__("Enter optional button's color", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),//btn text color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "button_color_separator". ++$separatorCounter,
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
                "value" => "rgb(0,0,0)",
                "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),

            ),//btn bg hover color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "button_color_separator". ++$separatorCounter,
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
                "value" => "rgb(255,255,255)",
                "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "button_style",
                    'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
                ),

            ),//btn text hover color
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Link", 'massive-dynamic'),
                "param_name" => "btn_link_group",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last",
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),

            array(
                "type" => "textfield",
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("URL", 'massive-dynamic'),
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
                "param_name" => "button_linkr_separator" . ++$separatorCounter,
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "use_button",
                    'value' => array('yes')
                )
            ),//separator
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Target", 'massive-dynamic'),
                "group" => esc_attr__("Button", 'massive-dynamic'),
                "param_name" => "button_target",
                "admin_label" => false,
                "description" => esc_attr__("Open the link in the same tab or a blank browser tab", 'massive-dynamic'),
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

pixflow_add_params('md_splitBox', pixflow_addAnimationTab('md_splitBox'));
