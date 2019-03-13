<?php
/*
* get post setting status
* return unique or general
*/
function pixflow_get_post_setting_status($post_id=false){
    $id = $post_id;
    global $pixflow_post_setting_status;
    if($id && isset($pixflow_post_setting_status[$id])){
        return $pixflow_post_setting_status[$id];
    }elseif($pixflow_post_setting_status['no-post-id']!=''){
        return $pixflow_post_setting_status['no-post-id'];
    }
    $post_id =  pixflow_get_post_id($post_id);
    global $pixflow_post_id;
    $pixflow_post_id = $post_id;
    $post_type = get_post_type($post_id);
    global $pixflow_post_type;
    $pixflow_post_type = $post_type;
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
    if($id){
        $pixflow_post_setting_status[$id] = $setting_status;
    }else{
        $pixflow_post_setting_status['no-post-id'] = $setting_status;
    }
    return $setting_status;
}

/*
 * Get value from cashed setting for general setting and cache setting if its not cashed before
 * */
function pixflow_get_general_setting($setting,$default){
    if((isset($_REQUEST['action']) && $_REQUEST['action'] == 'pixflow-get-setting') || is_customize_preview()){
        return get_theme_mod($setting, $default);
    }
    global $pixflow_general_settings;
    if(!count($pixflow_general_settings)){
        $pixflow_general_settings = get_theme_mods();
    }
    return isset($pixflow_general_settings[$setting])?$pixflow_general_settings[$setting]:$default;
}

/*
 * Get value from cashed setting for unique setting and cache setting if its not cashed before
 * */
function pixflow_get_unique_setting($post_id,$post_type,$setting,$default){
    global $pixflow_unique_settings;
    if(!count($pixflow_unique_settings)){
        if ($post_type == 'post' || $post_type == 'portfolio' || $post_type == 'product') {
            $pixflow_unique_settings = wp_load_alloptions();
        } else {
            $settings = get_post_meta($post_id);
            foreach($settings as $key=>$val){
                $pixflow_unique_settings[$key] = $val[0];
            }
        }
    }
    if ($post_type == 'post' || $post_type == 'portfolio' || $post_type == 'product') {
        $value = (isset($pixflow_unique_settings[$post_type . '_' . $setting]) && $pixflow_unique_settings[$post_type . '_' . $setting] != '')?$pixflow_unique_settings[$post_type . '_' . $setting]:pixflow_get_general_setting($setting, $default);
        $value = ($value === false) ? pixflow_get_general_setting($setting, $default) : $value;
    } else {
        $value = (isset($pixflow_unique_settings[$setting]) && $pixflow_unique_settings[$setting] != '')?$pixflow_unique_settings[$setting]:pixflow_get_general_setting($setting, $default);
        $value = ($value === 'false') ? false : $value;
    }
    return $value;
}

//Return customizer option value
function pixflow_get_theme_mod($name, $default = null, $post_id = false){
    $setting_status = pixflow_get_post_setting_status($post_id);
    $customizedValues = (isset($_SESSION[$setting_status . '_customized'])) ? $_SESSION[$setting_status . '_customized'] : array();
    if (isset($_POST['customized'])) {
        $customizedValues = json_decode(wp_unslash($_POST['customized']), true);
    }
    if (count($customizedValues) && array_key_exists($name, $customizedValues)) {
        $value = $customizedValues[$name];
    }else{
        if ($setting_status == 'unique') {
            global $md_uniqueSettings;
            if (in_array($name, $md_uniqueSettings)) {
                global $pixflow_post_type;
                global $pixflow_post_id;
                $value = pixflow_get_unique_setting($pixflow_post_id,$pixflow_post_type,$name, $default);
            }else{
                $value = pixflow_get_general_setting($name, $default);
            }
        } else {
            $value = pixflow_get_general_setting($name, $default);
        }
    }
    $value = ($value === 'false') ? false : $value;
    $value = ($value === 'true') ? true : $value;
    return $value;
}

/*
 * return link for get started button on dashboard
 * @return string url of link
 * */
function pixflow_get_start_link($env = 'builder'){
    if (get_option('show_on_front') == 'posts' || (get_option('show_on_front') == 'page') && !is_object(get_post(get_option('page_on_front')))) {
        $sample_page_id = pixflow_get_sample_page_id();
        if(0 === $sample_page_id){
            $sample_page_id = pixflow_create_sample_page();
        }
        $url = get_permalink( $sample_page_id );
    }else{
        $url = home_url('/');
    }
    if($env == 'builder'){
        if( strpos($url , '?') !== false ){
            $url = $url.'&mbuilder=true';
        }else{
            $url = $url.'?mbuilder=true';
        }
    }elseif($env == 'customizer'){
        $url = admin_url('customize.php?url='.urlencode($url));
    }
    return  $url;
}

/*
 * get pixflow sample page id
 * @return int id of page if exist or 0 if page dose not exist
 * */
function pixflow_get_sample_page_id(){
    $args = array(
        'meta_query' => array(
            array(
                'key' => 'pixflow_sample_page',
                'value' => 'true',
                'compare' => '=',
                'type' => 'CHAR',
            ),
        ),
        'post_type' => 'page',
        'post_status' => 'publish',
        'numberposts' => 1
    );
    $posts = get_posts($args);
    if (count($posts)>0) {
        $id = $posts[0]->ID;
    } else {
        $id =  0;
    }
    return $id;
}

//extract spacing
function pixflow_extractSpacing($json = false, $marginTop = 0, $marginRight = 0, $marginBottom = 0, $marginLeft = 0, $paddingTop = 0, $paddingRight = 0, $paddingBottom = 0, $paddingLeft = 0)
{
    if ($json && $json != '') {
        $json = str_replace("``", '"', $json);
        $json = str_replace("'", '"', $json);
        $value = json_decode($json);
        $marginTop = $value->{"marginTop"};
        $marginRight = $value->{"marginRight"};
        $marginBottom = $value->{"marginBottom"};
        $marginLeft = $value->{"marginLeft"};
        $paddingTop = $value->{"paddingTop"};
        $paddingRight = $value->{"paddingRight"};
        $paddingBottom = $value->{"paddingBottom"};
        $paddingLeft = $value->{"paddingLeft"};
    }
    ob_start();
    ?>
    padding : <?php echo esc_attr($paddingTop . 'px ' . $paddingRight . 'px ' . $paddingBottom . 'px ' . $paddingLeft . 'px'); ?>;
    margin : <?php echo esc_attr($marginTop . 'px ' . $marginRight . 'px ' . $marginBottom . 'px ' . $marginLeft . 'px '); ?>;
    <?php
    return ob_end_flush();
}

function render_close_button(){
    $view_link = get_permalink( get_the_ID() );
    return $view_link;
}

function pixflow_is_builder_editable($id){

    if( ( function_exists('is_shop') &&  (is_woocommerce() || is_shop() || is_product_category() || is_product_tag() || is_product() || is_cart() ||
                is_checkout() || is_account_page() || is_wc_endpoint_url()) ) || ( true == is_home() || (true == is_singular( 'portfolio' )
                && 'standard' == pixflow_metabox('portfolio_options.template_type','standard')) ) || ( get_option('page_for_posts') == $id  ) || is_customize_preview() || post_password_required()) {
        return false;
    }else{
        return true ;
    }

}

function pixflow_save_custom_section(){

	if( isset( $_POST['section'] ) && $_POST['section_name'] ) {
		$section_params = $_POST['section'];
		$section_params['content'] = preg_replace('/(mbuilder-id=.*?")/i','',$section_params['content']);
		$section_list = get_option( 'pixflow_custom_section' );
		if( false !== $section_list ) {
			$section_list = json_decode( $section_list, true );
			$section_list[ $_POST['section_name'] ] = $section_params ;
			$section_list = json_encode( $section_list );
		} else {
			$section_list = array();
			$section_list[ $_POST['section_name'] ] =  $section_params;
			$section_list = json_encode( $section_list );
		}

		update_option( 'pixflow_custom_section', $section_list );
		wp_die('1');
	}

	wp_die('0');

}

function pixflow_delete_custom_section(){

	$section_list = get_option( 'pixflow_custom_section' );
	if ( isset( $_POST['section_name'] ) &&  false !== $section_list ){
		$section_list = json_decode( $section_list, true );
		if( isset( $section_list[ $_POST['section_name'] ] ) ){
			unset( $section_list[ $_POST['section_name'] ]  );
			$section_list = json_encode( $section_list );
			update_option( 'pixflow_custom_section', $section_list );
			wp_die('1');
		}

	}

	wp_die('0');
}


function pixflow_get_custom_section(){

	$section_list = get_option( 'pixflow_custom_section' );
	if ( false === $section_list ){
		$section_list = array();
	}

	wp_localize_script( 'mBuilder', 'customSections', $section_list );

}

add_action( 'wp_ajax_mBuilder_save_custom_section', 'pixflow_save_custom_section' );
add_action( 'wp_ajax_mBuilder_delete_custom_section', 'pixflow_delete_custom_section' );
add_filter( 'wp_footer', 'pixflow_get_custom_section' );
