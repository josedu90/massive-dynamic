<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Skill 2
/*-----------------------------------------------------------------------------------*/

function pixflow_skill_style2_param()
{

    $filedClass = 'vc_col-sm-12 vc_column ';
    $separatorCounter = 0;
    $bar_num_param = 'skill_style2_num';
    $bar_num = 10;
    $dropDown = array(
        esc_attr__("Four", 'massive-dynamic') => 4,
        esc_attr__("One", 'massive-dynamic') => 1,
        esc_attr__("Two", 'massive-dynamic') => 2,
        esc_attr__("Three", 'massive-dynamic') => 3,
        esc_attr__("Five", 'massive-dynamic') => 5,
        esc_attr__("Six", 'massive-dynamic') => 6,
        esc_attr__("Seven", 'massive-dynamic') => 7,
        esc_attr__("Eight", 'massive-dynamic') => 8,
        esc_attr__("Nine", 'massive-dynamic') => 9,
        esc_attr__("Ten", 'massive-dynamic') => 10,
    );

    $param = array(

        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Appearance", 'massive-dynamic'),
            "param_name" => "line_height_group",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "edit_field_class" => $filedClass . "glue first last"
        ),
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue first last",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Number of Skills:", 'massive-dynamic'),
            "param_name" => $bar_num_param,
            "admin_label" => false,
            "value" => $dropDown
        ),
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue first last",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Texts Color", 'massive-dynamic'),
            "param_name" => "skill_style2_texts_color",
            "admin_label" => false,
            "value" => '#4d4d4e',
        ),
    );

    for ($i = 1; $i <= (int)$bar_num; $i++) {
        $value = array();

        for ($k = $i; $k <= $bar_num; $k++) {
            $value[] = (string)$k;
        }

        $param[] =  array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Content", 'massive-dynamic'),
            "group" => esc_attr__("Bar ", 'massive-dynamic') . $i,
            "param_name" => "line_height_group",
            "edit_field_class" => $filedClass . "glue first last" ,
            'dependency' => array(
                'element' => $bar_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "first glue",

            "group" => esc_attr__("Bar ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Title", 'massive-dynamic'),
            "param_name" => "skill_style2_title_" . $i,
            "description" => esc_attr__("Skill Title", 'massive-dynamic'),
            "value" => 'Skill Title ' . $i,
            "admin_label" => false,
            'dependency' => array(
                'element' => $bar_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("Bar ", 'massive-dynamic') . $i,
            "param_name" => "skill_style2_bar_" . $i . "_separator" . ++$separatorCounter,
            'dependency' => array(
                'element' => $bar_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "md_vc_slider",
            "edit_field_class" => $filedClass . "glue",
            "group" => esc_attr__("Bar ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Percentage", 'massive-dynamic'),
            "param_name" => "skill_style2_percentage_" . $i,
            "admin_label" => false,
            "value" => '40',
            'dependency' => array(
                'element' => $bar_num_param,
                'value' => $value
            ),
            'defaultSetting' => array(
                "min" => "0",
                "max" => "100",
                "prefix" => "%",
                "step" => "1",
            ),
        );


        $param[] = array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("Bar ", 'massive-dynamic') . $i,
            "param_name" => "skill_style2_bar_" . $i . "_separator" . ++$separatorCounter,
            'dependency' => array(
                'element' => $bar_num_param,
                'value' => $value
            ),
        );
        $param[] =  array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Appearance", 'massive-dynamic'),
            "group" => esc_attr__("Bar ", 'massive-dynamic') . $i,
            "param_name" => "line_height_group",
            "edit_field_class" => $filedClass . "glue first last" ,
            'dependency' => array(
                'element' => $bar_num_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue last",
            "group" => esc_attr__("Bar ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Progressbar Color", 'massive-dynamic'),
            "param_name" => "skill_style2_color_" . $i,
            "admin_label" => false,
            "value" => '#7b58c3',
            'dependency' => array(
                'element' => $bar_num_param,
                'value' => $value
            ),
        );

    }
    return $param;
}

//Register "container" content element. It will hold all your inner (child) content elements
pixflow_map(array(
    "name" => esc_attr__("Skills 2", 'massive-dynamic'),
    "base" => "md_skill_style2",
    "show_settings_on_create" => false,
    "category" => esc_attr__("more", 'massive-dynamic'),
    "params" => pixflow_skill_style2_param()
));

pixflow_add_params('md_skill_style2', pixflow_addAnimationTab('md_skill_style2'));
