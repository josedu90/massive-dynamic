<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------*/
/*  MD TEXT
/*-----------------------------------------------------------------------------------*/
global $separatorCounter;
$separatorCounter = 1;
$textParamArray = array(

    array(
        "type" => "dropdown",
        "heading" => esc_attr__("Alignment", 'massive-dynamic'),
        "param_name" => "md_text_alignment",
        "group" => esc_attr__("Design", 'massive-dynamic'),
        "edit_field_class" => $filedClass . "glue first last",
        "value" => array(
            esc_attr__("Left", 'massive-dynamic') => "left",
            esc_attr__("Center", 'massive-dynamic') => "center",
            esc_attr__("Right", 'massive-dynamic') => "right",

        ),
    ),

    array(
        "type" => "md_group_title",
        "heading" => esc_attr__("Line Height", 'massive-dynamic'),
        "param_name" => "line_height_group",
        "group" => esc_attr__("Design", 'massive-dynamic'),
        "edit_field_class" => $filedClass . "glue first last"
    ),

    array(
        'type' => 'md_vc_slider',
        "edit_field_class" => $filedClass . "glue first",
        'heading' => esc_attr__('Title ', 'massive-dynamic'),
        'param_name' => 'md_text_title_line_height',
        'value' => '40',
        "group" => esc_attr__("Design", 'massive-dynamic'),
        'defaultSetting' => array(
            "min" => "12",
            "max" => "120",
            "prefix" => " px",
            "step" => "1",
        )
    ),

    array(
        "type" => 'md_vc_separator',
        "edit_field_class" => $filedClass . "glue",
        "param_name" => "md_text_content_size_separator" . ++$separatorCounter,
        "group" => esc_attr__("Design", 'massive-dynamic'),
        "admin_label" => false,

    ),
    array(
        'type' => 'md_vc_slider',
        "edit_field_class" => $filedClass . "glue last",
        'heading' => esc_attr__('Description ', 'massive-dynamic'),
        'param_name' => 'md_text_desc_line_height',
        'value' => '21',
        "group" => esc_attr__("Design", 'massive-dynamic'),
        'defaultSetting' => array(
            "min" => "12",
            "max" => "120",
            "prefix" => " px",
            "step" => "1",
        )
    ),

    array(
        "type" => "md_group_title",
        "heading" => esc_attr__("Spacing", 'massive-dynamic'),
        "param_name" => "spacing_group",
        "group" => esc_attr__("Design", 'massive-dynamic'),
        "edit_field_class" => $filedClass . "glue first last"
    ),

    array(
        'type' => 'md_vc_slider',
        "edit_field_class" => $filedClass . "glue first",
        'heading' => esc_attr__('Title Bottom ', 'massive-dynamic'),
        'param_name' => 'md_text_title_bottom_space',
        'value' => '10',
        "group" => esc_attr__("Design", 'massive-dynamic'),
        'defaultSetting' => array(
            "min" => "0",
            "max" => "110",
            "prefix" => " px",
            "step" => "1",
        )
    ),
    array(
        "type" => 'md_vc_separator',
        "edit_field_class" => $filedClass . "glue",
        "param_name" => "separator". ++$separatorCounter ,
        "group" => esc_attr__("Design", 'massive-dynamic'),
        "admin_label" => false,
    ),
    array(
        'type' => 'md_vc_slider',
        "edit_field_class" => $filedClass . "glue",
        'heading' => esc_attr__('Separator Bottom ', 'massive-dynamic'),
        'param_name' => 'md_text_separator_bottom_space',
        'value' => '10',
        "group" => esc_attr__("Design", 'massive-dynamic'),
        'defaultSetting' => array(
            "min" => "0",
            "max" => "110",
            "prefix" => " px",
            "step" => "1",
        ),
        "dependency" => array(
            'element' => "md_text_title_separator",
            'value' => array('yes')
        )
    ),

    array(
        "type" => 'md_vc_separator',
        "edit_field_class" => $filedClass . "glue",
        "param_name" => "separator". ++$separatorCounter,
        "group" => esc_attr__("Design", 'massive-dynamic'),
        "admin_label" => false,
        "dependency" => array(
            'element' => "md_text_title_separator",
            'value' => array('yes')
        )
    ),
    array(
        'type' => 'md_vc_slider',
        "edit_field_class" => $filedClass . "glue last",
        'heading' => esc_attr__('Description Bottom', 'massive-dynamic'),
        'param_name' => 'md_text_description_bottom_space',
        'value' => '25',
        "group" => esc_attr__("Design", 'massive-dynamic'),
        'defaultSetting' => array(
            "min" => "0",
            "max" => "110",
            "prefix" => " px",
            "step" => "1",
        )
    ),

    array(
        "type" => "md_group_title",
        "heading" => esc_attr__("Seperator", 'massive-dynamic'),
        "param_name" => "seperator_group",
        "group" => esc_attr__("Design", 'massive-dynamic'),
        "edit_field_class" => $filedClass . "glue first last"
    ),

    array(
        'type' => 'md_vc_checkbox',
        "edit_field_class" => $filedClass . "glue first last",
        'heading' => esc_attr__('Separator', 'massive-dynamic'),
        'param_name' => 'md_text_title_separator',
        'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
        'checked' => true,
        "group" => esc_attr__("Design", 'massive-dynamic'),
    ),
    array(
        "type" => 'md_vc_separator',
        "edit_field_class" => $filedClass . "stick-to-top glue",
        "param_name" => "separator". ++$separatorCounter,
        "group" => esc_attr__("Design", 'massive-dynamic'),
        "admin_label" => false,
        "dependency" => array(
            'element' => "md_text_title_separator",
            'value' => array('yes')
        )
    ),
    array(
        'type' => 'md_vc_slider',
        "edit_field_class" => $filedClass . "glue",
        'heading' => esc_attr__('Width', 'massive-dynamic'),
        'param_name' => 'md_text_separator_width',
        'value' => '110',
        "group" => esc_attr__("Design", 'massive-dynamic'),
        'defaultSetting' => array(
            "min" => "1",
            "max" => "600",
            "prefix" => " px",
            "step" => "1",
        ),
        "dependency" => array(
            'element' => "md_text_title_separator",
            'value' => array('yes')
        )
    ),
    array(
        "type" => 'md_vc_separator',
        "edit_field_class" => $filedClass . "glue",
        "param_name" => "separator". ++$separatorCounter ,
        "group" => esc_attr__("Design", 'massive-dynamic'),
        "admin_label" => false,
        "dependency" => array(
            'element' => "md_text_title_separator",
            'value' => array('yes')
        )
    ),
    array(
        'type' => 'md_vc_slider',
        "edit_field_class" => $filedClass . "glue",
        'heading' => esc_attr__('height', 'massive-dynamic'),
        'param_name' => 'md_text_separator_height',
        'value' => '5',
        "group" => esc_attr__("Design", 'massive-dynamic'),
        'defaultSetting' => array(
            "min" => "1",
            "max" => "100",
            "prefix" => " px",
            "step" => "1",
        ),
        "dependency" => array(
            'element' => "md_text_title_separator",
            'value' => array('yes')
        )
    ),
    array(
        "type" => 'md_vc_separator',
        "edit_field_class" => $filedClass . "glue",
        "param_name" => "separator". ++$separatorCounter,
        "group" => esc_attr__("Design", 'massive-dynamic'),
        "admin_label" => false,
        "dependency" => array(
            'element' => "md_text_title_separator",
            'value' => array('yes')
        )
    ),
    array(
        "type" => "md_vc_colorpicker",
        "edit_field_class" => $filedClass . "glue last",
        "heading" => esc_attr__("Color", 'massive-dynamic'),
        "group" => esc_attr__("Design", 'massive-dynamic'),
        "param_name" => "md_text_separator_color",
        "admin_label" => false,
        "value" => "rgb(0, 255, 153)",
        "opacity" => true,
        "dependency" => array(
            'element' => "md_text_title_separator",
            'value' => array('yes')
        )

    ),//separator color

    array(
        "type" => "md_group_title",
        "heading" => esc_attr__("Style", 'massive-dynamic'),
        "param_name" => "title_style_group",
        "group" => esc_attr__("Title Option", 'massive-dynamic'),
        "edit_field_class" => $filedClass . "glue first last"
    ),

    array(
        "type" => "dropdown",
        "edit_field_class" => $filedClass . "first glue last   ",
        "heading" => esc_attr__("Title Style", 'massive-dynamic'),
        "param_name" => "md_text_style",
        "group" => esc_attr__("Title Option", 'massive-dynamic'),
        "value" => array(
            esc_attr__("Solid", 'massive-dynamic') => "solid",
            esc_attr__("Gradient", 'massive-dynamic') => "gradient",
            esc_attr__("Image", 'massive-dynamic') => "image",
        ),
    ),
    array(
        "type" => "md_vc_colorpicker",
        "edit_field_class" => $filedClass . " first glue last",
        "heading" => esc_attr__("Title Color", 'massive-dynamic'),
        "group" => esc_attr__("Title Option", 'massive-dynamic'),
        "param_name" => "md_text_solid_color",
        "value" => 'rgba(20,20,20,1)',
        "admin_label" => false,
        "opacity" => true,
        "dependency" => array(
            'element' => "md_text_style",
            'value' => array('solid')
        )
    ),
    array(
        "type" => "md_vc_gradientcolorpicker",
        "edit_field_class" => $filedClass . " first glue last",
        "heading" => esc_attr__("Title Gradient", 'massive-dynamic'),
        "param_name" => "md_text_gradient_color",
        "group" => esc_attr__("Title Option", 'massive-dynamic'),
        'dependency' => array(
            'element' => "md_text_style",
            'value' => array('gradient')
        ),
        'defaultColor' => (object)array(
            'color1' => '#8702ff',
            'color2' => '#06ff6e',
            'color1Pos' => '0',
            'color2Pos' => '100',
            'angle' => '0'),
    ),
    array(
        'type' => 'attach_image',
        "edit_field_class" => $filedClass . "first glue last",
        'heading' => esc_attr__('Title Image', 'massive-dynamic'),
        'param_name' => 'md_text_image_bg',
        "group" => esc_attr__("Title Option", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_style",
            'value' => array('image')
        ),
    ),
    array(
        'type' => 'md_vc_slider',
        "edit_field_class" => $filedClass . "glue first last dont-show",
        'heading' => esc_attr__('Title Size', 'massive-dynamic'),
        'param_name' => 'md_text_title_size',
        'value' => '32',
        "group" => esc_attr__("Title Option", 'massive-dynamic'),
        'defaultSetting' => array(
            "min" => "12",
            "max" => "120",
            "prefix" => " px",
            "step" => "1",
        )
    ),


    array(
        "type" => "md_group_title",
        "heading" => esc_attr__("Spacing", 'massive-dynamic'),
        "param_name" => "title_letter_space_group",
        "group" => esc_attr__("Title Option", 'massive-dynamic'),
        "edit_field_class" => $filedClass . "glue first last"
    ),

    array(
        'type' => 'md_vc_slider',
        "edit_field_class" => $filedClass . "first glue",
        'heading' => esc_attr__('Letter ', 'massive-dynamic'),
        'param_name' => 'md_text_letter_space',
        'value' => '0',
        "group" => esc_attr__("Title Option", 'massive-dynamic'),
        'defaultSetting' => array(
            "min" => "-2",
            "max" => "15",
            "prefix" => " px",
            "step" => "1",
        )
    ),
    array(
        "type" => 'md_vc_separator',
        "group" => esc_attr__("Title Option", 'massive-dynamic'),
        "param_name" => "md_text_letter_space_separator" . ++$separatorCounter,
    ),

    array(
        'type' => 'md_vc_slider',
        "group" => esc_attr__("Title Option", 'massive-dynamic'),
        "edit_field_class" => $filedClass . "glue",
        'heading' => esc_attr__('Hover Letter ', 'massive-dynamic'),
        'param_name' => 'md_text_hover_letter_space',
        'value' => '0',
        'defaultSetting' => array(
            "min" => "-2",
            "max" => "15",
            "prefix" => " px",
            "step" => "1",
        )
    ),
    array(
        "type" => 'md_vc_separator',
        "edit_field_class" => $filedClass . "glue",
        "group" => esc_attr__("Title Option", 'massive-dynamic'),
        "param_name" => "md_text_hover_letter_space_separator" . ++$separatorCounter,
    ),
    array(
        "type" => "dropdown",
        "heading" => esc_attr__("Easing", 'massive-dynamic'),
        "param_name" => "md_text_easing",
        "group" => esc_attr__("Title Option", 'massive-dynamic'),
        "edit_field_class" => $filedClass . "glue last",
        "value" => array(
            "easeOutCubic" => "cubic-bezier(0.215, 0.61, 0.355, 1)",
            "easeOutBack" => "cubic-bezier(0.175, 0.885, 0.32, 1.275);",
            "easeInOutQuint" => "cubic-bezier(0.86, 0, 0.07, 1);",
            "easeOutCirc" => "cubic-bezier(0.075, 0.82, 0.165, 1);",
        ),
    ),

    array(
        "type" => "md_group_title",
        "heading" => esc_attr__("Typography", 'massive-dynamic'),
        "param_name" => "title_font_group",
        "group" => esc_attr__("Title Option", 'massive-dynamic'),
        "edit_field_class" => $filedClass . "glue first last"
    ),

    array(
        'type' => 'md_vc_checkbox',
        "edit_field_class" => $filedClass . "first glue last",
        'heading' => esc_attr__('Use Custom font', 'massive-dynamic'),
        'param_name' => 'md_text_use_title_custom_font',
        'value' => array(esc_attr__('No', 'massive-dynamic') => 'no'),
        'checked' => false,
        "group" => esc_attr__("Title Option", 'massive-dynamic'),
    ),
    array(
        "type" => 'md_vc_separator',
        "edit_field_class" => $filedClass . "stick-to-top ",
        "param_name" => "md_text_use_title_custom_font_separator" . ++$separatorCounter,
        "group" => esc_attr__("Title Option", 'massive-dynamic'),
        "admin_label" => false,
        "mb_dependency" => array(
            'element' => "md_text_use_title_custom_font",
            'value' => array('yes')
        )
    ),
    array(
        'type' => 'google_fonts',
        'preview' => false,
        "edit_field_class" => $filedClass . "glue last",
        "group" => esc_attr__("Title Option", 'massive-dynamic'),
        'param_name' => 'md_text_title_google_fonts',
        'value' => 'font_family:Roboto%3A100%2C200%2C300%2Cregular%2C500%2C600%2C700%2C800%2C900|font_style:300%20light%20regular%3A300%3Anormal' ,
        'settings' => array(
            'fields' => array(
                'font_family_description' => esc_attr__('Font family', 'massive-dynamic'),
                'font_style_description' => esc_attr__('Font styling', 'massive-dynamic')
            )
        ),
        "mb_dependency" => array(
            'element' => "md_text_use_title_custom_font",
            'value' => array('yes')
        )
    ),
    array(
        "type" => "md_vc_description",
        "param_name" => "md_text_image_color_description",
        "admin_label" => false,
        "value" => '<ul><li>' . esc_attr__('Please note that title image only works in Google Chrome.', 'massive-dynamic') . ' </li></ul>',
        "group" => esc_attr__("Title Option", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_style",
            'value' => array('image')
        ),
    ),
    array(
        "type" => "md_vc_description",
        "param_name" => "md_text_style_description",
        "admin_label" => false,
        "value" => '<ul><li>' . esc_attr__('Please note that title gradient only works in Google Chrome.', 'massive-dynamic') . '</li></ul>',
        "group" => esc_attr__("Title Option", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_style",
            'value' => array('gradient')
        ),
    ),
    array(
        "type" => "dropdown",
        "heading" => esc_attr__("Title Number", 'massive-dynamic'),
        "param_name" => "md_text_number",
        "group" => esc_attr__("Titles", 'massive-dynamic'),
        "edit_field_class" => $filedClass . "glue first last",
        "value" => array(
            esc_attr__("One", 'massive-dynamic') => "1",
            esc_attr__("Two", 'massive-dynamic') => "2",
            esc_attr__("Three", 'massive-dynamic') => "3",
            esc_attr__("Four", 'massive-dynamic') => "4",
            esc_attr__("Five", 'massive-dynamic') => "5",
        ),
    ),
    array(
        "type" => "md_vc_base64_text",
        "edit_field_class" => $filedClass . "glue first last tinymce-editor",
        "heading" => esc_attr__("Title 1", 'massive-dynamic'),
        "param_name" => "md_text_title1",
        "admin_label" => false,
        "value" => "pixflow_base64VGV4dCBTaG9ydGNvZGU=", // <= Text Shortcode in Base64
        "group" => esc_attr__("Titles", 'massive-dynamic'),

    ),
    array(
        "type" => 'md_vc_separator',
        "edit_field_class" => $filedClass . "stick-to-top",
        "param_name" => "md_text_title1_separator" . ++$separatorCounter,
        "group" => esc_attr__("Titles", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_number",
            'value' => array('2', '3', '4', '5')
        )
    ),
    array(
        "type" => "textarea",
        "edit_field_class" => $filedClass . "glue last",
        "heading" => esc_attr__("Title 2", 'massive-dynamic'),
        "param_name" => "md_text_title2",
        "admin_label" => false,
        "value" => "Typography Shortcode",
        "group" => esc_attr__("Titles", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_number",
            'value' => array('2', '3', '4', '5')
        )
    ),
    array(
        "type" => 'md_vc_separator',
        "edit_field_class" => $filedClass . "stick-to-top",
        "param_name" => "md_text_title2_separator" . ++$separatorCounter,
        "group" => esc_attr__("Titles", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_number",
            'value' => array('3', '4', '5')
        )
    ),
    array(
        "type" => "textarea",
        "edit_field_class" => $filedClass . "glue last",
        "heading" => esc_attr__("Title 3", 'massive-dynamic'),
        "param_name" => "md_text_title3",
        "admin_label" => false,
        "value" => "Typography Shortcode",
        "group" => esc_attr__("Titles", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_number",
            'value' => array('3', '4', '5')
        )
    ),
    array(
        "type" => 'md_vc_separator',
        "edit_field_class" => $filedClass . "stick-to-top",
        "param_name" => "md_text_title3_separator" . ++$separatorCounter,
        "group" => esc_attr__("Titles", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_number",
            'value' => array('4', '5')
        )
    ),
    array(
        "type" => "textarea",
        "edit_field_class" => $filedClass . "glue last",
        "heading" => esc_attr__("Title 4", 'massive-dynamic'),
        "param_name" => "md_text_title4",
        "admin_label" => false,
        "value" => "Typography Shortcode",
        "group" => esc_attr__("Titles", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_number",
            'value' => array('4', '5')
        )
    ),
    array(
        "type" => 'md_vc_separator',
        "edit_field_class" => $filedClass . "stick-to-top",
        "param_name" => "md_text_title4_separator" . ++$separatorCounter,
        "group" => esc_attr__("Titles", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_number",
            'value' => array('5')
        )
    ),
    array(
        "type" => "textarea",
        "edit_field_class" => $filedClass . "glue last",
        "heading" => esc_attr__("Title 5", 'massive-dynamic'),
        "param_name" => "md_text_title5",
        "admin_label" => false,
        "value" => "Typography Shortcode",
        "group" => esc_attr__("Titles", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_number",
            'value' => array('5')
        )
    ),
    array(
        "type" => "md_vc_description",
        "param_name" => "md_text_title_description",
        "admin_label" => false,
        "value" => esc_attr__("If you choose more than 1 title (Title Slider Mode), you should open text settings panel to edit this shortcode.", 'massive-dynamic'),
        "group" => esc_attr__("Titles", 'massive-dynamic'),

    ),
    array(
        "type" => "md_vc_description",
        "param_name" => "md_text_title_description2",
        "admin_label" => false,
        "value" => esc_attr__("To break the text, you can use Enter key in textarea", 'massive-dynamic'),
        "group" => esc_attr__("Titles", 'massive-dynamic'),
    ),

    array(
        "type" => "textarea_html",
        "heading" => esc_attr__("Description", 'massive-dynamic'),
        "edit_field_class" => $filedClass . "glue first last tinymce-content-editor",
        "param_name" => "content",
        "admin_label" => false,
        "value" => "Meet the most advanced live website builder on WordPress.
        Featuring latest web technologies,enjoyable UX and the
         most beautiful design trends. Simply drag&drop elements",
        "description" => esc_attr__("Enter your content.", 'massive-dynamic'),
        "group" => esc_attr__("Description", 'massive-dynamic'),
    ),
    array(
        'type' => 'md_vc_slider',
        "edit_field_class" => $filedClass . "glue first last dont-show",
        'heading' => esc_attr__('Description Size', 'massive-dynamic'),
        'param_name' => 'md_text_content_size',
        'value' => '14',
        "group" => esc_attr__("Description", 'massive-dynamic'),
        'defaultSetting' => array(
            "min" => "10",
            "max" => "40",
            "prefix" => " px",
            "step" => "1",
        )
    ),
    array(
        "type" => "md_vc_colorpicker",
        "edit_field_class" => $filedClass . "first glue last dont-show",
        "heading" => esc_attr__("Description Color", 'massive-dynamic'),
        "group" => esc_attr__("Description", 'massive-dynamic'),
        "param_name" => "md_text_content_color",
        "value" => 'rgba(20,20,20,1)',
        "admin_label" => false,
        "opacity" => true,

    ),
    array(
        'type' => 'md_vc_checkbox',
        "edit_field_class" => $filedClass . "first glue last",
        'heading' => esc_attr__('Use Custom Font', 'massive-dynamic'),
        'param_name' => 'md_text_use_desc_custom_font',
        'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
        'checked' => false,
        "group" => esc_attr__("Description", 'massive-dynamic'),
    ),
    array(
        "type" => 'md_vc_separator',
        "edit_field_class" => $filedClass . "stick-to-top",
        "param_name" => "md_text_use_desc_custom_font_separator" . ++$separatorCounter,
        "group" => esc_attr__("Description", 'massive-dynamic'),
        "admin_label" => false,
        "mb_dependency" => array(
            'element' => "md_text_use_desc_custom_font",
            'value' => array('yes')
        )
    ),
    array(
        'type' => 'google_fonts',
        'preview' => false,
        "edit_field_class" => $filedClass . "glue last",
        "group" => esc_attr__("Description", 'massive-dynamic'),
        'param_name' => 'md_text_desc_google_fonts',
        'value' => 'font_family:Roboto%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C700%2C700italic%2C900%2C900italic|font_style:400%20regular%3A400%3Anormal',
        'settings' => array(
            'fields' => array(
                'font_family_description' => esc_attr__('Font family', 'massive-dynamic'),
                'font_style_description' => esc_attr__('Font styling', 'massive-dynamic')
            )
        ),
        "mb_dependency" => array(
            'element' => "md_text_use_desc_custom_font",
            'value' => array('yes')
        )
    ),

    array(
        'type' => 'md_vc_checkbox',
        "edit_field_class" => $filedClass . "first glue last",
        'heading' => esc_attr__('Activate', 'massive-dynamic'),
        'param_name' => 'md_text_use_button',
        'value' => array(esc_attr__('No', 'massive-dynamic') => 'no'),
        'checked' => false,
        "group" => esc_attr__("Button", 'massive-dynamic'),
    ),
    array(
        "type" => "md_vc_description",
        "param_name" => "md_title_bottom_space_description",
        "admin_label" => false,
        "value" => esc_attr__("Title bottom space will also affect separator bottom space.", 'massive-dynamic'),
        "group" => esc_attr__("Design", 'massive-dynamic'),
    ),

    array(
        "type" => "md_group_title",
        "heading" => esc_attr__("Style", 'massive-dynamic'),
        "param_name" => "button_style_group",
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "edit_field_class" => $filedClass . "glue first last",
        "dependency" => array(
            'element' => "md_text_use_button",
            'value' => array('yes')
        )
    ),

    //add btn
    array(
        "type" => "dropdown",
        "edit_field_class" => $filedClass . "glue first last",
        "separate" => true,
        "heading" => esc_attr__("Style", 'massive-dynamic'),
        "param_name" => "md_text_button_style",
        "description" => esc_attr__("Choose between five button style", 'massive-dynamic'),
        "admin_label" => false,
        "value" => array(
            esc_attr__("Fade Oval", 'massive-dynamic') => "fade-oval",
            esc_attr__("Fade Square", 'massive-dynamic') => "fade-square",
            esc_attr__("Slide", 'massive-dynamic') => "slide",
            esc_attr__("Fill Slide", 'massive-dynamic') => "come-in",
            esc_attr__("Animation", 'massive-dynamic') => "animation",
            esc_attr__("Flash Animate", 'massive-dynamic') => "flash-animate",
            esc_attr__("Fill Rectangle", 'massive-dynamic') => "fill-rectangle",
            esc_attr__("Fill Oval", 'massive-dynamic') => "fill-oval"
        ),
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_use_button",
            'value' => array('yes')
        )
    ),//btn kind
    array(
        "type" => "dropdown",
        "edit_field_class" => $filedClass . "glue first",
        "heading" => esc_attr__("Size", 'massive-dynamic'),
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "param_name" => "md_text_button_size",
        "admin_label" => false,
        "description" => esc_attr__("Choose between three button sizes", 'massive-dynamic'),
        "value" => array(
            esc_attr__("Standard", 'massive-dynamic') => "standard",
            esc_attr__("Small", 'massive-dynamic') => "small"
        ),
        "dependency" => array(
            'element' => "md_text_use_button",
            'value' => array('yes')
        )
    ),//btn size
    array(
        "type" => 'md_vc_separator',
        "param_name" => "md_text_button_text_separator". ++$separatorCounter ,
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_use_button",
            'value' => array('yes')
        )
    ),
    array(
        'type' => 'md_vc_slider',
        "edit_field_class" => $filedClass . "glue last",
        'heading' => esc_attr__('Padding', 'massive-dynamic'),
        'param_name' => 'left_right_padding',
        'value' => '0',
        "group" => esc_attr__("Button", 'massive-dynamic'),
        'defaultSetting' => array(
            "min" => "0",
            "max" => "300",
            "prefix" => " px",
            "step" => "1",
        ),
        "dependency" => array(
            'element' => "md_text_use_button",
            'value' => array('yes')
        )
    ),//spacing
    array(
        "type" => "md_group_title",
        "heading" => esc_attr__("Content", 'massive-dynamic'),
        "param_name" => "button_content_group",
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "edit_field_class" => $filedClass . "glue first last",
        "dependency" => array(
            'element' => "md_text_use_button",
            'value' => array('yes')
        )
    ),
    array(
        "type" => "textfield",
        "edit_field_class" => $filedClass . "glue first",
        "heading" => esc_attr__("Text", 'massive-dynamic'),
        "param_name" => "md_text_button_text",
        "description" => esc_attr__("Button text", 'massive-dynamic'),
        "admin_label" => false,
        "value" => 'READ MORE',
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_use_button",
            'value' => array('yes')
        )
    ),//btn text
    array(
        "type" => 'md_vc_separator',
        "param_name" => "md_text_button_text_separator". ++$separatorCounter ,
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_use_button",
            'value' => array('yes')
        )
    ),
    array(
        "type" => "md_vc_iconpicker",
        "edit_field_class" => $filedClass . "glue last",
        "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
        "param_name" => "md_text_button_icon_class",
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "admin_label" => false,
        "description" => esc_attr__("Select an icon that shown before text", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_use_button",
            'value' => array('yes')
        ),
        'value' => 'icon-angle-right'
    ),//btn icon

    array(
        "type" => "md_group_title",
        "heading" => esc_attr__("Appearance", 'massive-dynamic'),
        "param_name" => "button_appearance_group",
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "edit_field_class" => $filedClass . "glue first last",
        "dependency" => array(
            'element' => "md_text_use_button",
            'value' => array('yes')
        )
    ),
    array(
        "type" => "md_vc_colorpicker",
        "edit_field_class" => $filedClass . "glue first last",
        "heading" => esc_attr__("General Color", 'massive-dynamic'),
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "param_name" => "md_text_button_color",
        "admin_label" => false,
        "opacity" => true,
        "value" => "rgba(0,0,0,1)",
        "description" => esc_attr__("Enter optional button's color", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_use_button",
            'value' => array('yes')
        )
    ),//btn general color
    array(
        "type" => 'md_vc_separator',
        "param_name" => "md_text_button_color_separator". ++$separatorCounter,
        "edit_field_class" => $filedClass . "stick-to-top",
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_button_style",
            'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
        ),
    ),//separator
    array(
        "type" => "md_vc_colorpicker",
        "edit_field_class" => $filedClass . "glue ",
        "heading" => esc_attr__("Text Color", 'massive-dynamic'),
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "param_name" => "md_text_button_text_color",
        "admin_label" => false,
        "opacity" => true,
        "value" => "rgba(255,255,255,1)",
        "description" => esc_attr__("Enter optional button's color", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_button_style",
            'value' => array('fill-oval', 'fill-rectangle'),
        ),
    ),//btn text color
    array(
        "type" => 'md_vc_separator',
        "param_name" => "md_text_button_color_separator". ++$separatorCounter,
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_button_style",
            'value' => array('fill-oval', 'fill-rectangle'),
        ),
    ),//separator
    array(
        "type" => "md_vc_colorpicker",
        "edit_field_class" => $filedClass . "glue",
        "heading" => esc_attr__("Bg Hover Color", 'massive-dynamic'),
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "param_name" => "md_text_button_bg_hover_color",
        "admin_label" => false,
        "value" => "rgb(0,0,0)",
        "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_button_style",
            'value' => array('fill-oval', 'fill-rectangle'),
        ),

    ),//btn bg hover color
    array(
        "type" => 'md_vc_separator',
        "param_name" => "md_text_button_color_separator". ++$separatorCounter,
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_button_style",
            'value' => array('fill-oval', 'fill-rectangle')
        )
    ),//separator
    array(
        "type" => "md_vc_colorpicker",
        "edit_field_class" => $filedClass . "glue last",
        "heading" => esc_attr__("Text Hover Color", 'massive-dynamic'),
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "param_name" => "md_text_button_hover_color",
        "admin_label" => false,
        "value" => "rgb(255,255,255)",
        "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_button_style",
            'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
        ),

    ),//btn text hover color


    array(
        "type" => "md_group_title",
        "heading" => esc_attr__("Link", 'massive-dynamic'),
        "param_name" => "button_link_group",
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "edit_field_class" => $filedClass . "glue first last",
        "dependency" => array(
            'element' => "md_text_use_button",
            'value' => array('yes')
        )
    ),

    array(
        "type" => "textfield",
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "edit_field_class" => $filedClass . "glue first",
        "heading" => esc_attr__("Link URL", 'massive-dynamic'),
        "param_name" => "md_text_button_url",
        "admin_label" => false,
        "value" => "#",
        "description" => esc_attr__("Button destination URL", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_use_button",
            'value' => array('yes')
        )
    ),//btn url
    array(
        "type" => 'md_vc_separator',
        "param_name" => "md_text_button_linkr_separator". ++$separatorCounter ,
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "dependency" => array(
            'element' => "md_text_use_button",
            'value' => array('yes')
        )
    ),//separator
    array(
        "type" => "dropdown",
        "edit_field_class" => $filedClass . "glue last",
        "heading" => esc_attr__("Link's target", 'massive-dynamic'),
        "group" => esc_attr__("Button", 'massive-dynamic'),
        "param_name" => "md_text_button_target",
        "admin_label" => false,
        "description" => esc_attr__("Open the link in the same tab or a blank browser tab", 'massive-dynamic'),
        "value" => array(
            esc_attr__("Open in same window", 'massive-dynamic') => "_self",
            esc_attr__("Open in new window", 'massive-dynamic') => "_blank"
        ),
        "dependency" => array(
            'element' => "md_text_use_button",
            'value' => array('yes')
        )
    ),//btn target

);
pixflow_map(
    array(
        "name" => "Rich Text",
        "base" => "md_text",
        "category" => esc_attr__('Basic', 'massive-dynamic'),
        'show_settings_on_create' => false,
        "allowed_container_element" => 'vc_row',
        "params" => $textParamArray
    )
);
pixflow_map(
    array(
        'base' => 'vc_column_text',
        'name' => esc_attr__('Text', 'massive-dynamic'),
        "category" => esc_attr__('Business', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "allowed_container_element" => 'vc_row',
        "params" => $textParamArray
    )
);

pixflow_add_params('md_text', pixflow_addAnimationTab('md_text'));