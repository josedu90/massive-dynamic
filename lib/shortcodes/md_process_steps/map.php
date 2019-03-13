<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------*/
/*  Process Steps
/*-----------------------------------------------------------------------------------*/
// Generate process step shortcode params
function pixflow_processStep_param()
{
    $filedClass = 'vc_col-sm-12 vc_column ';
    $separatorCounter = 0;
    $step_num_param = 'pstep_step_num';
    $step_num = 7;
    $dropDown = array(
        esc_attr__("Four", 'massive-dynamic') => 4,
        esc_attr__("Three", 'massive-dynamic') => 3,
        esc_attr__("Five", 'massive-dynamic') => 5,
        esc_attr__("Six", 'massive-dynamic') => 6
    );
    $param = array(
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Steps", 'massive-dynamic'),
            "param_name" => "steps_group",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "edit_field_class" => $filedClass . "glue first last",
        ),
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue first last",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Step Number:", 'massive-dynamic'),
            "param_name" => $step_num_param,
            "admin_label" => false,
            "value" => $dropDown
        ),
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Style", 'massive-dynamic'),
            "param_name" => "style_group",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "edit_field_class" => $filedClass . "glue first last"
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_attr__('Style', 'massive-dynamic'),
            "edit_field_class" => $filedClass . "first glue last",
            'param_name' => 'pstep_style',
            'group' => esc_attr__("General", 'massive-dynamic'),
            'value' => array(
                esc_attr__("Border", 'massive-dynamic') => "color",
                esc_attr__("Image", 'massive-dynamic') => "image",
            ),
        ),
        array(
            "type" => "md_vc_colorpicker",

            "edit_field_class" => $filedClass . "first last glue",
            "heading" => esc_attr__("Border Color", 'massive-dynamic'),
            "param_name" => "pstep_border_color",
            "value" => 'rgba(176,227,135,1)',
            "admin_label" => false,
            "opacity" => true,
            'group' => esc_attr__("General", 'massive-dynamic'),
            'dependency' => array(
                'element' => 'pstep_style',
                'value' => array('color')
            ),
        ),
        array(
            "type" => "md_vc_colorpicker",

            "edit_field_class" => $filedClass . "first last glue",
            "heading" => esc_attr__("Overlay Color", 'massive-dynamic'),
            "param_name" => "pstep_overlay_color",
            "value" => 'rgba(0,0,0,0.5)',
            "admin_label" => false,
            "opacity" => true,
            'group' => esc_attr__("General", 'massive-dynamic'),
            'dependency' => array(
                'element' => 'pstep_style',
                'value' => array('image')
            ),
        ),
        array(
            "type" => "md_vc_colorpicker",

            "edit_field_class" => $filedClass . "first last glue",
            "heading" => esc_attr__("General Color", 'massive-dynamic'),
            "param_name" => "pstep_general_color",
            'group' => esc_attr__("General", 'massive-dynamic'),
            "value" => 'rgb(0,0,0)',
            "admin_label" => false,
            "opacity" => true,
        ),
        array(
            "type" => "md_vc_description",
            "param_name" => "pstep_description",
            "admin_label" => false,
            'group' => esc_attr__("General", 'massive-dynamic'),
            "value" => wp_kses(__("<span>Tip:</span><ul><li>To see how this shortcode appears on scroll, save your changes in builder and check your website outside builder area.</li></ul>", 'massive-dynamic'), array('span' => array(), 'ul' => array(), 'li' => array())),
        ),
    );

    for ($i = 1; $i <= (int)$step_num; $i++) {
        $value = array();
        for ($k = $i; $k <= $step_num; $k++) {
            $value[] = (string)$k;
        }



        $param[] = array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Content", 'massive-dynamic'),
            "param_name" => "process_content_group",
            "group" => esc_attr__("Step ", 'massive-dynamic') . $i,
            "edit_field_class" => $filedClass . "glue first last",
            'dependency' => array(
                'element' => $step_num_param,
                'value' => $value
            )
        );



        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "first glue",
            "group" => esc_attr__("Step ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Caption", 'massive-dynamic'),
            "param_name" => "pstep_caption_" . $i,
            "admin_label" => false,
            "value" => '201' . $i,
            'dependency' => array(
                'element' => $step_num_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("Step ", 'massive-dynamic') . $i,
            "param_name" => "pstep_caption_" . $i . "_separator" . ++$separatorCounter,
            "admin_label" => false,
            'dependency' => array(
                'element' => $step_num_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue",
            "group" => esc_attr__("Step ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Title", 'massive-dynamic'),
            "param_name" => "pstep_title_" . $i,
            "value" => "Step " . $i,
            "admin_label" => false,
            'dependency' => array(
                'element' => $step_num_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("Step ", 'massive-dynamic') . $i,
            "param_name" => "pstep_title_" . $i . "_separator" . ++$separatorCounter,
            "admin_label" => false,
            'dependency' => array(
                'element' => $step_num_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => "textarea",
            "edit_field_class" => $filedClass . "glue last",
            "group" => esc_attr__("Step ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Description", 'massive-dynamic'),
            "param_name" => "pstep_desc_" . $i,
            "value" => "Description of step" . $i,
            "admin_label" => false,
            'dependency' => array(
                'element' => $step_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "attach_image",
            "edit_field_class" => $filedClass . "first glue last",
            "group" => esc_attr__("Step ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Image", 'massive-dynamic'),
            "param_name" => "pstep_image_" . $i,
            "admin_label" => false,
            'dependency' => array(
                'element' => $step_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Sizing", 'massive-dynamic'),
            "param_name" => "process_sizing_group",
            "group" => esc_attr__("Step ", 'massive-dynamic') . $i,
            "edit_field_class" => $filedClass . "glue first last",
            'dependency' => array(
                'element' => $step_num_param,
                'value' => $value
            )
        );

        $param[] = array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "first glue last",
            "group" => esc_attr__("Step ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Size", 'massive-dynamic'),
            "param_name" => "pstep_size_" . $i,
            "admin_label" => false,
            'value' => array(
                esc_attr__("Small", 'massive-dynamic') => "small",
                esc_attr__("Medium", 'massive-dynamic') => "medium",
                esc_attr__("Large", 'massive-dynamic') => "large",
            ),
            'dependency' => array(
                'element' => $step_num_param,
                'value' => $value
            ),
        );
    }
    return $param;
}

pixflow_map(
    array(
        'base' => 'md_process_steps',
        'name' => esc_attr__('Process Steps', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__('Business', 'massive-dynamic'),
        "params" => pixflow_processStep_param(),
    )
);