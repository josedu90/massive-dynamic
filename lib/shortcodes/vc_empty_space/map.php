<?php
/**
 * Pixflow
 */

pixflow_remove_param('vc_empty_space', 'el_class');

$empty_space_setting = array(
    'name' => esc_attr__("Empty Space", 'massive-dynamic'),
    'show_settings_on_create' => false,
    "category" => esc_attr__("Structure", 'massive-dynamic'),
);

pixflow_add_param("vc_empty_space", array(
    "type" => 'md_vc_slider',
    "weight" => "2",
    "heading" => esc_attr__("Height", 'massive-dynamic'),
    "param_name" => "height",
    "value" => "100",
    "edit_field_class" => $filedClass . "glue first last",
    'defaultSetting' => array(
        "min" => "0",
        "max" => "800",
        "prefix" => "px",
        "step" => '5',
    )
));

pixflow_map_update('vc_empty_space', $empty_space_setting);
