<?php
/**
 * Pixflow
 */


/*-----------------------------------------------------------------------------------*/
/*  Testimonial carousel
/*-----------------------------------------------------------------------------------*/

function pixflow_testimonial_carousel()
{

    $filedClass = 'vc_col-sm-12 vc_column ';
    $separatorCounter = 0;
    $count_num_param = 'testimonial_carousel_num';
    $testimonial_num = 5;
    $dropDown = array(
        esc_attr__("Three", 'massive-dynamic') => 3,
        esc_attr__("One", 'massive-dynamic') => 1,
        esc_attr__("Two", 'massive-dynamic') => 2,
        esc_attr__("Four", 'massive-dynamic') => 4,
        esc_attr__("Five", 'massive-dynamic') => 5,
    );

    $param = array(

        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue first last",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Testimonial Slides:", 'massive-dynamic'),
            "param_name" => $count_num_param,
            "admin_label" => false,
            "value" => $dropDown
        ),
        array(
            "type" => "md_vc_colorpicker",
            "edit_field_class" => $filedClass . "glue first",
            "heading" => esc_attr__("Texts Color", 'massive-dynamic'),
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "testimonial_carousel_text_color",
            "value" => '#000',
            "admin_label" => false,
            "opacity" => true
        ),
        array(
            "type" => 'md_vc_separator',
            "group" => esc_attr__("General", 'massive-dynamic'),
            "param_name" => "testimonial_carousel_separator" . ++$separatorCounter,
        ),
        array(
            "type" => "dropdown",
            "edit_field_class" => $filedClass . "glue last",
            "group" => esc_attr__("General", 'massive-dynamic'),
            "heading" => esc_attr__("Text size", 'massive-dynamic'),
            "param_name" => "testimonial_carousel_text_size",
            "description" => esc_attr__("Paragraph Size", 'massive-dynamic'),
            "admin_label" => false,
            "value" => array(
                "H6" => "h6",
                "H1" => "h1",
                "H2" => "h2",
                "H3" => "h3",
                "H4" => "h4",
                "H5" => "h5"
            ),
        ),
    );

    for ($i = 1; $i <= (int)$testimonial_num; $i++) {
        $value = array();

        for ($k = $i; $k <= $testimonial_num; $k++) {
            $value[] = (string)$k;
        }

        $param[] = array(
            "type" => 'attach_image',
            "edit_field_class" => $filedClass . "first glue last",
            "heading" => esc_attr__('Title Image', 'massive-dynamic'),
            "param_name" => "testimonial_carousel_img_" . $i,
            "description" => esc_attr__("Testimonial Title", 'massive-dynamic'),
            "group" => esc_attr__("Slide", 'massive-dynamic') . $i,
            "admin_label" => false,
            "dependency" => array(
                "element" => $count_num_param,
                "value" => $value
            ),
        );


        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . " first glue",
            "group" => esc_attr__("Slide", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Name", 'massive-dynamic'),
            "param_name" => "testimonial_carousel_name_" . $i,
            "admin_label" => false,
            "value" => 'Mari Javani',
            'dependency' => array(
                'element' => $count_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "glue",
            "group" => esc_attr__("Slide", 'massive-dynamic') . $i,
            "param_name" => "testimonial_carousel_slide_" . $i . "_separator" . ++$separatorCounter,
            'dependency' => array(
                'element' => $count_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "textfield",
            "edit_field_class" => $filedClass . "glue",
            "group" => esc_attr__("Slide", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Job Name", 'massive-dynamic'),
            "param_name" => "testimonial_carousel_job_name_" . $i,
            "admin_label" => false,
            "value" => 'Graphic Designer, Stupids Magazine',
            'dependency' => array(
                'element' => $count_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => 'md_vc_separator',
            "edit_field_class" => $filedClass . "glue",
            "group" => esc_attr__("Slide", 'massive-dynamic') . $i,
            "param_name" => "testimonial_carousel_slide_" . $i . "_separator" . ++$separatorCounter,
            'dependency' => array(
                'element' => $count_num_param,
                'value' => $value
            ),
        );

        $param[] = array(
            "type" => "textarea",
            "edit_field_class" => $filedClass . "glue last",
            "group" => esc_attr__("Slide", 'massive-dynamic') . $i,
            "heading" => esc_attr__("Description", 'massive-dynamic'),
            "param_name" => "testimonial_carousel_desc_" . $i,
            "admin_label" => false,
            "value" => 'orem ipsum dolor sit amet, nec in adipiscing purus luctus, urna pellentesque fringilla vel, non sed arcu integevestibulum in lorem nec',
            'dependency' => array(
                'element' => $count_num_param,
                'value' => $value
            ),
        );






    }
    return $param;
}

//Register "container" content element. It will hold all your inner (child) content elements
pixflow_map(array(
    "name" => esc_attr__("Testimonial Carousel", 'massive-dynamic'),
    "base" => "md_testimonial_carousel",
    "show_settings_on_create" => false,
    "category" => esc_attr__('Business', 'massive-dynamic'),
    "params" => pixflow_testimonial_carousel()
));

pixflow_add_params('md_testimonial_carousel', pixflow_addAnimationTab('md_testimonial_carousel'));
