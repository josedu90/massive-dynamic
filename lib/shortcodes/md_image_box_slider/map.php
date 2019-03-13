<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Image Box
/*-----------------------------------------------------------------------------------*/
global $separatorCounter;
$separatorCounter = 1;
pixflow_map(

    array(
        "name" => "Image Box",
        "base" => "md_image_box_slider",
        "category" => esc_attr__("Basic", 'massive-dynamic'),
        "allowed_container_element" => 'vc_row',
        "show_settings_on_create" => false,

        "params" => array(

            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Images", 'massive-dynamic'),
                "param_name" => "images_group",
                "group" => esc_attr__("General", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last"
            ),

            /* Background image tab */
            array(
                'type' => 'attach_images',
                'edit_field_class' => $filedClass . "first glue last",
                'heading' => esc_attr__('Choose Image(s)', 'massive-dynamic'),
                "group" => esc_attr__("General", 'massive-dynamic'),
                'param_name' => 'image_box_slider_image',
            ),

            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Sizing", 'massive-dynamic'),
                "param_name" => "sizing_group",
                "group" => esc_attr__("General", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last"
            ),

            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "glue first",
                'heading' => esc_attr__('Image Height', 'massive-dynamic'),
                "group" => esc_attr__("General", 'massive-dynamic'),
                'param_name' => 'image_box_slider_height',
                'value' => '300',
                'defaultSetting' => array(
                    "min" => "100",
                    "max" => "1000",
                    "prefix" => " px",
                    "step" => "10",
                ),

            ),

            array(
                "type" => 'md_vc_separator',
                "group" => esc_attr__("General", 'massive-dynamic'),
                "param_name" => "image_box_slider_separator" . ++$separatorCounter,
            ),

            array(
                'type' => 'dropdown',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Image Size', 'massive-dynamic'),
                "group" => esc_attr__("General", 'massive-dynamic'),
                'param_name' => 'image_box_slider_size',
                'checked' => true,
                "value" => array(
                    esc_attr__("Real Size", 'massive-dynamic') => "auto",
                    esc_attr__("Stretch", 'massive-dynamic') => "cover",
                    esc_attr__("Fit Box", 'massive-dynamic') => "contain",
                ),
            ),

            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Link", 'massive-dynamic'),
                "param_name" => "link_group",
                "group" => esc_attr__("General", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last"
            ),

            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue first ",
                "heading" => esc_attr__("Link URL", 'massive-dynamic'),
                "group" => esc_attr__("General", 'massive-dynamic'),
                "param_name" => "image_box_slider_hover_link",
                'value' => '',
                "admin_label" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "group" => esc_attr__("General", 'massive-dynamic'),
                "param_name" => "image_box_slider_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Link's target", 'massive-dynamic'),
                "param_name" => "image_box_slider_hover_link_target",
                "group" => esc_attr__("General", 'massive-dynamic'),
                "admin_label" => false,
                "value" => array(
                    esc_attr__("Open in same window", 'massive-dynamic') => "_self",
                    esc_attr__("Open in new window", 'massive-dynamic') => "_blank"
                )
            ),

            // Slider Effects

            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Slider Effect", 'massive-dynamic'),
                "param_name" => "image_box_slider_effect_slider",
                "admin_label" => false,
                "group" => esc_attr__("Slider", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Fade Effect", 'massive-dynamic') => "fade",
                    esc_attr__("Slide Effect", 'massive-dynamic') => "slide",
                ),
            ),


            array(
                "type" => 'md_vc_separator',
                "param_name" => "image_box_slider_separator" . ++$separatorCounter,
                "group" => esc_attr__("Slider", 'massive-dynamic'),
            ),

            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Slider Speed', 'massive-dynamic'),
                'param_name' => 'image_box_slider_speed',
                'value' => '3000',
                "group" => esc_attr__("Slider", 'massive-dynamic'),
                'defaultSetting' => array(
                    "min" => "1000",
                    "max" => "5000",
                    "prefix" => " / ms",
                    "step" => "100",
                )
            ),


            // Hover Tab
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "glue first last",
                'heading' => esc_attr__('Activate', 'massive-dynamic'),
                'param_name' => 'image_box_slider_hover',
                "group" => esc_attr__("Hover Effect", 'massive-dynamic'),
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'no'),
                'checked' => false,
            ),

            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Type", 'massive-dynamic'),
                "param_name" => "image_box_slider_hover_effect",
                "admin_label" => false,
                "group" => esc_attr__("Hover Effect", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Text", 'massive-dynamic') => "text",
                    esc_attr__("Image", 'massive-dynamic') => "image",
                ),
                "dependency" => Array(
                    'element' => "image_box_slider_hover",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "image_box_slider_separator". ++$separatorCounter,
                "group" => esc_attr__("Hover Effect", 'massive-dynamic'),
                "dependency" => Array(
                    'element' => "image_box_slider_hover_effect",
                    'value' => 'text'
                )
            ),

            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Text", 'massive-dynamic'),
                "param_name" => "image_box_slider_hover_text",
                'value' => 'Text Hover',
                "admin_label" => false,
                "group" => esc_attr__("Hover Effect", 'massive-dynamic'),
                "dependency" => Array(
                    'element' => "image_box_slider_hover_effect",
                    'value' => 'text'
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "image_box_slider_separator". ++$separatorCounter ,
                "group" => esc_attr__("Hover Effect", 'massive-dynamic'),
                "dependency" => Array(
                    'element' => "image_box_slider_hover_effect",
                    'value' => 'image'
                )
            ),

            array(
                'type' => 'attach_image',
                'edit_field_class' => $filedClass . "glue last",
                'heading' => esc_attr__('Choose Image(s)', 'massive-dynamic'),
                'param_name' => 'image_box_slider_hover_image_sec',
                "group" => esc_attr__("Hover Effect", 'massive-dynamic'),
                "dependency" => Array(
                    'element' => "image_box_slider_hover_effect",
                    'value' => 'image'
                )
            ),


            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue first last",
                "heading" => esc_attr__("Text Skin", 'massive-dynamic'),
                "param_name" => "image_box_slider_hover_text_effect",
                "admin_label" => false,
                "group" => esc_attr__("Hover Effect", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Light", 'massive-dynamic') => "light",
                    esc_attr__("Dark", 'massive-dynamic') => "dark",
                ),
                "dependency" => Array(
                    'element' => "image_box_slider_hover_effect",
                    'value' => 'text'
                )
            ),





        ),

    )
);

pixflow_add_params('md_image_box_slider', pixflow_addAnimationTab('md_image_box_slider'));