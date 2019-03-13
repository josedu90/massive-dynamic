<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------*/
/*  Mobile Slider
/*-----------------------------------------------------------------------------------*/

function pixflow_mobile_slider_param()
{

    $filedClass = 'vc_col-sm-12 vc_column ';
    $separatorCounter = 0;
    $slide_num_param = 'mobile_slide_num';
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
            "heading" => esc_attr__("Slider", 'massive-dynamic'),
            "param_name" => "slider_group",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "edit_field_class" => $filedClass . "glue first last",
        ),
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue first last slide_number",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Slide Number:", 'massive-dynamic'),
            "param_name" => $slide_num_param,
            "admin_label" => false,
            "value" => $dropDown
        ),
        array(
            'type' => 'md_vc_checkbox',
            "edit_field_class" => $filedClass . "glue first last",
            'heading' => esc_attr__('Autoplay  ', 'massive-dynamic'),
            'param_name' => 'mobile_slider_slideshow',
            "group" => esc_attr__('General', 'massive-dynamic'),
            'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
            'checked' => true,
        ),
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Slides", 'massive-dynamic'),
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "slides_group",
            "edit_field_class" => $filedClass . "glue first last",
        ),
    );


    for ($i = 1; $i <= (int)$slide_num; $i++) {
        $value = array();

        for ($k = $i; $k <= $slide_num; $k++) {
            $value[] = (string)$k;
        }
        $param[] = array(
            "type" => "attach_image",
            "edit_field_class" => $filedClass . "glue first last",
            "group" => esc_attr__('General', 'massive-dynamic'),
            "heading" => esc_attr__("Image ".$i , 'massive-dynamic'),
            "param_name" => "mobile_slider_slide_image_" . $i,
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
    "name" => esc_attr__("Mobile Slider", 'massive-dynamic'),
    "base" => "md_mobile_slider",
    "show_settings_on_create" => false,
    "category" => esc_attr__('Media','massive-dynamic'),
    "params" => pixflow_mobile_slider_param()
));


pixflow_add_params('md_mobile_slider', pixflow_addAnimationTab('md_mobile_slider'));
