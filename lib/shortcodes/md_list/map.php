<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------*/
/*  List
/*-----------------------------------------------------------------------------------*/
// Generate list shortcode params
function pixflow_list_param()
{

    $filedClass = 'vc_col-sm-12 vc_column ';
    $separatorCounter = 0;
    $item_num_param = 'list_item_num';
    $item_num = 10;
    $dropDown = array(
        esc_attr__("Five", 'massive-dynamic') => 5,
        esc_attr__("One", 'massive-dynamic') => 1,
        esc_attr__("Two", 'massive-dynamic') => 2,
        esc_attr__("Three", 'massive-dynamic') => 3,
        esc_attr__("Four", 'massive-dynamic') => 4,
        esc_attr__("Six", 'massive-dynamic') => 6,
        esc_attr__("Seven", 'massive-dynamic') => 7,
        esc_attr__("Eight", 'massive-dynamic') => 8,
        esc_attr__("Nine", 'massive-dynamic') => 9,
        esc_attr__("Ten", 'massive-dynamic') => 10

    );
    $param = array(

        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Appearance", 'massive-dynamic'),
            "param_name" => "line_height_group",
            'group' => esc_attr__("General", 'massive-dynamic'),
            "edit_field_class" => $filedClass . "glue first last"
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_attr__('Style', 'massive-dynamic'),
            "edit_field_class" => $filedClass . "first glue last",
            'param_name' => 'list_style',
            'group' => esc_attr__("General", 'massive-dynamic'),
            'value' => array(
                esc_attr__("Number", 'massive-dynamic') => "number",
                esc_attr__("Icon", 'massive-dynamic') => "icon",
            ),
        ),
        array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "stick-to-top",
            "param_name" => "list_style_separator" . ++$separatorCounter,
            "group" => esc_attr__("General", 'massive-dynamic'),
            "dependency" => array(
                'element' => "list_style",
                'value' => array('icon')
            )
        ),
        array(
            "type" => "md_vc_iconpicker",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
            "param_name" => "list_icon_class",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "admin_label" => false,
            "dependency" => array(
                'element' => "list_style",
                'value' => array('icon')
            ),
            'value' => 'icon-checkmark'
        ),
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue first",
            "heading" => esc_attr__("General Color", 'massive-dynamic'),
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "list_general_color",
            "value" => '#a3a3a3',
            "admin_label" => false,
            "opacity" => false,
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "list_general_color_separator" . ++$separatorCounter,
            "group" => esc_attr__("General", 'massive-dynamic'),
        ),
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Hover Color", 'massive-dynamic'),
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "list_hover_color",
            "value" => '#e45d75',
            "admin_label" => false,
            "opacity" => false,
        ),
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue first last",
            "group" => esc_attr__("Items", 'massive-dynamic'),
            "heading" => esc_attr__("Item Number:", 'massive-dynamic'),
            "param_name" => $item_num_param,
            "admin_label" => false,
            "value" => $dropDown
        ),
    );

    for ($i = 1; $i <= (int)$item_num; $i++) {
        $value = array();

        for ($k = $i; $k <= $item_num; $k++) {
            $value[] = (string)$k;
        }

        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "first last glue",
            "group" => esc_attr__("Items", 'massive-dynamic'),
            "heading" => esc_attr__("Item ", 'massive-dynamic') . $i,
            "param_name" => "list_item_" . $i,
            "value" => 'This is text for item' . $i,
            "admin_label" => false,
            'dependency' => array(
                'element' => $item_num_param,
                'value' => $value
            ),
        );
    }
    return $param;
}

pixflow_map(
    array(
        'base' => 'md_list',
        'name' => esc_attr__('List', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__("more", 'massive-dynamic'),
        "params" => pixflow_list_param()
    )
);

pixflow_add_params('md_list', pixflow_addAnimationTab('md_list'));
