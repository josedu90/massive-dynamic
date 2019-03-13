<?php
/**
 * Pixflow
 */


/****************************team member new*********************************************/
$filed_class = 'vc_col-sm-12 vc_column ';
$separator_counter = 0;
pixflow_map(
    array(
        "name" => "Team Member Modern",
        "base" => "md_team_member_modern",
        "category" => esc_attr__('Business','massive-dynamic'),
        "allowed_container_element" => 'vc_row',
        "show_settings_on_create" => false,
        "params" => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Content", 'massive-dynamic'),
                "param_name" => "content_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filed_class . "first glue",
                "heading" => esc_attr__("Name", 'massive-dynamic'),
                "param_name" => "team_member_modern_title",
                'value' => 'Maria Guerra',
                "admin_label" => false,
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "team_member_styl1_separator" . ++$separator_counter,
            ),

            array(
                "type" => "textfield",
                "edit_field_class" => $filed_class . "glue",
                "heading" => esc_attr__("Job Title", 'massive-dynamic'),
                "param_name" => "team_member_modern_subtitle",
                'value' => 'Finance Manager',
                "admin_label" => false,
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "team_member_styl1_separator" . ++$separator_counter,
            ),

            array(
                "type" => "textarea",
                "edit_field_class" => $filed_class . "glue last",
                "heading" => esc_attr__("About Member", 'massive-dynamic'),
                "param_name" => "team_member_modern_description",
                'value' => 'Hello, my name is Maria Guerra, I\'m a Finance Manager at Pixflow.',
                "admin_label" => false,
            ),

            array(
                'type' => 'attach_image',
                'edit_field_class' => $filed_class . "glue first last",
                'heading' => esc_attr__('Choose Image', 'massive-dynamic'),
                'param_name' => 'team_member_modern_image',

            ),

            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Color", 'massive-dynamic'),
                "param_name" => "color_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filed_class . "first glue last",
                "heading" => esc_attr__("Overlay", 'massive-dynamic'),
                "param_name" => "team_member_modern_hover_color",
                "admin_label" => false,
                'value' => '#1c61a8'
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Social Network 1", 'massive-dynamic'),
                "param_name" => "sn1_group",
                "group" => esc_attr__("Social Icons", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filed_class . "glue first",
                "heading" => esc_attr__("Icon", 'massive-dynamic'),
                "param_name" => "team_member_modern_icon1",
                "group" => esc_attr__("Social Icons", 'massive-dynamic'),
                "admin_label" => false,
                "value" => "icon-facebook2"
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "team_member_styl1_separator" . ++$separator_counter,
                'group' => esc_attr__('Social Icons', 'massive-dynamic'),
            ),

            array(
                "type" => "textfield",
                "edit_field_class" => $filed_class . "glue last",
                "heading" => esc_attr__("URL", 'massive-dynamic'),
                "param_name" => "team_member_modern_icon1_url",
                "value" => 'http://www.facebook.com',
                'group' => esc_attr__('Social Icons', 'massive-dynamic'),
                "admin_label" => false,
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Social Network 2", 'massive-dynamic'),
                "param_name" => "sn2_group",
                "group" => esc_attr__("Social Icons", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "md_vc_iconpicker",

                "edit_field_class" => $filed_class . "glue first",
                "heading" => esc_attr__("Icon", 'massive-dynamic'),
                "param_name" => "team_member_modern_icon2",
                'group' => esc_attr__('Social Icons', 'massive-dynamic'),
                "admin_label" => false,
                "value" => 'icon-twitter5',
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "team_member_styl1_separator" . ++$separator_counter,
                'group' => esc_attr__('Social Icons', 'massive-dynamic'),
            ),

            array(
                "type" => "textfield",
                "edit_field_class" => $filed_class . "glue last",

                "heading" => esc_attr__("URL", 'massive-dynamic'),
                "param_name" => "team_member_modern_icon2_url",
                'value' => 'http://www.twitter.com',
                'group' => esc_attr__('Social Icons', 'massive-dynamic'),
                "admin_label" => false,
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Social Network 3", 'massive-dynamic'),
                "param_name" => "sn1_group",
                "group" => esc_attr__("Social Icons", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filed_class . "glue first",
                "heading" => esc_attr__("Icon", 'massive-dynamic'),
                "param_name" => "team_member_modern_icon3",
                'group' => esc_attr__('Social Icons', 'massive-dynamic'),
                "admin_label" => false,
                "value" => 'icon-google',
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "team_member_styl1_separator" . ++$separator_counter,
                'group' => esc_attr__('Social Icons', 'massive-dynamic'),
            ),

            array(
                "type" => "textfield",
                "edit_field_class" => $filed_class . "glue last",

                "heading" => esc_attr__("URL", 'massive-dynamic'),
                "param_name" => "team_member_modern_icon3_url",
                'value' => 'http://www.google.com',
                'group' => esc_attr__('Social Icons', 'massive-dynamic'),
                "admin_label" => false,
            ),


        ),

    )
);

pixflow_add_params('md_team_member_modern', pixflow_addAnimationTab('md_team_member_modern'));