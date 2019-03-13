<?php
/**
 * Pixflow
 */


/* -------------------------------------------------------
--------------------------Tab-----------------------------
---------------------------------------------------------*/

$tab_id_1 = ''; // 'def' . time() . '-1-' . rand( 0, 100 );
$tab_id_2 = ''; // 'def' . time() . '-2-' . rand( 0, 100 );
pixflow_map(array(
    "name" => esc_attr__('Tabs', 'massive-dynamic'),
    'base' => 'md_tabs',
    'show_settings_on_create' => false,
    'is_container' => true,
    "category" => esc_attr__("Structure", 'massive-dynamic'),
    'description' => esc_attr__('Tabbed content', 'massive-dynamic'),
    'as_parent' => array('only' => 'md_tab'),
    'params' => array(
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Appearance", 'massive-dynamic'),
            "param_name" => "appearance_group",
            "edit_field_class" => $filedClass . "glue first last"
        ),
        array(
            "type" => "md_vc_colorpicker",

            "edit_field_class" => $filedClass . "first glue",
            "heading" => esc_attr__("Title Color", 'massive-dynamic'),
            "param_name" => "title_color",
            "value" => "rgba(255,255,255,1)",
            "opacity" => true,
            "admin_label" => false,
            "description" => esc_attr__("Enter optional tab title's color", 'massive-dynamic'),
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "title_color_separator" . ++$separatorCounter,
        ),
        array(
            "type" => "md_vc_colorpicker",

            "edit_field_class" => $filedClass . " glue",
            "heading" => esc_attr__("Tab Color", 'massive-dynamic'),
            "param_name" => "tab_color",
            "admin_label" => false,
            "value" => "rgba(43,42,40,1)",
            "opacity" => true,
            "description" => esc_attr__("Enter optional tab's color", 'massive-dynamic'),
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "tab_color_separator" . ++$separatorCounter,
        ),
        array(
            "type" => "md_vc_colorpicker",

            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Active Tab Color", 'massive-dynamic'),
            "param_name" => "tab_active_color",
            "value" => "rgba(235,78,1,1)",
            "opacity" => true,
            "admin_label" => false,
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "tab_color_separator" . ++$separatorCounter,
        ),
        array(
            "type" => "md_vc_colorpicker",

            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Content BG Color", 'massive-dynamic'),
            "param_name" => "tabs_background",
            "value" => "rgba(247,247,247,1)",
            "opacity" => true,
            "admin_label" => false,
        ),
        array(
            "type" => "md_vc_description",

            "param_name" => "tabs_description",
            "admin_label" => false,
            "value" => esc_attr__("This is the general setting for tab. To customize each tab, click on them, then click on setting icon which appears under them.", 'massive-dynamic')
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
[md_tab title="' . esc_attr__('TAB', 'massive-dynamic') . '" tab_id="' . uniqid('tab') . '"][/md_tab]
[md_tab title="' . esc_attr__('TAB', 'massive-dynamic') . '" tab_id="' . uniqid('tab') . '"][/md_tab]
',
    'js_view' => 'MdTabsView'
));

class Pixflow_PixflowShortCode_Md_Tabs extends WPBakeryShortCode
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

        // Extract tab titles

        preg_match_all('/md_tab title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $content, $matches, PREG_OFFSET_CAPTURE);
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
                    $tmp .= '<li><a href="#tab-' . (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title($tab_matches[1][0])) . '">' . $tab_matches[1][0] . '</a><span class="' . $tab_icon_class . '" ></span></li>';

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
        return '<div class="wpb_template">' . do_shortcode('[md_tab title="TAB" tab_id="" tab_icon_class=""][/md_tab]') . '</div>';
    }

    public function setCustomTabId($content)
    {
        return preg_replace('/tab\_id\=\"([^\"]+)\"/', 'tab_id="$1-' . time() . '"', $content);
    }
}

pixflow_add_params('md_tabs', pixflow_addAnimationTab('md_tabs'));
