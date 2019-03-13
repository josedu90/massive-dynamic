<?php

function unset_filters_for($hook = '')
{
    global $wp_filter;
    if (empty($hook) || !isset($wp_filter[$hook]))
        return;

    unset($wp_filter[$hook]);
}

unset_filters_for('vc_shortcode_output');

/**
 * Detect manual insert new line
 * @param string value
 * @return string with new br tags
 */
function pixflow_detect_new_lines($value)
{
	if( get_post_type( get_the_ID() ) == 'post'){
		$newLineArray = array("\r\n","\n\r","\n","\r");
		$new_string = str_replace($newLineArray,"<br />", $value);
	}else{
		$new_string = array();
		$new_string_with_br = explode('<br />', nl2br($value));
		for ($i = 0; $i < count($new_string_with_br); $i++) {
			if (strlen($new_string_with_br[$i]) !== 1) {
				$new_string[] = trim($new_string_with_br[$i]);
			}
		}
		$new_string = implode('<br />', $new_string);
	}

	return $new_string;
}

/**
 * Check the content contains p tag or not
 * @param string value
 * @return string with p tags
 */
function pixflow_detectPTags($value)
{
    if (strpos($value, '</p>') == false) :
        $NewString = '<p>' . $value . '</p>';
        return $NewString;
    else:
        return $value;
    endif;
}

/**
 * Check the content of text shortcode Which is not something else.
 * @param string content of text shortcode
 * @return string that removes extra stuff.
 */
function pixflow_detectBasetext($content)
{
    if (preg_match("/<div[^>]*?class=\"md-text-content\">(.*?)<\\/div>/si", $content, $match)) {
        $content = $match[1];
        return trim($content);
    } else {
        return $content;
    }
}

function pixflow_output_validation($content)
{
    if (strpos($content, '</style>') || strpos($content, '</script>')) {
        $content = preg_replace('/(<script[^>]*>.+?<\/script>)/s', '', $content);
//        $content = trim(preg_replace(array('/\r/', '/\n/' , '/<!--(.*)-->/Uis'), '',$content));
        return $content;
    } else {
        return $content;
    }
}
// use wp_filesystem for import
function pixflow_import_media($content)
{
    unset($_SESSION['pixflow_' . get_site_url() .'inlinejs']);
    $_SESSION['pixflow_' . get_site_url() .'inlinejs'] = $content;
}

// pixflow_get_inline_scripts
function pixflow_get_inline_scripts($data)
{
    global $jsString;
    if (preg_match_all('#<\s*?script\b[^>]*>(.*?)</script\b[^>]*>#s', $data, $match)) {
        foreach ($match[1] as $jsdata) {
            $jsString .= $jsdata;
        }
        return trim($jsString);
    } else {
        return "";
    }
}

/**
 * load dependency file (shortcode or widget) and return array of dependent js,css and shortcodes
 * @param string $name shortcode name or widget name
 * @param string $type can be shortcode or widget
 * @return array
 */
function pixflow_load_dependecy_file($name, $type = 'shortcode'){
    $return = array('js'=>'','css'=>'');

    if('shortcode'==$type){
        $path = PIXFLOW_THEME_SHORTCODES;
    }elseif('widget'==$type){
        $path = PIXFLOW_THEME_WIDGETS;
    }
    $dependency_list =  $path. '/' . $name . '/dependency.json';

    if(!file_exists($dependency_list)) {
        return $return;
    }
    $require_plugin = json_decode(@file_get_contents($dependency_list), true);
    if($require_plugin){
        $require_plugin['shortcode'] = (isset($require_plugin['shortcode']))?$require_plugin['shortcode']:array();
        return $require_plugin;
    }else{
        return $return;
    }
}

/**
 * load dependet scripts of shortcodes and widgets
 * @param array list of depentens plugins
 * @return string as dependent scripts
 */
function pixflow_load_dependent_scripts($require_plugins){
    global $pixflow_loaded_plugins;
    $pixflow_loaded_dependency = array();
    $scripts = '';
    // Load dependent plugin scripts
    if (count($require_plugins['js']) != 0 &&
        ( is_array( $require_plugins['js'] ) || is_object( $require_plugins['js']  ) ) ) {
        foreach ($require_plugins['js'] as $js_path) {
            if(file_exists(PIXFLOW_THEME_DIR . '/'. $js_path) &&
                array_search( $js_path , $pixflow_loaded_dependency , true ) == false ) {
                if(in_array($js_path,$pixflow_loaded_plugins)){
                    continue;
                }
                $scripts .= @file_get_contents(PIXFLOW_THEME_DIR . '/'. $js_path);
                $pixflow_loaded_dependency[] = $js_path ;
                $pixflow_loaded_plugins[] = $js_path ;
            }
        }
    }
    return $scripts;
}

/**
 * load dependet styles of shortcodes and widgets
 * @param array list of depentens plugins and shortcodes
 * @return string as dependent styles
*/
function pixflow_load_dependent_styles($require_plugins){
    global $pixflow_loaded_plugins;
    $styles = '';
    $pixflow_loaded_dependency = array();
    // Load dependent plugin styles
    if (count($require_plugins['css']) != 0 &&
        ( is_array( $require_plugins['css'] ) || is_object( $require_plugins['css'] ) ) ) {
        foreach ($require_plugins['css'] as $css_path) {
            if(file_exists(PIXFLOW_THEME_DIR . '/'. $css_path) &&
                array_search( $css_path , $pixflow_loaded_dependency , true ) == false ) {
                if(in_array($css_path,$pixflow_loaded_plugins)){
                    continue;
                }
                $styles .= @file_get_contents(PIXFLOW_THEME_DIR . '/'. $css_path);
                $pixflow_loaded_dependency[] = $css_path;
                $pixflow_loaded_plugins[] = $css_path;
            }
        }
    }
    return $styles;
}

function pixflow_get_style_script($atts, $content = null, $shortcodename = '')
{
    global $cssString;
    $shortCode_deny = array(
        'master_slider' => 'pixflow_sc_masterslider' ,
        'row' => 'mBuilder_vcrow' ,
        'col' => 'mBuilder_vccolumn'
    );
    if (preg_match('/vc_/', $shortcodename)) {
        if ($shortcodename == 'vc_column_inner') {
            $funcName = 'mBuilder_vccolumn';
        } else {
            $funcName = str_replace('vc_', 'mBuilder_vc', $shortcodename);
        }
    } else {
        $funcName = str_replace('md', 'pixflow_sc', $shortcodename);
    }
    if(function_exists($funcName)){
        $output = call_user_func_array($funcName, array($atts, $content));
        // Output shortcode attributes if row dropped as section
        if ( isset( $_POST['attrs'] ) && strpos( $_POST['attrs'], 'section_id' ) ) {
            $attributes = '';
            foreach( $atts as $k => $v ) {
                $attributes .= "$k=\"$v\" ";
            }
            $output .= '<span class="section-shortcode-attrs">'.$attributes.'</span>';
        }

        // Minify Scripts and Styles
        $output = pixflow_minify_shortcodes_scripts($output);

        if (is_customize_preview() == false && (!defined('DOING_AJAX') || !DOING_AJAX)) {
            if(array_search($funcName , $shortCode_deny) == FALSE ){
                /*
                pixflow_import_media(pixflow_get_inline_scripts($output));
                return pixflow_output_validation($output);
                */
                return $output;
            }else{
                return $output;
            }
        } else {
            return $output;
        }
    }else{
        return ;
    }
}

// Load Require Plugin
function pixflow_load_dependency($name,$type = 'shortcode'){
    global $pixflow_loaded_shortcodes;
    global $pixflow_loaded_plugins;

    // Load dependency array
    $require_plugins = pixflow_load_dependecy_file($name,$type);
    $return = array(
        'js' => '' ,
        'css' => ''
    );

    // Load dependent Shortcodes
    if(isset($require_plugins['shortcode'])){
        foreach($require_plugins['shortcode'] as $dependent_shortcodes){
            if(in_array($dependent_shortcodes,$pixflow_loaded_shortcodes)){
                continue;
            }
            $shortcodes_files = pixflow_load_dependency($dependent_shortcodes,'shortcode');
            $return['js'] .= $shortcodes_files['js'];
            $return['css'] .= $shortcodes_files['css'];
            $return['js'] .= @file_get_contents(PIXFLOW_THEME_SHORTCODES . '/' . $dependent_shortcodes . '/script.min.js');
            $return['css'] .= @file_get_contents(PIXFLOW_THEME_SHORTCODES. '/' . $dependent_shortcodes . '/style.min.css');
            $shortcode_index_file = PIXFLOW_THEME_SHORTCODES . '/'. $dependent_shortcodes . '/index.php';
            if(file_exists($shortcode_index_file)) {
                require_once $shortcode_index_file;
            }
            $pixflow_loaded_shortcodes[] = $dependent_shortcodes;
        }
    }

    // Load dependent scripts
    $return['js'] .= pixflow_load_dependent_scripts($require_plugins);

    // Load dependent styles
    $return['css'] .= pixflow_load_dependent_styles($require_plugins);

    return $return;
}

/*
 * load required shortcodes that used do_shortcode
 * @param array list of dependents shortcodes
*/
function pixflow_load_do_shortcodes(){
    $do_shortcodes = array();
    // load video shortcode for loop-blog-video
    if ( (is_front_page() && is_home()) || (!is_front_page() && is_home()) || is_archive() ) {
        $do_shortcodes[] = 'md_video';
    }
    // load subscribe shortcode on single blog and sbscribe widget
    if (is_singular('post') || is_active_widget( '', '', 'md_subscribe_widgett')) {
        $do_shortcodes[] = 'md_subscribe';
    }
    return $do_shortcodes;
}

function pixflow_rename_shortcode($value){
    return trim(str_replace('/index' , '' , $value));
}

add_action("wp_ajax_pixflow_load_more_posts", "load_more_post_blog_masonry");
add_action("wp_ajax_pixflow_load_more_posts", "load_more_post_blog_masonry");



function load_more_post_blog_masonry()
{
    if (isset($_POST['atts']) && isset($_POST['paged'])) {
        $atts = $_POST['atts'];
        $page = $_POST['paged'];
    } else {
        exit;
    }

    $query = $output = $width = $subStr = $style = $col = $blog_accent_color = $blog_post_number = $blog_text_accent_color =
    $blog_category = $blog_foreground_color = $blog_background_color = $id = $blog_column = $blog_bg = $blog_post_shadow = '';
    $list = $day = array();
    $i = 0;
    extract(shortcode_atts(array(
        'blog_column' => 'three',
        'blog_category' => '',
        'blog_post_number' => '5',
        'blog_post_title_heading' => 'h1',
        'blog_foreground_color' => 'rgb(255,255,255)',
        'blog_background_color' => 'rgb(87,63,203)',
        'blog_accent_color' => 'rgb(220,38,139)',
        'blog_text_accent_color' => 'rgb(0,0,0)',
        'blog_post_shadow' => 'rgba(0,0,0,.12)',
        'blog_load_more' => 'no',
        'blog_button_style' => 'fade-square',
        'blog_button_text' => 'LOAD MORE',
        'blog_button_icon_class' => 'icon-plus6',
        'blog_button_color' => 'rgba(0,0,0,1)',
        'blog_button_text_color' => '#fff',
        'blog_button_bg_hover_color' => '#9b9b9b',
        'blog_button_hover_color' => 'rgb(255,255,255)',
        'blog_button_size' => 'standard',
        'blog_button_padding' => '0',
    ), $atts));

    $paged = isset($page) ? $page : 1;
    $arrg = array(
        'category_name' => $blog_category,
        'posts_per_page' => $blog_post_number,
        'paged' => $paged
    );

    $query = new WP_Query($arrg);
    if ($query->max_num_pages > 0) {

        if (is_numeric($blog_bg)) {
            $blog_bg = wp_get_attachment_image_src($blog_bg, 'pixflow_post-single');
            $blog_bg = (false == $blog_bg) ? PIXFLOW_PLACEHOLDER1 : $blog_bg[0];
        }

        if ($blog_column == 'three') {
            $width = 100 / 3;
            $col = 3;

        } else {
            $width = 100 / 4;
            $col = 4;
        }

        ob_start();
        while ($query->have_posts()) {
            $i++;
            $query->the_post();
            global $post;

            if (strlen(get_the_excerpt()) > 150) {
                $subStr = '...';
            } else {
                $subStr = '';
            }
            $format = get_post_format($post->ID);
            if ($format == false) $format = 'standard';
            $style = '';

            ?>
            <div class="blog-masonry-container <?php echo esc_attr($format); ?>">
                <?php
                if ($format == 'audio') {
                    $audio = pixflow_extract_audio_info(get_post_meta(get_the_ID(), 'audio-url', true));
                    if ($audio != null) {
                        echo pixflow_soundcloud_get_embed($audio['url'], '250');
                    }
                } elseif ($format == 'gallery') {
                    wp_enqueue_script('flexslider-script');
                    wp_enqueue_style('flexslider-style');
                    $images = get_post_meta(get_the_ID(), 'fg_perm_metadata');
                    $images = explode(',', $images[0]);
                    if (count($images)) { ?>
                        <div class="flexslider">
                            <ul class="slides">
                                <?php
                                $imageSize = 'pixflow_team-member-style2-thumb';
                                if (has_post_thumbnail()) {
                                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), $imageSize);
                                    $thumb = (false == $thumb) ? PIXFLOW_PLACEHOLDER1 : $thumb[0];
                                    $url = $thumb;
                                    ?>
                                    <li class="images" style="background-image: url('<?php echo esc_url($url); ?>');">
                                    </li>
                                    <?php
                                }
                                foreach ($images as $img) {
                                    $imgTag = wp_get_attachment_image_src($img, $imageSize);
                                    $imgTag = (false == $imgTag) ? PIXFLOW_PLACEHOLDER1 : $imgTag[0];
                                    ?>
                                    <li class="images"
                                        style="background-image: url('<?php echo esc_url($imgTag); ?>');">
                                    </li>
                                    <?php
                                } ?>
                            </ul>
                        </div>
                        <?php
                    }
                } elseif ($format == 'video') {
                    $videoUrl = get_post_meta(get_the_ID(), 'video-url', true);
                    $findme = 'vimeo.com';
                    $pos = strpos($videoUrl, $findme);
                    if ($pos == false) {
                        $host = 'youtube';
                    } else {
                        $host = 'vimeo';
                    }
                    if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {
                        $image = get_post_thumbnail_id($post->ID);
                    } else {
                        $image = "";
                    }
                    echo do_shortcode('[md_video md_video_host="' . $host . '" md_video_url_vimeo="' . esc_url($videoUrl) . '" md_video_url_youtube="' . esc_url($videoUrl) . '" md_video_style="squareImage" md_video_image="' . esc_attr($image) . '"]');
                } elseif ($format == 'standard') {
                    if (has_post_thumbnail()) {
                        $imageSize = 'medium';
                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), $imageSize);
                        $thumb = (false == $thumb) ? PIXFLOW_PLACEHOLDER1 : $thumb[0];
                        echo '<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" src="' . esc_attr($thumb) . '" />';
                    }
                } elseif ($format == 'quote') {
                    echo '<img class="quote-img" src="' . PIXFLOW_THEME_IMAGES_URI . '/masonry-quote.png" />';
                }
                ?>
                <div class="blog-masonry-content">
                    <?php if ($format != 'quote') { ?>
                        <span class="blog-details">
                    <?php
                    $terms = get_the_category($post->ID);
                    $catNames = array();
                    $md_catcounter = 0;
                    if ($terms)
                        foreach ($terms as $term) {
                            $md_catcounter++;
                            if ($md_catcounter < 2) {
                                ?>
                                <span class="blog-cat"><a
                                            href="<?php echo esc_url(get_category_link(get_cat_ID($term->name))) ?>"
                                            title='<?php echo esc_attr($term->name) ?>'><?php echo esc_attr($term->name) ?></a></span>
                            <?php }

                        } ?>
                    </span>
                        <?php
                    }
                    $archive_year = get_the_time('Y');
                    $archive_month = get_the_time('m');
                    $archive_day = get_the_time('d');

                    ?>
                    <?php if ($format == 'quote') { ?>
                        <span class="blog-date">
                    <i class="px-icon icon-calendar-1 classic-blog-icon"></i> <a
                                    href="<?php echo get_day_link($archive_year, $archive_month, $archive_day); ?>"><?php the_time(get_option('date_format')) ?></a>
                </span>
                    <?php } ?>

                    <?php if ($format != 'quote') { ?>
                    <a href="<?php the_permalink(); ?>"><<?php echo(esc_attr($blog_post_title_heading)) ?>
                        class="blog-title"> <?php the_title(); ?></<?php echo(esc_attr($blog_post_title_heading)) ?>></a>
                        <span class="blog-date">
                    <i class="px-icon icon-calendar-1 classic-blog-icon"></i> <a
                                    href="<?php echo get_day_link($archive_year, $archive_month, $archive_day); ?>"><?php the_time(get_option('date_format')) ?></a>
                </span>
                    <?php } ?>
                    <p class="blog-excerpt"> <?php echo mb_substr(get_the_excerpt(), 0, 150) . $subStr; ?></p>
                    <?php if ($format == 'quote') { ?>

                        <p class="blog-excerpt"> <?php the_title(); ?></p>

                    <?php }
                    if ($format != 'quote') {
                        ?>
                        <div class="post-like-holder">
                            <?php echo pixflow_getPostLikeLink(get_the_ID()); ?>
                        </div>
                        <?php
                        if (function_exists('is_plugin_active') && is_plugin_active('add-to-any/add-to-any.php')) {
                            if (!get_post_meta(get_the_ID(), 'sharing_disabled', false)) {
                                ?>
                                <div class="post-share">
                                    <a href="#" class="share a2a_dd"><i class="icon-share3"></i></a>
                                    <a href="#" class="a2a_dd share-hover"><i class="icon-share3"></i></a>
                                </div>
                            <?php }
                        } ?>


                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <div class="clearfix"></div>
        <script>
            var $ = jQuery;

            pixflow_blogMasonry('<?php echo $_POST['parent_id'] ?>');
        </script>
        <?php
        wp_reset_postdata();
        if (isset($_POST['paged'])) {
            exit;
        } else {
            return ob_get_clean();
        }
    } else {
        echo false;
    }


}

