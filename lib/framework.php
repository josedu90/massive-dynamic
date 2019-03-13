<?php

require_once(PIXFLOW_THEME_LIB .'/string.php');

class PixflowFramework {
    /**
     * Includes (require_once) php file(s) inside selected folder
     */
    public static function Pixflow_Require_Files($path, $fileName)
    {
        if(is_string($fileName))
        {
            require_once(pixflow_path_combine($path, $fileName) . '.php');
        }
        elseif(is_array($fileName))
        {
            foreach($fileName as $name)
            {
                require_once(pixflow_path_combine($path, $name) . '.php');
            }
        }
        else
        {
            //Throw error
            throw new Exception('Unknown parameter type');
        }
    }

    public static function Pixflow_Shortcodes($get_index_file = true)
    {
        $file_contents = @file_get_contents( PIXFLOW_THEME_SHORTCODES . '/shortcodes_list.json') ;

        $shortcodes_list = json_decode($file_contents,true);
        if( $get_index_file ) {
            $shortcodes_list = array_map("pixflow_shortcode_path", $shortcodes_list['shortcodes']);
        }else{
            $shortcodes_list = $shortcodes_list['shortcodes'];
        }
        return $shortcodes_list;
    }

}
function pixflow_shortcode_path($value) {
    return $value.'/index';
}
$pixflow_loaded_shortcodes = $pixflow_loaded_plugins = array();
//Include framework files
$requiredArray = array(
    'constants',
    'utilities',
    'admin/admin',
    'google-fonts',
    'scripts',
    'support',
    'retina-upload',
    'sidebars',
    'plugins-handler',
    'nav-walker',
    'menus',
    'shortcodes/shortcodes',
    'customizer/customizer',
    'metaboxes',
    'layout-functions',
    'unique-setting',
    'woocommerce/woocommerce',
    'instagram/instagram',
    'post-like',
);

PixflowFramework::Pixflow_Require_Files( PIXFLOW_THEME_LIB,$requiredArray);

//Add post types
PixflowFramework::Pixflow_Require_Files( PIXFLOW_THEME_LIB . '/post-types',
    array( 'blog','page','portfolio','featured-gallery'));

//Add widgets
PixflowFramework::Pixflow_Require_Files( PIXFLOW_THEME_LIB . '/widgets',
    array(
        'widget-recent_portfolio/index',
        'widget-recent_posts/index',
        'widget-progress/index',
        'widget-contact_info/index',
        'widget-instagram/index',
        'widget-text/index',
        'widget-social/index',
        //'widget-twitter',
        'widget-subscribe/index'
    )

);

if(is_customize_preview()){
    //Add Shortcodes
    $shortcodesBootStrap = PixflowFramework::Pixflow_Shortcodes();
    PixflowFramework::Pixflow_Require_Files( PIXFLOW_THEME_LIB . '/shortcodes',$shortcodesBootStrap);
}

pixflow_empty_cache();
if(!is_dir(PIXFLOW_THEME_CACHE)){
    wp_mkdir_p(PIXFLOW_THEME_CACHE);
}

/*
* Backup/Restore Theme Options
*/
class pixflow_export_import_theme_options {

    function export(){
        if (isset($_GET['theme_options']) && ($_GET['theme_options'] == 'export')) {
            header("Cache-Control: public, must-revalidate");
            header("Pragma: hack");
            header('Content-type: application/json');
            header('Content-Disposition: attachment; filename="theme-options.json"');
            echo json_encode($this->_get_options());
            die();
        }
    }
    function import($import_file) {

        // Import
        $options = json_decode(file_get_contents($import_file));
        if ($options) {
            foreach ($options as $name=>$value) {
                if($name == 'woocommerce_shop_page_id'){
                    $value = $_SESSION['importProcessedPosts'][$value];
                }
                update_option($name, $value);
            }
        }
    }

    function _get_options() {
        global $md_uniqueSettings;
        foreach ($md_uniqueSettings as $unique_setting){
            $export_options['product_'.$unique_setting] = null;
            $export_options['post_'.$unique_setting] = null;
            $export_options['portfolio_'.$unique_setting] = null;
        }
        $export_options['product_setting_status'] = null;
        $export_options['post_setting_status'] = null;
        $export_options['portfolio_setting_status'] = null;
        $export_options['woocommerce_shop_page_id'] = null;

        $all_options = wp_load_alloptions();

        $export_options = array_intersect_key($all_options, $export_options);
        return $export_options;
    }
}
if(is_admin()){
    $exporter = new pixflow_export_import_theme_options();
    $exporter->export();
}
