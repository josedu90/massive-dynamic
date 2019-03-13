<?php

function pixflow_get_pagination($query = null, $range = 3, $default_pagination = true){
    global $paged, $wp_query, $md_allowed_HTML_tags;

    $q = $query == null ? $wp_query : $query;
    $output = '';

    // How much pages do we have?
    if (!isset($max_page)) {
        $max_page = $q->max_num_pages;

        if (array_key_exists('paged', $q->query)) {
            $post_count = esc_attr($q->query['paged']);
        } else {
            $post_count = 1;
        }
    }

    // We need the pagination only if there is more than 1 page
    if ($max_page < 2)
        return $output;

    $output .= '<div class="post-pagination">';

    if (!$paged) $paged = 1;

    // If current page is our home page we will change the pagination structure to prevent 404 error , if not we use the default structure
    if (!$default_pagination) {
        $ppage = $paged + 1;
        $npage = $paged - 1;
        $plink = get_home_url() . "/?paged=" . $ppage;
        $nlink = get_home_url() . "/?paged=" . $npage;

        // If we are on page 2 , next page would be page 1 and its better that we just go to home page instead of passing pagination argument
        if ($paged == 2) {
            $nlink = $nlink = get_home_url();
        }
    } else {
        $plink = get_pagenum_link($paged + 1);
        $nlink = get_pagenum_link($paged - 1);
    }

    // Next page
    if ($paged < $max_page)
        $output .= '<a class="prev-page-link" href="' . $plink . '"><span class="prev-page"></span><span class="text">' . esc_attr__('PREVIOUS POSTS', 'massive-dynamic') . '</span></a>';
    else if ($paged == $max_page)
        $output .= '<a class="no-prev-page" href="#"><span class="text">' . esc_attr__('NO OLD POSTS', 'massive-dynamic') . '</span><span class="prev-page"></span></a>';


    $output .= '<span class="page-num">' . "Page $post_count of $max_page" . '</span>';

    // To the previous page
    if ($paged > 1)
        $output .= '<a class="next-page-link" href="' . $nlink . '"><span class="text">' . esc_attr__('NEXT POSTS', 'massive-dynamic') . '</span><span class="next-page"></span></a>';
    else if ($paged == 1)
        $output .= '<a class="no-next-page" href="#"><span class="text">' . esc_attr__('NO NEW POSTS', 'massive-dynamic') . '</span><span class="next-page"></span></a>';

    $output .= '<div class="clearfix"></div><a class="pagination-border"></a><a class="post-pagination-hover"></a></div><!-- post-pagination -->';

    echo wp_kses($output, $md_allowed_HTML_tags);
}

function pixflow_get_related_posts_by_taxonomy($postId, $taxonomy, $maxPosts = 9)
{
    $terms = wp_get_object_terms($postId, $taxonomy);

    if (!count($terms))
        return new WP_Query();

    $termsSlug = array();

    foreach ($terms as $term)
        $termsSlug[] = $term->slug;

    $args = array(
        'post__not_in' => array((int)$postId),
        'post_type' => get_post_type($postId),
        'showposts' => (int)$maxPosts,
        'tax_query' => array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => $termsSlug
            )
        )
    );

    return new WP_Query($args);
}

function pixflow_get_video_meta(array &$video)
{
    if ($video['type'] != 'youtube' && $video['type'] != 'vimeo')
        return null;

    $ret = pixflow_get_url_content($video['url']/*, '127.0.0.1:8080'*/);

    if (is_array($ret))
        return 'Server Error: ' . $ret['error'] . " \nError No: " . $ret['errorno'];

    if (trim($ret) == '')
        return 'Error: got empty response from youtube';

    $html = pixflow_str_get_html($ret);
    $vW = $html->find('meta[property="og:video:width"]');
    $vH = $html->find('meta[property="og:video:height"]');

    if (count($vW) && count($vH)) {
        $video['width'] = $vW[0]->content;
        $video['height'] = $vH[0]->content;
    }

    return null;
}

/* Sidebar widget count */
function pixflow_count_sidebar_widgets($sidebar_id, $echo = false)
{
    $sidebars = wp_get_sidebars_widgets();

    if (!isset($sidebars[$sidebar_id])) {
        return -1;
    }


    $cnt = count($sidebars[$sidebar_id]);

    if ($echo)
        echo esc_attr($cnt);
    else
        return $cnt;
}

function pixflow_get_custom_sidebars()
{
    $sidebarStr = pixflow_opt('custom_sidebars');

    if (strlen($sidebarStr) < 1)
        return array();

    $arr = explode(',', $sidebarStr);
    $sidebars = array();

    foreach ($arr as $item) {
        $sidebars["custom-" . hash("crc32b", $item)] = str_replace('%666', ',', $item);
    }

    return $sidebars;
}

/* Get Sidebar */
function pixflow_get_sidebar($id = 'main-sidebar', $type, $class)
{
    $sidebarClass = "sidebar widget-area";
    $sidebarWidth = $GLOBALS['sidebarWidth'];
    $sidebarWidth = ($GLOBALS['sidebarPosition'] == 'double') ? $sidebarWidth / 2 : $sidebarWidth;

    if ('' != $class)
        $sidebarClass .= " $class";

    if ($type == 'sticky') {
        if (pixflow_count_sidebar_widgets($id) < 1)
            $sidebarClass .= ' no-widgets';
        ?>
        <div class="stickySidebar" style="width: <?php echo esc_attr($sidebarWidth) . '%'; ?>">
            <aside class="<?php echo esc_attr($sidebarClass); ?>">
                <div class="color-overlay"></div>
                <div class="texture-overlay"></div>
                <div class="bg-image"></div>
                <?php dynamic_sidebar($id); ?>
            </aside>
        </div>

        <?php
    } elseif ($type != 'sticky') {
        if (pixflow_count_sidebar_widgets($id) < 1)
            $sidebarClass .= ' no-widgets';

        $closeIcon = (strpos($sidebarClass, 'smart-sidebar') < 0 || !strpos($sidebarClass, 'smart-sidebar')) ? true : false;

        ?>
        <div widgetID="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($sidebarClass); ?>"
             style="width: <?php echo esc_attr($sidebarWidth) . '%'; ?>">

            <?php if ($closeIcon) { ?>
                <div class="color-overlay color-type"></div>
                <div class="color-overlay texture-type"></div>
                <div class="color-overlay image-type"></div>
                <div class="texture-overlay"></div>
                <div class="bg-image"></div>
            <?php } else { ?>
                <span class="close-sidebar"><i class="icon-cross"></i></span>
            <?php } ?>
            <?php dynamic_sidebar($id); ?>
        </div>

        <?php
    }
    ?>

    <?php
}
// Get socials
function pixflow_get_active_socials()
{
    $active_socials = array();
    $socials = array(
        'facebook' => 'icon-facebook2',
        'twitter' => 'icon-twitter5',
        'vimeo' => 'icon-vimeo',
        'youtube' => 'icon-youtube2',
        'googleP' => 'icon-googleplus',
        'dribbble' => 'icon-dribbble',
        'tumblr' => 'icon-tumblr',
        'linkedin' => 'icon-linkedin',
        'flickr' => 'icon-flickr2',
        'forrst' => 'icon-forrst',
        'github' => 'icon-github2',
        'lastfm' => 'icon-lastfm',
        'paypal' => 'icon-paypal2',
        'rss' => 'icon-feed2',
        'wp' => 'icon-wordpress',
        'deviantart' => 'icon-deviantart2',
        'steam' => 'icon-steam',
        'soundcloud' => 'icon-soundcloud3',
        'foursquare' => 'icon-foursquare',
        'skype' => 'icon-skype',
        'reddit' => 'icon-reddit',
        'instagram' => 'icon-instagram',
        'blogger' => 'icon-blogger',
        'yahoo' => 'icon-yahoo',
        'behance' => 'icon-behance',
        'delicious' => 'icon-delicious',
        'stumbleupon' => 'icon-stumbleupon3',
        'pinterest' => 'icon-pinterest3',
        'xing' => 'icon-xing'
    );
    $defaults = array('facebook', 'twitter', 'youtube');

    foreach ($socials as $setting => $icon) {
        $link = pixflow_get_theme_mod($setting . '_social');
        $default = (in_array($setting, $defaults)) ? '#' : '';
        $link = ($link === null) ? $default : $link;
        if ($link != '') {
            $active_socials[$setting]['title'] = $setting;
            $active_socials[$setting]['icon'] = $icon;
            $active_socials[$setting]['link'] = $link;
        }
    }
    if (count($active_socials) > 0) {
        return $active_socials;
    } else {
        return false;
    }
}

// Ajax Search
add_action('wp_ajax_pixflow_load_search_results', 'pixflow_load_search_results');
add_action('wp_ajax_nopriv_pixflow_load_search_results', 'pixflow_load_search_results');

function pixflow_load_search_results(){
    $query = esc_attr($_POST['query']);

    $args = array(
        'post_status' => 'publish',
        's' => $query
    );
    $search = new WP_Query($args);

    ob_start();

    if ($search->have_posts()) :
        ?>
        <div class="search-title"><span
                    class="stand-out"><?php echo sizeof($search->posts) ?></span> <?php echo esc_attr__('result(s) found for', 'massive-dynamic') ?>
            <span class="stand-out"><?php echo esc_attr($query); ?></span></div>
        <div class="row">
            <?php
            while ($search->have_posts()) : $search->the_post();
                $id = get_the_ID();
                $title = the_title('', '', false);
                $type = get_post_type($id);
                $thumbnail = (has_post_thumbnail()) ? get_post_thumbnail_id($id) : PIXFLOW_THEME_IMAGES_URI . '/placeholder-' . $type . '.jpg';
                if (is_numeric($thumbnail)) {
                    $thumbnail = wp_get_attachment_image_src($thumbnail, 'pixflow_post-related-sm');
                    $thumbnail = (false == $thumbnail) ? PIXFLOW_PLACEHOLDER_BLANK : $thumbnail[0];
                } ?>
                <div class="item col-lg-3 col-md-3 col-sm-3 col-xs-1">
                    <a href="<?php echo get_permalink() ?>">
                        <div class="thumbnail" style="background-image: url('<?php echo esc_url($thumbnail); ?>')">
                            <div class="background-overlay"></div>
                        </div>
                        <h4 class="title"><?php echo esc_attr($title); ?></h4>
                    </a>
                </div>
                <?php
            endwhile; ?>
        </div>
        <a class="more-result"
           href="<?php echo get_search_link($query); ?>"><?php echo esc_attr__('See more results..', 'massive-dynamic') ?></a>
        <?php
    else :
        echo '<div class="search-title-empty">' . esc_attr__('Nothing Found!', 'massive-dynamic') . '</div>';
    endif;

    ob_get_flush();
    die();

}

// remove temp content and vars in frontend
add_action('get_header', 'pixflow_removeTemp');
function pixflow_removeTemp()
{
    // destroy session when site load in frontend
    if (is_customize_preview() == false) {
        unset($_SESSION['general_customized']);
        unset($_SESSION['unique_customized']);
        unset($_SESSION['temp_status']);
    }
}

//Customizing wp_title
function pixflow_filter_wp_title($title, $separator)
{

    if (is_feed()) return $title;

    global $paged, $page;

    if (is_search()) {
        $title = sprintf(esc_attr__('Search results for %s', 'massive-dynamic'), '"' . get_search_query() . '"');

        if ($paged >= 2) {
            $title .= " $separator " . sprintf(esc_attr__('Page %s', 'massive-dynamic'), $paged);
        }
        $title .= " $separator " . get_bloginfo('name', 'display');
        return $title;
    }

    $title .= get_bloginfo('name', 'display');
    $site_description = get_bloginfo('description', 'display');

    if ($site_description && (is_home() || is_front_page())) {
        $title .= " $separator " . $site_description;
    }

    if ($paged >= 2 || $page >= 2) {
        $title .= " $separator " . sprintf(esc_attr__('Page %s', 'massive-dynamic'), max($paged, $page));
    }

    return $title;
}

add_filter('wp_title', 'pixflow_filter_wp_title', 10, 2);

function pixflow_move_comment_field_to_bottom($fields)
{
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter('comment_form_fields', 'pixflow_move_comment_field_to_bottom');

//Add no-js class to body tag in a non hardcode way
add_action('body_class', 'pixflow_add_custom_bodyclass');
function pixflow_add_custom_bodyclass($classes)
{
    $classes[] = 'no-js';
    global $post;
    if(isset($post->ID)){
        $isOnePageScroll = get_post_meta($post->ID, 'one_page_scroll', true);
        $disableSectionScrollMobile=get_post_meta($post->ID, 'disable_one_page_scroll_mobile', true);
    }else{
        $isOnePageScroll = 'no' ;
    }
    if($isOnePageScroll == 'yes'){

        $classes[] = 'one_page_scroll';
        if($disableSectionScrollMobile == 'yes') {
            $classes[]="disable_section_scroll_mobile";
        }
        wp_enqueue_script('section_scroll', pixflow_path_combine(PIXFLOW_THEME_JS_URI, 'section_scroll.min.js'), array('main-custom-js'), PIXFLOW_THEME_VERSION, true);
    }



    if (is_customize_preview()) {
        $classes[] = 'compose-mode';
        $classes[] = 'pixflow-customizer';
    }
    return $classes;
}

/*
 * make default menu if there is no menu when theme activate
 * */
add_action('after_switch_theme', 'pixflow_create_default_menu');
function pixflow_create_default_menu()
{
    $menu_name = 'Main Menu';
    $menu_exists = wp_get_nav_menu_object( $menu_name );
    if( !$menu_exists){
        // get id of pixflow sample page
        $sample_page_id = pixflow_get_sample_page_id();
        if(0 === $sample_page_id){
            $sample_page_id = pixflow_create_sample_page();
        }
        // get all page ids
        $args = array(
            'exclude' => $sample_page_id,
            'number' => 2,
            'post_type' => 'page',
            'post_status' => 'publish'
        );
        $pages = get_pages($args);
        $menu_exists = wp_get_nav_menu_object( $menu_name );
        $menu_id = wp_create_nav_menu($menu_name);
        if(is_int($menu_id)){
            $locations['primary-nav'] = $menu_id;
            $locations['mobile-nav'] = $menu_id;
            set_theme_mod('nav_menu_locations', $locations);
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'     =>  __( 'Test Page', 'massive-dynamic' ),
                'menu-item-object-id' => $sample_page_id,
                'menu-item-object'    => 'page',
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish'
            ) );
            foreach ($pages as $page){
                wp_update_nav_menu_item( $menu_id, 0, array(
                    'menu-item-title'     => $page->post_title,
                    'menu-item-object-id' => $page->ID,
                    'menu-item-object'    => 'page',
                    'menu-item-type'      => 'post_type',
                    'menu-item-status'    => 'publish'
                ) );
            }
        }
    }
}

// THIS CODE IT 'S FOR ADDING DEFER AND ASYNCE TO JS
$GLOBALS['script_array'] = array('jquery-cookie', 'autoloadpost');
function add_defer_attribute($tag, $handle)
{
    $browser = pixflow_get_browser();
    if ($browser['name'] == 'Google Chrome' && !(preg_match('/Edge/' , $browser['agent'])) ) {
        foreach ($GLOBALS['script_array'] as $individual_script) {
            if ($individual_script == $handle  || preg_match('/nicescroll.min/', $tag) ) {
                return str_replace('src', 'async="async" src', $tag);
            } else if(preg_match('/jquery.js/', $tag)  || preg_match('/assets\/js\/plugins.js/', $tag) ) {
                return $tag;
            }
            else{
                return str_replace('src', 'defer src', $tag);
            }
        }
    }
    else
    {
        return $tag;
    }
}
// Defer the css files for renderbloking
function add_defers_attribute($tag, $handle)
{
    $browser = pixflow_get_browser();
    if ($browser['name'] == 'Google Chrome' && !(preg_match('/Edge/' , $browser['agent'])) ) {
        return str_replace('rel=\'stylesheet\'', ' rel="preload" as="style" onload="this.rel=\'stylesheet\'"', $tag);
    } else {
        return $tag;
    }
}
/*
if (!is_admin() && is_customize_preview() == false ) {
    add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
    add_filter('style_loader_tag', 'add_defers_attribute', 10, 2);
}
*/

/*add_filter('the_content', 'pixflow_un_autop',0);
function pixflow_un_autop($content){
    $content = str_replace("\n",'<!-- wpnl -->',$content);
    $content = str_replace('<p>','<'.PIXFLOW_P_TAG.'>',$content);
    $content = str_replace('</p>','</'.PIXFLOW_P_TAG.'>',$content);
    return $content;
}*/
