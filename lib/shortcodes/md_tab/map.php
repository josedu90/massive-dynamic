<?php
/**
 * Pixflow
 */


pixflow_map(array(
    'name' => esc_attr__('Tab', 'massive-dynamic'),
    'base' => 'md_tab',
    'allowed_container_element' => 'vc_row',
    'is_container' => true,
    'content_element' => false,
    'params' => array(
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Title", 'massive-dynamic'),
            "param_name" => "title_group",
            "edit_field_class" => $filedClass . "glue first last"
        ),
        array(
            'type' => 'textfield',
            "edit_field_class" => $filedClass . "glue first",
            'heading' => esc_attr__('Title', 'massive-dynamic'),
            'param_name' => 'title',
            "value" => "TAB",
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "title_separator" . ++$separatorCounter,
        ),
        array(
            "type" => "md_vc_iconpicker",

            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
            "param_name" => "tab_icon_class",
            "value" => "icon-cog",
            "admin_label" => false,
        )
    ),
    'js_view' => 'MdTabView'
));

class Pixflow_PixflowShortCode_Md_Tab extends WPBakeryShortCode_VC_Column
{
    protected $controls_css_settings = 'tc vc_control-container';
    protected $controls_list = array('add', 'edit', 'clone', 'delete');
    protected $predefined_atts = array(
        'tab_id' => TAB_TITLE,
        'title' => '',
        'tab_icon_class' => ''
    );
    protected $controls_template_file = 'editors/partials/backend_controls_tab.tpl.php';

    public function __construct($settings)
    {
        parent::__construct($settings);
    }

    public function mainHtmlBlockParams($width, $i)
    {
        return 'data-element_type="' . $this->settings["base"] . '" class="wpb_' . $this->settings['base'] . ' wpb_sortable wpb_content_holder"' . $this->customAdminBlockParams();
    }

    public function customAdminBlockParams()
    {
        return ' id="tab-' . $this->atts['tab_id'] . '"';
    }

    public function containerHtmlBlockParams($width, $i)
    {
        return 'class="wpb_column_container vc_container_for_children"';
    }

    public function getColumnControls($controls, $extended_css = '')
    {
        return $this->getColumnControlsModular($extended_css);
    }
}