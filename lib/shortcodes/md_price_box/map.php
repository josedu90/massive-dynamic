<?php
/**
 * Pixflow
 */

/*-----------------------------------------------------------------------------------*/
/*  Pixflow Price Box
/*-----------------------------------------------------------------------------------*/

function pixflow_price_box()
{

    $filedClass = 'vc_col-sm-12 vc_column ';
    $separatorCounter = 0;
    $item_num_param = 'price_box_item_num';
    $item_num = 10;
    $dropDown = array(
        esc_attr__("Five", 'massive-dynamic') => 5,
        esc_attr__("One", 'massive-dynamic') => 1,
        esc_attr__("Two", 'massive-dynamic') => 2,
        esc_attr__("Three", 'massive-dynamic') => 3,
        esc_attr__("Four", 'massive-dynamic') => 4,
        esc_attr__("Five", 'massive-dynamic') => 5,
        esc_attr__("Six", 'massive-dynamic') => 6,
        esc_attr__("Seven", 'massive-dynamic') => 7,
        esc_attr__("Eight", 'massive-dynamic') => 8,
        esc_attr__("Nine", 'massive-dynamic') => 9,
        esc_attr__("Ten", 'massive-dynamic') => 10,

    );

    $param = array(
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Details", 'massive-dynamic'),
            "param_name" => "details_group",
            "edit_field_class" => $filedClass . "glue first last"
        ),
        array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "first glue last textNsize-text",
            "heading" => esc_attr__("Title", 'massive-dynamic'),
            "param_name" => "price_box_title",
            "value" => 'Personal',
            "admin_label" => false,
            "color_picker" => "price_box_title_color",
        ),
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue textNsize-size",
            "heading" => esc_attr__("Title Color", 'massive-dynamic'),
            "param_name" => "price_box_title_color",
            "admin_label" => false,
            "value" => "#623e95",
            "inline_color_picker" => true,
        ),
        array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "first glue",
            "heading" => esc_attr__("Price", 'massive-dynamic'),
            "param_name" => "price_box_price",
            "description" => esc_attr__("Type your price", 'massive-dynamic'),
            "admin_label" => false,
            "value" => '69.00',
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "price_box_separator" . ++$separatorCounter,
        ),
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Currency", 'massive-dynamic'),
            "param_name" => "price_box_currency",
            "admin_label" => false,
            "value" => array(
                esc_attr__('Dollar', 'massive-dynamic') => '$',
                esc_attr__('Euro', 'massive-dynamic') => '&euro;',
                esc_attr__('Pound', 'massive-dynamic') => '&pound;'
            )
        ),

        array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "first glue last textNsize-text",
            "heading" => esc_attr__("Subtitle", 'massive-dynamic'),
            "param_name" => "price_box_subtitle",
            "value" => 'Monthly',
            "admin_label" => false,
        ),
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Colors", 'massive-dynamic'),
            "param_name" => "details_group",
            "edit_field_class" => $filedClass . "glue first last"
        ),
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue first",
            "heading" => esc_attr__("General Color", 'massive-dynamic'),
            "param_name" => "price_box_general_color",
            "admin_label" => false,
            "value" => "#96df5c",
        ),
        array(
            "type" => 'md_vc_separator',
            "param_name" => "price_box_separator" . ++$separatorCounter,
        ),
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Border Color", 'massive-dynamic'),
            "param_name" => "price_box_border_color",
            "admin_label" => false,
            "value" => "#cccccc",
        ),
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Offer", 'massive-dynamic'),
            "param_name" => "details_group",
            "edit_field_class" => $filedClass . "glue first last"
        ),
        array(
            'type' => 'md_vc_checkbox',
            "edit_field_class" => $filedClass . "first glue last",
            'heading' => esc_attr__('Activate', 'massive-dynamic'),
            'param_name' => 'price_box_use_button',
            'value' => array(esc_attr__('Yes', 'massive-dynamic') => 'yes'),
            'checked' => true,
            "group" => esc_attr__("Button", 'massive-dynamic'),
        ),//add btn
        array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "stick-to-top",
            "param_name" => "price_box_separator" . ++$separatorCounter,
            "group" => esc_attr__("Button", 'massive-dynamic'),
            "admin_label" => false,
            "dependency" => array(
                'element' => "price_box_use_button",
                'value' => array('yes')
            )
        ),//separator
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue last",
            "separate" => true,
            "heading" => esc_attr__("Button Style", 'massive-dynamic'),
            "param_name" => "price_box_button_style",
            "admin_label" => false,
            "value" => array(
                esc_attr__("Fill Rectangle", 'massive-dynamic') => "fill-rectangle",
                esc_attr__("Fill Oval", 'massive-dynamic') => "fill-oval",
                esc_attr__("Fade Oval", 'massive-dynamic') => "fade-oval",
                esc_attr__("Fade Square", 'massive-dynamic') => "fade-square",
                esc_attr__("Slide", 'massive-dynamic') => "slide",
                esc_attr__("Fill Slide", 'massive-dynamic') => "come-in",
                esc_attr__("Animation", 'massive-dynamic') => "animation",
                esc_attr__("Flash Animate", 'massive-dynamic') => "flash-animate"

            ),
            "group" => esc_attr__("Button", 'massive-dynamic'),
            "dependency" => array(
                'element' => "price_box_use_button",
                'value' => array('yes')
            )
        ),//btn kind
        array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "first glue",
            "heading" => esc_attr__("Text", 'massive-dynamic'),
            "param_name" => "price_box_button_text",
            "admin_label" => false,
            "value" => 'Purchase',
            "group" => esc_attr__("Button", 'massive-dynamic'),
            "dependency" => array(
                'element' => "price_box_use_button",
                'value' => array('yes')
            )
        ),//btn text
        array(
            "type" => 'md_vc_separator',
            "param_name" => "price_box_separator" . ++$separatorCounter,
            "group" => esc_attr__("Button", 'massive-dynamic'),
            "dependency" => array(
                'element' => "price_box_use_button",
                'value' => array('yes')
            )
        ),//separator
        array(
            "type" => "md_vc_iconpicker",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Choose an icon", 'massive-dynamic'),
            "param_name" => "price_box_button_icon_class",
            "group" => esc_attr__("Button", 'massive-dynamic'),
            "admin_label" => false,
            "dependency" => array(
                'element' => "price_box_use_button",
                'value' => array('yes')
            ),
            'value' => 'icon-empty'
        ),//btn icon
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue first last",
            "heading" => esc_attr__("General Color", 'massive-dynamic'),
            "group" => esc_attr__("Button", 'massive-dynamic'),
            "param_name" => "price_box_button_color",
            "admin_label" => false,
            "opacity" => true,
            "value" => "#f0f0f0",
            "dependency" => array(
                'element' => "price_box_use_button",
                'value' => array('yes')
            )
        ),//btn general color
        array(
            "type" => 'md_vc_separator',
            "param_name" => "price_box_separator" . ++$separatorCounter,
            "edit_field_class" => $filedClass . "stick-to-top",
            "group" => esc_attr__("Button", 'massive-dynamic'),
            "dependency" => array(
                'element' => "price_box_button_style",
                'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
            ),
        ),//separator
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue ",
            "heading" => esc_attr__("Text Color", 'massive-dynamic'),
            "group" => esc_attr__("Button", 'massive-dynamic'),
            "param_name" => "price_box_button_text_color",
            "admin_label" => false,
            "opacity" => true,
            "value" => "#7e7e7e",
            "dependency" => array(
                'element' => "price_box_button_style",
                'value' => array('fill-oval', 'fill-rectangle'),
            ),
        ),//btn text color
        array(
            "type" => 'md_vc_separator',
            "param_name" => "price_box_separator" . ++$separatorCounter,
            "group" => esc_attr__("Button", 'massive-dynamic'),
            "dependency" => array(
                'element' => "price_box_button_style",
                'value' => array('fill-oval', 'fill-rectangle'),
            ),
        ),//separator
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue",
            "heading" => esc_attr__("Bg Hover Color", 'massive-dynamic'),
            "group" => esc_attr__("Button", 'massive-dynamic'),
            "param_name" => "price_box_button_bg_hover_color",
            "admin_label" => false,
            "value" => "#96df5c",
            "dependency" => array(
                'element' => "price_box_button_style",
                'value' => array('fill-oval', 'fill-rectangle'),
            ),

        ),//btn bg hover color
        array(
            "type" => 'md_vc_separator',
            "param_name" => "price_box_separator" . ++$separatorCounter,
            "group" => esc_attr__("Button", 'massive-dynamic'),
            "dependency" => array(
                'element' => "price_box_button_style",
                'value' => array('fill-oval', 'fill-rectangle')
            )
        ),//separator
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Text Hover Color", 'massive-dynamic'),
            "group" => esc_attr__("Button", 'massive-dynamic'),
            "param_name" => "price_box_button_hover_color",
            "admin_label" => false,
            "value" => "#623e95",
            "dependency" => array(
                'element' => "price_box_button_style",
                'value' => array('come-in', 'slide', 'fade-oval', 'fill-oval', 'fill-rectangle', 'fade-square'),
            ),

        ),//btn text hover color
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue first",
            "heading" => esc_attr__("Button size", 'massive-dynamic'),
            "group" => esc_attr__("Button", 'massive-dynamic'),
            "param_name" => "price_box_button_size",
            "admin_label" => false,
            "value" => array(
                esc_attr__("Standard", 'massive-dynamic') => "standard",
                esc_attr__("Small", 'massive-dynamic') => "small"
            ),
            "dependency" => array(
                'element' => "price_box_use_button",
                'value' => array('yes')
            )
        ),//btn size
        array(
            "type" => 'md_vc_separator',
            "param_name" => "price_box_separator" . ++$separatorCounter,
            "group" => esc_attr__("Button", 'massive-dynamic'),
            "dependency" => array(
                'element' => "price_box_use_button",
                'value' => array('yes')
            )
        ),//separator
        array(
            'type' => 'md_vc_slider',
            "edit_field_class" => $filedClass . "glue last",
            'heading' => esc_attr__('Button Padding', 'massive-dynamic'),
            'param_name' => 'price_box_button_padding',
            'value' => '30',
            "group" => esc_attr__("Button", 'massive-dynamic'),
            'defaultSetting' => array(
                "min" => "0",
                "max" => "300",
                "prefix" => " px",
                "step" => "1",
            ),
            "dependency" => array(
                'element' => "price_box_use_button",
                'value' => array('yes')
            )
        ),//spacing
        array(
            "type" => "textfield",
            "group" => esc_attr__("Button", 'massive-dynamic'),
            "edit_field_class" => $filedClass . "glue first",
            "heading" => esc_attr__("Link URL", 'massive-dynamic'),
            "param_name" => "price_box_button_url",
            "admin_label" => false,
            "value" => "#",
            "description" => esc_attr__("Button destination URL", 'massive-dynamic'),
            "dependency" => array(
                'element' => "price_box_use_button",
                'value' => array('yes')
            )
        ),//btn url
        array(
            "type" => 'md_vc_separator',
            "param_name" => "price_box_separator" . ++$separatorCounter,
            "group" => esc_attr__("Button", 'massive-dynamic'),
            "dependency" => array(
                'element' => "price_box_use_button",
                'value' => array('yes')
            )
        ),//separator
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Link's target", 'massive-dynamic'),
            "group" => esc_attr__("Button", 'massive-dynamic'),
            "param_name" => "price_box_button_target",
            "admin_label" => false,
            "value" => array(
                esc_attr__("Open in same window", 'massive-dynamic') => "_self",
                esc_attr__("Open in new window", 'massive-dynamic') => "_blank"
            ),
            "dependency" => array(
                'element' => "price_box_use_button",
                'value' => array('yes')
            )
        ),//btn target

        array(
            "type" => "md_vc_checkbox",
            "edit_field_class" => $filedClass . "glue first last",
            "heading" => esc_attr__("Activate", 'massive-dynamic'),
            "param_name" => "price_box_offer_chk",
            "admin_label" => false,
            "value" => array(esc_attr__('No', 'massive-dynamic') => 'no'),
            'checked' => false
        ),//offer checkbox
        array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "stick-to-top",
            "param_name" => "price_box_separator" . ++$separatorCounter,
            "admin_label" => false,
            "dependency" => array(
                'element' => "price_box_offer_chk",
                'value' => array('yes')
            )
        ),//separator
        array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "last glue",
            "heading" => esc_attr__("Title", 'massive-dynamic'),
            "param_name" => "price_box_offer_title",
            "value" => "BEST OFFER",
            "description" => esc_attr__("Offer text box", 'massive-dynamic'),
            "admin_label" => false,
            'dependency' => array(
                'element' => "price_box_offer_chk",
                'value' => array('yes'),
            )
        ),//offer text

        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue first",
            "group" => esc_attr__("Items", 'massive-dynamic'),
            "heading" => esc_attr__("Item Number:", 'massive-dynamic'),
            "param_name" => $item_num_param,
            "admin_label" => false,
            "value" => $dropDown
        ),//list items
        array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("Items", 'massive-dynamic'),
            "param_name" => "price_box_separator" . ++$separatorCounter,
            "admin_label" => false,
        ),//separator

        array(
            "type" => "md_vc_colorpicker",
            "group" => esc_attr__("Items", 'massive-dynamic'),
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("Items Color", 'massive-dynamic'),
            "param_name" => "price_box_items_color",
            "admin_label" => false,
            "value" => "#898989",
        ),
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Content", 'massive-dynamic'),
            "param_name" => "content_group",
            "group" => esc_attr__("Items", 'massive-dynamic'),
            "edit_field_class" => $filedClass . "glue first last"
        ),

    );

    for ($i = 1; $i <= (int)$item_num; $i++) {
        $value = array();

        for ($k = $i; $k <= $item_num; $k++) {
            $value[] = (string)$k;
        }

        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "first last glue",
            "group" => esc_attr__("Items", 'massive-dynamic'),
            "heading" => esc_attr__("Item ", 'massive-dynamic') . $i,
            "param_name" => "price_box_list_item_" . $i,
            "value" => 'This is text for item' . $i,
            "admin_label" => false,
            'dependency' => array(
                'element' => $item_num_param,
                'value' => $value
            ),
        );
    }
    return $param;
}

pixflow_map(

    array(
        'base' => 'md_price_box',
        'name' => esc_attr__('Pixflow Price Box', 'massive-dynamic'),
        "show_settings_on_create" => false,
        "category" => esc_attr__('Commerce', 'massive-dynamic'),
        "allowed_container_element" => 'vc_row',
        "params" => pixflow_price_box()
    )
);

pixflow_add_params('md_price_box', pixflow_addAnimationTab('md_price_box'));
