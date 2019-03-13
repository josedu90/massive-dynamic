<?php
/**
 * Pixflow
 */


/*******************************************************************
 *                  Rev Slider
 ******************************************************************/
$revsliders = array();
if (class_exists('RevSlider')) {
    pixflow_remove_element("rev_slider_vc");
    pixflow_remove_element("rev_slider");
    $slider = new RevSlider();
    $arrSliders = $slider->getArrSliders();
    if ($arrSliders) {
        foreach ($arrSliders as $slider) {
            $revsliders[$slider->getTitle()] = $slider->getAlias();
        }
    } else {
        $revsliders[esc_attr__('No sliders found', 'massive-dynamic')] = 0;
    }
}
pixflow_map(
    array(
        'name' => 'Revolution Slider',
        'base' => 'md_rev_slider',
        'controls' => 'full',
        'show_settings_on_create' => false,
        "category" => esc_attr__('Media', 'massive-dynamic'),
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_attr__('Select Slider', 'massive-dynamic'),
                'param_name' => 'md_rev_slider_alias',
                'value' => $revsliders,
            )
        )
    )
);