<?php
/**
 * Pixflow
 */



/*-----------------------------------------------------------------------------------*/
/*  Portfolio
/*-----------------------------------------------------------------------------------*/
global $separatorCounter;
$separatorCounter = 1;
$portfolio_cats = array();
$terms = get_terms('skills', 'orderby=count&hide_empty=0');
if (!empty($terms) && !is_wp_error($terms)) {
    foreach ($terms as $term) {
        $portfolio_cats[] = $term->name;
    }
}
pixflow_map(
    array(
        'base' => 'md_portfolio_multisize',
        'name' => esc_attr__('Portfolio', 'massive-dynamic'),
        'description' => esc_attr__('Choose Portfolio Options', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__("Basic", 'massive-dynamic'),
        'params' => array(
            array(
                'type' => 'textfield',
                "edit_field_class" => $filedClass . "glue first last",
                'heading' => esc_attr__('Title', 'massive-dynamic'),
                'param_name' => 'multisize_title',
                'group' => esc_attr__("General", 'massive-dynamic'),
                'admin_label' => false,
                "value" => "OUR PROJECTS",
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Content", 'massive-dynamic'),
                "param_name" => "content_group",
                'group' => esc_attr__("General", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_attr__('Meta Position', 'massive-dynamic'),
                "edit_field_class" => $filedClass . "first glue last",
                'param_name' => 'multisize_meta_position',
                'group' => esc_attr__("General", 'massive-dynamic'),
                'value' => array(
                    esc_attr__("Inside Portfolio Item", 'massive-dynamic') => "inside",
                    esc_attr__("Outside Portfolio Item", 'massive-dynamic') => "outside",
                ),
            ),
            array(
                'type' => 'md_vc_multiselect',
                'heading' => esc_attr__('Category', 'massive-dynamic'),
                "edit_field_class" => $filedClass . "first glue last",
                'param_name' => 'multisize_category',
                'group' => esc_attr__("General", 'massive-dynamic'),
                'items' => $portfolio_cats,
                'defaults' => 'all',
            ),
            array(
                'type' => 'textfield',
                "edit_field_class" => $filedClass . "glue first last",
                'heading' => esc_attr__('Load More Button', 'massive-dynamic'),
                'param_name' => 'multisize_item_number',
                'group' => esc_attr__("General", 'massive-dynamic'),
                'admin_label' => false,
                "value" => "-1",
            ),

            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Filter", 'massive-dynamic'),
                "param_name" => "filter_group",
                'group' => esc_attr__("General", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "glue first last",
                'heading' => esc_attr__('Enable Filters ', 'massive-dynamic'),
                'param_name' => 'multisize_filters',
                'group' => esc_attr__("General", 'massive-dynamic'),
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
                'checked' => true,
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . " first glue last",
                'heading' => esc_attr__('Show Post Counts ', 'massive-dynamic'),
                'param_name' => 'multisize_post_count',
                'group' => esc_attr__("General", 'massive-dynamic'),
                'value' => array(esc_attr__('No', 'massive-dynamic') => 'no'),
                'checked' => false,
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "multisize_separator". ++$separatorCounter ,
                "edit_field_class" => $filedClass . "stick-to-top glue",
                'group' => esc_attr__("General", 'massive-dynamic'),
                "admin_label" => false,
                'dependency' => array(
                    'element' => "multisize_post_count",
                    'value' => array('yes'),
                )
            ),//separator

            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . " glue",
                "heading" => esc_attr__("Background", 'massive-dynamic'),
                "param_name" => "multisize_counter_background_color",
                "value" => '#af72ff',
                "opacity" => false,
                "group" => esc_attr__('General', 'massive-dynamic'),
                "admin_label" => false,
                "description" => esc_attr__("Background", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "multisize_post_count",
                    'value' => array('yes'),
                )
            ),
            array(
                "type" => 'md_vc_separator',
                "param_name" => "multisize_separator". ++$separatorCounter ,
                "edit_field_class" => $filedClass . " glue",
                "admin_label" => false,
                "group" => esc_attr__('General', 'massive-dynamic'),
                'dependency' => array(
                    'element' => "multisize_post_count",
                    'value' => array('yes'),
                )
            ),//separator

            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Number", 'massive-dynamic'),
                "param_name" => "multisize_counter_color",
                "value" => '#ffffff',
                "opacity" => false,
                "group" => esc_attr__('General', 'massive-dynamic'),
                "admin_label" => false,
                "description" => esc_attr__("Counter Background Color", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "multisize_post_count",
                    'value' => array('yes'),
                )
            ),

            array(
                'type' => 'dropdown',
                'heading' => esc_attr__('Filters Align', 'massive-dynamic'),
                "edit_field_class" => $filedClass . "first glue last",
                'param_name' => 'multisize_filters_align',
                'group' => esc_attr__("General", 'massive-dynamic'),
                'value' => array(
                    esc_attr__("Left", 'massive-dynamic') => "left",
                    esc_attr__("Center", 'massive-dynamic') => "center",
                    esc_attr__("Right", 'massive-dynamic') => "right",
                ),
                'dependency' => array(
                    'element' => "multisize_filters",
                    'value' => array('yes'),
                )
            ),
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "appearance_group",
                'group' => esc_attr__("General", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last"
            ),
            array(
                "type" => 'md_vc_slider',
                "heading" => esc_attr__("Items Padding", 'massive-dynamic'),
                "param_name" => "multisize_spacing",
                "value" => "0",
                'group' => esc_attr__("General", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last",
                'defaultSetting' => array(
                    "min" => "0",
                    "max" => "30",
                    "prefix" => "px",
                    "step" => '1',
                )
            ), array(
                'type' => 'dropdown',
                "edit_field_class" => $filedClass . "glue first last",
                'heading' => esc_attr__('Open Mode', 'massive-dynamic'),
                'param_name' => 'multisize_detail_target',
                'group' => esc_attr__("General", 'massive-dynamic'),
                //'value' => array(esc_attr__('popup', 'massive-dynamic') => 'popup'),
                'value' => array(
                    esc_attr__("Popup", 'massive-dynamic') => "popup",
                    esc_attr__("Link Thumbnail", 'massive-dynamic') => "page"
                )
            ),
            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "glue first last",
                'heading' => esc_attr__('Enable Like ', 'massive-dynamic'),
                'param_name' => 'multisize_like',
                "group" => esc_attr__('General', 'massive-dynamic'),
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
                'checked' => true,
            ),

            array(
                'type' => 'md_vc_description',
                'heading' => ' ',
                'param_name' => 'multisize_description',
                "group" => esc_attr__('General', 'massive-dynamic'),
                'checked' => true,
                "value" => "<div class='portfolio-multisize1'>
                                             " . '<ul><li>' . esc_attr__('To add portfolio items, go to WordPress Dashboard > Portfolio > add new', 'massive-dynamic') . '</li><li>' . esc_attr__('Please notice that popup detail will not work in builder area', 'massive-dynamic') . '</li><li>' . esc_attr__('To display all your portfolio items, enter -1 in Load More Button filed.', 'massive-dynamic') . '</li></ul>' . "
                                        </div>"
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue first last",
                "heading" => esc_attr__("Title/Filter Color", 'massive-dynamic'),
                "param_name" => "multisize_filter_color",
                "value" => 'rgb(0,0,0)',
                "opacity" => false,
                "group" => esc_attr__('Colors', 'massive-dynamic'),
                "admin_label" => false,
                "description" => esc_attr__("Filter Color", 'massive-dynamic'),
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue first last",
                "heading" => esc_attr__("Item Text Color", 'massive-dynamic'),
                "param_name" => "multisize_text_color",
                "value" => 'rgba(191,191,191,1)',
                "opacity" => true,
                "group" => esc_attr__('Colors', 'massive-dynamic'),
                "admin_label" => false,
                "description" => esc_attr__("Text Color", 'massive-dynamic'),
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue first last",
                "heading" => esc_attr__("Overlay Color", 'massive-dynamic'),
                "param_name" => "multisize_overlay_color",
                "value" => 'rgba(0,0,0,0.5)',
                "opacity" => true,
                "group" => esc_attr__('Colors', 'massive-dynamic'),
                "admin_label" => false,
                "description" => esc_attr__("Overlay Color", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "multisize_meta_position",
                    'value' => array('inside')
                )
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue first last",
                "heading" => esc_attr__("Frame Color", 'massive-dynamic'),
                "param_name" => "multisize_frame_color",
                "value" => '#fff',
                "opacity" => false,
                "group" => esc_attr__('Colors', 'massive-dynamic'),
                "admin_label" => false,
                "description" => esc_attr__("Frame Color", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "multisize_meta_position",
                    'value' => array('outside')
                )
            ),

            array(
                'type' => 'md_vc_checkbox',
                "edit_field_class" => $filedClass . "glue first last",
                'heading' => esc_attr__('Activate', 'massive-dynamic'),
                'param_name' => 'multisize_load_more',
                'group' => esc_attr__("Load More Button", 'massive-dynamic'),
                'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
                'checked' => true,
            ),//add btn
            array(
                "type" => 'md_vc_separator',
                "param_name" => "multisize_separator" . ++$separatorCounter,
                "edit_field_class" => $filedClass . "stick-to-top",
                'group' => esc_attr__("Load More Button", 'massive-dynamic'),
                "admin_label" => false,
                'dependency' => array(
                    'element' => "multisize_load_more",
                    'value' => array('yes'),
                )
            ),//separator
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Style", 'massive-dynamic'),
                "param_name" => "btn_style_group",
                'group' => esc_attr__("Load More Button", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last",
                'dependency' => array(
                    'element' => "multisize_load_more",
                    'value' => array('yes'),
                )
            ),
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue last",
                "separate" => true,
                "heading" => esc_attr__("Button Style", 'massive-dynamic'),
                "param_name" => "multisize_button_style",
                "description" => esc_attr__("Choose between five button style", 'massive-dynamic'),
                "admin_label" => false,
                'group' => esc_attr__("Load More Button", 'massive-dynamic'),
                "value" => array(
                    esc_attr__("Fade Square", 'massive-dynamic') => "fade-square",
                    esc_attr__("Fade Oval", 'massive-dynamic') => "fade-oval",
                    esc_attr__("Slide", 'massive-dynamic') => "slide",
                    esc_attr__("Fill Slide", 'massive-dynamic') => "come-in",
                    esc_attr__("Animation", 'massive-dynamic') => "animation",
                    esc_attr__("Flash Animate", 'massive-dynamic') => "flash-animate",
                    esc_attr__("Fill Rectangle", 'massive-dynamic') => "fill-rectangle",
                    esc_attr__("Fill Oval", 'massive-dynamic') => "fill-oval"
                ),
                'group' => esc_attr__("Load More Button", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "multisize_load_more",
                    'value' => array('yes'),
                )
            ),//btn kind
            array(
                "type" => "dropdown",
                "edit_field_class" => $filedClass . "glue first",
                "heading" => esc_attr__("Size", 'massive-dynamic'),
                'group' => esc_attr__("Load More Button", 'massive-dynamic'),
                "param_name" => "multisize_button_size",
                "admin_label" => false,
                "value" => array(
                    esc_attr__("Standard", 'massive-dynamic') => "standard",
                    esc_attr__("Small", 'massive-dynamic') => "small"
                ),
                'dependency' => array(
                    'element' => "multisize_load_more",
                    'value' => array('yes'),
                )
            ),//btn size
            array(
                'type' => 'md_vc_slider',
                "edit_field_class" => $filedClass . "glue last",
                'heading' => esc_attr__('Padding', 'massive-dynamic'),
                'param_name' => 'multisize_button_padding',
                'value' => '0',
                "group" => esc_attr__("Load More Button", 'massive-dynamic'),
                'defaultSetting' => array(
                    "min" => "0",
                    "max" => "300",
                    "prefix" => " px",
                    "step" => "1",
                ),
                "dependency" => array(
                    'element' => "multisize_load_more",
                    'value' => array('yes')
                )
            ),//btn space
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Content", 'massive-dynamic'),
                "param_name" => "btn_content_group",
                'group' => esc_attr__("Load More Button", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last",
                'dependency' => array(
                    'element' => "multisize_load_more",
                    'value' => array('yes'),
                )
            ),
            array(
                "type" => "textfield",
                "edit_field_class" => $filedClass . "first glue",
                "heading" => esc_attr__("Text", 'massive-dynamic'),
                "param_name" => "multisize_button_text",
                "description" => esc_attr__("Button text", 'massive-dynamic'),
                "admin_label" => false,
                "value" => 'LOAD MORE',
                'group' => esc_attr__("Load More Button", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "multisize_load_more",
                    'value' => array('yes'),
                )
            ),//btn text
            array(
                "type" => 'md_vc_separator',
                "param_name" => "multisize_button_text_separator" . ++$separatorCounter,
                'group' => esc_attr__("Load More Button", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "multisize_load_more",
                    'value' => array('yes'),
                )
            ),//separator
            array(
                "type" => "md_vc_iconpicker",
                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
                "param_name" => "multisize_button_icon_class",
                'group' => esc_attr__("Load More Button", 'massive-dynamic'),
                "admin_label" => false,
                "description" => esc_attr__("Select an icon that shown before text", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "multisize_load_more",
                    'value' => array('yes'),
                ),
                'value' => 'icon-plus6'
            ),//btn icon
            array(
                "type" => "md_group_title",
                "heading" => esc_attr__("Appearance", 'massive-dynamic'),
                "param_name" => "btn_app_group",
                'group' => esc_attr__("Load More Button", 'massive-dynamic'),
                "edit_field_class" => $filedClass . "glue first last",
                'dependency' => array(
                    'element' => "multisize_load_more",
                    'value' => array('yes'),
                )
            ),
            array(
                "type" => "md_vc_colorpicker",
                "edit_field_class" => $filedClass . "glue first last",
                "heading" => esc_attr__("General Color", 'massive-dynamic'),
                'group' => esc_attr__("Load More Button", 'massive-dynamic'),
                "param_name" => "multisize_button_color",
                "admin_label" => false,
                "opacity" => true,
                "value" => "rgba(0,0,0,1)",
                "description" => esc_attr__("Enter optional button's color", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "multisize_load_more",
                    'value' => array('yes'),
                )
            ),//general color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "button_hover_color_separator" . ++$separatorCounter,
                "edit_field_class" => $filedClass . "stick-to-top",
                'group' => esc_attr__("Load More Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "multisize_button_style",
                    'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
                ),
            ),//separator
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Text Color", 'massive-dynamic'),
                "param_name" => "multisize_button_text_color",
                'group' => esc_attr__("Load More Button", 'massive-dynamic'),
                "admin_label" => false,
                "opacity" => true,
                "description" => esc_attr__("Enter optional button's color", 'massive-dynamic'),
                'value' => '#fff',
                "dependency" => array(
                    'element' => "multisize_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),//text color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "button_hover_color_separator" . ++$separatorCounter,
                'group' => esc_attr__("Load More Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "multisize_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),//separator
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue",
                "heading" => esc_attr__("Bg Hover Color", 'massive-dynamic'),
                "param_name" => "multisize_button_bg_hover_color",
                "admin_label" => false,
                "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
                'group' => esc_attr__("Load More Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "multisize_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
                'value' => '#9b9b9b'
            ),//bg hover color
            array(
                "type" => 'md_vc_separator',
                "param_name" => "multisize_button_color_separator" . ++$separatorCounter,
                'group' => esc_attr__("Load More Button", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "multisize_button_style",
                    'value' => array('fill-oval', 'fill-rectangle'),
                ),
            ),//separator
            array(
                "type" => "md_vc_colorpicker",

                "edit_field_class" => $filedClass . "glue last",
                "heading" => esc_attr__("Text Hover Color", 'massive-dynamic'),
                'group' => esc_attr__("Load More Button", 'massive-dynamic'),
                "param_name" => "multisize_button_hover_color",
                "admin_label" => false,
                "value" => "rgb(255,255,255)",
                "description" => esc_attr__("Enter optional button hover's color", 'massive-dynamic'),
                "dependency" => array(
                    'element' => "multisize_button_style",
                    'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
                ),

            ),//text hover color

            array(
                "type" => 'md_vc_separator',
                "param_name" => "multisize_button_hover_color_separator" . ++$separatorCounter,
                'group' => esc_attr__("Load More Button", 'massive-dynamic'),
                'dependency' => array(
                    'element' => "multisize_load_more",
                    'value' => array('yes'),
                )
            ),//separator

            array(
                "type" => "md_vc_description",
                "param_name" => "multisize_item_number_description",
                "admin_label" => false,
                "group" => esc_attr__("Load More Button", 'massive-dynamic'),
                "value" => '<ul><li>' . esc_attr__('Please note that Load More functionality does not work in builder view for technical reasons.', 'massive-dynamic') . '</li></ul>',
            ),
        )
    )
);

pixflow_add_params('md_portfolio_multisize', pixflow_addAnimationTab('md_portfolio_multisize'));
