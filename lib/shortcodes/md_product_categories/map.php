<?php
/**
 * Pixflow
 */
/*** Get product categories ***/
$product_cats = array();
$terms = get_terms('product_cat', 'orderby=count&hide_empty=0');
if (!empty($terms) && !is_wp_error($terms)) {
    foreach ($terms as $term) {
        $product_cats[] = $term->name;
    }
}
/*** Category Shortcode ***/
pixflow_map(
    array(
        'base' => 'md_product_categories',
        'name' => esc_attr__('Product Categories', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__("Commerce", 'massive-dynamic'),
        'params' => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Layout", 'massive-dynamic'),
                "param_name" => "layout_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),

            array(
                'type' => 'md_vc_multiselect',
                'heading' => esc_attr__('Category', 'massive-dynamic'),
                "edit_field_class" => $filedClass . "first glue last",
                'param_name' => 'product_categories',
                'items' => $product_cats,
                'defaults' => 'all',
            ),
            array(
                "type" => "dropdown",

                "edit_field_class" => $filedClass . "glue first last",
                "heading" => esc_attr__("Meta Alignment", 'massive-dynamic'),
                "param_name" => "product_categories_align",
                "admin_label" => false,
                "value" => array(
                    esc_attr__("Center", 'massive-dynamic') => "center",
                    esc_attr__("Left Corner", 'massive-dynamic') => "left",
                ),
            ),
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "first glue last",
                'heading' => esc_attr__('Columns', 'massive-dynamic'),
                'param_name' => 'product_categories_cols',
                'value' => 3,
                'defaultSetting' => array(
                    "min" => 1,
                    "max" => 12,
                    "prefix" => "",
                    "step" => 1,
                )
            ),

            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "appearance_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),

            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first last glue",
                "heading" => esc_attr__("Thumbnails Height", 'massive-dynamic'),
                "param_name" => "product_categories_height",
                "value" => '400',
                "admin_label" => false,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "first glue last",
                "heading" => esc_attr__("General Color", 'massive-dynamic'),
                "param_name" => "product_categories_hover_color",
                "admin_label" => false,
                "opacity" => false,
                'value' => 'rgb(255,255,255,255)'
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "first glue last",
                "heading" => esc_attr__("Overlay Color", 'massive-dynamic'),
                "param_name" => "product_categories_overlay_color",
                "admin_label" => false,
                "opacity" => true,
                'value' => 'rgba(0,0,0,0.2)'
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Hover", 'massive-dynamic'),
                "param_name" => "hover_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first last glue",
                "heading" => esc_attr__("Text", 'massive-dynamic'),
                "param_name" => "product_categories_hover_text",
                "value" => 'SEE THE COLLECTION',
                "admin_label" => false,
            ),
            array(
                "type" => "md_vc_description",
                "param_name" => "product_categories_description",
                "admin_label" => false,
                "value" => wp_kses(__("<ul>
                    <li>To edit fonts for category name and hover text, you should edit h4 and h6 typography. Category name uses h4, while hover text uses h6.</li>
                    <li>To add category thumbnail images, go to Dashboard > Products > Categories, click on the desired category and add an image in Thumbnail field.</li>
                </ul>", 'massive-dynamic'), array('ul' => array(), 'li' => array()))
            ),
        )
    )
);

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) || class_exists('WooCommerce')) {
    pixflow_add_params('md_product_categories', pixflow_addAnimationTab('md_product_categories'));
}