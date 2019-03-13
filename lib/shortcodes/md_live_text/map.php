<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  MD LIVE TEXT
/*-----------------------------------------------------------------------------------*/
pixflow_map(
    array(
        "name" => "Text",
        "base" => "md_live_text",
        "category" => esc_attr__('Basic','massive-dynamic'),
        "allowed_container_element" => 'vc_row',
        "show_settings_on_create" => false,
        "params" => array(
            array(
                "type" => "textarea_html",
                "heading" => esc_attr__("Description", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last dont-show hidden ",
                "param_name" => "content",
                "admin_label" => false,
                "value" => 'PHNwYW4gc3R5bGU9ImZvbnQtc2l6ZToyMHB4Ij5DbGljayBoZXJlIHRvIGVkaXQuPC9zcGFuPg==' ,
                "description" => esc_attr__("Enter your content.", 'massive-dynamic'),
                "group" => esc_attr__("Animation" , 'massive-dynamic'),
            ),
            array(
                "type" => "md_vc_slider",
                "edit_field_class" => $filedClass . "glue first last dont-show hidden",
                "heading" => esc_attr__("letter-spacing", 'massive-dynamic'),
                "param_name" => "meditor_letter_spacing",
                "admin_label" => false,
                "value" => "1",
                "group" => esc_attr__("Animation" , 'massive-dynamic'),
                'defaultSetting' => array(
                    "min" => "0",
                    "max" => "100",
                    "prefix" => " px",
                )
            ),
            array(
                "type" => "md_vc_slider",
                "edit_field_class" => $filedClass . "glue first last  dont-show hidden",
                "heading" => esc_attr__("line-height", 'massive-dynamic'),
                "param_name" => "meditor_line_height",
                "admin_label" => false,
                "value" => "1.5",
                "group" => esc_attr__("Animation" , 'massive-dynamic'),
                'defaultSetting' => array(
                    "min" => "0",
                    "max" => "100",
                    "prefix" => " px",
                )
            ),
        )
    )
);

pixflow_add_params('md_live_text', pixflow_addAnimationTab('md_live_text'));
pixflow_add_params( 'md_live_text' , array(
	array(
		"type" => "md_vc_description",
		"param_name" => "md_simple_text_description",
		"admin_label" => false,
		"value" => esc_attr__( "This shortcode setting and content is only accessible in Massive Builder , please open your page with Massive Bulder to use this shortcode." , 'massive-dynamic' ),
		"group" => esc_attr__( "Animation" , 'massive-dynamic' ),
	)
));