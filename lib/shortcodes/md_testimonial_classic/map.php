<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------*/
/*  Testimonial Classic
/*-----------------------------------------------------------------------------------*/

function pixflow_testimoial_classic()
{

    $filedClass = 'vc_col-sm-12 vc_column ';
    $separatorCounter = 0;
    $count_num_param = 'testimonial_classic_num';
    $testimonial_num = 5;
    $dropDown = array(
        esc_attr__("Two", 'massive-dynamic') => 2,
        esc_attr__("One", 'massive-dynamic') => 1,
        esc_attr__("Three", 'massive-dynamic') => 3,
        esc_attr__("Four", 'massive-dynamic') => 4,
        esc_attr__("Five", 'massive-dynamic') => 5,
    );

    $param = array(
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Content", 'massive-dynamic'),
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "content_group",
            "edit_field_class" => $filedClass . "glue first last"
        ),


        array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue first last",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Title", 'massive-dynamic'),
            "param_name" => "testimonial_classic_title",
            "admin_label" => false,
            "value" => 'TESTIMONIAL'
        ),
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue first ",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Testimonial Slides:", 'massive-dynamic'),
            "param_name" => $count_num_param,
            "admin_label" => false,
            "value" => $dropDown
        ),
        array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "testimonial_classic_separator" . ++$separatorCounter,
        ),
        array(
            "type" => "md_group_title",
            "heading" => esc_attr__("Appearance", 'massive-dynamic'),
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "app_group",
            "edit_field_class" => $filedClass . "glue first last"
        ),
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__("General Color", 'massive-dynamic'),
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "md_testimonial_solid_color",
            "value" => '#000',
            "admin_label" => false,
            "opacity" => true
        ),

        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue first",
            "heading" => esc_attr__("Alignment", 'massive-dynamic'),
            "param_name" => "md_testimonial_alignment",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "value" => array(
                esc_attr__("Left", 'massive-dynamic') => "left",
                esc_attr__("Center", 'massive-dynamic') => "center",
            ),
        ),

        array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "testimonial_classic_separator" . ++$separatorCounter,
        ),
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue last",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Text size", 'massive-dynamic'),
            "param_name" => "md_testimonial_text_size",
            "description" => esc_attr__("Paragraph Size", 'massive-dynamic'),
            "admin_label" => false,
            "value" => array(
                "H5" => "h5",
                "H1" => "h1",
                "H2" => "h2",
                "H3" => "h3",
                "H4" => "h4",
                "H6" => "h6"
            ),
        ),

    );

    for ($i = 1; $i <= (int)$testimonial_num; $i++) {
        $value = array();

        for ($k = $i; $k <= $testimonial_num; $k++) {
            $value[] = (string)$k;
        }

        $param[] = array(
            "type" => "md_vc_base64_textarea",
            "edit_field_class" => $filedClass . "glue first",
            "group" => esc_attr__("Slide", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Description", 'massive-dynamic'),
            "param_name" => "testimonial_classic_desc_" . $i,
            "admin_label" => false,
            "value" => 'Ipsum dol conse ctetuer adipis cing elit. Morbi com modo, ipsum sed pharetr gravida, orciut magna rhoncus neque,id pulvinaodio lorem non sansunioto koriot.Morbcom magna rhoncus neque,id',
            'dependency' => array(
                'element' => $count_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "glue",
            "group" => esc_attr__("Slide", 'massive-dynamic') . $i,
            "param_name" => "testimonial_classic_slide_" . $i . "_separator" . ++$separatorCounter,
            'dependency' => array(
                'element' => $count_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue",
            "group" => esc_attr__("Slide", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Name and Job Title", 'massive-dynamic'),
            "param_name" => "testimonial_classic_name_job_" . $i,
            "admin_label" => false,
            "value" => 'Randy Nicklson . ATC resident manager co.',
            'dependency' => array(
                'element' => $count_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "glue",
            "group" => esc_attr__("Slide", 'massive-dynamic') . $i,
            "param_name" => "testimonial_classic_slide_" . $i . "_separator" . ++$separatorCounter,
            'dependency' => array(
                'element' => $count_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => 'attach_image',
            "edit_field_class" => $filedClass . "glue last",
            "heading" => esc_attr__('Title Image', 'massive-dynamic'),
            "param_name" => "testimonial_classic_img_" . $i,
            "description" => esc_attr__("Testimonial Title", 'massive-dynamic'),
            "group" => esc_attr__("Slide", 'massive-dynamic') . $i,
            "admin_label" => false,
            "dependency" => array(
                "element" => $count_num_param,
                "value" => $value
            ),
        );
    }
    return $param;
}

//Register "container" content element. It will hold all your inner (child) content elements
pixflow_map(array(
    "name" => esc_attr__("Testimonial Classic", 'massive-dynamic'),
    "base" => "md_testimonial_classic",
    "show_settings_on_create" => false,
    "category" => esc_attr__('Business', 'massive-dynamic'),
    "params" => pixflow_testimoial_classic()
));

pixflow_add_params('md_testimonial_classic', pixflow_addAnimationTab('md_testimonial_classic'));
