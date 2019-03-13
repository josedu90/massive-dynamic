<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------
            Pixflow Slider
-----------------------------------------------------------------------------------*/

function pixflow_slider_param()
{

    $filedClass = 'vc_col-sm-12 vc_column ';
    $separatorCounter = 0;
    $slider_param = 'slider_num';
    $slider_num = 5;
    $dropDown = array(
        esc_attr__("Three", 'massive-dynamic') => 3,
        esc_attr__("One", 'massive-dynamic') => 1,
        esc_attr__("Two", 'massive-dynamic') => 2,
        esc_attr__("Four", 'massive-dynamic') => 4,
        esc_attr__("Five", 'massive-dynamic') => 5
    );

    $param = array(
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Slides Number", 'massive-dynamic'),
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "num_group",
            "edit_field_class" => $filedClass . "glue first last",
        ),
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue first last",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Number ", 'massive-dynamic'),
            "param_name" => $slider_param,
            "admin_label" => false,
            "value" => $dropDown
        ),
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Appearance", 'massive-dynamic'),
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "app_group",
            "edit_field_class" => $filedClass . "glue first last",
        ),
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue first last",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Skin", 'massive-dynamic'),
            "param_name" => 'slider_skin',
            "admin_label" => false,
            "value" => array(
                esc_attr__("Horizontal Left", 'massive-dynamic') => "hr-left",
                esc_attr__("Horizontal Center", 'massive-dynamic') => "hr-center",

            ),
            'dependency' => array(
                'callback' => 'pixflow_pixflowSliderDependency_contentType'
            )
        ),

        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue first last",
            "heading" => esc_attr__("Slider Height", 'massive-dynamic'),
            "param_name" => "slider_height_mode",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "value" => array(
                esc_attr__("Fit To Screen", 'massive-dynamic') => "fit",
                esc_attr__("Custom", 'massive-dynamic') => "custom",
            )
        ),
        array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "stick-to-top",
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("General", 'massive-dynamic'),
            "admin_label" => false,
            "dependency" => array(
                'element' => "slider_height_mode",
                'value' => array('custom')
            )
        ),
        array(
            'type' => 'md_vc_slider',
            "edit_field_class" => $filedClass . "glue last",
            'heading' => esc_attr__('Custom Height', 'massive-dynamic'),
            'param_name' => 'slider_height',
            "group" => esc_attr__('General', 'massive-dynamic'),
            "value" => "600",
            'defaultSetting' => array(
                "min" => "400",
                "max" => "2000",
                "prefix" => " px",
                "step" => "1"
            ),
            "dependency" => array(
                'element' => "slider_height_mode",
                'value' => array('custom'),
            )
        ),
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Autoplay", 'massive-dynamic'),
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "autoplay_group",
            "edit_field_class" => $filedClass . "glue first last",
        ),
        array(
            'type' => 'md_vc_checkbox',
            "edit_field_class" => $filedClass . "first glue last",
            'heading' => esc_attr__('Activate', 'massive-dynamic'),
            'param_name' => 'slider_autoplay',
            'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
            'checked' => false,
            "group" => esc_attr__("General", 'massive-dynamic'),
        ),
        array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "stick-to-top",
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("General", 'massive-dynamic'),
            "admin_label" => false,
            "dependency" => array(
                'element' => "slider_autoplay",
                'value' => array('yes')
            )
        ),
        array(
            'type' => 'md_vc_slider',
            "edit_field_class" => $filedClass . "glue last",
            'heading' => esc_attr__('Duration', 'massive-dynamic'),
            'param_name' => 'slider_autoplay_duration',
            "group" => esc_attr__('General', 'massive-dynamic'),
            "value" => "3",
            'defaultSetting' => array(
                "min" => "1",
                "max" => "30",
                "prefix" => " s",
                "step" => "0.1",
                "decimal" => "1",
            ),
            "dependency" => array(
                'element' => "slider_autoplay",
                'value' => array('yes'),
            ),
        ),
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Navigator", 'massive-dynamic'),
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "app_group",
            "edit_field_class" => $filedClass . "glue first last",
        ),
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue last first",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Navigator ", 'massive-dynamic'),
            "param_name" => "slider_indicator",
            "admin_label" => false,
            "value" => array(
                esc_attr__("Do Not Show", 'massive-dynamic') => "off",
                esc_attr__("Oval Mode", 'massive-dynamic') => "oval",
                esc_attr__("Circle Mode", 'massive-dynamic') => "circle",
            )
        ),

        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue first last",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Skin ", 'massive-dynamic'),
            "param_name" => "slider_indicator_theme",
            "admin_label" => false,
            "value" => array(
                esc_attr__("Dark", 'massive-dynamic') => "indicator-dark",
                esc_attr__("Light", 'massive-dynamic') => "indicator-light",
            ),
            "dependency" => array(
                'element' => "slider_indicator",
                'value' => array('oval', 'circle')
            )

        ),

        /*Title Typo*/
        array(
            'type' => 'md_vc_checkbox',
            "edit_field_class" => $filedClass . "first glue last",
            'heading' => esc_attr__('Tilte Custom font', 'massive-dynamic'),
            'param_name' => 'slider_title_custom_font',
            'value' => array(esc_attr__('No', 'massive-dynamic') => 'no'),
            'checked' => false,
            "group" => esc_attr__("Typography", 'massive-dynamic'),
        ),
        array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "stick-to-top",
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Typography", 'massive-dynamic'),
            "admin_label" => false,
            "dependency" => array(
                'element' => "slider_title_custom_font",
                'value' => array('yes')
            )
        ),
        array(
            'type' => 'google_fonts',
            'preview' => false,
            "edit_field_class" => $filedClass . "glue",
            "group" => esc_attr__("Typography", 'massive-dynamic'),
            'param_name' => 'slider_title_font',
            'value'=> 'font_family:Roboto%3A100%2C200%2C300%2Cregular%2C500%2C600%2C700%2C800%2C900|font_style:200%20light%20regular%3A200%3Anormal',
            'settings' => array(
                'fields' => array(
                    'font_family_description' => esc_attr__('Font family', 'massive-dynamic'),
                    'font_style_description' => esc_attr__('Font styling', 'massive-dynamic')
                )
            ),
            "dependency" => array(
                'element' => "slider_title_custom_font",
                'value' => array('yes')
            )
        ),
        array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . " glue",
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Typography", 'massive-dynamic'),
            "admin_label" => false,
            "dependency" => array(
                'element' => "slider_title_custom_font",
                'value' => array('yes')
            )
        ),
        array(
            'type' => 'md_vc_slider',
            "edit_field_class" => $filedClass . "glue",
            'heading' => esc_attr__('Title Size', 'massive-dynamic'),
            'param_name' => 'slider_title_size',
            "group" => esc_attr__("Typography", 'massive-dynamic'),
            "value" => "70",
            'defaultSetting' => array(
                "min" => "20",
                "max" => "120",
                "prefix" => " px",
                "step" => "1"
            ),
            "dependency" => array(
                'element' => "slider_title_custom_font",
                'value' => array('yes')
            )
        ),
        array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . " glue",
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Typography", 'massive-dynamic'),
            "admin_label" => false,
            "dependency" => array(
                'element' => "slider_title_custom_font",
                'value' => array('yes')
            )
        ),
        array(
            'type' => 'md_vc_slider',
            "edit_field_class" => $filedClass . "glue last",
            'heading' => esc_attr__('Title Line Height', 'massive-dynamic'),
            'param_name' => 'slider_title_line_height',
            "group" => esc_attr__("Typography", 'massive-dynamic'),
            "value" => "80",
            'defaultSetting' => array(
                "min" => "20",
                "max" => "120",
                "prefix" => " px",
                "step" => "1"
            ),
            "dependency" => array(
                'element' => "slider_title_custom_font",
                'value' => array('yes')
            )
        ),
        /*Subtitle Typo*/
        array(
            'type' => 'md_vc_checkbox',
            "edit_field_class" => $filedClass . "first glue last",
            'heading' => esc_attr__('Subtitle Custom font', 'massive-dynamic'),
            'param_name' => 'slider_subtitle_custom_font',
            'value' => array(esc_attr__('No', 'massive-dynamic') => 'no'),
            'checked' => false,
            "group" => esc_attr__("Typography", 'massive-dynamic'),
        ),
        array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "stick-to-top",
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Typography", 'massive-dynamic'),
            "admin_label" => false,
            "dependency" => array(
                'element' => "slider_subtitle_custom_font",
                'value' => array('yes')
            )
        ),
        array(
            'type' => 'google_fonts',
            'preview' => false,
            "edit_field_class" => $filedClass . "glue last",
            "group" => esc_attr__("Typography", 'massive-dynamic'),
            'param_name' => 'slider_subtitle_font',
            'value' =>'font_family:Roboto%3A100%2C200%2C300%2Cregular%2C500%2C600%2C700%2C800%2C900|font_style:200%20light%20regular%3A200%3Anormal',
            'settings' => array(
                'fields' => array(
                    'font_family_description' => esc_attr__('Font family', 'massive-dynamic'),
                    'font_style_description' => esc_attr__('Font styling', 'massive-dynamic')
                )
            ),
            "dependency" => array(
                'element' => "slider_subtitle_custom_font",
                'value' => array('yes')
            )
        ),
        array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . " glue",
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Typography", 'massive-dynamic'),
            "admin_label" => false,
            "dependency" => array(
                'element' => "slider_subtitle_custom_font",
                'value' => array('yes')
            )
        ),
        array(
            'type' => 'md_vc_slider',
            "edit_field_class" => $filedClass . "glue",
            'heading' => esc_attr__('Subtitle Size', 'massive-dynamic'),
            'param_name' => 'slider_subtitle_size',
            "group" => esc_attr__("Typography", 'massive-dynamic'),
            "value" => "20",
            'defaultSetting' => array(
                "min" => "20",
                "max" => "100",
                "prefix" => " px",
                "step" => "1"
            ),
            "dependency" => array(
                'element' => "slider_subtitle_custom_font",
                'value' => array('yes')
            )
        ),
        array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . " glue",
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Typography", 'massive-dynamic'),
            "admin_label" => false,
            "dependency" => array(
                'element' => "slider_subtitle_custom_font",
                'value' => array('yes')
            )
        ),
        array(
            'type' => 'md_vc_slider',
            "edit_field_class" => $filedClass . "glue last",
            'heading' => esc_attr__('Subtitle Line Height', 'massive-dynamic'),
            'param_name' => 'slider_subtitle_line_height',
            "group" => esc_attr__("Typography", 'massive-dynamic'),
            "value" => "20",
            'defaultSetting' => array(
                "min" => "20",
                "max" => "100",
                "prefix" => " px",
                "step" => "1"
            ),
            "dependency" => array(
                'element' => "slider_subtitle_custom_font",
                'value' => array('yes')
            )
        ),
        /*Description Typo*/
        array(
            'type' => 'md_vc_checkbox',
            "edit_field_class" => $filedClass . "first glue last classic-hidden",
            'heading' => esc_attr__('Description Custom font', 'massive-dynamic'),
            'param_name' => 'slider_desc_custom_font',
            'value' => array(esc_attr__('No', 'massive-dynamic') => 'no'),
            'checked' => false,
            "group" => esc_attr__("Typography", 'massive-dynamic'),
        ),
        array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "stick-to-top classic-hidden",
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Typography", 'massive-dynamic'),
            "admin_label" => false,
            "dependency" => array(
                'element' => "slider_desc_custom_font",
                'value' => array('yes')
            )
        ),
        array(
            'type' => 'google_fonts',
            'preview' => false,
            "edit_field_class" => $filedClass . "glue last classic-hiddenn",
            "group" => esc_attr__("Typography", 'massive-dynamic'),
            'param_name' => 'slider_desc_font',
            'value' => 'font_family:Roboto%3A100%2C200%2C300%2Cregular%2C500%2C600%2C700%2C800%2C900|font_style:200%20light%20regular%3A200%3Anormal',
            'settings' => array(
                'fields' => array(
                    'font_family_description' => esc_attr__('Font family', 'massive-dynamic'),
                    'font_style_description' => esc_attr__('Font styling', 'massive-dynamic')
                )
            ),
            "dependency" => array(
                'element' => "slider_desc_custom_font",
                'value' => array('yes')
            )
        ),
        array(
            "type" => "md_vc_description",
            "param_name" => "slider_typography_description",
            "admin_label" => false,
            "group" => esc_attr__("Typography", 'massive-dynamic'),
            "value" => '<ul><li>' . esc_attr__('By default pixflow slider get its font setting from ...... but if you choose custom font you can set your typography setting from  google font.', 'massive-dynamic') . '</li></ul>',
        ),
        array(
            "type" => "md_vc_description",
            "param_name" => "slider_typography_description",
            "admin_label" => false,
            "group" => esc_attr__("Typography", 'massive-dynamic'),
            "value" => '<ul><li>' . esc_attr__('Consider that custom font setting will load extra files and will affect your website load speed. ', 'massive-dynamic') . '</li></ul>',
        ),

    );
    $i = 1;
    for ($i = 1; $i <= (int)$slider_num; $i++) {
        $value = array();

        for ($k = $i; $k <= $slider_num; $k++) {
            $value[] = (string)$k;
        }

        $param[] = array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Title", 'massive-dynamic'),
            "param_name" => "title_group". $i,
            "edit_field_class" => $filedClass . "glue first last",
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue first last textNsize-text",
            "separate" => true,
            "heading" => esc_attr__("Title Type", 'massive-dynamic'),
            "param_name" => "slide_content_type_" . $i,
            "admin_label" => false,
            "value" => array(
                esc_attr__("Text", 'massive-dynamic') => "text",
                esc_attr__("Image", 'massive-dynamic') => "image"
            ),
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            ),

        );//Content Type

        /*Title*/
        $param[] = array(
            "type" => "textarea",
            "edit_field_class" => $filedClass . "glue first last textNsize-text",
            "heading" => esc_attr__("Slide Title", 'massive-dynamic'),
            "param_name" => "slide_title_" . $i,
            'value' => 'Massive Dynamic <br> Unique Slider',
            "admin_label" => false,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "color_picker" => "slide_title_color_" . $i,
            'dependency' => array(
                'element' => "slide_content_type_" . $i,
                'value' => 'text'
            ),
        );
        $param[] = array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "textNsize-size glue-color-textarea",
            "heading" => esc_attr__("Title Color", 'massive-dynamic'),
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "param_name" => "slide_title_color_" . $i,
            "admin_label" => false,
            "value" => "#ffffff",
            'dependency' => array(
                'element' => "slide_content_type_" . $i,
                'value' => 'text'
            ),
            "inline_color_picker" => true,
        );

        /* Image */
        $param[] = array(
            'type' => 'attach_image',
            'edit_field_class' => $filedClass . "glue first last",
            'heading' => esc_attr__('Content Image', 'massive-dynamic'),
            'param_name' => 'slide_content_image_' . $i,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => "slide_content_type_" . $i,
                'value' => 'image'
            ),
        );

        /*Subtitle*/
        $param[] = array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Subtitle", 'massive-dynamic'),
            "param_name" => "subtitle_group". $i,
            "edit_field_class" => $filedClass . "glue first last",
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            ),

        );
        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "first glue last textNsize-text",
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("subtitle", 'massive-dynamic'),
            "param_name" => "slide_subtitle_" . $i,
            "value" => 'Know About',
            "admin_label" => false,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            ),
            "color_picker" => "slide_subtitle_color_" . $i,
        );
        $param[] = array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue textNsize-size",
            "heading" => esc_attr__("Subtitle Color", 'massive-dynamic'),
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "param_name" => "slide_subtitle_color_" . $i,
            "admin_label" => false,
            "value" => "#dbdbdb",
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            ),
            "inline_color_picker" => true,

        );

        /*Description*/
        $param[] = array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Description", 'massive-dynamic'),
            "param_name" => "desc_group". $i,
            "edit_field_class" => $filedClass . "glue first last classic-hidden",
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value,

            ),

        );
        $param[] = array(
            "type" => "textarea",
            "edit_field_class" => $filedClass . "glue first last textNsize-text classic-hidden",
            "heading" => esc_attr__("Slide Description", 'massive-dynamic'),
            "param_name" => "slide_desc_" . $i,
            'value' => 'Lorem ipsum dolor sit amet.Lorem ipsum dolor sit amet.Lorem ipsum dolor sit amet.',
            "admin_label" => false,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value,

            ),
            "color_picker" => "slide_desc_color_" . $i,
        );

        $param[] = array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "textNsize-size glue-color-textarea classic-hidden",
            "heading" => esc_attr__("Description Color", 'massive-dynamic'),
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "param_name" => "slide_desc_color_" . $i,
            "admin_label" => false,
            "value" => "rgb(0, 255, 153)",
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            ),
            "inline_color_picker" => true,
        );

        /* Image  */
        $param[] = array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Image", 'massive-dynamic'),
            "param_name" => "image_group". $i,
            "edit_field_class" => $filedClass . "glue first last",
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value,

            ),

        );
        $param[] = array(
            'type' => 'attach_image',
            'edit_field_class' => $filedClass . "glue first last",
            'heading' => esc_attr__('Slide Image', 'massive-dynamic'),
            'param_name' => 'slide_image_' . $i,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "textNsize-size ",
            "heading" => esc_attr__("Overlay Color", 'massive-dynamic'),
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "param_name" => "slide_image_color_" . $i,
            "admin_label" => false,
            "value" => "rgba(0, 0, 0, 0.4)",
            "opacity" => true,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            ),
        );

        /* Button 1 */
        $param[] = array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Button 1", 'massive-dynamic'),
            "param_name" => "btn1_group". $i,
            "edit_field_class" => $filedClass . "glue first last",
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value,

            ),
        );
        $param[] = array(
            'type' => 'md_vc_checkbox',
            "edit_field_class" => $filedClass . "first glue last ",
            'heading' => esc_attr__('Activate', 'massive-dynamic'),
            'param_name' => 'slide_btn1_' . $i,
            'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
            'checked' => true,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value,
                'callback' => 'pixflow_pixflowSliderDependency_btn'
            )
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . " glue stick-to-top slide_btn1_" . $i . '_dependency',
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            )
        );

        $param[] = array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue slide_btn1_" . $i . '_dependency',
            "separate" => true,
            "heading" => esc_attr__("Button Style", 'massive-dynamic'),
            "param_name" => "slide_btn1_kind_" . $i,
            "description" => esc_attr__("Choose between five button style", 'massive-dynamic'),
            "admin_label" => false,
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
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            )
        );//btn kind

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . " glue slide_btn1_" . $i . '_dependency',
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            )
        );

        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue slide_btn1_" . $i . '_dependency',
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Title", 'massive-dynamic'),
            "param_name" => "slide_btn1_title_" . $i,
            "value" => 'DOWNLOAD',
            "admin_label" => false,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "glue slide_btn1_" . $i . '_dependency',
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            )
        );

        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue slide_btn1_" . $i . '_dependency',
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Link", 'massive-dynamic'),
            "param_name" => "slide_btn1_link_" . $i,
            "value" => 'http://pixflow.net/products/massive-dynamic/',
            "admin_label" => false,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "glue slide_btn1_" . $i . '_dependency',
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            )
        );

        $param[] = array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue slide_btn1_" . $i . '_dependency',
            "heading" => esc_attr__("Target", 'massive-dynamic'),
            "param_name" => "slide_btn1_target_" . $i,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "value" => array(
                esc_attr__("Open in new window", 'massive-dynamic') => "_blank",
                esc_attr__("Open in same window", 'massive-dynamic') => "_self"
            ),
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "glue slide_btn1_" . $i . '_dependency',
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            )
        );

        $param[] = array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue slide_btn1_" . $i . '_dependency',
            "heading" => esc_attr__("Button Color", 'massive-dynamic'),
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "param_name" => "slide_btn1_color_" . $i,
            "admin_label" => false,
            "value" => "#FFF",
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            ),

        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "glue slide_btn1_" . $i . '_dependency',
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            )
        );

        $param[] = array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue slide_btn1_" . $i . '_dependency',
            "heading" => esc_attr__("Bg Hover Color", 'massive-dynamic'),
            "param_name" => "slide_btn1_bg_hover_color_" . $i,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "admin_label" => false,
            "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
            "dependency" => array(
                'element' => "slide_btn1_kind_" . $i,
                'value' => array('fill-oval', 'fill-rectangle'),
            ),
            'value' => '#9b9b9b'
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "glue slide_btn1_" . $i . '_dependency',
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "dependency" => array(
                'element' => "slide_btn1_kind_" . $i,
                'value' => array('fill-oval', 'fill-rectangle'),
            ),
        );

        $param[] = array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue slide_btn1_" . $i . '_dependency',
            "heading" => esc_attr__("Text Color", 'massive-dynamic'),
            "param_name" => "slide_btn1_text_hover_color_" . $i,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "admin_label" => false,
            "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
            "dependency" => array(
                'element' => "slide_btn1_kind_" . $i,
                'value' => array('fill-oval', 'fill-rectangle'),
            ),
            'value' => '#000'
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "glue slide_btn1_" . $i . '_dependency',
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "dependency" => array(
                'element' => "slide_btn1_kind_" . $i,
                'value' => array('fill-oval', 'fill-rectangle'),
            ),
        );

        $param[] = array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue last slide_btn1_" . $i . '_dependency',
            "heading" => esc_attr__("Hover Color", 'massive-dynamic'),
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "param_name" => "slide_btn1_hover_color_" . $i,
            "admin_label" => false,
            "value" => "#ff0054",
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            ),

        );
        //button2
        $param[] = array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Button 2", 'massive-dynamic'),
            "param_name" => "btn2_group",
            "edit_field_class" => $filedClass . "glue first last",
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value,

            ),
        );
        $param[] = array(
            'type' => 'md_vc_checkbox',
            "edit_field_class" => $filedClass . "first glue last ",
            'heading' => esc_attr__('Button2', 'massive-dynamic'),
            'param_name' => 'slide_btn2_' . $i,
            'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
            'checked' => true,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value,
                'callback' => 'pixflow_pixflowSliderDependency_btn'
            )
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . " glue stick-to-top slide_btn2_" . $i . '_dependency',
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            )
        );

        $param[] = array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue slide_btn2_" . $i . '_dependency',
            "separate" => true,
            "heading" => esc_attr__("Button Style", 'massive-dynamic'),
            "param_name" => "slide_btn2_kind_" . $i,
            "description" => esc_attr__("Choose between five button style", 'massive-dynamic'),
            "admin_label" => false,
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
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            )
        );//btn kind

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . " slide_btn2_" . $i . '_dependency',
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            )
        );

        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue slide_btn2_" . $i . '_dependency',
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Title", 'massive-dynamic'),
            "param_name" => "slide_btn2_title_" . $i,
            "value" => 'READ MORE',
            "admin_label" => false,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "glue slide_btn2_" . $i . '_dependency',
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            )
        );

        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue slide_btn2_" . $i . '_dependency',
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Link", 'massive-dynamic'),
            "param_name" => "slide_btn2_link_" . $i,
            "value" => '#',
            "admin_label" => false,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "glue slide_btn2_" . $i . '_dependency',
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            )
        );

        $param[] = array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue slide_btn2_" . $i . '_dependency',
            "heading" => esc_attr__("Target", 'massive-dynamic'),
            "param_name" => "slide_btn2_target_" . $i,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "value" => array(
                esc_attr__("Open in new window", 'massive-dynamic') => "_blank",
                esc_attr__("Open in same window", 'massive-dynamic') => "_self"
            ),
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "glue slide_btn2_" . $i . '_dependency',
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            )
        );

        $param[] = array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue slide_btn2_" . $i . '_dependency',
            "heading" => esc_attr__("Color", 'massive-dynamic'),
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "param_name" => "slide_btn2_color_" . $i,
            "admin_label" => false,
            "value" => "#FFF",
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            ),

        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "glue slide_btn2_" . $i . '_dependency',
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            )
        );

        $param[] = array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue slide_btn2_" . $i . '_dependency',
            "heading" => esc_attr__("Bg Hover Color", 'massive-dynamic'),
            "param_name" => "slide_btn2_bg_hover_color_" . $i,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "admin_label" => false,
            "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
            "dependency" => array(
                'element' => "slide_btn2_kind_" . $i,
                'value' => array('fill-oval', 'fill-rectangle'),
            ),
            'value' => '#9b9b9b'
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "glue slide_btn2_" . $i . '_dependency',
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "dependency" => array(
                'element' => "slide_btn2_kind_" . $i,
                'value' => array('fill-oval', 'fill-rectangle'),
            ),
        );

        $param[] = array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue slide_btn2_" . $i . '_dependency',
            "heading" => esc_attr__("Text Color", 'massive-dynamic'),
            "param_name" => "slide_btn2_text_hover_color_" . $i,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "admin_label" => false,
            "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
            "dependency" => array(
                'element' => "slide_btn2_kind_" . $i,
                'value' => array('fill-oval', 'fill-rectangle'),
            ),
            'value' => '#000'
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "glue slide_btn2_" . $i . '_dependency',
            "param_name" => "slider" . ++$separatorCounter,
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "dependency" => array(
                'element' => "slide_btn2_kind_" . $i,
                'value' => array('fill-oval', 'fill-rectangle'),
            ),
        );

        $param[] = array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue last slide_btn2_" . $i . '_dependency',
            "heading" => esc_attr__("Hover Color", 'massive-dynamic'),
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "param_name" => "slide_btn2_hover_color_" . $i,
            "admin_label" => false,
            "value" => "#ff0054",
            'dependency' => array(
                'element' => $slider_param,
                'value' => $value
            ),
        );

    }
    return $param;
}

pixflow_map(
    array(
        "name"                    => "Pixflow Slider",
        "base"                    => "md_slider",
        "category"                => esc_attr__('Media','massive-dynamic'),
        "show_settings_on_create" => false,
        "params"                  => pixflow_slider_param()
    )
);