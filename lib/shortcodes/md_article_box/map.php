<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------*/
/*  Article Box
/*-----------------------------------------------------------------------------------*/
pixflow_map(
    array(
        'base' => 'md_article_box',
        'name' => esc_html__('Article Box', 'massive-dynamic'),
        "category" => esc_html__('Business', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "allowed_container_element" => 'vc_row',
        "params" => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Content", 'massive-dynamic'),
                "param_name" => "content_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "attach_image",
                "edit_field_class" => $filedClass . "first glue  last",
                "heading" => esc_attr__("Image", 'massive-dynamic'),
                "param_name" => "article_image",
                "admin_label" => false,
                "description" => esc_attr__("Choose an image", 'massive-dynamic'),
                'value' => PIXFLOW_THEME_IMAGES_URI . "/place-holder.jpg",
            ),

            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_html__("Title", 'massive-dynamic'),
                "param_name" => "article_title",
                "value" => 'Unique Element',
                "admin_label" => false,
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator" . ++$separatorCounter,
            ),

            array(
                "type" => "textarea",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_html__("Description", 'massive-dynamic'),
                "param_name" => "article_text",
                "admin_label" => false,
                "value" => "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit sed",
            ),
            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_html__("Choose an icon", 'massive-dynamic'),
                "param_name" => "article_icon",
                "value" => "icon-file-tasks-add",
                "admin_label" => false
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "app_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . " glue last",
                'heading' => esc_attr__('Height', 'massive-dynamic'),
                'param_name' => 'article_height',
                'value' => '345',
                'defaultSetting' => array(
                    "min" => "250",
                    "max" => "600",
                    "prefix" => " px",
                    "step" => "1",
                ),
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_html__("Overlay Color", 'massive-dynamic'),
                "param_name" => "article_overlay_color",
                "value" => 'rgb(48,71,103)',
                "admin_label" => false,
                "opacity" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_html__("Text Color", 'massive-dynamic'),
                "param_name" => "article_text_color",
                "value" => 'rgb(255,255,255)',
                "admin_label" => false,
                "opacity" => true,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_html__("Icon Color", 'massive-dynamic'),
                "param_name" => "article_icon_color",
                "value" => 'rgb(150,223,92)',
                "admin_label" => false,
                "opacity" => true,
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Read More", 'massive-dynamic'),
                "param_name" => "read_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_html__("Text", 'massive-dynamic'),
                "param_name" => "article_read_more_text",
                "value" => 'VIEW MORE',
                "admin_label" => false,
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator" . ++$separatorCounter,
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_html__("Link", 'massive-dynamic'),
                "param_name" => "article_read_more_link",
                "value" => '#',
                "admin_label" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "separator" . ++$separatorCounter,
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Target", 'massive-dynamic'),
                "param_name" => "article_target",
                "admin_label" => false,
                "description" => esc_attr__("Open the link in the same tab or a blank browser tab", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Open in new window", 'massive-dynamic') => "_blank",
                    esc_attr__("Open in same window", 'massive-dynamic') => "_self",
                ),
            ),

        )
    )
);

pixflow_add_params('md_article_box', pixflow_addAnimationTab('md_article_box'));
