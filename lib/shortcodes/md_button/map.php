<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------*/
/*  MD BUTTON
/*-----------------------------------------------------------------------------------*/
global $separatorCounter;
$separatorCounter = 1;
$button_params = array(
    array(
        "type" => "md_group_title",
        "heading" => esc_attr__("Style", 'massive-dynamic'),
        "param_name" => "style_group",
        "edit_field_class" => $filedClass . "glue first last"
    ),
    array(
        "type" => "dropdown",
        "edit_field_class" => $filedClass . "glue first last",
        "separate" => true,
        "heading" => esc_attr__("Style", 'massive-dynamic'),
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
    ),
    array(
        "type" => "dropdown",
        "edit_field_class" => $filedClass . "glue first",
        "heading" => esc_attr__("Size", 'massive-dynamic'),
        "param_name" => "button_size",
        "admin_label" => false,
        "description" => esc_attr__("Choose between three button sizes", 'massive-dynamic'),
        "value" => array(
            esc_attr__("Standard", 'massive-dynamic') => "standard",
            esc_attr__("Small", 'massive-dynamic') => "small"
        ),
    ),
    array(
        "type" => 'md_vc_separator',
        "param_name" => "button_text_separator" . ++$separatorCounter,
    ),
    array(
        'type' => 'md_vc_slider',
        "edit_field_class" => $filedClass . "glue last",
        'heading' => esc_attr__('Padding', 'massive-dynamic'),
        'param_name' => 'left_right_padding',
        'value' => '0',
        'defaultSetting' => array(
            "min" => "0",
            "max" => "300",
            "prefix" => " px",
            "step" => "1",
        )
    ),
    array(
        "type" => "dropdown",
        "edit_field_class" => $filedClass . "glue first last",
        "heading" => esc_attr__("Alignment", 'massive-dynamic'),
        "param_name" => "button_align",
        "admin_label" => false,
        "value" => array(
            esc_attr__("Left", 'massive-dynamic') => "left",
            esc_attr__("Center", 'massive-dynamic') => "center",
            esc_attr__("Right", 'massive-dynamic') => 'right'
        ),

    ),
    array(
        "type" => "md_group_title",
        "heading" => esc_attr__("Content", 'massive-dynamic'),
        "param_name" => "content_group",
        "edit_field_class" => $filedClass . "glue first last"
    ),
    array(
        "type" => "textfield",
        "edit_field_class" => $filedClass . "first glue",
        "heading" => esc_attr__("Text", 'massive-dynamic'),
        "param_name" => "button_text",
        "description" => esc_attr__("Button text", 'massive-dynamic'),
        "admin_label" => false,
        "value" => esc_attr__('Read more', 'massive-dynamic')
    ),
    array(
            "type" => 'md_vc_separator',
            "param_name" => "button_text_separator" . ++$separatorCounter
    ),
    array(
        "type" => "md_vc_iconpicker",
        "edit_field_class" => $filedClass . "glue last",
        "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
        "param_name" => "button_icon_class",
        "admin_label" => false,
        "description" => esc_attr__("Select an icon that shown before text", 'massive-dynamic'),
        'value' => 'icon-Layers'
    ),
    array(
        "type" => "md_group_title",
        "heading" => esc_attr__("Appearance", 'massive-dynamic'),
        "param_name" => "appearance_group",
        "edit_field_class" => $filedClass . "glue first last"
    ),
    array(
        "type" => "md_vc_colorpicker",
        "edit_field_class" => $filedClass . "glue first",
        "heading" => esc_attr__("General Color", 'massive-dynamic'),
        "param_name" => "button_color",
        "admin_label" => false,
        "opacity" => true,
        "description" => esc_attr__("Enter optional button's color", 'massive-dynamic'),
        'value' => '#000'
    ),
    array(
        "type" => 'md_vc_separator',
        "param_name" => "button_color_separator" . ++$separatorCounter,
        "edit_field_class" => $filedClass . "stick-to-top",
        "dependency" => array(
            'element' => "button_style",
            'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
        ),
    ),

    array(
        "type" => "md_vc_colorpicker",
        "edit_field_class" => $filedClass . "glue",
        "heading" => esc_attr__("Text Color", 'massive-dynamic'),
        "param_name" => "button_text_color",
        "admin_label" => false,
        "opacity" => true,
        "description" => esc_attr__("Enter optional button's color", 'massive-dynamic'),
        'value' => '#fff',
        "dependency" => array(
            'element' => "button_style",
            'value' => array('fill-oval', 'fill-rectangle')
        ),
    ),
    array(
        "type" => 'md_vc_separator',
        "edit_field_class" => $filedClass . "glue",
        "param_name" => "button_hover_color_separator" . ++$separatorCounter ,
        "dependency" => array(
            'element' => "button_style",
            'value' => array('fill-oval', 'fill-rectangle')
        ),
    ),
    array(
        "type" => "md_vc_colorpicker",
        "edit_field_class" => $filedClass . "glue",
        "heading" => esc_attr__("Bg Hover Color", 'massive-dynamic'),
        "param_name" => "button_bg_hover_color",
        "admin_label" => false,
        "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
        "dependency" => array(
            'element' => "button_style",
            'value' => array('fill-oval', 'fill-rectangle'),
        ),
        'value' => '#9b9b9b'
    ),
    array(
        "type" => 'md_vc_separator',
        "edit_field_class" => $filedClass . "glue",
        "param_name" => "button_hover_color_separator" . ++$separatorCounter,
        "dependency" => array(
            'element' => "button_style",
            'value' => array('fill-oval', 'fill-rectangle'),
        ),
    ),
    array(
        "type" => "md_vc_colorpicker",
        "edit_field_class" => $filedClass . "glue last",
        "heading" => esc_attr__("Text Hover Color", 'massive-dynamic'),
        "param_name" => "button_hover_color",
        "admin_label" => false,
        "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
        "dependency" => array(
            'element' => "button_style",
            'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
        ),
        'value' => '#FFF'
    ),



    array(
        "type" => "md_group_title",
        "heading" => esc_attr__("Link", 'massive-dynamic'),
        "param_name" => "link_group",
        "edit_field_class" => $filedClass . "glue first last"
    ),
    array(
        "type" => "textfield",
        "edit_field_class" => $filedClass . "glue first",
        "heading" => esc_attr__("Link URL", 'massive-dynamic'),
        "param_name" => "button_url",
        "admin_label" => false,
        "description" => esc_attr__("Button destination URL", 'massive-dynamic'),
        'value' => '#'
    ),
    array(
        "type" => 'md_vc_separator',
        "param_name" => "button_linkr_separator" . ++$separatorCounter,
    ),
    array(
        "type" => "dropdown",
        "edit_field_class" => $filedClass . "glue last",
        "heading" => esc_attr__("Link's target", 'massive-dynamic'),
        "param_name" => "button_target",
        "admin_label" => false,
        "description" => esc_attr__("Open the link in the same tab or a blank browser tab", 'massive-dynamic'),
        "value" => array(
            esc_attr__("Open in same window", 'massive-dynamic') => "_self",
            esc_attr__("Open in new window", 'massive-dynamic') => "_blank"
        ),
    )
);

if ( shortcode_exists( 'ninja-popup' ) ) {

    if(function_exists("snp_get_popups")) {
        $ninja_forms = array_flip(snp_get_popups());
    }else{
        function pixflow_list_popups()
        {
            $Return = array();
            $args = array(
                'numberposts' => 1000,
                'offset' => 0,
                'orderby' => 'title',
                'order' => 'ASC',
                'post_type' => 'snp_popups',
                'post_status' => 'publish',
                'suppress_filters' => true);
            $posts_array = get_posts($args);
            foreach ((array) $posts_array as $post)
            {
                $Return[$post->ID] = $post->post_title;
            }
            return $Return;
        }
        $ninja_forms = array_flip(pixflow_list_popups());
    }

    $button_params[] = array(
        "type" => "md_group_title",
        "heading" => esc_attr__("Ninja Popup", 'massive-dynamic'),
        "param_name" => "ninja_popup_group",
        "edit_field_class" => $filedClass . "glue first last"
    );
    $button_params[] = array(
        'type' => 'md_vc_checkbox',
        "edit_field_class" => $filedClass . "first glue last",
        'heading' => esc_attr__('Ninja Popup', 'massive-dynamic'),
        'param_name' => 'ninja_popup_validate',
        'value' => array(esc_attr__('No', 'massive-dynamic') => 'no'),
        'checked' => false,

    );
    $button_params[] = array(
        "type" => "dropdown",
        "heading" => esc_attr__("popup form", 'massive-dynamic'),
        "param_name" => "ninja_popup_form_id",
        "edit_field_class" => $filedClass . "glue first last",
        'value' => $ninja_forms,
        "mb_dependency" => array(
            'element' => "ninja_popup_validate",
            'value' => array('yes')
        )
    );
    $button_params[] =  array(
        "type" => "md_vc_description",
        "param_name" => "md_ninja_popup_description",
        "value" => esc_attr__("Ninja Popup doesn't work in this environment.", 'massive-dynamic'),
        "mb_dependency" => array(
            'element' => "ninja_popup_validate",
            'value' => array('yes')
        )

    );

}
pixflow_map(

    array(
        "name" => "Button",
        "base" => "md_button",
        "category" => esc_attr__('Basic', 'massive-dynamic'),
        "allowed_container_element" => 'vc_row',
        "show_settings_on_create" => false,
        "params" =>  $button_params,
    )
);

pixflow_add_params('md_button', pixflow_addAnimationTab('md_button'));
