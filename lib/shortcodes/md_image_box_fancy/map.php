<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Image Box Fancy
/*-----------------------------------------------------------------------------------*/

pixflow_map(

    array(
        "name" => "Image Box Fancy",
        "base" => "md_image_box_fancy",
        "category" => esc_attr__('Media','massive-dynamic'),
        "allowed_container_element" => 'vc_row',
        "show_settings_on_create" => false,

        "params" => array(

            /* Background image tab */
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Images(s)", 'massive-dynamic'),
                "param_name" => "img_group",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                'type' => 'attach_images',
                'edit_field_class' => $filedClass . "first glue last",
                'heading' => esc_attr__('Choose Image(s)', 'massive-dynamic'),
                'param_name' => 'image_box_fancy_image',
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Sizing", 'massive-dynamic'),
                "param_name" => "size_group",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                'type' => 'dropdown',
                "edit_field_class" => $filedClass . " first glue ",
                'heading' => esc_attr__('Height', 'massive-dynamic'),
                'param_name' => 'image_box_fancy_height_type',
                "value" => array(
                    esc_attr__("Manual", 'massive-dynamic') => "manual",
                    esc_attr__("Fit to Row Height", 'massive-dynamic') => "fit",
                ),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "image_box_fancy_separator" . ++$separatorCounter,
                "dependency" => array(
                    'element' => "image_box_fancy_height_type",
                    'value' => 'manual'
                )
            ),

            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "glue",
                'heading' => esc_attr__('Image Height', 'massive-dynamic'),
                'param_name' => 'image_box_fancy_height',
                'value' => '450',
                'defaultSetting' => array(
                    "min" => "100",
                    "max" => "1000",
                    "prefix" => " px",
                    "step" => "10",
                ),
                "dependency" => array(
                    'element' => "image_box_fancy_height_type",
                    'value' => 'manual'
                )
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "image_box_fancy_separator" . ++$separatorCounter,
            ),

            array(
                'type' => 'dropdown',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Image Size', 'massive-dynamic'),
                'param_name' => 'image_box_fancy_size',
                'checked' => true,
                "value" => array(
                    esc_attr__("Real Size", 'massive-dynamic') => "auto",
                    esc_attr__("Stretch", 'massive-dynamic') => "cover",
                    esc_attr__("Fit Box", 'massive-dynamic') => "contain",
                ),
            ),

            // Description
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Content", 'massive-dynamic'),
                "param_name" => "content_group",
                "group" => esc_attr__("Description", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filedClass . " first glue last",
                "heading" => esc_attr__("Icon", 'massive-dynamic'),
                "param_name" => "image_box_fancy_icon",
                "value" => "icon-Diamond",
                "admin_label" => false,
                "group" => esc_attr__("Description", 'massive-dynamic'),

            ),//icon
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "param_name" => "image_box_fancy_description_title",
                'value' => 'Fancy Image Box',
                "group" => esc_attr__("Description", 'massive-dynamic'),
                "admin_label" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "image_box_fancy_separator" . ++$separatorCounter,
                "group" => esc_attr__("Description", 'massive-dynamic'),
            ),
            array(
                "type" => "textarea",
                "edit_field_class" => $filedClass . " glue last",
                "heading" => esc_attr__("Description", 'massive-dynamic'),
                "param_name" => "image_box_fancy_description_text",
                'value' => 'Massive Dynamic has over 10 years of experience in Design. We take pride in delivering Intelligent Designs and Engaging Experiences for clients all over the World.',
                "group" => esc_attr__("Description", 'massive-dynamic'),
                "admin_label" => false,
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "app_group",
                "group" => esc_attr__("Description", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                'type' => 'dropdown',
                "edit_field_class" => $filedClass . "first glue last",
                'heading' => esc_attr__('Style', 'massive-dynamic'),
                'param_name' => 'image_box_fancy_style',
                'value' => array(
                    esc_attr__('Normal Overlay', 'massive-dynamic') => 'normal',
                    esc_attr__('Full Overlay', 'massive-dynamic') => 'full',
                ),
                "group" => esc_attr__("Description", 'massive-dynamic'),
            ),
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Icon Color", 'massive-dynamic'),
                "param_name" => "image_box_fancy_icon_color",
                "admin_label" => false,
                "value" => "rgba(0,177,177,1)",
                "opacity" => true,
                "group" => esc_attr__("Description", 'massive-dynamic'),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "image_box_fancy_separator" . ++$separatorCounter,
                "group" => esc_attr__("Description", 'massive-dynamic'),
            ),
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . " glue",
                "heading" => esc_attr__("Text Color", 'massive-dynamic'),
                "param_name" => "image_box_fancy_text_color",
                "admin_label" => false,
                "value" => "rgba(0,0,0,1)",
                "opacity" => true,
                "group" => esc_attr__("Description", 'massive-dynamic'),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "image_box_fancy_separator" . ++$separatorCounter,
                "group" => esc_attr__("Description", 'massive-dynamic'),
            ),
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "last glue",
                "heading" => esc_attr__("Background Color", 'massive-dynamic'),
                "param_name" => "image_box_fancy_background_color",
                "admin_label" => false,
                "value" => "rgba(255,255,255,1)",
                "opacity" => true,
                "group" => esc_attr__("Description", 'massive-dynamic'),
            ),
            // Slider Effects

            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Effect", 'massive-dynamic'),
                "param_name" => "image_box_fancy_effect_slider",
                "admin_label" => false,
                "group" => esc_attr__("Slider", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Fade Effect", 'massive-dynamic') => "fade",
                    esc_attr__("Slide Effect", 'massive-dynamic') => "slide",
                ),
            ),


            array(
                "type" => 'md_vc_separator',
                "param_name" => "image_box_fancy_separator" . ++$separatorCounter,
                "group" => esc_attr__("Slider", 'massive-dynamic'),
            ),

            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Speed', 'massive-dynamic'),
                'param_name' => 'image_box_fancy_speed',
                'value' => '3000',
                "group" => esc_attr__("Slider", 'massive-dynamic'),
                'defaultSetting' => array(
                    "min" => "1000",
                    "max" => "5000",
                    "prefix" => " / ms",
                    "step" => "100",
                )
            ),



        ),

    )
);

pixflow_add_params('md_image_box_fancy', pixflow_addAnimationTab('md_image_box_fancy'));
