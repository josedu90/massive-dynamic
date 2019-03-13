<?php
require_once(PIXFLOW_THEME_LIB . '/includes/simple_html_dom.php');
include_once(ABSPATH . 'wp-admin/includes/plugin.php');

if (basename($_SERVER['PHP_SELF']) == 'customize.php') {
    if (session_id() == '' && !headers_sent()) {
        session_start();
    }
    unset($_SESSION['temp_status']);
    echo wp_kses('&nbsp;<div class="customizer-beautifier"></div>',array('div' => array('class' => array())));
}

//set sefault setting for add to any plugin
if (function_exists('A2A_menu_locale')) {
    $options = get_option('addtoany_options');
    $options['display_in_posts_on_front_page'] = '-1';
    $options['display_in_posts_on_archive_pages'] = '-1';
    $options['display_in_excerpts'] = '-1';
    $options['display_in_posts'] = '-1';
    $options['display_in_feed'] = '-1';
    $options['display_in_pages'] = '-1';
    $options['display_in_posts_on_front_page'] = '-1';
    $options['display_in_cpt_portfolio'] = '-1';
    if (isset($options['display_in_cpt_product'])) {
        $options['display_in_cpt_product'] = '-1';
    }
    update_option('addtoany_options', $options);
}

if(function_exists('wpforms_setting')){
    $options=$options = get_option('wpforms_settings');;
    $options['global-assets']=true;
    update_option( 'wpforms_settings',$options);
}

// Global Variabel
$jsString = '';
$pixflow_general_settings = $pixflow_unique_settings = array();
$pixflow_post_setting_status = array('no-post-id'=>'');
$pixflow_post_type = '';
$pixflow_post_id = '';
$library_to_include = array(
    'admin_bar' ,
    'assets_manage' ,
    'builder' ,
    'color_mange' ,
    'customizer' ,
    'demo_importer' ,
    'filesystem' ,
    'front_end' ,
    'helper' ,
    'media_mange' ,
    'shortcodes' ,
    'theme' ,
    'typography' ,
    'user_agent' ,
    'widget' ,
    'wordpress'
);


// Load the external function
foreach ($library_to_include as $func_file){
    require_once ( PIXFLOW_THEME_FUNCTONS . '/' . $func_file . '_functions.php' );
}