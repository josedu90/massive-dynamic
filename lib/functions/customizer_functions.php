<?php

function pixflow_get_post_id($post_id = false){

    if ($post_id != false) {
        $post_id = $post_id;
    } elseif (isset($_SESSION['pixflow_post_id']) && $_SESSION['pixflow_post_id'] != null) {
        $post_id = $_SESSION['pixflow_post_id'];
    } else {
        if (is_home() || is_404() || is_search()) {
            $post_id = get_option('page_for_posts');
        } elseif (function_exists('is_shop') && (is_shop() || is_product_category()) && !is_product()) {
            $post_id = get_option('woocommerce_shop_page_id');
        } else {
            $post_id = get_the_ID();
        }
    }
    return $post_id;

}

function pixflow_redirectToCustomizer(){
    remove_filter('install_plugin_complete_actions', 'pixflow_redirectToCustomizer');
    return '';
}

function pixflow_get_assets_for_customizer($shortcodes_list){

    $js_content = $css_content = '';
    foreach($shortcodes_list as $shortcode):
        $dependencies = pixflow_load_dependency($shortcode);
        $js_content .= $dependencies['js'];
        $js_content .= @file_get_contents(PIXFLOW_THEME_LIB.'/shortcodes/'. $shortcode . '/script.min.js');
        $css_content .= $dependencies['css'];
        $css_content .= @file_get_contents(PIXFLOW_THEME_LIB.'/shortcodes/'. $shortcode . '/style.min.css');
    endforeach;

    wp_enqueue_style( 'custom-style', pixflow_path_combine(PIXFLOW_THEME_CSS_URI,'custom-style.min.css'));
    wp_add_inline_style( 'custom-style', $css_content );
    wp_enqueue_script( 'custom-script', pixflow_path_combine(PIXFLOW_THEME_JS_URI,'custom-script.min.js'));
    wp_add_inline_script( 'main-custom-js', $js_content );
    return ;
}