<?php
// Demo Importer
add_action('wp_ajax_pixflow_ImportClearCache', 'pixflow_ImportClearCache');
add_action('wp_ajax_nopriv_pixflow_ImportClearCache', 'pixflow_ImportClearCache');
function pixflow_ImportClearCache()
{
    //if(!isset($_SESSION['importDemo']) || $_SESSION['importDemo'] != $_POST['demo']) {
    unset($_SESSION['importPosts']);
    unset($_SESSION['importRemove']);
    unset($_SESSION['importFiles']);
    unset($_SESSION['importImported']);
    unset($_SESSION['importContent']);
    unset($_SESSION['importDoIt']);
    unset($_SESSION['importProcessedPosts']);
    unset($_SESSION['importProcessedAuthors']);
    unset($_SESSION['importProcessedMenuItems']);
    unset($_SESSION['importProcessedTerms']);
    unset($_SESSION['importMenuItemOrphans']);
    unset($_SESSION['importMissingMenuItems']);
    //}elseif($_SESSION['importDemo'] == $_POST['demo']){
    unset($_SESSION['importDemo']);
    echo "retry";
    //}
}

add_action('wp_ajax_pixflow_ImportClearAllCache', 'pixflow_ImportClearAllCache');
add_action('wp_ajax_nopriv_pixflow_ImportClearAllCache', 'pixflow_ImportClearAllCache');
function pixflow_ImportClearAllCache()
{
    unset($_SESSION['importPosts']);
    unset($_SESSION['importRemove']);
    unset($_SESSION['importFiles']);
    unset($_SESSION['importImported']);
    unset($_SESSION['importContent']);
    unset($_SESSION['importDoIt']);
    unset($_SESSION['importProcessedPosts']);
    unset($_SESSION['importProcessedAuthors']);
    unset($_SESSION['importProcessedMenuItems']);
    unset($_SESSION['importProcessedTerms']);
    unset($_SESSION['importMenuItemOrphans']);
    unset($_SESSION['importMissingMenuItems']);

}

add_action('wp_ajax_pixflow_ImportDummyData', 'pixflow_ImportDummyData');
add_action('wp_ajax_nopriv_pixflow_ImportDummyData', 'pixflow_ImportDummyData');
function pixflow_ImportDummyData()
{
    @set_time_limit(0);
    // remove Front Page meta
    if (!isset($_SESSION['removeFrontPage'])) {
        $args = array(
            'post_type' => 'page'
        );
        $my_query = new WP_Query($args);
        if ($my_query->have_posts()) {
            while ($my_query->have_posts()) {
                $my_query->the_post();
                $id = get_the_ID();
                delete_post_meta($id, 'pixflow_front_page');
            } // end while
        } // end if
        wp_reset_postdata();
        $_SESSION['removeFrontPage'] = true;
    }

    require_once(ABSPATH . 'wp-admin/includes/file.php');
    WP_Filesystem(false,false,true);
    global $wp_filesystem;
    $demo = $_POST['demo'];
    $_SESSION['importDemo'] = $demo;
    $revslider = $_POST['revslider'];
    $purchase = $_POST['purchase'];
    $content = $_POST['content'];
    $setting = $_POST['setting'];
    $widget = $_POST['widget'];
    $media = $_POST['media'];
    $isStore = $_POST['isStore'];
    $revslider = ($revslider == 'false') ? false : true;
    $content = ($content == 'false') ? false : true;
    $setting = ($setting == 'false') ? false : true;
    $widget = ($widget == 'false') ? false : true;
    $media = ($media == 'false') ? false : true;
    $isStore = ($isStore == 'false') ? false : $isStore;
    // Check woocommerce is active
    $revsliderErr = false;
    $woocommerceErr = false;
    $cf7Err = false;

    $woocommerce = 'deactive';
    if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) || class_exists('WooCommerce')) {
        $woocommerce = 'active';
    }
    // Check contact form 7 is active
    $cf7 = 'deactive';
    if ((is_plugin_active('contact-form-7/wp-contact-form-7.php') || defined('WPCF7_PLUGIN'))) {
        $cf7 = 'active';
    }

    // Check Rev Slider is active
    $revsliderStatus = 'deactive';
    if (class_exists('RevSlider')) {
        $revsliderStatus = 'active';
    }
    if ($isStore && $woocommerce == 'deactive') {
        $woocommerceErr = true;
    }
    if ($revslider && $revsliderStatus == 'deactive') {
        $revsliderErr = true;
    }
    if ($cf7 == 'deactive' && $content == true) {
        $cf7Err = true;
    }

    if ($cf7Err == true || $pxPortfolioErr == true || $woocommerceErr == true || $revsliderErr == true) {
        $err = array();
        if ($cf7Err == true) {
            $err[] = esc_attr__('Please install & activate ContactForm7 before importing this demo data.', 'massive-dynamic');
        }
        if ($revsliderErr == true) {
            $err[] = esc_attr__('Please install & activate Revolution Slider before importing this demo data.', 'massive-dynamic');
        }

        if ($woocommerceErr == true) {
            $err[] = esc_attr__('Please install & activate WooCommerce before importing this demo data.', 'massive-dynamic');
        }
        print(json_encode($err));
        die();
    }

    $upload_dir = wp_upload_dir();
    if (!isset($_SESSION['importRemove']) || $_SESSION['importRemove'] !== true) {
        if (is_dir($upload_dir['basedir'] . '/demo')) {
            $dirPath = $upload_dir['basedir'] . '/demo/demo' . $demo . '/';
            $files = glob($dirPath . '*', GLOB_MARK);
            foreach ($files as $file) {
                $wp_filesystem->delete($file);
            }

            $wp_filesystem->rmdir( $dirPath );
            $wp_filesystem->rmdir( $upload_dir['basedir'] . '/demo/' );
        }
        $_SESSION['importRemove'] = true;
        echo 'continue';
        return;
    }
    if (!isset($_SESSION['importFiles'])) {
        $files = array();
        if ($revslider && $content) {
            $files[] = 'revslider.zip';
        }
        if ($content) {
            $files[] = 'content.xml';
        }
        if ($setting) {
            $files[] = 'customizer.dat';
            $files[] = 'theme-options.json';
        }
        if ($widget) {
            $files[] = 'widget.json';
        }
        $_SESSION['importFiles'] = $files;
    } else {
        $files = $_SESSION['importFiles'];
    }



    $demo_url = 'http://pixflow.co/import-demo.php?demo='.$demo;
    wp_remote_get( $demo_url, array(
            'timeout' => 45,
        )
    );

    $upload_dir = wp_upload_dir();
    $d_path = $upload_dir['basedir'] . '/demo/';
    $filepath = PIXFLOW_THEME_DEMOS . '/demo' . $demo . '.zip';
    $unzipfile = unzip_file($filepath, $d_path);
    if (is_wp_error($unzipfile)) {
        define('FS_METHOD', 'direct'); //lets try direct.
        WP_Filesystem();  //WP_Filesystem() needs to be called again since now we use direct !
        $unzipfile = unzip_file($filepath, $d_path);
    }
    if (!is_wp_error($unzipfile)) {
        $_SESSION['importFiles'] = array();
        global $md_allowed_HTML_tags;
        echo wp_kses('extracted successfully<br/>',array("br"=>array()));
    } else {
        $message = $unzipfile->get_error_message();
        $wp_filesystem->delete($d_path, true);
        return;
    }

    // Import Content
    if ($content && !isset($_SESSION['importContent'])) {

        if (!class_exists('WP_Import')) {
            //Try to use custom version of the plugin
            require_once PIXFLOW_THEME_INCLUDES . '/demo-importer/wordpress-importer.php';
        }
        $wp_import = new WP_Import();
        $wp_import->fetch_attachments = $media;
        // dont remove it
        /*if($media == false){
            $wp_import->placeholder = true;
        }*/
        echo wp_kses("-- Importing Content.xml File <br /> <br />",array("br"=>array()));
        $wp_import->import($upload_dir['basedir'] . '/demo/demo' . $demo . '/content.xml');
        $_SESSION['importContent'] = true;
        die('continue:1/1');
    }

    // Import Customizer Setting
    if ($setting) {
        if (!class_exists('Pixflow_CEI_Core')) {
            require_once PIXFLOW_THEME_INCLUDES . '/demo-importer/class-pixflow-cei-core.php';
        }
        global $wp_customize;
        //$customizer_file = content_url().'/uploads/demo/customizer.dat';
        echo wp_kses("-- Importing Customizer Setting <br /><br />",array("br"=>array()));
        Pixflow_CEI_Core::init('import', $wp_customize, $upload_dir['basedir'] . '/demo/demo' . $demo . '/customizer.dat');

        //set navigation to theme locations
        $d_path = $d_path . 'demo' . $demo . '/';
        $customizerResponse = ($wp_filesystem->exists($d_path . 'customizer.dat')) ? @file_get_contents($d_path . 'customizer.dat') : '';
        if ($customizerResponse == '') {
            echo esc_attr('customizer.dat does not exist!');
        }
        $contentResponse = ($wp_filesystem->exists($d_path . 'content.xml')) ? @file_get_contents($d_path . 'content.xml') : '';
        if ($contentResponse == '') {
            echo esc_attr('content.xml does not exist!');
        }

        $pos = strpos($customizerResponse, 'a:3');
        $customizerResponse = substr($customizerResponse, $pos);
        $data = @unserialize($customizerResponse);
        $menu_id = $data['mods']['nav_menu_locations']['primary-nav'];
        preg_match("~<wp:term>.*?<wp:term_id>$menu_id</wp:term_id>.*?<wp:term_slug><!\[CDATA\[(.*?)\]\]></wp:term_slug>~is", $contentResponse, $res);
        $term = get_term_by('slug', $res[1], 'nav_menu');
        $menu_id = $term->term_id;
        echo wp_kses("-- Menu Configuration <br /><br />",array("br"=>array()));
        if (is_int($menu_id)) {
            $locations['primary-nav'] = $menu_id;
            $locations['mobile-nav'] = $menu_id;
            set_theme_mod('nav_menu_locations', $locations);
        }
        // Set Front Page
        $args = array(
            'post_type' => 'page',
            'meta_query' => array(
                array(
                    'key' => 'pixflow_front_page',
                    'value' => 'true',
                    'compare' => '=',
                    'type' => 'CHAR',
                ),
            ),
        );
        $my_query = new WP_Query($args);
        if ($my_query->have_posts()) {
            while ($my_query->have_posts()) {
                $my_query->the_post();
                $id = get_the_ID();
                update_option('show_on_front', 'page');
                update_option('page_on_front', $id);
            } // end while
        } // end if
        wp_reset_postdata();
    }

    // Import Theme Setting like unique setting for posts, portfolios and products
    if($setting){
        $importer = new pixflow_export_import_theme_options();
        $importer->import($upload_dir['basedir'] . '/demo/demo' . $demo . '/theme-options.json');
    }


    //Import Widgets
    if ($widget) {
        // include Widget data class
        if (!class_exists('Pixflow_Widget_Data')) {
            require_once PIXFLOW_THEME_INCLUDES . '/demo-importer/class-widget-data.php';
        }

        $widget_data = new Pixflow_Widget_Data();
        echo wp_kses("-- Importing Widgets <br /><br />",array("br"=>array()));
        $widget_data->ajax_import_widget_data(content_url() . '/uploads/demo/demo' . $demo . '/widget.json');
    }


    // Import revslider
    if ($revslider) {

        require_once ABSPATH . 'wp-admin/includes/file.php';
        if (pixflow_get_filesystem()) {
            global $wp_filesystem;
        }
        $filepath = $upload_dir['basedir'] . '/demo/demo' . $demo . '/revslider.zip';
        ob_start();
        $slider = new RevSlider();
        echo wp_kses("-- Importing Revolution Slider <br /><br />",array("br"=>array()));
        $response = $slider->importSliderFromPost(true, true, $filepath, false, false);
        ob_end_clean();

    }


    // Remove Downloaded files
    $dirPath = $upload_dir['basedir'] . '/demo/demo' . $demo . '/';
    $files = glob($dirPath . '*', GLOB_MARK);

    foreach ($files as $file) {
        print("-- Removing $file <br /><br />");
        $wp_filesystem->delete($file);
    }
    $wp_filesystem->rmdir($dirPath);
    $wp_filesystem->rmdir($upload_dir['basedir'] . '/demo/');

    unset($_SESSION['importPosts']);
    unset($_SESSION['importImported']);
    unset($_SESSION['importFiles']);
    unset($_SESSION['importRemove']);
    unset($_SESSION['importContent']);
    unset($_SESSION['importDemo']);
    unset($_SESSION['removeFrontPage']);
    unset($_SESSION['importDoIt']);
    unset($_SESSION['importProcessedPosts']);
    unset($_SESSION['importProcessedAuthors']);
    unset($_SESSION['importProcessedMenuItems']);
    unset($_SESSION['importProcessedTerms']);
    unset($_SESSION['importMenuItemOrphans']);
    unset($_SESSION['importMissingMenuItems']);

    wp_cache_flush();

    $catArr = get_terms(array(
        'taxonomy' => 'skills',
        'hide_empty' => false,
        'fields' => 'ids',
    ));
    if (count($catArr)) {
        wp_update_term_count_now($catArr, 'skills');
    }

    return true;
    die();
}