<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Slider Carousel
/*-----------------------------------------------------------------------------------*/

pixflow_map(

    array(
        "name" => "Slider Carousel",
        "base" => "md_slider_carousel",
        "category" => esc_attr__('Media','massive-dynamic'),
        "allowed_container_element" => 'vc_row',
        "show_settings_on_create" => false,

        "params" => array(

            /* Background image tab */
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Slides", 'massive-dynamic'),
                "param_name" => "slides_group",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                'type' => 'attach_images',
                'edit_field_class' => $filedClass . "first glue last",
                'heading' => esc_attr__('Choose Image(s)', 'massive-dynamic'),
                'param_name' => 'slider_images',
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "app_group",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "first glue ",
                'heading' => esc_attr__('Slider Height', 'massive-dynamic'),
                'param_name' => 'slider_heights',
                'value' => '600',
                'defaultSetting' => array(
                    "min" => "100",
                    "max" => "1200",
                    "prefix" => " px",
                    "step" => "5",
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "slider_separator" . ++$separatorCounter,
            ),
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . " glue last",
                'heading' => esc_attr__('Margin', 'massive-dynamic'),
                'param_name' => 'slider_margin',
                'value' => '20',
                'defaultSetting' => array(
                    "min" => "0",
                    "max" => "100",
                    "prefix" => " px",
                    "step" => "1",
                )
            ),

            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "first glue last",
                "heading" => esc_attr__("Nav Active Color", 'massive-dynamic'),
                "param_name" => "slider_nav_active_color",
                "value" => 'rgba(68,123,225,1)',
                "admin_label" => false,
                "opacity" => true,
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "glue first last",
                'heading' => esc_attr__('Shadow', 'massive-dynamic'),
                'param_name' => 'slider_shadow',
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
                'checked' => true,
            ),

            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Autoplay", 'massive-dynamic'),
                "param_name" => "auto_group",
                "edit_field_class" => $filedClass . "glue first",
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "glue first last",
                'heading' => esc_attr__('Activate', 'massive-dynamic'),
                'param_name' => 'slider_auto_play',
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
                'checked' => true,
            ),
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "separator" . ++$separatorCounter,
                "dependency" => array(
                    'element' => "slider_auto_play",
                    'value' => array('yes'),
                ),
            ),//separator
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "last glue",
                'heading' => esc_attr__('Duration', 'massive-dynamic'),
                'param_name' => 'slider_slider_speed',
                'value' => '5',
                'defaultSetting' => array(
                    "min" => "1",
                    "max" => "30",
                    "prefix" => " / s",
                    "step" => "1",
                ),
                "dependency" => array(
                    'element' => "slider_auto_play",
                    'value' => array('yes'),
                ),
            ),
            array(
                "type" => "md_vc_description",
                "param_name" => "modern_description",
                "admin_label" => false,
                "value" => '<ul><li>' . esc_attr__('For correct output, please use at least 3 images.', 'massive-dynamic') . '</li><li>' . esc_attr__('For adding multiple images to carousel, hold Ctrl(Cmd on Mac) and select images in image uploader.', 'massive-dynamic') . '</li></ul>',
            ),
        ),
    )
);

pixflow_add_params('md_slider_carousel', pixflow_addAnimationTab('md_slider_carousel'));
