<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Full width BUTTON
/*-----------------------------------------------------------------------------------*/
global $separatorCounter;
$separatorCounter = 1 ;
pixflow_map(

	array(
		"name" => "Full Width Button",
		"base" => "md_full_button",
		"category" => esc_attr__('Business', 'massive-dynamic'),
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
				"edit_field_class" => $filedClass . "first glue",
				"heading" => esc_attr__("Text", 'massive-dynamic'),
				"param_name" => "full_button_text",
				"admin_label" => false,
				"value" => esc_attr__('Read more', 'massive-dynamic')
			),
			array(
				"type" => 'md_vc_separator',
				"param_name" => ++$separatorCounter,
			),

			array(
				"type" => "dropdown",
				"edit_field_class" => $filedClass . "glue last",
				"heading" => esc_attr__("Title Typography", 'massive-dynamic'),
				"param_name" => "full_button_heading",
				"description" => esc_attr__("Choose your heading", 'massive-dynamic'),
				"admin_label" => false,
				"value" => array(
					"H3" => "h3",
					"H1" => "h1",
					"H2" => "h2",
					"H4" => "h4",
					"H5" => "h5",
					"H6" => "h6"
				),
			),
			array(
				"type" => "md_group_title",
				"heading" => esc_attr__("Sizing", 'massive-dynamic'),
				"param_name" => "sizing_group",
				"edit_field_class" => $filedClass . "glue first last"
			),
			array(
				'type' => 'md_vc_slider',
				"edit_field_class" => $filedClass . "first glue ",
				'heading' => esc_attr__('Button Height', 'massive-dynamic'),
				'param_name' => 'full_button_height',
				'value' => '90',
				'defaultSetting' => array(
					"min" => "50",
					"max" => "500",
					"prefix" => " px",
					"step" => "1",
				)
			),
			array(
				"type" => 'md_vc_separator',
				"param_name" => ++$separatorCounter,
			),

			array(
				'type' => 'md_vc_slider',
				"edit_field_class" => $filedClass . "glue",
				'heading' => esc_attr__('Text Size', 'massive-dynamic'),
				'param_name' => 'full_button_text_size',
				'value' => '19',
				'defaultSetting' => array(
					"min" => "10",
					"max" => "100",
					"prefix" => " px",
					"step" => "1",
				)
			),
			array(
				"type" => 'md_vc_separator',
				"param_name" => ++$separatorCounter,
			),

			array(
				'type' => 'md_vc_slider',
				"edit_field_class" => $filedClass . "glue last",
				'heading' => esc_attr__('Hover letter Spacing', 'massive-dynamic'),
				'param_name' => 'full_button_hover_letter_spacing',
				'value' => '2',
				'defaultSetting' => array(
					"min" => "0",
					"max" => "15",
					"prefix" => " px",
					"step" => "1",
				)
			),

			array(
				"type" => "md_group_title",
				"heading" => esc_attr__("Link", 'massive-dynamic'),
				"param_name" => "link_group",
				"edit_field_class" => $filedClass . "glue first last"
			),
			array(
				"type" => "textfield",
				"edit_field_class" => $filedClass . "glue first",
				"heading" => esc_attr__("URL", 'massive-dynamic'),
				"param_name" => "full_button_url",
				"admin_label" => false,
				'value' => '#'
			),
			array(
				"type" => 'md_vc_separator',
				"param_name" => ++$separatorCounter,
			),
			array(
				"type" => "dropdown",
				"edit_field_class" => $filedClass . "glue last",
				"heading" => esc_attr__("Target", 'massive-dynamic'),
				"param_name" => "full_button_target",
				"admin_label" => false,
				"value" => array(
					esc_attr__("Open in same window", 'massive-dynamic') => "_self",
					esc_attr__("Open in new window", 'massive-dynamic') => "_blank"
				),
			),
			array(
				"type" => "md_group_title",
				"heading" => esc_attr__("Appearance", 'massive-dynamic'),
				"param_name" => "app_group",
				"edit_field_class" => $filedClass . "glue first last"
			),
			array(
				"type" => "md_vc_colorpicker",
				"edit_field_class" => $filedClass . "glue first",
				"heading" => esc_attr__("Bg Color", 'massive-dynamic'),
				"param_name" => "full_button_bg_color",
				"admin_label" => false,
				"opacity" => true,
				"description" => esc_attr__("Enter optional button's color", 'massive-dynamic'),
				'value' => '#202020'
			),
			array(
				"type" => 'md_vc_separator',
				"param_name" => ++$separatorCounter,
			),
			array(
				"type" => "md_vc_colorpicker",
				"edit_field_class" => $filedClass . "glue",
				"heading" => esc_attr__("Text Color", 'massive-dynamic'),
				"param_name" => "full_button_text_color",
				"admin_label" => false,
				"opacity" => true,
				'value' => '#fff',
			),
			array(
				"type" => 'md_vc_separator',
				"param_name" => ++$separatorCounter,
			),
			array(
				"type" => "md_vc_colorpicker",
				"edit_field_class" => $filedClass . "glue",
				"heading" => esc_attr__("Bg Hover Color", 'massive-dynamic'),
				"param_name" => "full_button_bg_hover_color",
				"admin_label" => false,
				'value' => '#3E005D'
			),
			array(
				"type" => 'md_vc_separator',
				"param_name" => ++$separatorCounter,
			),
			array(
				"type" => "md_vc_colorpicker",
				"edit_field_class" => $filedClass . "glue last",
				"heading" => esc_attr__("Text Hover Color", 'massive-dynamic'),
				"param_name" => "full_button_hover_color",
				"admin_label" => false,
				'value' => '#FFF'
			),
		),
	)
);

pixflow_add_params('md_full_button', pixflow_addAnimationTab('md_full_button'));
