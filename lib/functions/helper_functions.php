<?php
/*
 * Gets array value with specified key, if the key doesn't exist
 * default value is returned
 */
function pixflow_array_value($key, $arr, $default = '')
{
    return array_key_exists($key, $arr) ? $arr[$key] : $default;
}

/*
 * Converts array of slugs to corresponding array of IDs
 */
function pixflow_slugs_to_ids($slugs = array(), $taxonomy)
{
    $tempArr = array();
    foreach ($slugs as $slug) {
        if (!strlen(trim($slug))) continue;
        $term = get_term_by('slug', $slug, $taxonomy);
        if (!$term) continue;
        $tempArr[] = $term->term_id;
    }

    return $tempArr;
}

/*
    generate gradient css
    parameters: json(if source is json(json string)),first color(hex or rgb-optional),second color(hex or rgb-optional),start position(int),end position(int),angle(int0-360)
*/
function pixflow_makeGradientCSS($json = false, $color1 = '#fff', $color2 = '#000', $pos1 = 0, $pos2 = 100, $angle = 0)
{
    if ($json && $json != '') {

        if( preg_match('/pixflow_base64/' , $json)){
            $json = str_replace('pixflow_base64' , '' , $json);
            $json = base64_decode($json);
        }

        $json = str_replace("``", '"', $json);
        $json = str_replace("'", '"', $json);
        $value = json_decode($json);
        $color1 = $value->{"color1"};
        $color2 = $value->{"color2"};
        $pos1 = $value->{"color1Pos"};
        $pos2 = $value->{"color2Pos"};
        $angle = $value->{"angle"};
    }
    $angle = (int)$angle;
    if ($angle <= 90) {
        $masterAngle = 90 - $angle;
    } else {
        $masterAngle = 360 - ($angle - 90);
    }
    /*$masterAngle = (int)$angle + 90;
    $masterAngle = ($masterAngle>360)?$masterAngle - 360:$masterAngle;*/
    ob_start();
    ?>
    background: <?php echo esc_attr($color1) ?>;
    background: -webkit-gradient(linear, <?php echo esc_attr($angle) ?>deg, color-stop(<?php echo esc_attr($pos1) ?>%,<?php echo esc_attr($color1) ?>), color-stop(<?php echo esc_attr($pos2) ?>%,<?php echo esc_attr($color2) ?>));
    background: -webkit-linear-gradient(<?php echo esc_attr($angle) ?>deg,  <?php echo esc_attr($color1) ?> <?php echo esc_attr($pos1) ?>%,<?php echo esc_attr($color2) ?> <?php echo esc_attr($pos2) ?>%);
    background: -o-linear-gradient(<?php echo esc_attr($angle) ?>deg,  <?php echo esc_attr($color1) ?> <?php echo esc_attr($pos1) ?>%,<?php echo esc_attr($color2) ?> <?php echo esc_attr($pos2) ?>%);
    background: -ms-linear-gradient(<?php echo esc_attr($angle) ?>deg,  <?php echo esc_attr($color1) ?> <?php echo esc_attr($pos1) ?>%,<?php echo esc_attr($color2) ?> <?php echo esc_attr($pos2) ?>%);
    background: linear-gradient(<?php echo esc_attr($masterAngle) ?>deg,  <?php echo esc_attr($color1) ?> <?php echo esc_attr($pos1) ?>%,<?php echo esc_attr($color2) ?> <?php echo esc_attr($pos2) ?>%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo esc_attr($color1) ?>', endColorstr='<?php echo esc_attr($color2) ?>', GradientType=0);
    <?php
    return ob_end_flush();
}

function pixflow_decodeSetting()
{
    list($detail, $setting_status, $pageID) = pixflow_getPageInfo();
    if (isset($_POST['customized'])) {
        $_SESSION[$setting_status . '_customized'] = json_decode(wp_unslash($_POST['customized']), true);
    }
    return true;
}

function pixflow_metaPageType()
{
    list($detail, $setting_status, $pageID) = pixflow_getPageInfo();
    if ($pageID != 0) {
        $link = get_permalink($pageID);
    } else {
        $link = '';
    }
    //Get sidebar
    $sidebar = '';
    if (is_single()) {
        $sidebar = 'blogSingle';
    } elseif ((is_front_page() && is_home()) || is_home()) {
        $sidebar = 'blogPage';
    } elseif (is_page()) {
        $sidebar = 'general';
    }
    if ((in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) || class_exists('WooCommerce')) && function_exists('is_woocommerce')) {
        if (is_woocommerce()) {
            $sidebar = 'shop';
        }
    }
    echo '<meta sidebar-type="' . esc_attr($sidebar) . '" name="post-id" content="' . esc_attr($pageID) . '" setting-status="' . esc_attr($setting_status) . '" detail="' . esc_attr($detail) . '" page-url="' . esc_url($link) . '" />';
}

function pixflow_getPageInfo()
{
    if (is_home()) {
        $pageID = get_option('page_for_posts');
    } elseif (function_exists('is_shop') && (is_shop() || is_product_category()) && !is_product()) {
        $pageID = get_option('woocommerce_shop_page_id');
    } else {
        $pageID = get_the_ID();
    }

    $post_type = get_post_type($pageID);
    if ((isset($_SESSION['temp_status'])) && ($_SESSION['temp_status']['id'] == $pageID || (!is_home()))) {
        $setting_status = $_SESSION['temp_status']['status'];
    } else {
        if (isset($_SESSION['temp_status'])) {
            unset($_SESSION['temp_status']);
        }
        if (is_single() && ($post_type == 'post' || $post_type == 'portfolio' || $post_type == 'product')) {
            if (isset($_SESSION[$post_type . '_status'])) {
                $setting_status = $_SESSION[$post_type . '_status'];
                unset($_SESSION[$post_type . '_status']);
            } else {
                $setting_status = get_option($post_type . '_setting_status');
            }
        } else {
            $setting_status = get_post_meta($pageID, 'setting_status', true);
        }
    }
    $setting_status = ($setting_status == 'unique') ? 'unique' : 'general';
    if (is_singular('post')) {
        $detail = 'post';
    } elseif (is_singular('portfolio')) {
        $detail = 'portfolio';
    } elseif (is_singular('product')) {
        $detail = 'product';
    } else {
        $detail = 'other';
    }
    return array($detail, $setting_status, $pageID);
}

/**
 * Try alternative way to test for bool value
 *
 * @param mixed
 * @param bool
 */
if (!function_exists('boolval')) {
    function boolval($BOOL, $STRICT = false)
    {

        if (is_string($BOOL)) {
            $BOOL = strtoupper($BOOL);
        }

        // no strict test, check only against false bool
        if (!$STRICT && in_array($BOOL, array(false, 0, NULL, 'FALSE', 'NO', 'N', 'OFF', '0'), true)) {

            return false;

            // strict, check against true bool
        } elseif ($STRICT && in_array($BOOL, array(true, 1, 'TRUE', 'YES', 'Y', 'ON', '1'), true)) {

            return true;

        }

        // let PHP decide
        return $BOOL ? true : false;
    }
}

function pixflow_checkBase64($value){
    if( preg_match('/pixflow_base64/' , $value)){
        $value = str_replace('pixflow_base64' , '' , $value);
        $value = base64_decode($value);
    }
    return $value;
}


function pixflow_base64TextTitle( $content ) {

    $content = preg_replace_callback(
        "/md_text_title1=[\"']((?!pixflow_base64)(.*?)(?=md_text_))?/si",
        "pixflow_base64TextTitleReplace",
        $content);
    return $content;
}
function pixflow_base64TextTitleReplace($matches){
    if(isset($matches[1])) {
        $matches[1] = preg_replace("/['\"](?=[^'\"]*$)/s",'',$matches[1]);
        return 'md_text_title1="pixflow_base64' . base64_encode($matches[1]) . '" ';
    }
    return $matches[0];
}
add_filter( 'content_edit_pre', 'pixflow_base64TextTitle' );
