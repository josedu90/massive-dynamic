<?php
/**
 * Pixflow
 */



/*-----------------------------------------------------------------------------------*/
/*  Showcase
/*-----------------------------------------------------------------------------------*/
global $separatorCounter;
$separatorCounter = 1;
pixflow_map(
    array(
        'base' => 'md_showcase',
        'name' => esc_attr__('Showcase', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__('Media','massive-dynamic'),
        'params' => array(

            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue first last",

                "heading" => esc_attr__("Image Number", 'massive-dynamic'),
                "param_name" => "showcase_count",
                "admin_label" => false,
                "value" => array(
                    esc_attr__("Three", 'massive-dynamic') => "three",
                    esc_attr__("Five", 'massive-dynamic') => "five"
                ),
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Featured", 'massive-dynamic'),
                "param_name" => "featured_group",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                "type" => "attach_image",
                "edit_field_class" => $filedClass . "first glue",

                "heading" => esc_attr__("Image", 'massive-dynamic'),
                "param_name" => "showcase_featured_image",
                "admin_label" => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "showcase_separator". ++$separatorCounter,
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . " glue last",
                'heading' => esc_attr__('Meta Box', 'massive-dynamic'),
                'param_name' => 'showcase_meta1',
                'value' => array(esc_attr__('No', 'massive-dynamic') => 'no'),
                'checked' => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "showcase_separator". ++$separatorCounter,
                "dependency" => Array(
                    'element' => "showcase_meta1",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "param_name" => "showcase_title1",
                "admin_label" => false,
                "value" => 'title',
                "dependency" => Array(
                    'element' => "showcase_meta1",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "showcase_separator". ++$separatorCounter,
                "dependency" => Array(
                    'element' => "showcase_meta1",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Subtitle", 'massive-dynamic'),
                "param_name" => "showcase_subtitle1",
                "admin_label" => false,
                "value" => 'subtitle',
                "dependency" => Array(
                    'element' => "showcase_meta1",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "showcase_separator". ++$separatorCounter,
                "dependency" => Array(
                    'element' => "showcase_meta1",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Border Color", 'massive-dynamic'),
                "param_name" => "showcase_border_color1",
                "value" => 'rgb(255,255,255)',
                "admin_label" => false,
                "opacity" => true,
                "dependency" => Array(
                    'element' => "showcase_meta1",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Image 1", 'massive-dynamic'),
                "param_name" => "image1_group",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                "type" => "attach_image",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Image", 'massive-dynamic'),
                "param_name" => "showcase_image1",
                "admin_label" => false,
                "dependency" => Array(
                    'element' => "showcase_count",
                    'value' => array('three', 'five')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "showcase_separator". ++$separatorCounter,
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . " glue last",
                'heading' => esc_attr__('Meta Box', 'massive-dynamic'),
                'param_name' => 'showcase_meta2',
                'value' => array(esc_attr__('No', 'massive-dynamic') => 'no'),
                'checked' => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "showcase_separator". ++$separatorCounter,
                "dependency" => Array(
                    'element' => "showcase_meta2",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "param_name" => "showcase_title2",
                "admin_label" => false,
                "value" => 'title',
                "dependency" => Array(
                    'element' => "showcase_meta2",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "showcase_separator". ++$separatorCounter,
                "dependency" => Array(
                    'element' => "showcase_meta2",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Subtitle", 'massive-dynamic'),
                "param_name" => "showcase_subtitle2",
                "admin_label" => false,
                "value" => 'subtitle',
                "dependency" => Array(
                    'element' => "showcase_meta2",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "showcase_separator". ++$separatorCounter,
                "dependency" => Array(
                    'element' => "showcase_meta2",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Border Color", 'massive-dynamic'),
                "param_name" => "showcase_border_color2",
                "value" => 'rgb(255,255,255)',
                "admin_label" => false,
                "opacity" => true,
                "dependency" => Array(
                    'element' => "showcase_meta2",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Image 2", 'massive-dynamic'),
                "param_name" => "image2_group",
                "edit_field_class" => $filedClass . "glue first last",
            ),
            array(
                "type" => "attach_image",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Image", 'massive-dynamic'),
                "param_name" => "showcase_image2",
                "admin_label" => false,
                "dependency" => Array(
                    'element' => "showcase_count",
                    'value' => array('three', 'five')
                )
            ),//for three
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "showcase_separator". ++$separatorCounter,
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . " glue last",
                'heading' => esc_attr__('Meta Box', 'massive-dynamic'),
                'param_name' => 'showcase_meta3',
                'value' => array(esc_attr__('No', 'massive-dynamic') => 'no'),
                'checked' => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "showcase_separator". ++$separatorCounter,
                "dependency" => Array(
                    'element' => "showcase_meta3",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "param_name" => "showcase_title3",
                "admin_label" => false,
                "value" => 'title',
                "dependency" => Array(
                    'element' => "showcase_meta3",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "showcase_separator". ++$separatorCounter,
                "dependency" => Array(
                    'element' => "showcase_meta3",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Subtitle", 'massive-dynamic'),
                "param_name" => "showcase_subtitle3",
                "admin_label" => false,
                "value" => 'subtitle',
                "dependency" => Array(
                    'element' => "showcase_meta3",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "showcase_separator". ++$separatorCounter,
                "dependency" => Array(
                    'element' => "showcase_meta3",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Border Color", 'massive-dynamic'),
                "param_name" => "showcase_border_color3",
                "value" => 'rgb(255,255,255)',
                "admin_label" => false,
                "opacity" => true,
                "dependency" => Array(
                    'element' => "showcase_meta3",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Image 3", 'massive-dynamic'),
                "param_name" => "image3_group",
                "edit_field_class" => $filedClass . "glue first last",
                "dependency" => Array(
                    'element' => "showcase_count",
                    'value' => array('five')
                )
            ),
            array(
                "type" => "attach_image",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Image", 'massive-dynamic'),
                "param_name" => "showcase_image3",
                "admin_label" => false,
                "dependency" => Array(
                    'element' => "showcase_count",
                    'value' => array('five')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "showcase_separator". ++$separatorCounter,
                "dependency" => Array(
                    'element' => "showcase_count",
                    'value' => array('five')
                )
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . " glue last",
                'heading' => esc_attr__('Meta Box', 'massive-dynamic'),
                'param_name' => 'showcase_meta4',
                'value' => array(esc_attr__('No', 'massive-dynamic') => 'no'),
                'checked' => false,
                "dependency" => Array(
                    'element' => "showcase_count",
                    'value' => array('five')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "showcase_separator". ++$separatorCounter,
                "dependency" => Array(
                    'element' => "showcase_meta4",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "param_name" => "showcase_title4",
                "admin_label" => false,
                "value" => 'title',
                "dependency" => Array(
                    'element' => "showcase_meta4",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "showcase_separator". ++$separatorCounter,
                "dependency" => Array(
                    'element' => "showcase_meta4",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Subtitle", 'massive-dynamic'),
                "param_name" => "showcase_subtitle4",
                "admin_label" => false,
                "value" => 'subtitle',
                "dependency" => Array(
                    'element' => "showcase_meta4",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "showcase_separator". ++$separatorCounter,
                "dependency" => Array(
                    'element' => "showcase_meta4",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Border Color", 'massive-dynamic'),
                "param_name" => "showcase_border_color4",
                "value" => 'rgb(255,255,255)',
                "admin_label" => false,
                "opacity" => true,
                "dependency" => Array(
                    'element' => "showcase_meta4",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Image 4", 'massive-dynamic'),
                "param_name" => "image4_group",
                "edit_field_class" => $filedClass . "glue first last",
                "dependency" => Array(
                    'element' => "showcase_count",
                    'value' => array('five')
                )
            ),
            array(
                "type" => "attach_image",
                "edit_field_class" => $filedClass . "first glue last",
                "heading" => esc_attr__("Image", 'massive-dynamic'),
                "param_name" => "showcase_image4",
                "admin_label" => false,
                "dependency" => Array(
                    'element' => "showcase_count",
                    'value' => array('five')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "showcase_separator". ++$separatorCounter,
                "dependency" => Array(
                    'element' => "showcase_count",
                    'value' => array('five')
                )
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . " glue last",
                'heading' => esc_attr__('Meta Box', 'massive-dynamic'),
                'param_name' => 'showcase_meta5',
                'value' => array(esc_attr__('No', 'massive-dynamic') => 'no'),
                'checked' => false,
                "dependency" => Array(
                    'element' => "showcase_count",
                    'value' => array('five')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "edit_field_class" => $filedClass . "stick-to-top",
                "param_name" => "showcase_separator". ++$separatorCounter,
                "dependency" => Array(
                    'element' => "showcase_meta5",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Title", 'massive-dynamic'),
                "param_name" => "showcase_title5",
                "admin_label" => false,
                "value" => 'title',
                "dependency" => Array(
                    'element' => "showcase_meta5",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "showcase_separator". ++$separatorCounter,
                "dependency" => Array(
                    'element' => "showcase_meta5",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Subtitle", 'massive-dynamic'),
                "param_name" => "showcase_subtitle5",
                "admin_label" => false,
                "value" => 'subtitle',
                "dependency" => Array(
                    'element' => "showcase_meta5",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "showcase_separator". ++$separatorCounter,
                "dependency" => Array(
                    'element' => "showcase_meta5",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Border Color", 'massive-dynamic'),
                "param_name" => "showcase_border_color5",
                "value" => 'rgb(255,255,255)',
                "admin_label" => false,
                "opacity" => true,
                "dependency" => Array(
                    'element' => "showcase_meta5",
                    'value' => array('yes')
                )
            ),
            array(
                "type" => "md_vc_description",
                "param_name" => "showcase_description",
                "admin_label" => false,
                "value" => wp_kses(__("<span>Tip:</span><ul><li>This Shortcode is only designed for 12 columns (1/1 or full-width column), don't use it in less than 12 columns.</li><li>To see how the showcase appears, save your changes in builder and check your website outside builder area.</li></ul>", 'massive-dynamic'), array('span' => array(), 'ul' => array(), 'li' => array())),
            ),
        )
    )
);

pixflow_add_params('md_showcase', pixflow_addAnimationTab('md_showcase'));
