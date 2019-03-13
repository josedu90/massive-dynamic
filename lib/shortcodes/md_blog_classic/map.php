<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------*/
/*  Blog Classic
/*-----------------------------------------------------------------------------------*/
$posts_cats = array();
$terms = get_terms('category', 'orderby=count&hide_empty=0');
if (!empty($terms) && !is_wp_error($terms)) {
    foreach ($terms as $term) {
        $posts_cats[] = $term->name;
    }
}
pixflow_map(
    array(
        'base' => 'md_blog_classic',
        'name' => esc_attr__('Blog Classic', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__('Media','massive-dynamic'),
        'params' => array(

            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Category", 'massive-dynamic'),
                "param_name" => "category_group",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                'type' => 'md_vc_multiselect',
                "edit_field_class" => $filedClass . "first glue",
                'heading' => esc_attr__('Category', 'massive-dynamic'),
                'param_name' => 'blog_category',
                'items' => $posts_cats,
                'defaults' => 'all',
            ), array(
                "type" => 'md_vc_separator',
                "param_name" => "blog_category_separator" . ++$separatorCounter,
                "admin_label" => false,
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Post Per Page", 'massive-dynamic'),
                "param_name" => "blog_post_number",
                "admin_label" => false,
                "value" => '5',
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Colors", 'massive-dynamic'),
                "param_name" => "color_group",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "param_name" => "blog_title_color",
                "value" => 'rgb(68,37,153)',
                "admin_label" => false,
                "opacity" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "blog_text_color_separator" . ++$separatorCounter,
                "admin_label" => false,
            ),
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Text", 'massive-dynamic'),
                "param_name" => "blog_text_color",
                "value" => 'rgb(163,163,163)',
                "admin_label" => false,
                "opacity" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "blog_text_color_separator" . ++$separatorCounter,
                "admin_label" => false,
            ),
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue ",
                "heading" => esc_attr__("Category ", 'massive-dynamic'),
                "param_name" => "blog_category_color",
                "value" => 'rgb(52,202,161)',
                "admin_label" => false,
                "opacity" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "blog_text_color_separator" . ++$separatorCounter,
                "admin_label" => false,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Shadow ", 'massive-dynamic'),
                "param_name" => "blog_shadow_color",
                "value" => 'rgba(0,0,0,.12)',
                "admin_label" => false,
                "opacity" => true,
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "app_group",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Alignment", "massive-dynamic"),
                "param_name" => "blog_category_align",
                "value" => array(
                    esc_attr__("Left", 'massive-dynamic') => "left",
                    esc_attr__("Center", 'massive-dynamic') => "center",
                ),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "blog_category_align_separator" . ++$separatorCounter,
                "admin_label" => false,
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Title Size", 'massive-dynamic'),
                "param_name" => "blog_title_size",
                "admin_label" => false,
                'value' => array(
                    esc_attr__("Large", 'massive-dynamic') => "47",
                    esc_attr__("Medium", 'massive-dynamic') => "35",
                    esc_attr__("Small", 'massive-dynamic') => "25"
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "blog_category_align_separator" . ++$separatorCounter,
                "admin_label" => false,
            ),
            array(
                "type" => "md_vc_checkbox",
                "edit_field_class" => $filedClass . "glue  last",
                "param_name" => "blog_category_author",
                "heading" => esc_attr__("Show Author", "massive-dynamic"),
                'checked' => true,
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
            ),
            array(
                "type" => "md_vc_description",
                "param_name" => "blog_description",
                "admin_label" => false,
                "value" => esc_attr__("To add blog posts, go to WordPress Dashboard > Posts > add new", 'massive-dynamic'),
            ),

        )
    )
);