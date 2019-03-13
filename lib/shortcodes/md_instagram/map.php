<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------*/
/*  Instagram
/*-----------------------------------------------------------------------------------*/
$redirect_uri = PIXFLOW_THEME_LIB_URI . '/instagram/get_token_access.php';
$instagram = new pixflow_Instagram(array(
    'apiKey' => 'a0416c7630d74bfb894916fb4c8d0c70',
    'apiSecret' => '9df90946a6c142c9b75e6df51726124c',
    'apiCallback' => 'http://demo2.pixflow.net/instagram-app/redirect.php?redirect_uri=' . urlencode($redirect_uri)
));
$InstagramloginURL = $instagram->getLoginUrl();

pixflow_map(
    array(
        'base' => 'md_instagram',
        'name' => esc_attr__('Instagram', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__('Media','massive-dynamic'),
        "params" => array(
            array(
                'type' => 'textfield',
                "edit_field_class" => $filedClass . "first glue last",
                'param_name' => 'instagram_token_access',
                "heading" => esc_attr__("Token Access", 'massive-dynamic'),
            ),
            array(
                "type" => "md_vc_description",
                "param_name" => "get_token_access_link",
                "edit_field_class" => "get_token_access_link",
                "admin_label" => false,
                "value" => "<a href='" . $InstagramloginURL . "' target='_blank'>" . esc_attr__('Get Token Access', 'massive-dynamic') . "</a>"
            ),
            array(
                'type' => 'textfield',
                "edit_field_class" => $filedClass . "first glue last",
                'param_name' => 'instagram_title',
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "value" => "Follow on Instagram",
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Options", 'massive-dynamic'),
                "param_name" => "category_group",
                "edit_field_class" => $filedClass . "glue first ",
            ),
            array(
                "type" => 'md_vc_slider',
                "heading" => esc_attr__("Image number", 'massive-dynamic'),
                "param_name" => "instagram_image_number",
                "value" => "4",
                "edit_field_class" => $filedClass . "glue first last",
                'defaultSetting' => array(
                    "min" => "1",
                    "max" => "50",
                    "prefix" => "",
                    "step" => '1',
                )
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "glue first",
                'heading' => esc_attr__('Show Header', 'massive-dynamic'),
                'param_name' => 'instagram_heading',
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
                'checked' => true,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "instagram_header_separator" . ++$separatorCounter,
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "glue",
                'heading' => esc_attr__('Show Like', 'massive-dynamic'),
                'param_name' => 'instagram_like',
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
                'checked' => true,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "instagram_like_separator" . ++$separatorCounter,
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Show Comments', 'massive-dynamic'),
                'param_name' => 'instagram_comment',
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
                'checked' => true,
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Colors", 'massive-dynamic'),
                "param_name" => "color_group",
                "edit_field_class" => $filedClass . "glue first ",
            ),
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("General", 'massive-dynamic'),
                "param_name" => "instagram_general_color",
                "value" => 'rgb(0,0,0)',
                "admin_label" => false,
                "opacity" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "instagram_general_color_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "last glue",
                "heading" => esc_attr__("Overlay", 'massive-dynamic'),
                "param_name" => "instagram_overlay_color",
                "value" => 'rgba(255,255,255,0.6)',
                "admin_label" => false,
                "opacity" => true,
            ),
            array(
                "type" => "md_vc_description",
                "param_name" => "instagram_shortcode_description",
                "admin_label" => false,
                "value" => '<ul><li>' . esc_attr__('Please note that when you change a value in Instagram shortcode, it takes a little time to apply changes. It\'s suggested to save and refresh the page.', 'massive-dynamic') . '</li></ul>',
            ),


        )
    )
);

pixflow_add_params('md_instagram', pixflow_addAnimationTab('md_instagram'));
