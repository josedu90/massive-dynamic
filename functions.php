<?php
remove_filter('the_content','wpautop');

/*Turn of the count function warning which only appear on PHP 7 */
if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
    error_reporting(E_ERROR | E_PARSE);
}

$pixflow_wordpress_upload_dir = wp_upload_dir();
$pixflow_wordpress_upload_dir['baseurl'] = set_url_scheme($pixflow_wordpress_upload_dir['baseurl']);
define('PIXFLOW_THEME_SLUG', 'massive-dynamic');
define('MASSIVEDYNAMIC_THEME_SLUG', 'massive-dynamic');

/**************************************************
 * FOLDERS
 **************************************************/

define('PIXFLOW_THEME_DIR', get_template_directory());
define('PIXFLOW_THEME_LIB', PIXFLOW_THEME_DIR . '/lib');
define('PIXFLOW_THEME_ADMIN', PIXFLOW_THEME_LIB . '/admin');
define('PIXFLOW_THEME_INCLUDES', PIXFLOW_THEME_LIB . '/includes');
define('PIXFLOW_THEME_DEMOS', PIXFLOW_THEME_INCLUDES . '/demo-importer/demos');
define('PIXFLOW_THEME_CUSTOMIZER', PIXFLOW_THEME_LIB . '/customizer');
define('PIXFLOW_THEME_LANGUAGES', PIXFLOW_THEME_LIB . '/languages');
define('PIXFLOW_THEME_CACHE', $pixflow_wordpress_upload_dir['basedir'] . '/md_cache');
define('PIXFLOW_THEME_SESSION', $pixflow_wordpress_upload_dir['basedir'] . '/session');
define('PIXFLOW_THEME_ASSETS', PIXFLOW_THEME_DIR . '/assets');
define('PIXFLOW_THEME_PLUGINS', PIXFLOW_THEME_DIR . '/plugins');
define('PIXFLOW_THEME_JS', PIXFLOW_THEME_ASSETS . '/js');
define('PIXFLOW_THEME_CSS', PIXFLOW_THEME_ASSETS . '/css');
define('PIXFLOW_THEME_IMAGES', PIXFLOW_THEME_ASSETS . '/img');
define('PIXFLOW_THEME_SHORTCODES', PIXFLOW_THEME_LIB . '/shortcodes');
define('PIXFLOW_THEME_SECTIONS', PIXFLOW_THEME_LIB . '/sections');
define('PIXFLOW_THEME_WIDGETS', PIXFLOW_THEME_LIB . '/widgets');
define('PIXFLOW_THEME_FUNCTONS', PIXFLOW_THEME_LIB . '/functions');
// Defining The List Of Font Requstes
$pixflow_merge_font_list = array();
/**************************************************
 * FOLDER URI
 **************************************************/

define('PIXFLOW_THEME_URI', get_template_directory_uri());
define('PIXFLOW_THEME_LIB_URI', PIXFLOW_THEME_URI . '/lib');
define('PIXFLOW_THEME_CACHE_URI' , $pixflow_wordpress_upload_dir['baseurl'] . '/md_cache');
define('PIXFLOW_THEME_ADMIN_URI', PIXFLOW_THEME_LIB_URI . '/admin');
define('PIXFLOW_THEME_CUSTOMIZER_URI', PIXFLOW_THEME_LIB_URI . '/customizer');
define('PIXFLOW_THEME_WOOCOMMERCE_URI', PIXFLOW_THEME_LIB_URI . '/woocommerce');
define('PIXFLOW_THEME_LANGUAGES_URI', PIXFLOW_THEME_LIB_URI . '/languages');
define('PIXFLOW_THEME_PLUGINS_URI', PIXFLOW_THEME_URI . '/plugins');
define('PIXFLOW_THEME_ASSETS_URI', PIXFLOW_THEME_URI . '/assets');
define('PIXFLOW_THEME_JS_URI', PIXFLOW_THEME_ASSETS_URI . '/js');
define('PIXFLOW_THEME_CSS_URI', PIXFLOW_THEME_ASSETS_URI . '/css');
define('PIXFLOW_THEME_IMAGES_URI', PIXFLOW_THEME_ASSETS_URI . '/img');
define('PIXFLOW_PLACEHOLDER_BLANK', PIXFLOW_THEME_IMAGES_URI . '/placeholders/blank.png');
define('PIXFLOW_PLACEHOLDER1', PIXFLOW_THEME_IMAGES_URI . '/placeholders/placeholder1.jpg');
define('PIXFLOW_PLACEHOLDER_BG', PIXFLOW_THEME_IMAGES_URI . '/placeholders/blank.png');
define('PIXFLOW_THEME_SHORTCODES_URI', PIXFLOW_THEME_LIB_URI . '/shortcodes');
define('PIXFLOW_THEME_WIDGETS_URI', PIXFLOW_THEME_LIB_URI . '/widgets');

/**************************************************
 * Check if session is available or not , if not it will start it
 *************************************************/
if ('' == session_id()) {
	if( is_multisite() ){
		require_once ( PIXFLOW_THEME_FUNCTONS . '/session_handler_functions.php' );
		$handler = new File_Session_Handler();
		session_set_save_handler(
			array($handler, 'open'),
			array($handler, 'close'),
			array($handler, 'read'),
			array($handler, 'write'),
			array($handler, 'destroy'),
			array($handler, 'gc')
		);
		register_shutdown_function('session_write_close');
		session_start();
	}else{
		//Check if Session Save Path Set or not , if Not we will create tmp directory in wordpress root folder and set it as session save path
		$session_path = ini_get('session.save_path');
		if ('' == $session_path) {
			if (!is_dir(ABSPATH . "/tmp")) {
				wp_mkdir_p(ABSPATH . "/tmp");
			}
			@session_save_path(ABSPATH . "/tmp");
		}
		if (function_exists("session_start")) {
			session_start();
		}
	}
}

/**************************************************
 * Content view
 *************************************************/
function pixflow_custom_excerpt_length($length)
{
    return 90;
}

add_filter('excerpt_length', 'pixflow_custom_excerpt_length', 999);

function pixflow_new_excerpt_more($more)
{
    return '<a class="more-link" href="' . get_permalink(get_the_ID()) . '">SEE DETAILS <span class="more-link-image"></span><span class="more-link-hover-image"></span></a>';

}

add_filter('excerpt_more', 'pixflow_new_excerpt_more');

/**************************************************
 * Text Domain
 **************************************************/

load_theme_textdomain('massive-dynamic', PIXFLOW_THEME_DIR . '/languages');

/**************************************************
 * Content Width
 **************************************************/

if (!isset($content_width)) $content_width = 1170;

/**************************************************
 * LIBRARIES
 **************************************************/
if (strpos($_SERVER['REQUEST_URI'], 'customize.php') !== false) {
    require_once(PIXFLOW_THEME_LIB . '/customizer-loader.php');
} else {
    require_once(PIXFLOW_THEME_LIB . '/framework.php');
    require_once(PIXFLOW_THEME_LIB . '/mbuilder/mbuilder.php');
    if($in_mbuilder){
        //Add Shortcodes
        $shortcodesBootStrap = PixflowFramework::Pixflow_Shortcodes();
        PixflowFramework::Pixflow_Require_Files( PIXFLOW_THEME_LIB . '/shortcodes',$shortcodesBootStrap);
        // Hide wordpress admin bar on Pixflow Builder
        add_filter('show_admin_bar', '__return_false');
    }
}

add_filter('wp_head','pixflow_set_favicon');

function pixflow_set_favicon(){
    $favicon_url=pixflow_get_theme_mod('favicon');
    if(''!=$favicon_url){
        echo("<link rel='shortcut icon' href='$favicon_url' type='image/x-icon'/>");
        echo("<link rel='apple-touch-icon' href='$favicon_url' type='image/x-icon'/>");
    }
}
