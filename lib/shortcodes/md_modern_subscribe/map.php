<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Subscribe Modern
/*-----------------------------------------------------------------------------------*/

pixflow_map(
    array(
        'base' => 'md_modern_subscribe',
        'name' => esc_attr__('Modern Subscribe', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__('Business', 'massive-dynamic'),
        "params" => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Content", 'massive-dynamic'),
                "param_name" => "content_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "param_name" => "subscribe_title",
                "value" => 'Sign Up To Our Newsletter',
                "admin_label" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "subscribe_sep" . ++$separatorCounter,
            ),
            array(
                "type" => "textarea",
                "edit_field_class" => $filedClass . " glue last",
                "heading" => esc_attr__("Description", 'massive-dynamic'),
                "param_name" => "subscribe_desc",
                "value" => 'To get the latest news from us please subscribe your email.we promise worthy news with no spam.',
                "admin_label" => false,
            ),
            array(
                'type' => 'attach_image',
                "edit_field_class" => $filedClass . "glue first last",
                'heading' => esc_attr__('Image', 'massive-dynamic'),
                'param_name' => 'subscribe_image',
                'value' => PIXFLOW_THEME_IMAGES_URI . "/place-holder.jpg",
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "app_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . " glue first ",
                'heading' => esc_attr__('Shadow', 'massive-dynamic'),
                'param_name' => 'subscribe_shadow',
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes')
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "subscribe_sep" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . " glue",
                "heading" => esc_attr__("Text Color", 'massive-dynamic'),
                "param_name" => "subscribe_textcolor",
                "value" => '#000',
                "admin_label" => false,
                "opacity" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "subscribe_sep" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Background Color", 'massive-dynamic'),
                "param_name" => "subscribe_bgcolor",
                "value" => '#fff',
                "admin_label" => false,
                "opacity" => true,
            ),

            array(
                "type" => "md_vc_description",
                "param_name" => "modern_description",
                "admin_label" => false,
                "value" => '<ul><li>' . __('You must install and configure "MailChimp for WordPress Lite" plugin before using this shortcode.', 'massive-dynamic') . '</li></ul>',
            ),
        )
    )
);

pixflow_add_params('md_modern_subscribe', pixflow_addAnimationTab('md_modern_subscribe'));
