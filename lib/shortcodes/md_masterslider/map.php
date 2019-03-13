<?php
/**
 * Pixflow
 */

/*******************************************************************
 *                  Master Slider
 ******************************************************************/
$master_sliders = array();
if (function_exists('get_masterslider_names')) {
    pixflow_remove_element("masterslider_pb");
    $slides = get_masterslider_names('title-id');
    $master_sliders = array_merge(array(esc_attr__('Select slider', 'massive-dynamic') => ''), $slides);
}
pixflow_map(
    array(
        'name' => 'Master Slider',
        'base' => 'md_masterslider',
        'controls' => 'full',
        'show_settings_on_create' => false,
        "category" => esc_attr__('Media', 'massive-dynamic'),
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_attr__('Master Slider', 'massive-dynamic'),
                'param_name' => 'md_masterslider_id',
                'value' => $master_sliders,
            )
        )
    )
);