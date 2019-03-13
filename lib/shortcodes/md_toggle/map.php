<?php
/**
 * Pixflow
 */




/*-----------------------------------------------------------------------------------*/
/*  Toggle
/*-----------------------------------------------------------------------------------*/
pixflow_map(

    array(
        'name' => esc_attr__('Toggle', 'massive-dynamic'),
        'base' => 'md_toggle',
        'show_settings_on_create' => false,
        'is_container' => true,
        "category" => esc_attr__('Tab', 'massive-dynamic'),
        'description' => esc_attr__('Collapsible content panels', 'massive-dynamic'),
        "as_parent" => array('only' => 'md_toggle_tab'),
        'params' => array(
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appreance", 'massive-dynamic'),
                "param_name" => "app_group",
                "edit_field_class" => $filedClass . "glue first ",
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "first glue first",
                "heading" => esc_attr__("Skin", 'massive-dynamic'),
                "param_name" => "theme_style",
                "description" => esc_attr__("Choose one theme style", 'massive-dynamic'),
                "admin_label" => false,
                "value" => array(
                    esc_attr__("With Border", 'massive-dynamic') => "with_border",
                    esc_attr__("Without Border", 'massive-dynamic') => "without_border"
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "theme_style_separator" . ++$separatorCounter,
            ),

            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Main Color", 'massive-dynamic'),
                "param_name" => "main_color",
                "admin_label" => false,
                "value" => "rgb(0,0,0)",
                "description" => esc_attr__("Choose a color for Border,Icon,Arrow and Title", 'massive-dynamic'),
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "main_color_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Hover Color", 'massive-dynamic'),
                "param_name" => "hover_color",
                "value" => "rgb(220,220,220)",
                "opacity" => false,
                "admin_label" => false,
                "description" => esc_attr__("Choose a color for hover", 'massive-dynamic'),
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Extra Options", 'massive-dynamic'),
                "param_name" => "category_group",
                "edit_field_class" => $filedClass . "glue first ",
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "hover_color_separator" . ++$separatorCounter,
            ),
            array(
                'type' => 'textfield',
                "edit_field_class" => $filedClass . "glue",
                'heading' => esc_attr__('Extra class name', 'massive-dynamic'),
                'param_name' => 'el_class',
                'description' => esc_attr__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'massive-dynamic')
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "el_class_separator" . ++$separatorCounter,
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_attr__('Active section', 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue",
                'param_name' => 'active_tab',
                "value" => "1",
                'description' => __('Enter section number to be active on load or enter "false" to collapse all sections.', 'massive-dynamic')
            ),

            array(
                "type" => "md_vc_description",
                "edit_field_class" => $filedClass . "glue last",
                "param_name" => "toggle_description_control",
                "admin_label" => false,
                "value" => esc_attr__("Use comma (,) for having multiple active sections. e.g:1,2,3 ", 'massive-dynamic')
            ),
            array(
                "type" => "md_vc_description",
                "param_name" => "accordion_description",
                "admin_label" => false,
                "value" => esc_attr__("This is the general setting for toggle shortcode. Each tab has a unique setting icon, click on it and customize them separately.", 'massive-dynamic')
            )
        ),
        'custom_markup' => '
        <div class="wpb_toggle_holder wpb_holder clearfix vc_container_for_children">

        </div>
        <div class="tab_controls">
            <a class="add_tab" title="' . esc_attr__('Add section', 'massive-dynamic') . '"><span class="vc_icon"></span> <span class="tab-label">' . esc_attr__('Add section', 'massive-dynamic') . '</span></a>
        </div>
        ',
        'default_content' => '
        [md_toggle_tab title="' . esc_attr__('Section', 'massive-dynamic') . '"][/md_toggle_tab]
        [md_toggle_tab title="' . esc_attr__('Section', 'massive-dynamic') . '"][/md_toggle_tab]
        ',
        'js_view' => 'MdToggleView'
    )
);
if (class_exists('WPBakeryShortCodesContainer')) {
    class Pixflow_WPBakeryShortCode_Md_Toggle extends WPBakeryShortCodesContainer
    {
        protected $controls_css_settings = 'out-tc vc_controls-content-widget';

        public function __construct($settings)
        {
            parent::__construct($settings);
        }

        public function contentAdmin($atts, $content = null)
        {
            $width = $custom_markup = '';
            $shortcode_attributes = array('width' => '1/1');
            foreach ($this->settings['params'] as $param) {
                if ($param['param_name'] != 'content') {
                    if (isset($param['value']) && is_string($param['value'])) {
                        $shortcode_attributes[$param['param_name']] = $param['value'];
                    } elseif (isset($param['value'])) {
                        $shortcode_attributes[$param['param_name']] = $param['value'];
                    }
                } else if ($param['param_name'] == 'content' && $content == null) {
                    $content = $param['value'];
                }
            }
            extract(shortcode_atts(
                $shortcode_attributes
                , $atts));

            $output = '';

            $elem = $this->getElementHolder($width);

            $inner = '';
            foreach ($this->settings['params'] as $param) {
                $param_value = '';
                $param_value = isset($$param['param_name']) ? $$param['param_name'] : '';
                if (is_array($param_value)) {
                    // Get first element from the array
                    reset($param_value);
                    $first_key = key($param_value);
                    $param_value = $param_value[$first_key];
                }
                $inner .= $this->singleParamHtmlHolder($param, $param_value);
            }
            $tmp = '';

            if (isset($this->settings["custom_markup"]) && $this->settings["custom_markup"] != '') {
                if ($content != '') {
                    $custom_markup = str_ireplace("%content%", $tmp . $content, $this->settings["custom_markup"]);
                } else if ($content == '' && isset($this->settings["default_content_in_template"]) && $this->settings["default_content_in_template"] != '') {
                    $custom_markup = str_ireplace("%content%", $this->settings["default_content_in_template"], $this->settings["custom_markup"]);
                } else {
                    $custom_markup = str_ireplace("%content%", '', $this->settings["custom_markup"]);
                }
                //$output .= do_shortcode($this->settings["custom_markup"]);
                $inner .= do_shortcode($custom_markup);
            }
            $elem = str_ireplace('%wpb_element_content%', $inner, $elem);
            $output = $elem;

            return $output;
        }
    }
}

pixflow_add_params('md_toggle', pixflow_addAnimationTab('md_toggle'));
