<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Toggle Tab 2 (Business Version)
/*-----------------------------------------------------------------------------------*/
pixflow_map(

    array(
        'name' => esc_attr__('Section', 'massive-dynamic'),
        'base' => 'md_toggle_tab2',
        "as_child" => array('only' => 'md_toggle2'),
        'is_container' => true,
        'content_element' => false,
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_attr__('Title', 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first",
                'param_name' => 'title',
                "value" => "Section",
                'description' => esc_attr__('Enter accordion section title.', 'massive-dynamic')
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "title_separator" . ++$separatorCounter,
            ),
            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
                "param_name" => "icon",
                "admin_label" => false,
                "value" => "icon-empty"
            )
        ),
        'js_view' => 'MdToggleTab2View'
    )
);

if (class_exists('PixflowShortCode')) {
    class Pixflow_PixflowShortCode_Md_Toggle_tab2 extends WPBakeryShortCode
    {
        protected $controls_css_settings = 'tc vc_control-container';
        protected $controls_list = array('add', 'edit', 'clone', 'delete');
        protected $predefined_atts = array(
            'el_class' => '',
            'width' => '',
            'title' => ''
        );

        public function contentAdmin($atts, $content = null)
        {

            $output = $title = $el_id = '';

            extract(shortcode_atts(array(
                'title' => esc_attr__("Section", 'massive-dynamic'),
                'icon' => 'icon-laptop',
            ), $atts));

            $output = <<<CONTENTEND
            <div data-element_type="md_toggle_tab2" class="wpb_md_toggle_tab2 wpb_content_element wpb_sortable"><div class="vc_controls">
	<div class="vc_controls-tc vc_control-container">
		<a class="vc_control-btn vc_element-name vc_element-move">
				<span class="vc_btn-content"
				      title="Drag to move Section">Section</span>
		</a>
														<a class="vc_control-btn vc_control-btn-prepend vc_edit" href="#"
					   title="Prepend to Section"><span
							class="vc_btn-content"><span class="icon"></span></span></a>
																<a class="vc_control-btn vc_control-btn-edit" href="#"
					   title="Edit Section"><span
							class="vc_btn-content"><span class="icon"></span></span></a>
																<a class="vc_control-btn vc_control-btn-clone" href="#"
					   title="Clone Section"><span
							class="vc_btn-content"><span class="icon"></span></span></a>
																<a class="vc_control-btn vc_control-btn-delete" href="#"
					   title="Delete Section"><span
							class="vc_btn-content"><span class="icon"></span></span></a>
										</div>
</div><div class="wpb_element_wrapper ">
CONTENTEND;
            $output .= "\n\t\t\t\t" . '<h3 class="wpb_toggle_header ui-accordion-header"><div class="icon_left"><span class="icon ' . $icon . '"></span></div><a href="#' . sanitize_title($title) . '" class="md-toggle-tab2-title">' . $title . '</a></h3>';

            $output .= "\n\t\t\t\t" . '<div class="wpb_toggle_content ui-accordion-content vc_clearfix">';
            $output .= ($content == '' || $content == ' ') ? '<div class="wpb_column_container vc_container_for_children vc_empty-container ui-droppable ui-sortable"></div>' : "\n\t\t\t\t" . pixflow_js_remove_wpautop($content);
            $output .= "\n\t\t\t\t" . '</div>';
            $output .= "\n\t\t\t" . '</div> ' . "\n";
            return $output;
        }
    }
}
