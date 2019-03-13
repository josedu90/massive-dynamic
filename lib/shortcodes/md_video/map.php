<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------*/
/*  Video
/*-----------------------------------------------------------------------------------*/
global $separatorCounter;
$separatorCounter = 1;
pixflow_map(
    array(
        "name" => esc_attr__('Video', 'massive-dynamic'),
        "base" => "md_video",
        "category" => esc_attr__("Basic", 'massive-dynamic'),
        'show_settings_on_create' => false,
        "allowed_container_element" => 'vc_row',
        "params" => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Source", 'massive-dynamic'),
                "param_name" => "source_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_attr__("Host", 'massive-dynamic'),
                "param_name" => "md_video_host",
                "edit_field_class" => $filedClass . "glue first last",
                "value" => array(

                    "Youtube" => "youtube",
                    "Vimeo" => "vimeo",
                    "Self Hosted" => "self",

                ),
            ),
            array(
                'type' => 'textfield',
                "edit_field_class" => $filedClass . "first glue",
                'param_name' => 'md_video_url_mp4',
                "heading" => esc_attr__("MP4 Link", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "md_video_host",
                    'value' => array('self')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "md_video_url_mp4_separator". ++$separatorCounter,
                "dependency" => array(
                    'element' => "md_video_host",
                    'value' => array('self')
                )
            ),
            array(
                'type' => 'textfield',
                "edit_field_class" => $filedClass . "glue",
                'param_name' => 'md_video_url_webm',
                "heading" => esc_attr__("Webm Link", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "md_video_host",
                    'value' => array('self')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "md_video_url_webm_separator". ++$separatorCounter,
                "dependency" => array(
                    'element' => "md_video_host",
                    'value' => array('self')
                )
            ),
            array(
                'type' => 'textfield',
                "edit_field_class" => $filedClass . "glue last",
                'param_name' => 'md_video_url_ogg',
                "heading" => esc_attr__("Ogg Link", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "md_video_host",
                    'value' => array('self')
                )
            ),
            array(
                'type' => 'textfield',
                "edit_field_class" => $filedClass . "first glue last",
                'param_name' => 'md_video_url_youtube',
                "heading" => esc_attr__("Link", 'massive-dynamic'),
                "value" => 'https://www.youtube.com/watch?v=tcxlSrYEkq8',
                "dependency" => array(
                    'element' => "md_video_host",
                    'value' => array('youtube')
                )
            ),
            array(
                'type' => 'textfield',
                "edit_field_class" => $filedClass . "first glue last",
                'param_name' => 'md_video_url_vimeo',
                "heading" => esc_attr__("Link", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "md_video_host",
                    'value' => array('vimeo')
                )
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "app_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_attr__("Style", 'massive-dynamic'),
                "param_name" => "md_video_style",
                "edit_field_class" => $filedClass . "glue first",
                "value" => array(
                    esc_attr__("Color Button", 'massive-dynamic') => "color",
                    esc_attr__("Square Image", 'massive-dynamic') => "squareImage",
                    esc_attr__("Circle Image", 'massive-dynamic') => "circleImage",
                ),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "md_text_style_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Color", 'massive-dynamic'),
                "param_name" => "md_video_solid_color",
                "value" => 'rgba(20,20,20,1)',
                "admin_label" => false,
                "opacity" => true,
                "dependency" => array(
                    'element' => "md_video_style",
                    'value' => array('color')
                )
            ),

            array(
                'type' => 'attach_image',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Image', 'massive-dynamic'),
                'param_name' => 'md_video_image',
                "dependency" => array(
                    'element' => "md_video_style",
                    'value' => array('circleImage', 'squareImage')
                ),
            ),

            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . " glue first last",
                'heading' => esc_attr__('Size', 'massive-dynamic'),
                'param_name' => 'md_video_size',
                'value' => '100',
                'defaultSetting' => array(
                    "min" => "60",
                    "max" => "100",
                    "prefix" => " %",
                    "step" => "1",
                )
            ),


        )
    )
);

pixflow_add_params('md_video', pixflow_addAnimationTab('md_video'));
