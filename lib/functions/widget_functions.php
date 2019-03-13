<?php
// detect and call short code
function pixflow_get_style_script_widget_text(){
    return pixflow_get_style_script_widget('widget-text');
}

function pixflow_get_style_script_widget_subscribe(){
    return pixflow_get_style_script_widget('widget-subscribe');
}

function pixflow_get_style_script_widget_recent_post (){
    return pixflow_get_style_script_widget('widget-recent_posts');
}

function pixflow_get_style_script_widget_portfolio(){
    return pixflow_get_style_script_widget('widget-recent_portfolio');
}

function pixflow_get_style_script_widget_contact(){
    return pixflow_get_style_script_widget('widget-contact_info');
}

function pixflow_get_style_script_widget_instagram(){
    return pixflow_get_style_script_widget('widget-instagram');
}

function pixflow_get_style_script_widget_social(){
    return pixflow_get_style_script_widget('widget-social');
}

function pixflow_get_style_script_widget_progress(){
    return pixflow_get_style_script_widget('widget-progress');
}

function pixflow_get_style_script_widget($widget_name = '')
{
    if($widget_name != '') {
        $dependent = pixflow_load_dependency($widget_name,'widget');
        if(file_exists(PIXFLOW_THEME_WIDGETS.'/'.$widget_name.'/script.js')) {
            $widget_script = @file_get_contents(PIXFLOW_THEME_LIB.'/widgets/'. $widget_name . '/script.min.js');
            $widget_script .= $dependent['js'];
            wp_add_inline_script('main-custom-js', $widget_script);
        }
        if(file_exists(PIXFLOW_THEME_WIDGETS.'/'.$widget_name.'/style.css')){
            $widget_style = @file_get_contents(PIXFLOW_THEME_LIB.'/widgets/'. $widget_name . '/style.min.css');
            $widget_style .= $dependent['css'];
            wp_add_inline_style('style', $widget_style);
        }

    }
    return ;
}