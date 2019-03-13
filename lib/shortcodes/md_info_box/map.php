<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Info Box
/*-----------------------------------------------------------------------------------*/


function pixflow_info_box()
{

    $filedClass = 'vc_col-sm-12 vc_column ';
    $separatorCounter = 0;

    $param = array(
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Content", 'massive-dynamic'),
            "param_name" => "content_group",
            "edit_field_class" => $filedClass . "glue first last"
        ),
        array(
            "type" => "textarea",
            "edit_field_class" => $filedClass . "glue first",
            "heading" => esc_attr__("Title", 'massive-dynamic'),
            "param_name" => "info_box_title",
            "admin_label" => false,
            "value" => "Planning for the
future.",
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "info_box_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),



        array(
            "type" => "textarea",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Description", 'massive-dynamic'),
            "param_name" => "info_box_description",
            "description" => esc_attr__("info box description text", 'massive-dynamic'),
            "admin_label" => false,
            "value" => esc_attr__("Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.", 'massive-dynamic'),
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "info_box_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),

        array(
            "type" => "md_vc_iconpicker",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
            "param_name" => "info_box_icon_class",
            "admin_label" => false,
            "description" => esc_attr__("Select an icon", 'massive-dynamic'),
            'value' => 'icon-romance-love-target'
        ),
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Appearance", 'massive-dynamic'),
            "param_name" => "app_group",
            "edit_field_class" => $filedClass . "glue first last"
        ),
        array(
            'type' => 'md_vc_checkbox',
            "edit_field_class" => $filedClass . "glue first",
            'heading' => esc_attr__('Separator', 'massive-dynamic'),
            'param_name' => 'info_box_checkbox',
            'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
            'checked' => false,
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "info_box_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),
        // colors

        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Title Color", 'massive-dynamic'),
            "param_name" => "info_box_title_color",
            "admin_label" => false,
            "description" => esc_attr__("Choose title color", 'massive-dynamic'),
            "value" => '#0338a2',
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "info_box_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Description Color", 'massive-dynamic'),
            "param_name" => "info_box_description_color",
            "admin_label" => false,
            "description" => esc_attr__("Choose description color", 'massive-dynamic'),
            "value" => '#7e7e7e',
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "info_box_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),

        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Border Color", 'massive-dynamic'),
            "param_name" => "info_box_border_color",
            "admin_label" => false,
            "opacity" => true,
            "description" => esc_attr__("Choose border color", 'massive-dynamic'),
            "value" => 'rgba(31,213,190, .1)',
        ),
        /* Button */
        array(
            'type' => 'md_vc_checkbox',
            "edit_field_class" => $filedClass . " glue last first ",
            'heading' => esc_attr__('Add Button', 'massive-dynamic'),
            'param_name' => 'info_box_button',
            'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
            "group" => esc_attr__('Button', 'massive-dynamic'),
        ),// info_box top add button
        array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "stick-to-top",
            "param_name" => "info_box_use_button" . ++$separatorCounter,
            "group" => esc_attr__('Button', 'massive-dynamic'),
            "admin_label" => false,
            "dependency" => array(
                'element' => "info_box_button",
                'value' => array('yes')
            )
        ),//separator
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue last",
            "separate" => true,
            "heading" => esc_attr__("Button Style", 'massive-dynamic'),
            "param_name" => "info_box_button_style",
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
            'dependency' => array(
                'element' => "info_box_button",
                'value' => array('yes')
            ),
            "group" => esc_attr__('Button', 'massive-dynamic'),
        ),//info_box top btn kind
        array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue first",
            "heading" => esc_attr__("Button Text", 'massive-dynamic'),
            "param_name" => "info_box_button_text",
            "value" => "View more",
            "description" => esc_attr__("Button text", 'massive-dynamic'),
            "admin_label" => false,
            'dependency' => array(
                'element' => "info_box_button",
                'value' => array('yes')
            ),
            "group" => esc_attr__('Button', 'massive-dynamic'),
        ),//info_box top btn text
        array(
            "type" => 'md_vc_separator',
            "param_name" => "info_box_button_text_separator" . ++$separatorCounter,
            "admin_label" => false,
            'dependency' => array(
                'element' => "info_box_button",
                'value' => array('yes')
            ),
            "group" => esc_attr__('Button', 'massive-dynamic'),
        ),//info_box top separator
        array(
            "type" => "md_vc_iconpicker",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
            "param_name" => "info_box_button_icon_class",
            "admin_label" => false,
            "description" => esc_attr__("Select an icon that shown before text", 'massive-dynamic'),
            'value' => 'icon-snowflake2',
            'dependency' => array(
                'element' => "info_box_button",
                'value' => array('yes')
            ),
            "group" => esc_attr__('Button', 'massive-dynamic'),
        ),//info_box top btn icon
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue first last",
            "heading" => esc_attr__("Button Color", 'massive-dynamic'),
            "param_name" => "info_box_button_color",
            "admin_label" => false,
            "opacity" => false,
            "value" => '#017eff',
            "group" => esc_attr__('Button', 'massive-dynamic'),
            "description" => esc_attr__("Choose background color", 'massive-dynamic'),
            'dependency' => array(
                'element' => "info_box_button",
                'value' => array('yes')
            ),
        ),//info_box top btn general color
        array(
            "type" => 'md_vc_separator',
            "param_name" => "info_box_color_separator" . ++$separatorCounter,
            "group" => esc_attr__('Button', 'massive-dynamic'),
            "edit_field_class" => $filedClass . "stick-to-top",
            "dependency" => array(
                'element' => "info_box_button_style",
                'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
            ),
        ),//info_box top btn separator
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Text Color", 'massive-dynamic'),
            "param_name" => "info_box_button_text_color",
            "admin_label" => false,
            "opacity" => true,
            "description" => esc_attr__("Enter optional button's color", 'massive-dynamic'),
            'value' => '#fff',
            "group" => esc_attr__('Button', 'massive-dynamic'),
            "dependency" => array(
                'element' => "info_box_button_style",
                'value' => array('fill-oval', 'fill-rectangle'),
            ),
        ),//info_box top btn text color
        array(
            "type" => 'md_vc_separator',
            "param_name" => "info_box_button_hover_color_separator" . ++$separatorCounter,
            "dependency" => array(
                'element' => "info_box_button_style",
                'value' => array('fill-oval', 'fill-rectangle'),
            ),
            "group" => esc_attr__('Button', 'massive-dynamic'),
        ),//info_box top btn separator
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Bg Hover Color", 'massive-dynamic'),
            "param_name" => "info_box_button_bg_hover_color",
            "admin_label" => false,
            "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
            "group" => esc_attr__('Button', 'massive-dynamic'),
            "dependency" => array(
                'element' => "info_box_button_style",
                'value' => array('fill-oval', 'fill-rectangle'),
            ),
            'value' => '#017eff'
        ),//info_box top btn bg hover color
        array(
            "type" => 'md_vc_separator',
            "param_name" => "info_box_button_hover_color_separator" . ++$separatorCounter,
            "group" => esc_attr__('Button', 'massive-dynamic'),
            "dependency" => array(
                'element' => "info_box_button_style",
                'value' => array('fill-oval', 'fill-rectangle'),
            ),
        ),//info_box top btn separator
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Text Hover Color", 'massive-dynamic'),
            "param_name" => "info_box_button_hover_color",
            "admin_label" => false,
            "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
            'value' => '#fff',
            "dependency" => array(
                'element' => "info_box_button_style",
                'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
            ),
            "group" => esc_attr__('Button', 'massive-dynamic'),
        ),//info_box top btn text hover color
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue first",

            "heading" => esc_attr__("Button Size", 'massive-dynamic'),
            "param_name" => "info_box_button_size",
            "admin_label" => false,
            "description" => esc_attr__("Choose size of your button", 'massive-dynamic'),
            "value" => array(
                esc_attr__("Standard", 'massive-dynamic') => "standard",
                esc_attr__("Small", 'massive-dynamic') => "small"
            ),
            'dependency' => array(
                'element' => "info_box_button",
                'value' => array('yes')
            ),
            "group" => esc_attr__('Button', 'massive-dynamic'),
        ),//info_box top btn  btn size
        array(
            "type" => 'md_vc_separator',
            "param_name" => "info_box_button_size_separator" . ++$separatorCounter,
            "admin_label" => false,
            'dependency' => array(
                'element' => "info_box_button",
                'value' => array('yes')
            ),
            "group" => esc_attr__('Button', 'massive-dynamic'),
        ),//info_box top btn separator
        array(
            'type' => 'md_vc_slider',
            "edit_field_class" => $filedClass . "glue last",
            'heading' => esc_attr__('Button Padding', 'massive-dynamic'),
            'param_name' => 'info_box_button_padding',
            'value' => '0',
            'defaultSetting' => array(
                "min" => "0",
                "max" => "300",
                "prefix" => " px",
                "step" => "1",
            ),
            'dependency' => array(
                'element' => "info_box_button",
                'value' => array('yes')
            ),
            "group" => esc_attr__('Button', 'massive-dynamic'),
        ),//info_box top btn space
        array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue first",
            "heading" => esc_attr__("Button Link", 'massive-dynamic'),
            "param_name" => "info_box_button_url",
            "value" => "#",
            "admin_label" => false,
            "description" => esc_attr__("Button destination URL", 'massive-dynamic'),
            'dependency' => array(
                'element' => "info_box_button",
                'value' => array('yes')
            ),
            "group" => esc_attr__('Button', 'massive-dynamic'),
        ),//info_box top btn url
        array(
            "type" => 'md_vc_separator',
            "param_name" => "info_box_button_url_separator" . ++$separatorCounter,
            "admin_label" => false,
            'dependency' => array(
                'element' => "info_box_button",
                'value' => array('yes')
            ),
            "group" => esc_attr__('Button', 'massive-dynamic'),
        ),//info_box top btn separator
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Link's target", 'massive-dynamic'),
            "param_name" => "info_box_button_target",
            "admin_label" => false,
            "description" => esc_attr__("Open the link in the same tab or a blank browser tab", 'massive-dynamic'),
            "value" => array(
                esc_attr__("Open in same window", 'massive-dynamic') => "_self",
                esc_attr__("Open in new window", 'massive-dynamic') => "_blank"
            ),
            'dependency' => array(
                'element' => "info_box_button",
                'value' => array('yes')
            ),
            "group" => esc_attr__('Button', 'massive-dynamic'),
        ),//info_box top btn target

    );
    return $param;
}

//Register "container" content element. It will hold all your inner (child) content elements
pixflow_map(array(
    "name" => esc_attr__("Info Box", 'massive-dynamic'),
    "base" => "md_info_box",
    "show_settings_on_create" => false,
    "category" => esc_attr__('Business','massive-dynamic'),
    "params" => pixflow_info_box()
));

pixflow_add_params('md_info_box', pixflow_addAnimationTab('md_info_box'));
