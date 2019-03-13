<?php

// add a Customizer link to the WP Toolbar
function pixflow_custom_toolbar_link($wp_admin_bar)
{
    $pageID = 0;
    $site_url = get_site_url();
    if (is_home()) {
        $pageID = get_option('page_for_posts');
    } elseif (function_exists('is_shop') && (is_shop() || is_product_category()) && !is_product()) {
        $pageID = get_option('woocommerce_shop_page_id');
    } else if(is_category()){
        $category_id = get_cat_ID( single_cat_title('' , false ) );
    }else{
        $pageID = get_the_ID();
    }
    if ($pageID != 0){
        $link = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    } else {
        $link = home_url('/');
    }
    $link = isset($category_id) ? '?cat=' . $category_id : $link ;
    $address = $link ;
    if( ( function_exists('is_shop') && (is_shop() || is_product_category()) && !is_product() )  ){
        global $wp;
        $address =  strtok( add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) , '?' );
    }
    // Add setting button
    $setting_button = array(
        'id' => 'md_customizer_button',
        'title' => __('site Setting','massive-dynamic'),
        'href' => admin_url('customize.php?url='.urlencode($address)),
        'meta' => array(
            'class' => 'pixflow_custom_links md_customizer',
            'title' => __('Edit Setting','massive-dynamic')
        )
    );

    $clear_cache_button = array(
        'id' => 'md_clear_cache_button',
        'title' => __('Clear Cache','massive-dynamic'),
        'href' => "#",
        'meta' => array(
            'class' => 'pixflow_custom_links md_customizer',
            'title' => __('Clear Cache','massive-dynamic')
        )
    );
    // Add Builder button
    if(pixflow_is_builder_editable(get_the_ID()) == true){
        $builder_url = (count($_GET))?'&':'?';
        $address .= $builder_url.'mbuilder=true';
        $builder_button = array(
            'id' => 'md_setting_button',
            'title' => __('Edit Content','massive-dynamic'),
            'href' => $address,
            'meta' => array(
                'class' => 'pixflow_custom_links md_builder',
                'title' => __('Edit Content','massive-dynamic')
            )
        );
    }

    if (!is_admin()) {

        $wp_admin_bar->add_node($clear_cache_button);
        if(pixflow_is_builder_editable(get_the_ID()) == true){
            $wp_admin_bar->add_node($builder_button);
        }
        $wp_admin_bar->add_node($setting_button);
    }



}
add_action('admin_bar_menu', 'pixflow_custom_toolbar_link', 999);

// Style Our Customizer Button
function pixflow_style_admin_bar()
{
    $inline_css = '#wpadminbar .pixflow_custom_links a {' .
        'text-transform: uppercase;' .
        'background-color: transparent;' .
        'font-size: 9px;' .
        'color: #bbc5ff;' .
        'letter-spacing: 2px;' .
        'padding: 0 18px 0 18px !important;' .
        'transition: all 0.3s ease-in;' .
        'display: flex;'.
        'align-items: center;'.
        '}' ;

    $inline_css .= '#wpadminbar.nojq .quicklinks .ab-top-menu>li>.ab-item:focus,'.
        '#wpadminbar:not(.mobile) .ab-top-menu>.pixflow_custom_links:hover>.ab-item, '.
        '#wpadminbar:not(.mobile) .ab-top-menu>li>.ab-item:focus{'.
        'background-color: transparent;' .
        'color: #bbc5ff;'.
        'opacity : .7'.
        '}';

    $inline_css .= '#wpadminbar .pixflow_custom_links {' .
        'background-color: #3242a2;' .
        'transition : background-color .3s;' .
        '}' ;

    $inline_css .= '#wpadminbar .pixflow_custom_links:hover {' .
        'background-color: #253074;' .
        '}' ;

    $inline_css .= '#wpadminbar .pixflow_custom_links a:hover {' .
        'background-color: rgba(75, 162, 94, 0.65);' .
        'color: #bbc5ff;' .
        '}' ;

    $inline_css .= '#wpadminbar .pixflow_custom_links a:before {' .
        'font: 400 13px/1 pixflow-font-library;' .
        '}' ;

    $inline_css .= '#wpadminbar .pixflow_custom_links a:hover:before {' .
        'color:#bbc5ff;' .
        '}' ;

    $inline_css .= '#wpadminbar .pixflow_custom_links.md_builder a:before {' .
        'content: "";' .
        'width:12px;'.
        'height:12px;'.
        '}' ;
    $inline_css .= '#wpadminbar #wp-admin-bar-md_setting_button a {' .
        'background-image : url('.PIXFLOW_THEME_LIB_URI.'/assets/img/edit-setting.png);'.
        'background-repeat:no-repeat;'.
        'background-position: 18px center;'.
        '}' ;

    $inline_css .= '#wp-admin-bar-md_clear_cache_button a:before {' .
        'content: "\e080" !important;' .
        'top:0;'.
        '}' ;

    $inline_css .= '#wpadminbar .pixflow_custom_links.md_customizer a:before {' .
        'content: "\e6e0";'.
        'top:0;'.
        '}' ;



    $inline_css .= '#wpadminbar  li.pixflow_custom_links.md_customizer{' .
        '  margin-right: 5px !important;' .
        '}';

    $inline_css .= '#wpadminbar ul#wp-admin-bar-root-default>li img{' .
        'display: inline-block;' .
        '}';

    $inline_css .= '#wp-admin-bar-vc_inline-admin-bar-link {' .
        'display: none;' .
        '}' ;

    wp_add_inline_style('admin-bar' , wp_strip_all_tags( $inline_css ) );
}
add_action('wp_enqueue_scripts', 'pixflow_style_admin_bar');

/*
 * Show notice to dashboard if htaccess config deny to load js cache files from upload dir
 * */
function pixflow_cache_file_permission_notice() {
    $current_page = get_current_screen();
    if($current_page->base != 'dashboard'){
        return;
    }
    $pixflow_wordpress_upload_dir = wp_upload_dir();
    $htaccess_file_path = $pixflow_wordpress_upload_dir['basedir'].'/.htaccess';
    if(file_exists($htaccess_file_path)){
        $htaccess_file = file_get_contents($htaccess_file_path);
        $result = preg_match_all('@<FilesMatch.*?".*?[^a-z](js)[^a-z].*?">.*?deny from all.*?</filesMatch>@is', $htaccess_file, $matches);
        if(0 == $result){
            return;
        }
    }else{
        return;
    }
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e('Massive Dynamic can not load JavaScript cache files from upload directory. If there is a .htaccess file in upload directory, please either edit/delete it or <a target="_blank" href="http://help.pixflow.net">contact our support team</a>  and we will help you.', 'massive-dynamic'); ?></p>
    </div>
    <?php
}
add_action('admin_notices', 'pixflow_cache_file_permission_notice');