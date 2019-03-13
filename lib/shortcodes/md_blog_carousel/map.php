<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Blog Carousel
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
        'base' => 'md_blog_carousel',
        'name' => esc_attr__('Blog Carousel', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__('Media','massive-dynamic'),
        'params' => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Categories", 'massive-dynamic'),
                "param_name" => "category_group",
                'group' => esc_attr__('General', 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first ",
            ),
            array(
                'type' => 'md_vc_multiselect',
                "edit_field_class" => $filedClass . "glue first",
                'heading' => esc_attr__('Category', 'massive-dynamic'),
                'param_name' => 'blog_category',
                'items' => $posts_cats,
                'defaults' => 'all',
                'group' => esc_attr__('General', 'massive-dynamic')
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "blog_category_separator" . ++$separatorCounter,
                "admin_label" => false,
                'group' => esc_attr__('General', 'massive-dynamic')
            ),
            array(
                "type" => 'md_vc_slider',
                "heading" => esc_attr__("Post Number", 'massive-dynamic'),
                "param_name" => "blog_post_number",
                "value" => "5",
                "edit_field_class" => $filedClass . "glue ",
                'defaultSetting' => array(
                    "min" => "0",
                    "max" => "30",
                    "prefix" => "",
                    "step" => '1',
                ),

                'group' => esc_attr__('General', 'massive-dynamic')
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Autoplay", 'massive-dynamic'),
                "param_name" => "category_group",
                'group' => esc_attr__('General', 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first ",
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "blog_category_separator" . ++$separatorCounter,
                "admin_label" => false,
                'group' => esc_attr__('General', 'massive-dynamic')
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Activate', 'massive-dynamic'),
                'param_name' => 'carousel_autoplay',
                'value' => array(esc_attr__('No', 'massive-dynamic') => 'no'),
                'checked' => false,
                "group" => esc_attr__("General", 'massive-dynamic'),
            ),
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Background Color", 'massive-dynamic'),
                "param_name" => "blog_background_color",
                "value" => 'rgb(255,255,255)',
                "admin_label" => false,
                "opacity" => false,
                'group' => esc_attr__('Design', 'massive-dynamic')
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "blog_background_color_separator" . ++$separatorCounter,
                "admin_label" => false,
                'group' => esc_attr__('Design', 'massive-dynamic')
            ),
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue ",
                "heading" => esc_attr__("Text Color", 'massive-dynamic'),
                "param_name" => "blog_foreground_color",
                "value" => 'rgb(0,0,0)',
                "admin_label" => false,
                "opacity" => false,
                'group' => esc_attr__('Design', 'massive-dynamic')
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "blog_background_color_separator" . ++$separatorCounter,
                "admin_label" => false,
                'group' => esc_attr__('Design', 'massive-dynamic')
            ),
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Date Color", 'massive-dynamic'),
                "param_name" => "blog_date_color",
                "value" => 'rgb(84,84,84)',
                "admin_label" => false,
                "opacity" => false,
                'group' => esc_attr__('Design', 'massive-dynamic')
            ),
        )
    )
);

pixflow_add_params('md_blog_carousel', pixflow_addAnimationTab('md_blog_carousel'));
