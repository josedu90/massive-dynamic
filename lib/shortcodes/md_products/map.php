<?php
/**
 * Pixflow
 */


$product_cats = array();
$product_orderby=array(
    "Publishing Date"=>'date',
    "Product ID" => 'id',
    "Popularity." => 'popularity',
    'Randomly order' => 'rand',
    'Product rating.' =>  'rating',
    'product Title' => 'title'
);

$product_order=array(
    "Ascending"=>'ASC',
    "Descending " => 'DESC',
);


$terms = get_terms('product_cat', 'orderby=count&hide_empty=0');
if (!empty($terms) && !is_wp_error($terms)) {
    foreach ($terms as $term) {
        $product_cats[$term->name] = $term->name;
    }
}

/*** Products Shortcode ***/
pixflow_map(
    array(
        'base' => 'md_products',
        'name' => esc_attr__('Products', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__("Commerce", 'massive-dynamic'),
        'params' => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Categories", 'massive-dynamic'),
                "param_name" => "category_title",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_attr__('Category', 'massive-dynamic'),
                "edit_field_class" => $filedClass . "first glue last",
                'param_name' => 'products_categories',
                "admin_label" => false,
                'value' => $product_cats,
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first last glue",
                "heading" => esc_attr__("Products Number", 'massive-dynamic'),
                "param_name" => "products_number",
                "value" => '-1',
                "admin_label" => false,
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_attr__('Order By ', 'massive-dynamic'),
                "edit_field_class" => $filedClass . "first glue last",
                'param_name' => 'products_orderby',
                "admin_label" => false,
                'value' => $product_orderby,
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_attr__('Order ', 'massive-dynamic'),
                "edit_field_class" => $filedClass . "first glue last",
                'param_name' => 'products_order',
                "admin_label" => false,
                'value' => $product_order,
            ),
            array(
                "type" => "md_vc_description",

                "param_name" => "products_description",
                "admin_label" => false,
                "value" => wp_kses(__("<ul>
                    <li>Product order will have no effect if you choose sort by rating or random sorting</li>         
                </ul>", 'massive-dynamic'), array('ul' => array(), 'li' => array()))
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Layout", 'massive-dynamic'),
                "param_name" => "category_title",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "first glue last",
                'heading' => esc_attr__('Columns', 'massive-dynamic'),
                'param_name' => 'products_cols',
                'value' => 3,
                'defaultSetting' => array(
                    "min" => 1,
                    "max" => 6,
                    "prefix" => "",
                    "step" => 1,
                )
            ),

            array(
                "type" => "dropdown",

                "edit_field_class" => $filedClass . "glue first last",
                "heading" => esc_attr__("Alignment", 'massive-dynamic'),
                "param_name" => "products_align",
                "admin_label" => false,
                "value" => array(
                    esc_attr__("Left", 'massive-dynamic') => "left",
                    esc_attr__("Center", 'massive-dynamic') => "center",
                ),
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "category_title",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                "type" => "dropdown",

                "edit_field_class" => $filedClass . "glue first last",
                "heading" => esc_attr__("Products Style", 'massive-dynamic'),
                "param_name" => "products_style",
                "admin_label" => false,
                "value" => array(
                    esc_attr__("Classic", 'massive-dynamic') => "classic",
                    esc_attr__("Modern", 'massive-dynamic') => "modern",
                ),
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first last glue",
                "heading" => esc_attr__("Thumbnails Height", 'massive-dynamic'),
                "param_name" => "products_height",
                "value" => '500',
                "admin_label" => false,
            ),
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . " first glue",
                "heading" => esc_attr__("Sale Badge Background", 'massive-dynamic'),
                "param_name" => "products_sale_bg_color",
                "admin_label" => false,
                "opacity" => true,
                'value' => 'rgba(255,255,255,1)',
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "products_color_separator" . ++$separatorCounter,
            ),//separator
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Sale Badge Text Color", 'massive-dynamic'),
                "param_name" => "products_sale_text_color",
                "admin_label" => false,
                "opacity" => true,
                'value' => 'rgba(0,0,0,1)',
            ),

            array(
                "type" => "md_vc_description",

                "param_name" => "products_description",
                "admin_label" => false,
                "value" => wp_kses(__("<ul>
                    <li>In products number field, you can choose all products by entering -1 </li>
                    <li>Please note that 'add to cart button' is not supposed to work correctly in builder environment</li>
                </ul>", 'massive-dynamic'), array('ul' => array(), 'li' => array()))
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "first glue last",
                'heading' => esc_attr__('Activate', 'massive-dynamic'),
                'param_name' => 'products_use_button',
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
                'checked' => false,
                "group" => esc_attr__("More Products Button", 'massive-dynamic'),
            ),//add btn
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "products_use_button" . ++$separatorCounter,
                "group" => esc_attr__("More Products Button", 'massive-dynamic'),
                "admin_label" => false,
                "dependency" => array(
                    'element' => "products_use_button",
                    'value' => array('yes')
                )
            ),//separator
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",
                "separate" => true,
                "heading" => esc_attr__("Button Style", 'massive-dynamic'),
                "param_name" => "products_button_style",
                "description" => esc_attr__("Choose between five button style", 'massive-dynamic'),
                "admin_label" => false,
                "value" => array(
                    esc_attr__("Fade Oval", 'massive-dynamic') => "fade-oval",
                    esc_attr__("Fade Square", 'massive-dynamic') => "fade-square",
                    esc_attr__("Slide", 'massive-dynamic') => "slide",
                    esc_attr__("Fill Slide", 'massive-dynamic') => "come-in",
                    esc_attr__("Animation", 'massive-dynamic') => "animation",
                    esc_attr__("Flash Animate", 'massive-dynamic') => "flash-animate",
                    esc_attr__("Fill Rectangle", 'massive-dynamic') => "fill-rectangle",
                    esc_attr__("Fill Oval", 'massive-dynamic') => "fill-oval"
                ),
                "group" => esc_attr__("More Products Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "products_use_button",
                    'value' => array('yes')
                )
            ),//btn kind
            array(
                "type" => "textfield",

                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Text", 'massive-dynamic'),
                "param_name" => "products_button_text",
                "description" => esc_attr__("Button text", 'massive-dynamic'),
                "admin_label" => false,
                "value" => 'More Products',
                "group" => esc_attr__("More Products Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "products_use_button",
                    'value' => array('yes')
                )
            ),//btn text
            array(
                "type" => 'md_vc_separator',
                "param_name" => "products_button_text_separator" . ++$separatorCounter,
                "group" => esc_attr__("More Products Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "products_use_button",
                    'value' => array('yes')
                )
            ),//separator
            array(
                "type" => "md_vc_iconpicker",

                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
                "param_name" => "products_button_icon_class",
                "group" => esc_attr__("More Products Button", 'massive-dynamic'),
                "admin_label" => false,
                "description" => esc_attr__("Select an icon that shown before text", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "products_use_button",
                    'value' => array('yes')
                ),
                'value' => 'icon-chevron-right'
            ),//btn icon
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue first last",
                "heading" => esc_attr__("General Color", 'massive-dynamic'),
                "group" => esc_attr__("More Products Button", 'massive-dynamic'),
                "param_name" => "products_button_color",
                "admin_label" => false,
                "opacity" => true,
                "value" => "rgba(0,0,0,1)",
                "description" => esc_attr__("Enter optional button's color", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "products_use_button",
                    'value' => array('yes')
                )
            ),//btn general color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "products_button_color_separator" . ++$separatorCounter,
                "edit_field_class" => $filedClass . "stick-to-top",
                "group" => esc_attr__("More Products Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "products_button_style",
                    'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
                ),
            ),//separator
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Text Color", 'massive-dynamic'),
                "param_name" => "products_button_text_color",
                "group" => esc_attr__("More Products Button", 'massive-dynamic'),
                "admin_label" => false,
                "opacity" => true,
                "description" => esc_attr__("Enter optional button's color", 'massive-dynamic'),
                'value' => '#fff',
                "dependency" => array(
                    'element' => "products_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),//text color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "button_hover_color_separator" . ++$separatorCounter,
                "group" => esc_attr__("More Products Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "products_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),//separator
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Bg Hover Color", 'massive-dynamic'),
                "param_name" => "products_button_bg_hover_color",
                "admin_label" => false,
                "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
                "group" => esc_attr__("More Products Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "products_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
                'value' => '#9b9b9b'
            ),//bg hover color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "button_hover_color_separator" . ++$separatorCounter,
                "group" => esc_attr__("More Products Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "products_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),//separator
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Text Hover Color", 'massive-dynamic'),
                "group" => esc_attr__("More Products Button", 'massive-dynamic'),
                "param_name" => "products_button_hover_color",
                "admin_label" => false,
                "value" => "rgb(255,255,255)",
                "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "products_button_style",
                    'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
                ),

            ),//btn hover text color
            array(
                "type" => "dropdown",

                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Button size", 'massive-dynamic'),
                "group" => esc_attr__("More Products Button", 'massive-dynamic'),
                "param_name" => "products_button_size",
                "admin_label" => false,
                "description" => esc_attr__("Choose between three button sizes", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Standard", 'massive-dynamic') => "standard",
                    esc_attr__("Small", 'massive-dynamic') => "small"
                ),
                "dependency" => array(
                    'element' => "products_use_button",
                    'value' => array('yes')
                )
            ),//btn size
            array(
                "type" => 'md_vc_separator',
                "param_name" => "products_button_size_separator" . ++$separatorCounter,
                "group" => esc_attr__("More Products Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "products_use_button",
                    'value' => array('yes')
                )
            ),//separator
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Button Padding', 'massive-dynamic'),
                'param_name' => 'products_left_right_padding',
                'value' => '0',
                "group" => esc_attr__("More Products Button", 'massive-dynamic'),
                'defaultSetting' => array(
                    "min" => "0",
                    "max" => "300",
                    "prefix" => " px",
                    "step" => "1",
                ),
                "dependency" => array(
                    'element' => "products_use_button",
                    'value' => array('yes')
                )
            ),//btn space
            array(
                "type" => "textfield",

                "group" => esc_attr__("More Products Button", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Link URL", 'massive-dynamic'),
                "param_name" => "products_button_url",
                "admin_label" => false,
                "value" => "#",
                "description" => esc_attr__("Button destination URL", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "products_use_button",
                    'value' => array('yes')
                )
            ),//btn url
            array(
                "type" => 'md_vc_separator',
                "param_name" => "products_button_linkr_separator" . ++$separatorCounter,
                "group" => esc_attr__("More Products Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "products_use_button",
                    'value' => array('yes')
                )
            ),//separator
            array(
                "type" => "dropdown",

                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Link's target", 'massive-dynamic'),
                "group" => esc_attr__("More Products Button", 'massive-dynamic'),
                "param_name" => "products_button_target",
                "admin_label" => false,
                "description" => esc_attr__("Open the link in the same tab or a blank browser tab", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Open in same window", 'massive-dynamic') => "_self",
                    esc_attr__("Open in new window", 'massive-dynamic') => "_blank"
                ),
                "dependency" => array(
                    'element' => "products_use_button",
                    'value' => array('yes')
                )
            ),//btn target
        )
    )
);

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) || class_exists('WooCommerce')) {
    pixflow_add_params('md_products', pixflow_addAnimationTab('md_products'));
}
