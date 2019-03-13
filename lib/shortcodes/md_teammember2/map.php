<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Team Member Style 2
/*-----------------------------------------------------------------------------------*/

function pixflow_team_member2_param()
{

    $filedClass = 'vc_col-sm-12 vc_column ';
    $separatorCounter = 0;
    $members_param = 'team_member_style2_num';
    $members_num = 12;
    $dropDown = array(
        esc_attr__("Eight", 'massive-dynamic') => 8,
        esc_attr__("One", 'massive-dynamic') => 1,
        esc_attr__("Two", 'massive-dynamic') => 2,
        esc_attr__("Three", 'massive-dynamic') => 3,
        esc_attr__("Four", 'massive-dynamic') => 4,
        esc_attr__("Five", 'massive-dynamic') => 5,
        esc_attr__("Six", 'massive-dynamic') => 6,
        esc_attr__("Seven", 'massive-dynamic') => 7,
        esc_attr__("Nine", 'massive-dynamic') => 9,
        esc_attr__("Ten", 'massive-dynamic') => 10,
        esc_attr__("Eleven", 'massive-dynamic') => 11,
        esc_attr__("Twelve", 'massive-dynamic') => 12,
    );

    $param = array(

        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Content", 'massive-dynamic'),
            "param_name" => "content_group",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "edit_field_class" => $filedClass . "glue first last"
        ),
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue first last",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Number Of Members:", 'massive-dynamic'),
            "param_name" => $members_param,
            "admin_label" => false,
            "value" => $dropDown
        ),
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Appearance", 'massive-dynamic'),
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "app_group",
            "edit_field_class" => $filedClass . "glue first last"
        ),
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue first",
            "heading" => esc_attr__("Text Color", 'massive-dynamic'),
            "param_name" => "team_member_style2_texts_color",
            "admin_label" => false,
            'value' => '#fff',
            "group" => esc_attr__("General", 'massive-dynamic'),
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "team_member_style2_separator" . ++$separatorCounter,
            "group" => esc_attr__("General", 'massive-dynamic'),
        ),
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Overlay Text Color", 'massive-dynamic'),
            "param_name" => "team_member_style2_hover_color",
            "admin_label" => false,
            'value' => 'rgba(255, 255, 255, 1)',
            "group" => esc_attr__("General", 'massive-dynamic'),
        )
    );
    $s = 1;
    for ($i = 1; $i <= (int)$members_num; $i++) {
        $value = array();

        for ($k = $i; $k <= $members_num; $k++) {
            $value[] = (string)$k;
        }

        $param[] = array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Information", 'massive-dynamic'),
            "param_name" => "information_group".$i,
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            "edit_field_class" => $filedClass . "glue first last",
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            )
        );

        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "first glue",
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Name", 'massive-dynamic'),
            "param_name" => "team_member_style2_name_" . $i,
            "value" => 'Member' . $i,
            "admin_label" => false,
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            "param_name" => "team_member_style2_" . $i . "_separator" . ++$separatorCounter,
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue",

            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Job Title", 'massive-dynamic'),
            "param_name" => "team_member_style2_position_" . $i,
            "value" => 'Manager',
            "admin_label" => false,
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            "param_name" => "team_member_style2_" . $i . "_separator" . ++$separatorCounter,
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => "textarea",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("About Member", 'massive-dynamic'),
            "param_name" => "team_member_style2_description_" . $i,
            'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porta, mi ut facilisis ullamcorper.',
            "admin_label" => false,
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );

        $param[] = array(
            'type' => 'attach_image',
            'edit_field_class' => $filedClass . "glue first last",
            'heading' => esc_attr__('Choose Image', 'massive-dynamic'),
            'param_name' => 'team_member_style2_image_' . $i,
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Socials", 'massive-dynamic'),
            "param_name" => "socials_group".$i,
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            "edit_field_class" => $filedClass . "glue first last",
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            )
        );

        $param[] = array(
            "type" => "md_vc_iconpicker",
            "edit_field_class" => $filedClass . "glue first",
            "heading" => esc_attr__("Social Network 1", 'massive-dynamic'),
            "param_name" => "team_member_style2_social_icon_" . $s,
            "admin_label" => false,
            "value" => "icon-facebook2",
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => 'md_vc_separator',
            "param_name" => "team_member_style2_separator" . ++$separatorCounter,
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue last",

            "heading" => esc_attr__("Page Url", 'massive-dynamic'),
            "param_name" => "team_member_style2_social_icon_url_" . $s++,
            "value" => 'http://www.facebook.com',
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            "admin_label" => false,
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "md_vc_iconpicker",

            "edit_field_class" => $filedClass . "glue first",
            "heading" => esc_attr__("Social Network 2", 'massive-dynamic'),
            "param_name" => "team_member_style2_social_icon_" . $s,
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            "admin_label" => false,
            "value" => 'icon-twitter5',
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "param_name" => "team_member_style2_separator" . ++$separatorCounter,
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue last",

            "heading" => esc_attr__("Page Url", 'massive-dynamic'),
            "param_name" => "team_member_style2_social_icon_url_" . $s++,
            'value' => 'http://www.twitter.com',
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            "admin_label" => false,
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "md_vc_iconpicker",

            "edit_field_class" => $filedClass . "glue first",
            "heading" => esc_attr__("Social Network 3", 'massive-dynamic'),
            "param_name" => "team_member_style2_social_icon_" . $s,
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            "admin_label" => false,
            "value" => 'icon-google',
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => 'md_vc_separator',
            "param_name" => "team_member_style2_separator" . ++$separatorCounter,
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue last",

            "heading" => esc_attr__("Page Url", 'massive-dynamic'),
            "param_name" => "team_member_style2_social_icon_url_" . $s++,
            'value' => 'http://www.google.com',
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            "admin_label" => false,
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "md_vc_iconpicker",

            "edit_field_class" => $filedClass . "glue first",
            "heading" => esc_attr__("Social Network 4", 'massive-dynamic'),
            "param_name" => "team_member_style2_social_icon_" . $s,
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            "admin_label" => false,
            "value" => 'icon-dribbble',
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => 'md_vc_separator',
            "param_name" => "team_member_style2_separator" . ++$separatorCounter,
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue last",

            "heading" => esc_attr__("Page Url", 'massive-dynamic'),
            "param_name" => "team_member_style2_social_icon_url_" . $s++,
            'value' => 'http://www.dribbble.com',
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            "admin_label" => false,
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "md_vc_iconpicker",

            "edit_field_class" => $filedClass . "glue first",
            "heading" => esc_attr__("Social Network 5", 'massive-dynamic'),
            "param_name" => "team_member_style2_social_icon_" . $s,
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            "admin_label" => false,
            "value" => 'icon-instagram',
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => 'md_vc_separator',
            "param_name" => "team_member_style2_separator" . ++$separatorCounter,
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );
        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue last",

            "heading" => esc_attr__("Page Url", 'massive-dynamic'),
            "param_name" => "team_member_style2_social_icon_url_" . $s++,
            'value' => 'http://www.instagram.com',
            "group" => esc_attr__("Member ", 'massive-dynamic') . $i,
            "admin_label" => false,
            'dependency' => array(
                'element' => $members_param,
                'value' => $value
            ),
        );

    }
    return $param;
}

pixflow_map(
    array(
        "name" => "Team Carousel",
        "base" => "md_teammember2",
        "category" => esc_attr__('Business','massive-dynamic'),
        "show_settings_on_create" => false,
        "params" => pixflow_team_member2_param(),

    )
);

pixflow_add_params('md_teammember2', pixflow_addAnimationTab('md_teammember2'));
