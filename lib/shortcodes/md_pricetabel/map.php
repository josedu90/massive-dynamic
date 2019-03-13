<?php
/**
 * Pixflow
 */



/*-----------------------------------------------------------------------------------*/
/*  Price Table
/*-----------------------------------------------------------------------------------*/

// Load Created Price tables form Go Pricing
if (class_exists('GW_GoPricing_Data')) {
    $pricing_tables = get_posts( 'post_type="go_pricing_tables"&numberposts=-1' );;
    if (count($pricing_tables)) {
        foreach ($pricing_tables as $pricing_table) {
            $title = $pricing_table->post_title;
            $id = $pricing_table->post_excerpt;
            if (!empty($title) && !empty($id)) $dropdown_data[$title] = $id;
        }
    }
} else {
    $dropdown_data = array();
}
if (empty($dropdown_data)) $dropdown_data[0] = esc_attr__('No tables found!', 'massive-dynamic');

pixflow_map(
    array(
        'base' => 'md_pricetabel',
        'name' => esc_attr__('Price Table', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__('Commerce', 'massive-dynamic'),
        "allowed_container_element" => 'vc_row',
        "params" => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_attr__('Select Price Table', 'massive-dynamic'),
                "edit_field_class" => $filedClass . "first glue last",
                'param_name' => 'pricetable_id',
                'value' => $dropdown_data,
            ),
            array(
                "type" => "md_vc_description",
                "param_name" => "pricetable_attention",
                "admin_label" => false,
                "value" => esc_attr__("You should install Go Pricing plugin first, then create tables and use this shortcode to drop them in your website.", 'massive-dynamic'),
            ),
        )
    )
);