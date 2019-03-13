<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Process Panel
/*-----------------------------------------------------------------------------------*/

function pixflow_process_panel()
{

    $filedClass = 'vc_col-sm-12 vc_column ';
    $separatorCounter = 0;
    $bar_num_param = 'process_panel_num';
    $bar_num = 4;
    $dropDown = array(
        esc_attr__("Three", 'massive-dynamic') => 3,
//        esc_attr__("One",'massive-dynamic')   => 1,
        esc_attr__("Two", 'massive-dynamic') => 2,
        esc_attr__("Four", 'massive-dynamic') => 4,
    );

    $param = array(
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Steps", 'massive-dynamic'),
            "param_name" => "steps_group",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "edit_field_class" => $filedClass . "glue first last"
        ),
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue first",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Steps Number", 'massive-dynamic'),
            "param_name" => $bar_num_param,
            "admin_label" => false,
            "value" => $dropDown,
        ),
    );

    $param[] = array(
        "type" => 'md_vc_separator',
        "group" => esc_attr__("General", 'massive-dynamic'),
        "param_name" => "process_panel_bar_separator" . ++$separatorCounter,
    );

    $param[] = array(
        "type" => "md_group_title",
        "heading" => esc_attr__("Color", 'massive-dynamic'),
        "group" => esc_attr__("General", 'massive-dynamic'),
        "param_name" => "color_group",
        "edit_field_class" => $filedClass . "glue first last",
    );

    $param[] = array(
        "type" => "md_vc_colorpicker",
        "edit_field_class" => $filedClass . "glue last",
        "group" => esc_attr__("General", 'massive-dynamic'),
        "heading" => esc_attr__("Base Color", 'massive-dynamic'),
        "param_name" => "process_panel_base_color",
        "admin_label" => false,
        "value" => '#fff',
    );

    $stepColor = array('#65d97d', '#42a881', '#1f8784', '#156664');
    for ($i = 1; $i <= (int)$bar_num; $i++) {
        $value = array();

        for ($k = $i; $k <= $bar_num; $k++) {
            $value[] = (string)$k;
        }

        $param[] = array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Content", 'massive-dynamic'),
            "param_name" => "content_group". $i,
            "group" => esc_attr__("Step", 'massive-dynamic') . $i,
            "edit_field_class" => $filedClass . "glue first last",
            'dependency' => array(
                'element' => $bar_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "first glue",
            "group" => esc_attr__("Step", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Title", 'massive-dynamic'),
            "param_name" => "process_panel_title_" . $i,
            "description" => esc_attr__("Process Panel Title", 'massive-dynamic'),
            "value" => 'Online Presence Analysis',
            "admin_label" => false,
            'dependency' => array(
                'element' => $bar_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("Step", 'massive-dynamic') . $i,
            "param_name" => "process_panel_bar_" . $i . "_separator" . ++$separatorCounter,
            'dependency' => array(
                'element' => $bar_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "textfield",
            "group" => esc_attr__("Step", 'massive-dynamic') . $i,
            "edit_field_class" => $filedClass . " glue",
            "heading" => esc_attr__("Subtitle", 'massive-dynamic'),
            "param_name" => "process_panel_subtitle_" . $i,
            "value" => 'Complete Projects',
            "admin_label" => false,
            'dependency' => array(
                'element' => $bar_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("Step", 'massive-dynamic') . $i,
            "param_name" => "process_panel_bar_" . $i . "_separator" . ++$separatorCounter,
            'dependency' => array(
                'element' => $bar_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "md_vc_iconpicker",
            "group" => esc_attr__("Step", 'massive-dynamic') . $i,
            "edit_field_class" => $filedClass . " glue",
            "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
            "param_name" => "process_panel_icon_" . $i,
            "admin_label" => false,
            "description" => esc_attr__("Select an icon that shown before text", 'massive-dynamic'),
            'value' => 'icon-Health',
            'dependency' => array(
                'element' => $bar_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("Step", 'massive-dynamic') . $i,
            "param_name" => "process_panel_bar_" . $i . "_separator" . ++$separatorCounter,
            'dependency' => array(
                'element' => $bar_num_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Colors", 'massive-dynamic'),
            "param_name" => "colors_group". $i,
            "group" => esc_attr__("Step", 'massive-dynamic') . $i,
            "edit_field_class" => $filedClass . "glue first last",
            'dependency' => array(
                'element' => $bar_num_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue",
            "group" => esc_attr__("Step", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Icon", 'massive-dynamic'),
            "param_name" => "process_panel_icon_color_" . $i,
            "admin_label" => false,
            "value" => '#fff',
            'dependency' => array(
                'element' => $bar_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("Step", 'massive-dynamic') . $i,
            "param_name" => "process_panel_bar_" . $i . "_separator" . ++$separatorCounter,
            'dependency' => array(
                'element' => $bar_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue last",
            "group" => esc_attr__("Step", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Background", 'massive-dynamic'),
            "param_name" => "process_panel_bg_color_" . $i,
            "admin_label" => false,
            "value" => $stepColor[$i - 1],
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
    "name" => esc_attr__("Process Panel", 'massive-dynamic'),
    "base" => "md_process_panel",
    "show_settings_on_create" => false,
    "category" => esc_attr__('Business','massive-dynamic'),
    "params" => pixflow_process_panel()
));

pixflow_add_params('md_process_panel', pixflow_addAnimationTab('md_process_panel'));
