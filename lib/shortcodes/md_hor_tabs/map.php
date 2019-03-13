<?php
/**
 * Pixflow
 */


/* -------------------------------------------------------
--------------------------Horizontal Tab-----------------------------
---------------------------------------------------------*/
global $separatorCounter;
pixflow_map(array(
    "name" => esc_attr__('Horizontal Tabs', 'massive-dynamic'),
    'base' => 'md_hor_tabs',
    'show_settings_on_create' => false,
    'is_container' => true,
    "category" => esc_attr__("Tab", 'massive-dynamic'),
    'description' => esc_attr__('Tabbed content', 'massive-dynamic'),
    'as_parent' => array('only' => 'md_hor_tab'),
    'params' => array(

        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Background", 'massive-dynamic'),
            "param_name" => "bg_group",
            "edit_field_class" => $filedClass . "glue first ",
        ),
        array(
            'type' => 'md_vc_checkbox',
            "edit_field_class" => $filedClass . "first glue last",
            'heading' => esc_attr__('Activate', 'massive-dynamic'),
            'param_name' => 'use_bg',
            'value' => array(esc_attr__('yes', 'massive-dynamic') => 'yes'),
            'checked' => true,
        ),
        array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "stick-to-top",
            "param_name" => "use_bg_separator" . ++$separatorCounter,
            "admin_label" => false,
            "dependency" => array(
                'element' => "use_bg",
                'value' => array('yes')
            )
        ),//separator
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Type", 'massive-dynamic'),
            "param_name" => "bg_type",
            "dependency" => array(
                'element' => "use_bg",
                'value' => 'yes',
            ),
            "value" => array(
                esc_attr__("Color", 'massive-dynamic') => "color",
                esc_attr__("Image", 'massive-dynamic') => "image",
            ),
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "bg_type_separator" . ++$separatorCounter,
            "dependency" => array(
                'element' => "use_bg",
                'value' => 'yes',
            ),
        ),
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Color", 'massive-dynamic'),
            "param_name" => "bg_color",
            "value" => 'rgb(215,176,126)',
            "admin_label" => false,
            "opacity" => true,
            "dependency" => array(
                'element' => "bg_type",
                'value' => array('color')
            )
        ),
        array(
            'type' => 'attach_image',
            "edit_field_class" => $filedClass . "glue last",
            'heading' => esc_attr__('Image', 'massive-dynamic'),
            'param_name' => 'bg_image',
            "dependency" => array(
                'element' => "bg_type",
                'value' => array('image')
            ),
        ),
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Color(s)", 'massive-dynamic'),
            "param_name" => "app_group",
            "edit_field_class" => $filedClass . "glue first ",
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "bg_type_separator" . ++$separatorCounter,
            "edit_field_class" => $filedClass . "stick-to-top",
            "dependency" => array(
                'element' => "use_bg",
                'value' => 'no',
            ),
        ),
        array(
            "type" => "md_vc_colorpicker",

            "edit_field_class" => $filedClass . " glue last",
            "heading" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "general_color",
            "value" => "rgb(255,255,255)",
            "admin_label" => false,
        ),

        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Hover", 'massive-dynamic'),
            "param_name" => "hor_tab_hover_color",
            "value" => 'rgb(215,176,126)',
            "admin_label" => false,
            "opacity" => true,
            "dependency" => array(
                'element' => "use_bg",
                'value' => 'no',
            ),
        ),
    ),
    'custom_markup' => '
<div class="wpb_tabs_holder wpb_holder vc_container_for_children">
<ul class="tabs_controls">
</ul>
%content%
</div>'
,
    'default_content' => '
[md_hor_tab title="' . esc_attr__('Tab', 'massive-dynamic') . '" tab_id="' . uniqid('tab') . '"][/md_hor_tab]
[md_hor_tab title="' . esc_attr__('Tab', 'massive-dynamic') . '" tab_id="' . uniqid('tab') . '"][/md_hor_tab]
[md_hor_tab title="' . esc_attr__('Tab', 'massive-dynamic') . '" tab_id="' . uniqid('tab') . '"][/md_hor_tab]
[md_hor_tab title="' . esc_attr__('Tab', 'massive-dynamic') . '" tab_id="' . uniqid('tab') . '"][/md_hor_tab]
',
    'js_view' => 'MdHorTabsView'
));


class Pixflow_PixflowShortCode_Md_HorTabs extends WPBakeryShortCode
{
    static $filter_added = false;
    protected $controls_css_settings = 'out-tc vc_controls-content-widget';
    protected $controls_list = array('edit', 'clone', 'delete');

    public function __construct($settings)
    {
        parent::__construct($settings);
        if (!self::$filter_added) {
            $this->addFilter('vc_inline_template_content', 'setCustomTabId');
            self::$filter_added = true;
        }
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


        preg_match_all('/md_hor_tab title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $content, $matches, PREG_OFFSET_CAPTURE);
        $output = '';
        $tab_titles = array();

        if (isset($matches[0])) {
            $tab_titles = $matches[0];
        }
        $tmp = '';
        if (count($tab_titles)) {
            $tmp .= '<ul class="clearfix tabs_controls">';
            foreach ($tab_titles as $tab) {
                preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE);
                if (isset($tab_matches[1][0])) {
                    $tmp .= '<li><a href="#tab-' . (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title($tab_matches[1][0])) . '">' . $tab_matches[1][0] . '</a><span class="' . $tab_icon . '" ></span></li>';

                }
            }
            $tmp .= '</ul>' . "\n";
        } else {
            $output .= do_shortcode($content);
        }


        $elem = $this->getElementHolder($width);

        $iner = '';
        foreach ($this->settings['params'] as $param) {
            $custom_markup = '';
            $param_value = isset($$param['param_name']) ? $$param['param_name'] : '';
            if (is_array($param_value)) {
                // Get first element from the array
                reset($param_value);
                $first_key = key($param_value);
                $param_value = $param_value[$first_key];
            }
            $iner .= $this->singleParamHtmlHolder($param, $param_value);
        }

        if (isset($this->settings["custom_markup"]) && $this->settings["custom_markup"] != '') {
            if ($content != '') {
                $custom_markup = str_ireplace("%content%", $tmp . $content, $this->settings["custom_markup"]);
            } else if ($content == '' && isset($this->settings["default_content_in_template"]) && $this->settings["default_content_in_template"] != '') {
                $custom_markup = str_ireplace("%content%", $this->settings["default_content_in_template"], $this->settings["custom_markup"]);
            } else {
                $custom_markup = str_ireplace("%content%", '', $this->settings["custom_markup"]);
            }
            //$output .= do_shortcode($this->settings["custom_markup"]);
            $iner .= do_shortcode($custom_markup);
        }
        $elem = str_ireplace('%wpb_element_content%', $iner, $elem);
        $output = $elem;
        return $output;
    }

    public function getTabTemplate()
    {
        return '<div class="wpb_template">' . do_shortcode('[md_hor_tab title="TAB" tab_id="" tab_icon=""][/md_hor_tab]') . '</div>';
    }

    public function setCustomTabId($content)
    {
        return preg_replace('/tab\_id\=\"([^\"]+)\"/', 'tab_id="$1-' . time() . '"', $content);
    }
}

pixflow_add_params('md_hor_tabs', pixflow_addAnimationTab('md_hor_tabs'));
