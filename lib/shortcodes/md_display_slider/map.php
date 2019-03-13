<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------*/
/*  Display Slider
/*-----------------------------------------------------------------------------------*/

function pixflow_display_slider_param()
{
    $filedClass = 'vc_col-sm-12 vc_column ';
    $separatorCounter = 0;
    $slide_num_param = 'slide_num';
    $slide_num = 5;
    $dropDown = array(
        esc_attr__("Three", 'massive-dynamic') => 3,
        esc_attr__("One", 'massive-dynamic') => 1,
        esc_attr__("Two", 'massive-dynamic') => 2,
        esc_attr__("Four", 'massive-dynamic') => 4,
        esc_attr__("Five", 'massive-dynamic') => 5,
        /*"Six"   => "6",
        "Seven"   => "7",
        "Eight"   => "8",
        "Nine"   => "9",
        "Ten"   => "10"*/
    );
    $param = array(
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Appearance", 'massive-dynamic'),
            "param_name" => "app_group",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "edit_field_class" => $filedClass . "glue first last",
        ),
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "first glue last slide_number",
            //"class" => "slide_number",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Slide Number", 'massive-dynamic'),
            "param_name" => $slide_num_param,
            "admin_label" => false,
            "value" => $dropDown
        ),

        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "first glue",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Text Color", 'massive-dynamic'),
            "param_name" => "text_color",
            "admin_label" => false,
            "defaultColor" => '#000'
        ),
         array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Autoplay", 'massive-dynamic'),
            "param_name" => "title_group",
             "group" => esc_attr__("General", 'massive-dynamic'),
            "edit_field_class" => $filedClass . "glue first last",
         ),
        array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "text_color_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),
        array(
            'type' => 'md_vc_checkbox',
            "edit_field_class" => $filedClass . "glue  last",
            'heading' => esc_attr__('Activate', 'massive-dynamic'),
            'param_name' => 'device_slider_slideshow',
            "group" => esc_attr__('General', 'massive-dynamic'),
            'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
            'checked' => true,
        ),
    );
    for ($i = 1; $i <= (int)$slide_num; $i++) {
        $value = array();
        for ($k = $i; $k <= $slide_num; $k++) {
            $value[] = (string)$k;
        }
        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "first glue",
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Title", 'massive-dynamic'),
            "param_name" => "slide_title_" . $i,
            "description" => esc_attr__("Slide Title", 'massive-dynamic'),
            "admin_label" => false,
            'dependency' => array(
                'element' => $slide_num_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "param_name" => "slide_title_" . $i . "_separator" . ++$separatorCounter,
            'dependency' => array(
                'element' => $slide_num_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => "textarea",
            "edit_field_class" => $filedClass . "glue",
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Description", 'massive-dynamic'),
            "param_name" => "slide_description_" . $i,
            "description" => esc_attr__("slide description text", 'massive-dynamic'),
            "admin_label" => false,
            'dependency' => array(
                'element' => $slide_num_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "param_name" => "slide_description_" . $i . "_separator" . ++$separatorCounter,
            "admin_label" => false,
            'dependency' => array(
                'element' => $slide_num_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => "attach_image",
            "edit_field_class" => $filedClass . "glue last",
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Slide Image", 'massive-dynamic'),
            "param_name" => "slide_image_" . $i,
            "admin_label" => false,
            "description" => esc_attr__("Choose Slide image", 'massive-dynamic'),
            'dependency' => array(
                'element' => $slide_num_param,
                'value' => $value
            ),
        );
    }
    return $param;
}

//Register "container" content element. It will hold all your inner (child) content elements
pixflow_map(array(
    "name" => esc_attr__("Display Slider", 'massive-dynamic'),
    "base" => "md_display_slider",
    "category" => esc_attr__('Media', 'massive-dynamic'),
    "show_settings_on_create" => false,
    "params" => pixflow_display_slider_param()
));

pixflow_add_params('md_display_slider', pixflow_addAnimationTab('md_display_slider'));
