<?php
/**
 * Pixflow
 */


/*******************************************************************
 *                  Google Map
 ******************************************************************/
pixflow_map(
    array(
        'base' => 'md_google_map',
        'name' => esc_attr__('Custom Google Map', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__('Business', 'massive-dynamic'),
        "allowed_container_element" => 'vc_row',
        "params" => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Coordinates", 'massive-dynamic'),
                "param_name" => "cor_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue ",
                "param_name" => "md_google_map_lat",
                "heading" => esc_attr__("Map latitude", "massive-dynamic"),
                "value" => '37.7533106',
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "md_google_map_lat_separator" . ++$separatorCounter,
            ),
            array(
                'type' => 'textfield',
                "edit_field_class" => $filedClass . "glue ",
                'heading' => esc_attr__('Map Longitude', 'massive-dynamic'),
                'param_name' => 'md_google_map_lon',
                'value' => '-122.4818691',
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "md_google_map_lon_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Map", 'massive-dynamic'),
                "param_name" => "map_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Zoom Level', 'massive-dynamic'),
                'param_name' => 'md_google_map_zoom',
                'value' => '15',
                'defaultSetting' => array(
                    "min" => "1",
                    "max" => "19",
                    "step" => "1",
                ),
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Type", "massive-dynamic"),
                "param_name" => "md_google_map_type",
                "value" => array(
                    esc_attr__("Gray", 'massive-dynamic') => "gray",
                    esc_attr__("Ultra Light", 'massive-dynamic') => "ultralight",
                    esc_attr__("Gray scale", 'massive-dynamic') => "grayscale",
                    esc_attr__("Light Dream", 'massive-dynamic') => "lightdream",
                    esc_attr__("Blue One", 'massive-dynamic') => "blueone",
                    esc_attr__("Default Map", 'massive-dynamic') => "map",
                    //esc_attr__("Custom Map", 'massive-dynamic') => "custom",
                ),
            ),
            array(
                "type" => "textarea",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_html__("Custom Style", 'massive-dynamic'),
                "param_name" => "md_google_map_custom_style",
                "admin_label" => false,
                "value" => "",
                'dependency' => array(
                    'element' => 'md_google_map_type',
                    'value' => array("custom")
                ),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "md_google_map_type_separator" . ++$separatorCounter,
            ),
            array(
                'type' => 'attach_image',
                "edit_field_class" => $filedClass . "glue",
                'heading' => esc_attr__('Marker', 'massive-dynamic'),
                'param_name' => 'md_google_map_marker',
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "md_google_map_marker_separator" . ++$separatorCounter,
            ),
            array(
                'type' => 'textfield',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Height', 'massive-dynamic'),
                'param_name' => 'md_google_map_height',
                'value' => '400',
            ),
            array(
                'type' => 'textfield',
                "edit_field_class" => $filedClass . "glue last first",
                'heading' => esc_attr__('API Key', 'massive-dynamic'),
                'param_name' => 'md_google_map_key',
                'value' => '',
            ),
            array(
                "type" => "md_vc_description",
                "param_name" => "md_google_map_description",
                "admin_label" => false,
                "value" => esc_attr__("To use google map you should go to google app console and create a browser api key for your site", 'massive-dynamic'),
            ),

        )
    )
);

pixflow_add_params('md_google_map', pixflow_addAnimationTab('md_google_map'));
