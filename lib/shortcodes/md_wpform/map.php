<?php
/*-----------------------------------------------------------------------------------*/
/*  WP FORM Shortcode
/*-----------------------------------------------------------------------------------*/
global $separatorCounter;
$separatorCounter = 1;
pixflow_map(
    array(
        "name" => esc_attr__('WP Form', 'massive-dynamic'),
        "base" => "md_wpform",
        "category" => esc_attr__("Basic", 'massive-dynamic'),
        'show_settings_on_create' => false,
        "allowed_container_element" => 'vc_row',
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => esc_attr__("Form Name", 'massive-dynamic'),
                "param_name" => "md_form_id",
                "edit_field_class" => $filedClass . "glue first last",
                "value" => get_wp_form_list(),
            ),
        )
    )
);

pixflow_add_params('md_wpform', pixflow_addAnimationTab('md_wpform'));

function get_wp_form_list(){
    $list=[];
    $list['Not Selected']='';
    $args = array(
        'numberposts' => -1,
        'post_type' => 'wpforms',
    );
    $postList=get_posts($args);
    foreach($postList as $key => $value){
        $list[$value->post_title]=$value->ID;
    }
    return ($list);
}