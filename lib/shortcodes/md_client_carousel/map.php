<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------*/
/*  Client Carousel
/*-----------------------------------------------------------------------------------*/
function pixflow_client_carousel_param()
{
    $filedClass = 'vc_col-sm-12 vc_column ';
    $members_param = 'client_carousel_num';
    $members_num = 12;
    $dropDown = array(
        esc_attr__("Eight", 'massive-dynamic') => 8,
        esc_attr__("One", 'massive-dynamic') => 1,
        esc_attr__("Two", 'massive-dynamic') => 2,
        esc_attr__("Three", 'massive-dynamic') => 3,
        esc_attr__("Four", 'massive-dynamic') => 4,
        esc_attr__("Five", 'massive-dynamic') => 5,
        esc_attr__("Six", 'massive-dynamic') => 6,
        esc_attr__("Seven", 'massive-dynamic') => 7,
        esc_attr__("Nine", 'massive-dynamic') => 9,
        esc_attr__("Ten", 'massive-dynamic') => 10,
        esc_attr__("Eleven", 'massive-dynamic') => 11,
        esc_attr__("Twelve", 'massive-dynamic') => 12,
    );

    $param = array(

        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue first last",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Number Of Clients:", 'massive-dynamic'),
            "param_name" => $members_param,
            "admin_label" => false,
            "value" => $dropDown
        ),
        array(
            "type" => "md_vc_slider",
            "edit_field_class" => $filedClass . "glue first last",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Slide to show:", 'massive-dynamic'),
            "param_name" => "client_carousel_number",
            "admin_label" => false,
            "value" => '5',
            'defaultSetting' => array(
                "min" => "1",
                "max" => "12",
                "prefix" => "",
                "step" => '1',
            )
        ),
        array(
            'type' => 'md_vc_checkbox',
            "edit_field_class" => $filedClass . "first glue last",
            'heading' => esc_attr__('Auto Play', 'massive-dynamic'),
            'param_name' => 'client_play_mode',
            'value' => array(esc_attr__('No', 'massive-dynamic') => 'no'),
            'checked' => false,
            "group" => esc_attr__("General", 'massive-dynamic'),
        )
    );

    for ($i = 1; $i <= (int)$members_num; $i++) {
        $value = array();

        for ($k = $i; $k <= $members_num; $k++) {
            $value[] = (string)$k;
        }
        $param[] = array(
            'type' => 'attach_image',
            'edit_field_class' => $filedClass . "glue first last",
            'heading' => esc_attr__('Client '.$i, 'massive-dynamic'),
            'param_name' => 'client_carousel_logo_' . $i,
            "group" => esc_attr__("Client", 'massive-dynamic'),
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );
        $param[] = array(
            'type' => 'textfield',
            'edit_field_class' => $filedClass . "glue first last",
            'heading' => esc_attr__('Client Link '.$i, 'massive-dynamic'),
            'param_name' => 'client_carousel_link_' . $i,
            "group" => esc_attr__("Client", 'massive-dynamic'),
            "value" => '#',
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );
    }
    return $param;
}

pixflow_map(
    array(
        'base' => 'md_client_carousel',
        'name' => esc_attr__('Client Carousel', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "allowed_container_element" => 'vc_row',
        "category" => esc_attr__('Business', 'massive-dynamic'),
        "params" => pixflow_client_carousel_param()
    )
);
