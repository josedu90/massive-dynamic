<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Icon Box New
/*-----------------------------------------------------------------------------------*/

pixflow_map(
    array(
        "name" => "Icon Box New",
        "base" => "md_iconbox_new",
        "category" => esc_attr__("more", 'massive-dynamic'),
        "allowed_container_element" => 'vc_row',
        'show_settings_on_create' => false,

        "params" => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Content", 'massive-dynamic'),
                "param_name" => "app_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "first glue last",
                "heading" => esc_attr__("Title size", 'massive-dynamic'),
                "param_name" => "iconbox_new_heading",
                "description" => esc_attr__("Choose your heading", 'massive-dynamic'),
                "admin_label" => false,
                "value" => array(
                    "H6" => "h6",
                    "H1" => "h1",
                    "H2" => "h2",
                    "H3" => "h3",
                    "H4" => "h4",
                    "H5" => "h5"
                ),
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "param_name" => "iconbox_new_title",
                "value" => "Super Flexible",
                "description" => esc_attr__("Iconbox new heading text", 'massive-dynamic'),
                "admin_label" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "iconbox_new_title_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . " glue",
                "heading" => esc_attr__("Text", 'massive-dynamic'),
                "param_name" => "iconbox_new_readmore",
                "description" => esc_attr__("Read more text", 'massive-dynamic'),
                "admin_label" => false,
                "value" => 'Find Out More',
            ),//Read More Text
            array(
                "type" => 'md_vc_separator',
                "param_name" => "iconbox_new_readmore_separator" . ++$separatorCounter,
                "admin_label" => false,
            ),//separator
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("URL Link", 'massive-dynamic'),
                "param_name" => "iconbox_new_url",
                "value" => "#",
                "admin_label" => false,
                "description" => esc_attr__("destination URL", 'massive-dynamic'),
            ),//iconbox new url
            array(
                "type" => 'md_vc_separator',
                "param_name" => "iconbox_new_url_separator" . ++$separatorCounter,
                "admin_label" => false,
            ),//separator
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Link's target", 'massive-dynamic'),
                "param_name" => "iconbox_new_target",
                "admin_label" => false,
                "description" => esc_attr__("Open the link in the same tab or a blank browser tab", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Open in same window", 'massive-dynamic') => "_self",
                    esc_attr__("Open in new window", 'massive-dynamic') => "_blank"
                ),
            ),//iconbox new target
            array(
                "type" => "textarea",
                "edit_field_class" => $filedClass . "first glue last",
                "heading" => esc_attr__("Description", 'massive-dynamic'),
                "param_name" => "iconbox_new_description",
                "value" => "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable",
                "description" => esc_attr__("Iconbox new description text", 'massive-dynamic'),
                "admin_label" => false,
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Content", 'massive-dynamic'),
                "param_name" => "app_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Hover Effect", 'massive-dynamic'),
                "param_name" => "iconbox_new_hover",
                "admin_label" => false,
                "description" => esc_attr__("Icon box new hover effect", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Circle", 'massive-dynamic') => "circle-hover",
                    esc_attr__("Box", 'massive-dynamic') => "box-hover"
                ),
            ),//hover effect
            array(
                "type" => 'md_vc_separator',
                "param_name" => "iconbox_new_hover_effect_separator" . ++$separatorCounter,
                "admin_label" => false,
            ),//separator

            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Hover Color", 'massive-dynamic'),
                "param_name" => "iconbox_new_hover_color",
                "value" => "#efefef",
                "admin_label" => false,
                "description" => esc_attr__("Choose hover color", 'massive-dynamic'),
            ),//hover color

            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "first glue last",
                "heading" => esc_attr__("General Color", 'massive-dynamic'),
                "param_name" => "iconbox_new_general_color",
                "value" => "#5e5e5e",
                "admin_label" => false,
                "description" => esc_attr__("Choose general color", 'massive-dynamic'),
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Icon Color", 'massive-dynamic'),
                "param_name" => "iconbox_new_icon_color",
                "value" => "rgb(0,0,0)",
                "admin_label" => false,
                "description" => esc_attr__("Choose icon color", 'massive-dynamic'),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "icon_color_separator" . ++$separatorCounter,
                "admin_label" => false,
            ),
            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
                "param_name" => "iconbox_new_icon",
                "value" => "icon-microphone-outline",
                "admin_label" => false,
                "description" => esc_attr__("Select an icon", 'massive-dynamic')
            ),//iconbox icon
        )
    )
);

pixflow_add_params('md_iconbox_new', pixflow_addAnimationTab('md_iconbox_new'));
