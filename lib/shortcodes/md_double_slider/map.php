<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Double Slider
/*-----------------------------------------------------------------------------------*/

function pixflow_double_slider_param()
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
            "type" => "md_group_title",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Style", 'massive-dynamic'),
            "param_name" => "style_group",
            "edit_field_class" => $filedClass . "glue first last",
        ),
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "first glue last",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Orientation", 'massive-dynamic'),
            "param_name" => 'double_slider_appearance',
            "admin_label" => false,
            "value" => array(
                "First Image" => 'double-slider-left',
                "First Text" => 'double-slider-right'
            )
        ),
        array(
            'type' => 'md_vc_slider',
            "edit_field_class" => $filedClass . " first last glue",
            'heading' => esc_attr__('Height', 'massive-dynamic'),
            'param_name' => 'double_slider_height',
            "group" => esc_attr__("General", 'massive-dynamic'),
            'value' => '500',
            'defaultSetting' => array(
                "min" => "250",
                "max" => "800",
                "prefix" => "px",
                "step" => "10",
            ),
        ),
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Autoplay", 'massive-dynamic'),
            "param_name" => "auto_group",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "edit_field_class" => $filedClass . "glue first last",
        ),
        array(
            'type' => 'md_vc_checkbox',
            "edit_field_class" => $filedClass . "glue first last",
            'heading' => esc_attr__('Activate ', 'massive-dynamic'),
            'param_name' => 'double_slider_auto_play',
            "group" => esc_attr__("General", 'massive-dynamic'),
            'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
            'checked' => true,
        ),

        array(
            'type' => 'md_vc_slider',
            "edit_field_class" => $filedClass . " first last glue",
            'heading' => esc_attr__(' Duration', 'massive-dynamic'),
            'param_name' => 'double_slider_duration',
            "group" => esc_attr__("General", 'massive-dynamic'),
            'value' => '5',
            'defaultSetting' => array(
                "min" => "1",
                "max" => "30",
                "prefix" => " s",
                "step" => "1",
            ),
            "dependency" => array(
                'element' => "double_slider_auto_play",
                'value' => array('yes'),
            ),
        ),


    );
    for ($i = 1; $i <= (int)$slide_num; $i++) {
        $value = array();
        for ($k = $i; $k <= $slide_num; $k++) {
            $value[] = (string)$k;
        }

        $param[] = array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Content", 'massive-dynamic'),
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "param_name" => "content_group".$i,
            "edit_field_class" => $filedClass . "glue first last",
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
        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "first glue",
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Title", 'massive-dynamic'),
            "param_name" => "slide_title_" . $i,
            "admin_label" => false,
            "value" => 'Title' . $i,
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
            "type" => "textfield",
            "edit_field_class" => $filedClass . " glue",
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Subtitle", 'massive-dynamic'),
            "param_name" => "slide_sub_title_" . $i,
            "value" => 'Subtitle' . $i,
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
            "value" => 'Slide Description' . $i,
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
            "type" => "md_group_title",
            "heading" => esc_attr__("Appearance", 'massive-dynamic'),
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "param_name" => "app_group".$i,
            "edit_field_class" => $filedClass . "glue first last",
            'dependency' => array(
                'element' => $slide_num_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "first glue",
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Background color", 'massive-dynamic'),
            "param_name" => "slide_bg_" . $i,
            "value" => "#447be0",
            "description" => esc_attr__("Slide Background", 'massive-dynamic'),
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
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "last glue",
            "group" => esc_attr__("Slide ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Text color", 'massive-dynamic'),
            "param_name" => "slide_fg_" . $i,
            "value" => "#ffffff",
            "admin_label" => false,
            'dependency' => array(
                'element' => $slide_num_param,
                'value' => $value
            ),
        );


    }
    return $param;
}

pixflow_map(array(
    "name" => esc_attr__("Double Slider", 'massive-dynamic'),
    "base" => "md_double_slider",
    "category" => esc_attr__('Media', 'massive-dynamic'),
    "show_settings_on_create" => false,
    "params" => pixflow_double_slider_param()
));

pixflow_add_params('md_double_slider', pixflow_addAnimationTab('md_double_slider'));
