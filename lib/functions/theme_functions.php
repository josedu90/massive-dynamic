<?php

//Return theme option
function pixflow_opt($option)
{
    $opt = get_option(PIXFLOW_OPTIONS_KEY);
    return stripslashes($opt[$option]);
}

//Echo theme option
function pixflow_eopt($option)
{
    echo pixflow_opt($option);
}

/**
 * Empty All Caches When New Version Realesed
 *
 *
 * @return void
 * @since 2.0.0
 */

function pixflow_empty_cache(){
    $last_version = get_option('pixflow_md_version') ;
    if( $last_version != PIXFLOW_THEME_VERSION  ){
        pixflow_empty_massive_cache();
        pixflow_empty_w3_total_cache();
        pixflow_empty_super_cache();
        update_option('pixflow_md_version', PIXFLOW_THEME_VERSION );
    }
    return true ;
}

/**
 * Empty All Caches From w3 Total Cache Plugin
 *
 *
 * @return void
 * @since 2.0.0
 */

function pixflow_empty_w3_total_cache(){
    if ( function_exists('is_plugin_active') && is_plugin_active( 'w3-total-cache/w3-total-cache.php' )  ) {
        if (function_exists('w3tc_dbcache_flush')) {
            w3tc_flush_all();
        }
    }
    return true ;
}

/**
 * Empty All Caches From Super Cache Plugin
 *
 *
 * @return void
 * @since 2.0.0
 */
function pixflow_empty_super_cache() {
    if (function_exists('is_plugin_active') && is_plugin_active('wp-super-cache/wp-cache.php')) {
        echo "<!--[if !IE]> Clear Super Cache <![endif]-->";
    }
    return true ;
}

/**
 * Empty All Caches That MD Created
 *
 *
 * @return void
 * @since 2.0.0
 */
function pixflow_empty_massive_cache(){
    require_once ABSPATH . 'wp-admin/includes/file.php';
    if (pixflow_get_filesystem()) {
        global $wp_filesystem;
    }
    if(isset($wp_filesystem) && $wp_filesystem != null ){
        $wp_filesystem->rmdir( PIXFLOW_THEME_CACHE , true);

    }else{
        array_map('unlink', glob(PIXFLOW_THEME_CACHE . "/*.*"));
        rmdir(PIXFLOW_THEME_CACHE);
    }
    return true;
}

function pixflow_old_get_theme_mod($name, $default = null, $post_id = false)
{
    $post_id =  pixflow_get_post_id($post_id);
    $post_type = get_post_type($post_id);
    if ((isset($_SESSION['temp_status'])) && $_SESSION['temp_status']['id'] == $post_id) {
        $setting_status = $_SESSION['temp_status']['status'];
    } elseif (get_option('page_for_posts') != $post_id && ($post_type == 'post' || $post_type == 'portfolio' || $post_type == 'product')) {
        if (isset($_SESSION[$post_type . '_status'])) {
            $setting_status = $_SESSION[$post_type . '_status'];
        } else {
            $setting_status = get_option($post_type . '_setting_status');
        }
    } else {
        $setting_status = get_post_meta($post_id, 'setting_status', true);
    }

    $setting_status = ($setting_status == 'unique') ? 'unique' : 'general';

    $customizedValues = (isset($_SESSION[$setting_status . '_customized'])) ? $_SESSION[$setting_status . '_customized'] : array();
    if (isset($_POST['customized'])) {
        $customizedValues = json_decode(wp_unslash($_POST['customized']), true);
    }

    if (count($customizedValues) && array_key_exists($name, $customizedValues)) {
        $value = $customizedValues[$name];

    } else {
        global $md_uniqueSettings;
        $settings = $md_uniqueSettings;

        if ($setting_status == 'unique' && in_array($name, $settings)) {

            if ($post_type == 'post' || $post_type == 'portfolio' || $post_type == 'product') {
                $value = get_option($post_type . '_' . $name);
                $value = ($value === false) ? get_theme_mod($name, $default) : $value;
            } else {
                $value = get_post_meta($post_id, $name, true);
                $value = ($value === 'false') ? false : $value;
            }

            if ($value === '') {
                $value = get_theme_mod($name, $default);
                $value = ($value === '') ? $default : $value;
            }
        } else {
            $value = get_theme_mod($name, $default);
        }
    }
    $value = ($value === 'false') ? false : $value;
    return $value;
}

function pixflow_localize_tynimce(){
    $data_values = array(
        'tinymce_code_plugin_url' => PIXFLOW_THEME_LIB_URI . '/mbuilder/assets/js/tinymce/code/plugin.min.js'
    );

    wp_localize_script('mBuilder', 'tinyMceValues', $data_values );
    wp_localize_script('adminJs', 'tinyMceValues', $data_values );
}
add_action('wp_enqueue_scripts','pixflow_localize_tynimce',99999);
