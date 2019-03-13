<?php
/**
 * mBuilder provides some functionality for editing shortcodes in customizer.
 *
 * mBuilder is a visual editor for shortcodes and makes working with shortcodes more easier and fun.
 * It is added as a part of Massive Dynamic since V3.0.0 and designed to work with customizer. Enjoy Editing ;)
 *
 * @author  PixFlow
 *
 */
$fonts_list = PIXFLOW_THEME_LIB_URI . '/googlefonts-small.txt';
$fonts_list_dir = PIXFLOW_THEME_LIB . '/googlefonts-small.txt';
$file_content = wp_remote_get(
    $fonts_list,
    array(
        "timeout" => 90,
        "sslverify" => false
    )
);
if(is_wp_error($file_content)){
    $fonts = json_decode( @file_get_contents( $fonts_list_dir ) );
}else{
    $fonts = json_decode(  $file_content['body'] );
}

$mBuilderShortcodes = array();
$mbuilder_sections = array(
	65 => array('title' => 'Section 65'),
	64 => array('title' => 'Section 64'),
	63 => array('title' => 'Section 63'),
	62 => array('title' => 'Section 62'),
	61 => array('title' => 'Section 61'),
	60 => array('title' => 'Section 60'),
	59 => array('title' => 'Section 59'),
	58 => array('title' => 'Section 58'),
	57 => array('title' => 'Section 57'),
	56 => array('title' => 'Section 56'),
	55 => array('title' => 'Section 55'),
	54 => array('title' => 'Section 54'),
	34 => array('title' => 'Section 34'),
	35 => array('title' => 'Section 35'),
	36 => array('title' => 'Section 36'),
	37 => array('title' => 'Section 37'),
	38 => array('title' => 'Section 38'),
	39 => array('title' => 'Section 39'),
	40 => array('title' => 'Section 40'),
	41 => array('title' => 'Section 41'),
	42 => array('title' => 'Section 42'),
	43 => array('title' => 'Section 43'),
	44 => array('title' => 'Section 44'),
	45 => array('title' => 'Section 45'),
	46 => array('title' => 'Section 46'),
	47 => array('title' => 'Section 47'),
	48 => array('title' => 'Section 48'),
	49 => array('title' => 'Section 49'),
	50 => array('title' => 'Section 50'),
	51 => array('title' => 'Section 51'),
	52 => array('title' => 'Section 52'),
	53 => array('title' => 'Section 53'),
	1 => array('title' => 'Section 1'),
	2 => array('title' => 'Section 2'),
	3 => array('title' => 'Section 3'),
	4 => array('title' => 'Section 4'),
	6 => array('title' => 'Section 6'),
    7 => array('title' => 'Section 7'),
	9 => array('title' => 'Section 9'),
    10 => array('title' => 'Section 10'),
	11 => array('title' => 'Section 11'),
	12 => array('title' => 'Section 12'),
	13 => array('title' => 'Section 13'),
	14 => array('title' => 'Section 14'),
	16 => array('title' => 'Section 16'),
	17 => array('title' => 'Section 17'),
	18 => array('title' => 'Section 18'),
	19 => array('title' => 'Section 19'),
	20 => array('title' => 'Section 20'),
	21 => array('title' => 'Section 21'),
	22 => array('title' => 'Section 22'),
	23 => array('title' => 'Section 23'),
	24 => array('title' => 'Section 24'),
	25 => array('title' => 'Section 25'),
	26 => array('title' => 'Section 26'),
	27 => array('title' => 'Section 27'),
	29 => array('title' => 'Section 29'),
	30 => array('title' => 'Section 30'),
	31 => array('title' => 'Section 31'),
	32 => array('title' => 'Section 32'),
	33 => array('title' => 'Section 33'),
);
$in_mbuilder = false;
$mBuilderExternalTypes = array();

/**
 * @version 1.1.0
 */
class MBuilder{

    /**
     * @var MBuilder - The reference to *Singleton* instance of this class
     */
    private static $instance;

    /**
     * @var array - models of each shortcode
     */
    public $models;

    /**
     * @var array - used shortcodes in content
     */
    public $used_shortcodes;

    /**
     * @var string - content of shortcodes
     */
    public $content = '';

    /**
     * Returns the *Singleton* instance of this class.
     *
     * @return MBuilder - The *Singleton* instance.
     * @since 1.0.0
     */
    public static function getInstance(){
        if (null === MBuilder::$instance) {
            MBuilder::$instance = new MBuilder();
        }

        return MBuilder::$instance;
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     * @since 1.0.0
     */
    private function __clone(){}

    /**
     * Private unserialize method to prevent unserializing of the *Singleton* instance.
     *
     * @return void
     * @since 1.0.0
     */
    private function __wakeup(){}

    /**
     * MBuilder constructor.
     */
    protected function __construct(){
        global $mBuilderShortcodes,$in_mbuilder;
        $loadBuilder = true;
        // Skip load Builder if its not in customizer
        if(is_customize_preview() || (defined('DOING_AJAX') && DOING_AJAX)) {
            $loadBuilder = false;
        }
        // Skip load Builder if its blog or single portfolio template page
        if ( true == is_home() || (true == is_singular( 'portfolio' ) && 'standard' == pixflow_metabox('portfolio_options.template_type','standard')) ) {
            $loadBuilder = false;
        }
        // Skip load Builder if its shop page
        if(function_exists('is_shop')){
            if(is_woocommerce() || is_shop() || is_product_category() || is_product_tag() || is_product() || is_cart() || is_checkout() || is_account_page() || is_wc_endpoint_url()){
                $loadBuilder = false;
            }
        }
        // Skip load Builder if its Password protect page
        if ( post_password_required() ) {
            $loadBuilder = false;
        }

        if($loadBuilder && $in_mbuilder) {
            $this->load_shortcode_maps();

            do_action('mBuilder_before_init');

            // Enqueue required assets
            wp_enqueue_style('massivebuilderfonts', PIXFLOW_THEME_LIB_URI . '/customizer/assets/css/massivebuilderfonts.min.css',array(),PIXFLOW_THEME_VERSION);
            wp_enqueue_style('tinymce_css', includes_url( 'css/' ) . 'editor.min.css',array(),PIXFLOW_THEME_VERSION);
            wp_enqueue_script('webfont', PIXFLOW_THEME_LIB_URI . '/customizer/assets/js/webfont.min.js', array(),PIXFLOW_THEME_VERSION,true);
            wp_enqueue_script('tinymce_js', includes_url( 'js/tinymce/' ) . 'wp-tinymce.php', array( 'jquery' ), false, true );
            wp_enqueue_script('mBuilder', PIXFLOW_THEME_LIB_URI . '/mbuilder/assets/js/mbuilder.min.js',array(),PIXFLOW_THEME_VERSION,true);
            wp_enqueue_script('color-picker-js', PIXFLOW_THEME_LIB_URI . '/mbuilder/assets/js/color-picker.min.js',array(),PIXFLOW_THEME_VERSION,true);
            wp_enqueue_script('meditor-js', PIXFLOW_THEME_LIB_URI . '/mbuilder/assets/js/meditor.min.js',array('mBuilder' , 'backbone'),PIXFLOW_THEME_VERSION,true);
            wp_enqueue_style('meditor-css', pixflow_path_combine(PIXFLOW_THEME_LIB_URI . '/mbuilder/assets/css/', 'meditor.min.css'), array(), PIXFLOW_THEME_VERSION);
            wp_enqueue_style('color-picker-css', pixflow_path_combine(PIXFLOW_THEME_LIB_URI . '/mbuilder/assets/css/', 'color-picker.min.css'), array(), PIXFLOW_THEME_VERSION);
            wp_enqueue_media();
            wp_enqueue_style('mBuilder-gizmo', pixflow_path_combine(PIXFLOW_THEME_LIB_URI . '/mbuilder/assets/css/', 'mbuilder.min.css'), array(), PIXFLOW_THEME_VERSION);

            wp_localize_script('mBuilder', 'mBuilderValues', $this->localize_values() );
            wp_enqueue_style('admin',pixflow_path_combine(PIXFLOW_THEME_LIB_URI,'/assets/css/admin.min.css'),false,PIXFLOW_THEME_VERSION);


            do_action('mBuilder_shortcodes_init');

            foreach($mBuilderShortcodes as $key => $value){
                unset($value['params']);
                $mBuilderShortcode[$key] = $value;
            }

            wp_localize_script('mBuilder', 'mBuilderShortcodes', $mBuilderShortcode);

            $this->map_loader();
            $this->external_types();
        }

    }

    /*
     * Print script for each shortcode on drop to define its map to the builder
     *
     * @param string $shortcode shortcode name
     * @return void
     */
    public static function print_shortcode_map( $shortcode ){
        global $mBuilderShortcodes;
        echo '<script>';
        echo 'builder.refresh_shortcode_params( true );';
        echo 'builder.shortcodes_param.' . $shortcode . '= ' . json_encode( $mBuilderShortcodes[ $shortcode ] );
        echo '</script>';
    }

    /*
     * Load used shortcodes map for each page that opens in the builder
     *
     * @return void
     */
    public function map_loader(){
        global $mBuilderShortcodes;
		global $mBuilderExternalTypes;
		global $fonts;
        $id = get_the_ID();
        $page_shortcodes = $this->list_used_shortcodes($id);
        $page_shortcodes_model = array();
        foreach ($page_shortcodes as $shortcode){
            if (isset($mBuilderShortcodes[$shortcode])){
                $page_shortcodes_model[$shortcode] = $mBuilderShortcodes[$shortcode];
            }
        }
		pixflow_add_custom_fields();
		$spectrum = PIXFLOW_THEME_CUSTOMIZER_URI.'/assets/js/spectrum.min.js';
		$spectrumcss = PIXFLOW_THEME_CUSTOMIZER_URI.'/assets/css/spectrum.min.css';

		$nouislider = PIXFLOW_THEME_CUSTOMIZER_URI.'/assets/js/jquery.nouislider.min.js';
		$nouislidercss= PIXFLOW_THEME_CUSTOMIZER_URI.'/assets/css/jquery.nouislider.min.css';

        $shortcode_maps = array(
            'shortcodes_param' => json_encode($page_shortcodes_model) ,
            'google_gonts' => $fonts ,
            'mBuilder_external_types' => $mBuilderExternalTypes ,
            'spectrum' => array(
                'js' => $spectrum ,
                'css' => $spectrumcss ,
            ) ,
            'nouislider' => array(
                'js' => $nouislider ,
                'css' => $nouislidercss
            )
        );
        wp_localize_script('mBuilder', 'shortcode_maps', $shortcode_maps);
    }

    /*
     * Load external field types template
     *
     * @return void
     */
    public function external_types(){
        global $mBuilderExternalTypes;
        pixflow_add_custom_fields();
        foreach ( $mBuilderExternalTypes as $type ):
            ?>
            <script type="text/html" id="tmpl-mbuilder-field-type-<?php echo $type['callback']?>">
                <?php echo call_user_func_array( $type[ 'callback' ], array( array(), '{{ value }}', '' , true ) );?>
            </script>
            <?php
        endforeach;
    }

    /*
     * Include all shortcode maps php files
     *
     * @return void
     */
    public static function load_shortcode_maps(){
        $shortcodes = PixflowFramework::Pixflow_Shortcodes(false);
        MBuilder::load_shortcode_map($shortcodes);
    }

    /*
     * Create a list of wordpress urls that we need in our js files
     * @return void
    */
    private function localize_values() {
        $mBuilderValues = array(
            'ajax_url'    => admin_url('admin-ajax.php'),
            'ajax_nonce'  => wp_create_nonce('ajax-nonce'),
            'deleteText'  => __('Delete','massive-dynamic'),
            'duplicateText'  => __('Duplicate','massive-dynamic'),
            'animationText'  => __('Animation','massive-dynamic'),
            'settingText'  => __('Setting','massive-dynamic'),
            'rowText'     => __('Row','massive-dynamic'),
            'layoutText'  => __('Layout','massive-dynamic'),
            'customColText'  => __('Custom Column','massive-dynamic'),
            'deleteDescText' => __('Are you sure ?','massive-dynamic'),
            'settingText'    => __('Setting','massive-dynamic'),
            'leaveMsg' => esc_attr__('You are about to leave this page and you haven\'t saved changes yet, would you like to save changes before leaving?','massive-dynamic'),
            'unsaved' => esc_attr__('Unsaved Changes!','massive-dynamic'),
            'saved' => esc_attr__('Publish','massive-dynamic'),
            'saving' => esc_attr__('Saving...','massive-dynamic'),
            'save' => esc_attr__('Publish','massive-dynamic'),
            'google_font' => PIXFLOW_THEME_LIB_URI . '/googlefonts.txt' ,
            'designText' => esc_attr__('Design','massive-dynamic'),
            'responsiveText' => esc_attr__('Responsive','massive-dynamic'),
            'spacingText' => esc_attr__('Spacing','massive-dynamic') ,
            'rowBackground'=> esc_attr__('Background','massive-dynamic') ,
            'saveMessages'=> esc_attr__('Would you mind save your changes before leaving?','massive-dynamic') ,
            'updateFirst'=> esc_attr__('Update First','massive-dynamic') ,
            'justLeave'=> esc_attr__('Just Leave','massive-dynamic') ,
            'applyClose'=> esc_attr__('Apply & Close' ,'massive-dynamic') ,
            'apply'=> esc_attr__('Apply' ,'massive-dynamic') ,
            'dontShow'=> esc_attr__('dont-show' ,'massive-dynamic') ,

        );
        return  $mBuilderValues;
    }

    /*
     * Include shortcode map php file
     *
     * @param string|array $shortcode name or array of shortcode names
     * @return void
    */
    public static function load_shortcode_map( $shortcode ) {
        $filedClass = 'vc_col-sm-12 vc_column ';
        static $separatorCounter = 0;
        if( is_string( $shortcode ) ) {

            if( file_exists( PIXFLOW_THEME_SHORTCODES . '/' . $shortcode . '/map.php' ) ) {
                require_once( PIXFLOW_THEME_SHORTCODES . '/' . $shortcode . '/map.php' );
            }

        } elseif( is_array( $shortcode ) ) {

            foreach( $shortcode as $name ) {
                if( file_exists( PIXFLOW_THEME_SHORTCODES . '/' . $name . '/map.php' ) ) {
                    require_once( PIXFLOW_THEME_SHORTCODES . '/' . $name . '/map.php' );
                }

            }

        } else {

            //Throw error
            throw new Exception( 'Unknown shortcode type' );

        }
    }



    public static function parseAttributes($attributes){
        $attr = json_decode(stripslashes($attributes),true);

        if(!is_array($attr)){

            if($attr == null){
                $attr = stripslashes($attributes);
            }
            $attributes = array();
            if(preg_match('/^ *\[/s',$attr )) {
                if (!preg_match('/^\[[^\]]*? /s', $attr)) {
                    return $attributes;
                }
                $attr = preg_replace('/^\[[^\]]*? /s','' ,$attr );
            }
            $i=0;

            while($attr) {
                if(++$i>200){
                    break;
                }
                $attr = trim($attr);
                if(preg_match('/^\].*/s',$attr )){
                    $attr = null;
                    break;
                }
                preg_match('/(?=[^\'"]*)[\'"]/s', $attr, $separator);

                if(isset($separator[0])){
                    if($separator[0] == '') {
                        echo esc_attr($attr);
                        break;
                    }
                    $attrs = explode($separator[0], $attr, 2);
                    $key = $attrs[0];
                    if(preg_match('/^'.$separator[0].'/s',$attrs[1])){
                        $value = array();
                        $value[0] = '';
                        $value[1] = '';
                        $value[2] = substr($attrs[1],1);
                    }else{
                        $value = preg_split("/([^\\\])$separator[0]/s", $attrs[1], 2, PREG_SPLIT_DELIM_CAPTURE);
                    }
                    $key = str_replace('=', '', $key);
                    if( ! (isset($value[0]) && isset($value[1]) && isset($value[2])) ){
                        $value = array();
                        $value[0] = '';
                        $value[1] = '';
                        $value[2] = substr($attrs[1],1);
                    }
                    $attr = $value[2];
                    $value = $value[0].$value[1];
                    $value = str_replace('\"','"',$value);
                    $key = trim($key);
                    $attributes[$key] = $value;
                }
            }
            return $attributes;
        }
        return $attr;
    }

    public static function getModelAttribute($attributes,$attr){
        $attrs = MBuilder::parseAttributes($attributes);
        if(isset($attrs[$attr])){
            return $attrs[$attr];
        }else{
            return false;
        }
    }

    /**
     * Prepare content from models
     *
     * @param $models - shortcode models
     *
     * @return string - content of the page by shortcode tags
     * @since 1.0.0
     */
    public function getContent($models){
        $this->content = '';
        $this->models = json_decode(stripslashes($models),true);

        // Find childs
        foreach ($this->models as $id=>$model) {
            $current_id = $id;
            $this->models[$id]['flag'] = false;
            $this->models[$id]['id'] = $id;
            //find childes
            $childes = array();
            foreach ($this->models as $key2=>$model2) {
                $el = $model2;
                if(isset($el['parentId'])){
                    if($el['parentId'] == $current_id){
                        $childes[] = $key2;
                    }
                }
            }
            $orderedChildes = array();
            $o = 1;
            foreach($childes as $child){
                if(array_key_exists('order', $this->models[$child])){
                    if(isset($orderedChildes[$this->models[$child]['order']])){
                        $orderedChildes[++$this->models[$child]['order']] = $child;
                    }else{
                        $orderedChildes[$this->models[$child]['order']] = $child;
                    }
                }else{
                    $orderedChildes[$o++] = $child;
                }
            }
            ksort($orderedChildes);
            $this->models[$id]['childes'] = $orderedChildes;
        }
        $els = $this->models;
        $rows = array();

        foreach($this->models as $key=>$item){
            if($item['type'] == 'vc_row'){
                $rows[$key] = $item['order'];
                unset($this->models[$key]);
            }
        }
        arsort($rows);
        foreach($rows as $key=>$item){
            $this->models = array($key=>$els[$key])+$this->models;
        }
        foreach ($this->models as $id=>$model) {
            if($this->models[$id]['flag']){
                continue;
            }else{
                $this->models[$id]['flag'] = true;
            }
            $this->generateContent($id);
        }
        $this->save_sections_images();
        return $this->content;
    }

    /**
     * Check content for external images of sections and save its as local
     *
     * @return content
     * @since 1.0.0
     */
    public function save_sections_images(){
        $content = $this->content;
        $result = preg_match_all('#http:\/\/theme.pixflow.net\/massive-dynamic\/.*?[.](jpg|jpeg|gif|png)#i', $content, $matches);
		if( $result ){
            $images = $matches[0];
            $images = array_unique($images);
            foreach($images as $image){
                $image_id = pixflow_save_remote_images( $image );
                if( $image_id ){
                    $content = str_replace($image, $image_id, $content);
                }
            }
        }
        $this->content = $content;
    }

    /**
     * Save content of page/post to the database
     *
     * @param $id - post/page ID
     *
     * @return void
     * @since 1.0.0
     */
    public function saveContent($id){
        $current_item = array(
            'ID'           => $id,
            'post_content' => $this->content,
        );
        $post_id = wp_update_post( $current_item, true );
        if (is_wp_error($post_id)) {
            $errors = $post_id->get_error_messages();
            foreach ($errors as $error) {
                echo esc_attr($error);
            }
        }else{
            echo 'updated';
        }
    }

    /**
     * replace shortcode models with wordpress shortcode pattern
     *
     * @param $id - Shortcode model ID
     *
     * @return void
     * @since 1.0.0
     */
    public function generateContent($id){
        $type = trim($this->models[$id]['type']);
        $attr = trim($this->models[$id]['attr']);


        $pat = '~el_id=".*?"~s';
        $attr = trim(preg_replace($pat,'', $attr));
        $childes = $this->models[$id]['childes'];
        $content = $this->models[$id]['content'];
        $attr = ($attr != '')?' '.$attr:$attr;
        // to prevent put double qoutation on VC Column
        if($type == 'vc_column'){
            $attr = str_replace('url("','url(``',$attr);
            $attr = str_replace('");','``)',$attr);
        }
        $this->content .= '['.$type.$attr.']';
        if(count($childes)){
            foreach ($childes as $child) {
                if( $this->models[$child]['flag']){
                    continue;
                }else{
                    $this->models[$child]['flag'] = true;
                }
                $this->content .= $this->generateContent($child);
            }
        }
        if($content != ''){
            $this->content .= $content;
        }
        $this->content .='[/'.$type.']';
    }

    public function generate_pages_models($page_id=null){
        if(null == $page_id){
            $page_id = get_the_ID();
        }
    	global $mBuilderModelIdArray,$in_mbuilder;
        $last_in_mbuilder = $in_mbuilder;
        $in_mbuilder =true;
		$page_content = get_post($page_id);

        if(!function_exists('pixflow_js_remove_wpautop')){
            require_once ('includes/visualcomposer-functions.php');
        }
        if($page_content) {
            pixflow_js_remove_wpautop($page_content->post_content);
        }
	    $this->models = $mBuilderModelIdArray;
        $in_mbuilder = $last_in_mbuilder;

	    return $this->models;
    }

    /**
     * Get shortcodes in text
     *
     * @param $content - content of shortcodes
     *
     * @return array - list of used shortcodes
     * @since 1.0.0
     */

    public function get_shortcodes_by_content($content){
        $used_shortcodes = array();
        $pat = "~\[[^\/][^=]*?( .*?)*?\]~s";
        if(preg_match_all($pat, $content, $mats)){
            $els = $mats[0];
            $dels = array_count_values($els);
            foreach($dels as $el=>$n){
                $el = substr($el,1);
                $el = str_replace(']','',$el);
                $el = explode(' ',trim($el));
                $used_shortcodes[] = $el[0];
            }
            $used_shortcodes = array_unique($used_shortcodes);
        }
        return $used_shortcodes;
    }

    public function list_used_shortcodes($page_id=null){
        if(null == $page_id){
            $page_id = get_the_ID();
        }
        $used_shortcodes = array();
        $content = get_post($page_id);
        if (! $content){
            return $used_shortcodes;
        }
        $content = $content->post_content;

        $this->used_shortcodes = $this->get_shortcodes_by_content($content);
        return $this->used_shortcodes;
    }

    /**
     * Generate static JS and CSS for each page based on their shortcodes after publish
     *
     * @param $id - Page ID
     * @param $models - Shortcode models
     *
     * @return boolean
     * @since 1.0.0
     */
    public function generate_static_js_css($id){
        require_once(ABSPATH . 'wp-admin/includes/file.php');

	    $page_js_path = PIXFLOW_THEME_CACHE . '/' . $id . '.js';
	    $page_css_path = PIXFLOW_THEME_CACHE . '/' . $id . '.css';
        WP_Filesystem(false,false,true);
        global $wp_filesystem;
        $models = array();
        $js_content = $css_content ='';
        if(empty($this->models) && (!file_exists($page_js_path) || !file_exists($page_css_path)) ) {
            $this->generate_pages_models($id);
        }
        if(empty($this->models)) {
            $this->models = array();
        }
        $used_do_shortcodes = array();
        $do_shortcodes = pixflow_load_do_shortcodes();
        foreach ($do_shortcodes as $shortcode){
            $used_do_shortcodes[] = array('attr'=>'','content'=>'','type'=>$shortcode);
        }
        if(count($used_do_shortcodes)){
            $this->models = $used_do_shortcodes + $this->models;
        }
        foreach($this->models as $model){
            if(!in_array($model['type'],$models)){
                $models[] = $model['type'];
                $dependencies = pixflow_load_dependency($model['type']);
                $js_content .= $dependencies['js'];
                $js_content .= @file_get_contents(PIXFLOW_THEME_LIB.'/shortcodes/'. $model['type'] . '/script.min.js');
                $css_content .= $dependencies['css'];
                $css_content .= @file_get_contents(PIXFLOW_THEME_LIB.'/shortcodes/'. $model['type'] . '/style.min.css');
            }
        }

        if ( false === file_put_contents(  PIXFLOW_THEME_CACHE .'/'.$id.'.js', $js_content) )
        {
            echo esc_attr__("error saving file!",'massive-dynamic');
        }
        if ( false === file_put_contents(  PIXFLOW_THEME_CACHE . '/'.$id.'.css', $css_content) )
        {
            echo esc_attr__("error saving file!",'massive-dynamic');
        }
    }

    /**
     * A filter on the_content if mBuilder is loaded to change normal texts to the Text Shortcode
     *
     * @since 1.0.0
     */
    public function textToShortcode($content){
        if(strpos($content,"[vc_row")===false){
            $temp = str_replace( array('<p>','</p>'), '', $content );
            if ( strlen( trim( $temp ) ) > 0 ) {
                $content = '[vc_row][vc_column][md_text md_text_title1="" md_text_title_separator="no"]'.$content.'[/md_text][/vc_column][/vc_row]';
            }
        }
        return $content;
    }

}

/**
 * Add visual composer classes to the editor
 *
 * @param $classes - classes of the body
 *
 * @return string - new classes for the body
 * @since 1.0.0
 */
function addBodyClasses($classes){
    global $in_mbuilder;
    if ($in_mbuilder) {
        $classes[] = 'compose-mode';
        $classes[] = 'vc_editor';
        $classes[] = 'pixflow-builder';
    }
    return $classes;
}
add_filter('body_class', 'addBodyClasses');

function mbuilder_set_assets(){
    $shortcodes_list = PixflowFramework::Pixflow_Shortcodes() ;
    $shortcodes_list = array_map('pixflow_rename_shortcode' , $shortcodes_list);
    return pixflow_get_assets_for_customizer($shortcodes_list) ;
}
/**
 * Massive Dynamic Starts using mBuilder as its default builder
 *
 * @param $content
 * @return string
 */
function pixflow_mBuilder($content){
    $mBuilder = MBuilder::getInstance();
    // Skip load Builder if its not in customizer
	global $in_mbuilder;

    if(pixflow_is_builder_editable(get_the_ID()) == false && isset($_GET['mbuilder'] )) {
    	$url = get_permalink();
    	?>
		<script> window.location.href = ' <?php echo esc_url($url); ?> ' </script>
		<?php
        return false ;
    }

    if(!strpos($content,'[md_blog')){
        $content = $in_mbuilder ? $mBuilder->textToShortcode($content) : $content ;
    }


    do_action('mBuilder_before_render');

    return $content;
}
add_filter('the_content','pixflow_mBuilder');

$current_user = wp_get_current_user();
if(isset($_GET['mbuilder']) && user_can( $current_user, 'administrator' )){
    global $in_mbuilder;
    $in_mbuilder = true;
    add_action('wp_enqueue_scripts','mbuilder_set_assets');
}

/**
 * Add visual composer basic shortcodes to mBuilder
 *
 *
 * @return void
 * @since 1.0.0
 */
function mBuilderPrerequisits(){
    add_shortcode("vc_row",'pixflow_get_style_script');
    add_shortcode("vc_row_inner",'pixflow_get_style_script');
    add_shortcode("vc_column",'pixflow_get_style_script');
    add_shortcode("vc_column_inner",'pixflow_get_style_script');
    require_once(PIXFLOW_THEME_LIB.'/mbuilder/includes/visualcomposer-functions.php');
}
require_once(PIXFLOW_THEME_LIB.'/mbuilder/includes/visualcomposer-compatibilities.php');
require_once(PIXFLOW_THEME_LIB.'/mbuilder/includes/ajax-actions.php');

add_action('init', 'mBuilderPrerequisits', 998);

function pixflow_tinymce_config( $init ) {
    $init['wpautop'] = false;
    $init['cleanup'] = false;
    $init['forced_root_block'] = false;
    $init['force_br_newlines'] = true;
    $init['remove_linebreaks'] = false;
    $init['convert_newlines_to_brs'] = false;
    $init['remove_redundant_brs'] = false;
    return $init;
}
add_filter('tiny_mce_before_init', 'pixflow_tinymce_config');

/**
 * Late load bootstrap styles to override visualcomposer styles.
 *
 * @since 1.0.0
 */
function mbuilderLateLoadStyles(){
    wp_enqueue_style('bootstrap-style',pixflow_path_combine(PIXFLOW_THEME_CSS_URI,'bootstrap.min.css'),array(),null);
}
add_action('wp_enqueue_scripts','mbuilderLateLoadStyles',999);

/**
 * Delete cache files from cache directory after each save post
 *
 * @since 1.1.0
 */
function mbuilder_generate_cache_files($post_id){
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    WP_Filesystem(false,false,true);
    global $wp_filesystem;

    $wp_filesystem->delete(PIXFLOW_THEME_CACHE.'/'.$post_id.'.css');
    $wp_filesystem->delete(PIXFLOW_THEME_CACHE.'/'.$post_id.'.js');
}
add_action( 'save_post', 'mbuilder_generate_cache_files' );

function pixflow_load_builder_layout() {
    get_template_part('lib/mbuilder/templates/toolbar');
    get_template_part('lib/mbuilder/templates/shortcode-sidebar');
}
if($in_mbuilder){
    add_action('pixflow_body_start', 'pixflow_load_builder_layout');
}

/*
 * Add custom styles when load pixflow builder toolbar
 * */
function pixflow_builder_toolbar_style(){
    $inline_css = 'html { margin-top: 47px !important; }'.'* html body { margin-top: 47px !important; }';
    wp_add_inline_style("responsive-style" , wp_strip_all_tags( $inline_css ) );
}
if($in_mbuilder){
    add_action('wp_enqueue_scripts', 'pixflow_builder_toolbar_style');
}

