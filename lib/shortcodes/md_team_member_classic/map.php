<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Team member Style 1
/*-----------------------------------------------------------------------------------*/

pixflow_map(
    array(
        "name" => "Team Member Classic",
        "base" => "md_team_member_classic",
        "category" => esc_attr__('Business','massive-dynamic'),
        "allowed_container_element" => 'vc_row',
        "show_settings_on_create" => false,

        "params" => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Information", 'massive-dynamic'),
                "param_name" => "info_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Name", 'massive-dynamic'),
                "param_name" => "team_member_classic_title",
                'value' => 'John Parker!',
                "admin_label" => false,
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "team_member_styl1_separator" . ++$separatorCounter,
            ),

            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Job Title", 'massive-dynamic'),
                "param_name" => "team_member_classic_subtitle",
                'value' => 'writer',
                "admin_label" => false,
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "team_member_styl1_separator" . ++$separatorCounter,
            ),

            array(
                "type" => "textarea",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("About Member", 'massive-dynamic'),
                "param_name" => "team_member_classic_description",
                'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porta, mi ut facilisis ullamcorper, magna risus vehicula augue, eget faucibus.',
                "admin_label" => false,
            ),

            array(
                'type' => 'attach_image',
                'edit_field_class' => $filedClass . "glue first last",
                'heading' => esc_attr__('Choose Image', 'massive-dynamic'),
                'param_name' => 'team_member_classic_image',
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Colors", 'massive-dynamic'),
                "param_name" => "colors_group",
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Text", 'massive-dynamic'),
                "param_name" => "team_member_classic_texts_color",
                "admin_label" => false,
                'value' => '#fff'
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "team_member_styl1_separator" . ++$separatorCounter,
            ),

            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Overlay", 'massive-dynamic'),
                "param_name" => "team_member_classic_hover_color",
                "admin_label" => false,
                "opacity" => true,
                'value' => 'rgba(11, 171, 167, 0.85)'
            ),

            /* Socials tab */

            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Social Network 1", 'massive-dynamic'),
                "param_name" => "team_member_social_icon1",
                "group" => esc_attr__("Socials", 'massive-dynamic'),
                "admin_label" => false,
                "value" => "icon-facebook2"
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "team_member_styl1_separator" . ++$separatorCounter,
                'group' => esc_attr__('Socials', 'massive-dynamic'),
            ),

            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue last",

                "heading" => esc_attr__("Page Url", 'massive-dynamic'),
                "param_name" => "team_member_social_icon1_url",
                "value" => 'http://www.facebook.com',
                'group' => esc_attr__('Socials', 'massive-dynamic'),
                "admin_label" => false,
            ),

            array(
                "type" => "md_vc_iconpicker",

                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Social Network 2", 'massive-dynamic'),
                "param_name" => "team_member_social_icon2",
                'group' => esc_attr__('Socials', 'massive-dynamic'),
                "admin_label" => false,
                "value" => 'icon-twitter5',
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "team_member_styl1_separator" . ++$separatorCounter,
                'group' => esc_attr__('Socials', 'massive-dynamic'),
            ),

            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue last",

                "heading" => esc_attr__("Page Url", 'massive-dynamic'),
                "param_name" => "team_member_social_icon2_url",
                'value' => 'http://www.twitter.com',
                'group' => esc_attr__('Socials', 'massive-dynamic'),
                "admin_label" => false,
            ),

            array(
                "type" => "md_vc_iconpicker",

                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Social Network 3", 'massive-dynamic'),
                "param_name" => "team_member_social_icon3",
                'group' => esc_attr__('Socials', 'massive-dynamic'),
                "admin_label" => false,
                "value" => 'icon-google',
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "team_member_styl1_separator" . ++$separatorCounter,
                'group' => esc_attr__('Socials', 'massive-dynamic'),
            ),

            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue last",

                "heading" => esc_attr__("Page Url", 'massive-dynamic'),
                "param_name" => "team_member_social_icon3_url",
                'value' => 'http://www.google.com',
                'group' => esc_attr__('Socials', 'massive-dynamic'),
                "admin_label" => false,
            ),

            array(
                "type" => "md_vc_iconpicker",

                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Social Network 4", 'massive-dynamic'),
                "param_name" => "team_member_social_icon4",
                'group' => esc_attr__('Socials', 'massive-dynamic'),
                "admin_label" => false,
                "value" => 'icon-dribbble',
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "team_member_styl1_separator" . ++$separatorCounter,
                'group' => esc_attr__('Socials', 'massive-dynamic'),
            ),

            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue last",

                "heading" => esc_attr__("Page Url", 'massive-dynamic'),
                "param_name" => "team_member_social_icon4_url",
                'value' => 'http://www.dribbble.com',
                'group' => esc_attr__('Socials', 'massive-dynamic'),
                "admin_label" => false,
            ),

            array(
                "type" => "md_vc_iconpicker",

                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Social Network 5", 'massive-dynamic'),
                "param_name" => "team_member_social_icon5",
                'group' => esc_attr__('Socials', 'massive-dynamic'),
                "admin_label" => false,
                "value" => 'icon-instagram',
            ),

            array(
                "type" => 'md_vc_separator',
                "param_name" => "team_member_styl1_separator" . ++$separatorCounter,
                'group' => esc_attr__('Socials', 'massive-dynamic'),
            ),

            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue last",

                "heading" => esc_attr__("Page Url", 'massive-dynamic'),
                "param_name" => "team_member_social_icon5_url",
                'value' => 'http://www.instagram.com',
                'group' => esc_attr__('Socials', 'massive-dynamic'),
                "admin_label" => false,
            ),

        ),

    )
);

pixflow_add_params('md_team_member_classic', pixflow_addAnimationTab('md_team_member_classic'));
