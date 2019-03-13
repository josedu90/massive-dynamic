<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Blog Calendar
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
        'base' => 'md_blog',
        'name' => esc_attr__('Blog Calendar', 'massive-dynamic'),
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
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "blog_category_separator" . ++$separatorCounter,
                "admin_label" => false,
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Post Number", 'massive-dynamic'),
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
                "heading" => esc_attr__("Text ", 'massive-dynamic'),
                "param_name" => "blog_forground_color",
                "value" => 'rgb(255,255,255)',
                "admin_label" => false,
                "opacity" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "blog_forground_color_separator" . ++$separatorCounter,
                "admin_label" => false,
            ),
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Overlay", 'massive-dynamic'),
                "param_name" => "blog_background_color",
                "value" => 'rgb(0,0,0)',
                "admin_label" => false,
                "opacity" => false,
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "category_group",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                "type" => "attach_image",
                "edit_field_class" => $filedClass . "first glue last",

                "heading" => esc_attr__("Background Image", 'massive-dynamic'),
                "param_name" => "blog_bg",
                "admin_label" => false,
            ),
            array(
                "type" => "md_vc_description",
                "param_name" => "calendar_description",
                "admin_label" => false,
                "value" => esc_attr__("To add blog posts, go to WordPress Dashboard > Posts > add new", 'massive-dynamic'),
            ),

        )
    )
);

pixflow_add_params('md_blog', pixflow_addAnimationTab('md_blog'));
