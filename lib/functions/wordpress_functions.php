<?php

function pixflow_print_terms($terms, $separatorString){
    $termIndex = 1;
    if ($terms)
        foreach ($terms as $term) {
            echo esc_attr($term->name);

            if (count($terms) > $termIndex)
                echo esc_attr($separatorString);

            $termIndex++;
        }
}

function pixflow_get_post_terms_names($taxonomy)
{
    $terms = get_the_terms(get_the_ID(), $taxonomy);

    if (!is_array($terms))
        return $terms;

    $termNames = array();

    foreach ($terms as $term)
        $termNames[] = $term->name;

    return $termNames;
}

/*
 * Concatenate post category names
 */
function pixflow_implode_post_terms($taxonomy, $separator = ', ')
{
    $terms = pixflow_get_post_terms_names($taxonomy);

    if (!is_array($terms))
        return null;

    return implode($separator, $terms);
}

//Thanks to:
//http://bavotasan.com/tutorials/limiting-the-number-of-words-in-your-excerpt-or-content-in-wordpress/
function pixflow_excerpt($limit)
{
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
    return $excerpt;
}

add_action('wp_ajax_pixflow_generateThumbs', 'pixflow_generateThumbs');
add_action('wp_ajax_nopriv_pixflow-generateThumbs', 'pixflow_generateThumbs');
function pixflow_generateThumbs()
{
    set_time_limit(0);
    if (!isset($_SESSION['pixflow_media']) && !is_array($_SESSION['pixflow_media'])) {
        die('err');
    }
    foreach ($_SESSION['pixflow_media'] as $post_id => $item) {
        wp_update_attachment_metadata($post_id, wp_generate_attachment_metadata($post_id, $item));
    }
    die('done!');
}

// Ensure cart contents update when products are added to the cart via AJAX
add_filter('woocommerce_add_to_cart_fragments', 'pixflow_woocommerce_header_add_to_cart_fragment');
function pixflow_woocommerce_header_add_to_cart_fragment($fragments)
{
    ob_start();
    global $woocommerce, $md_allowed_HTML_tags;

    do_action('woocommerce_before_mini_cart');
    ?>
    <ul class="cart_list product_list_widget ">

        <?php if (!$woocommerce->cart->is_empty()) : ?>

            <?php
            foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) {
                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {

                    $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key);
                    $product_price = apply_filters('woocommerce_cart_item_price', $woocommerce->cart->get_product_price($_product), $cart_item, $cart_item_key);
                    $url = wp_get_attachment_image_src(get_post_thumbnail_id($_product->id), 'woocommerce_cart_item_thumbnail');
                    $url = (false == $url) ? PIXFLOW_PLACEHOLDER_BLANK : $url['0'];
                    if ($url != '')
                        $thumbnail = '<div class="cart-img" style="background-image: url(' . $url . ')"></div>';

                    ?>
                    <li class="<?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
                        <?php
                        echo apply_filters('woocommerce_cart_item_remove_link', sprintf(
                            '<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                            esc_url($woocommerce->cart->get_remove_url($cart_item_key)),
                            esc_attr__('Remove this item', 'massive-dynamic'),
                            esc_attr($product_id),
                            esc_attr($_product->get_sku())
                        ), $cart_item_key);
                        ?>
                        <?php if (!$_product->is_visible()) : ?>
                            <?php echo str_replace(array('http:', 'https:'), '', $thumbnail) . $product_name . '&nbsp;'; ?>
                        <?php else : ?>
                            <a href="<?php echo esc_url($_product->get_permalink($cart_item)); ?>">
                                <?php echo str_replace(array('http:', 'https:'), '', $thumbnail) . $product_name . '&nbsp;'; ?>
                            </a>
                        <?php endif; ?>
                        <?php echo wp_kses($woocommerce->cart->get_item_data($cart_item), $md_allowed_HTML_tags); ?>

                        <?php echo apply_filters('woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf('%s &times; %s', $cart_item['quantity'], $product_price) . '</span>', $cart_item, $cart_item_key); ?>
                    </li>
                    <?php
                }
            }
            ?>

        <?php else : ?>

            <li class="empty"><?php esc_attr_e('No products in the cart.', 'massive-dynamic'); ?></li>

        <?php endif; ?>

    </ul><!-- end product list -->

    <?php if (!WC()->cart->is_empty()) : ?>

    <p class="total"><strong><?php esc_attr_e('Subtotal', 'massive-dynamic'); ?>
            :</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

    <?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

    <p class="buttons">
        <a href="<?php echo wc_get_cart_url(); ?>"
           class="button wc-forward"><?php esc_attr_e('View Cart', 'massive-dynamic'); ?></a>
        <a href="<?php echo wc_get_checkout_url(); ?>"
           class="button checkout wc-forward"><?php esc_attr_e('Checkout', 'massive-dynamic'); ?></a>
    </p>

<?php endif; ?>

    <?php do_action('woocommerce_after_mini_cart'); ?>
    <script type="text/javascript">pixflow_addToCart();</script>
    <?php
    $fragments['ul.cart_list'] = ob_get_clean();

    return $fragments;
}

//Get Metabox value from vafpress function
function pixflow_metabox($key, $default = null)
{
    $value = vp_metabox($key, $default);
    $value = (null == $value) ? $default : $value;
    return $value;
}

function pixflow_drfw_postID_by_url($url)
{
    global $wpdb;
    $id = url_to_postid($url);
    if ($id == 0) {
        $fileupload_url = get_option('fileupload_url', null) . '/';
        if (strpos($url, $fileupload_url) !== false) {
            $url = str_replace($fileupload_url, '', $url);
            $id = $wpdb->get_var($wpdb->prepare("SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '$url' AND wposts.post_type = 'attachment'"));
        }
    }
    return $id;
}

// remove Open Sans font
add_action('wp_enqueue_scripts', 'pixflow_deregister_styles', 100);

function pixflow_deregister_styles()
{
    wp_deregister_style('open-sans');
    wp_register_style('open-sans', false);
    wp_enqueue_style('open-sans');
}

/*********************************************************************/
/* Add featured post checkbox
/********************************************************************/

add_action('add_meta_boxes', 'pixflow_showPageTitleMetaBox');
function pixflow_showPageTitleMetaBox()
{
    add_meta_box('show_page_title_id', esc_attr__('Page Options', 'massive-dynamic'), 'pixflow_pageMetaBox_callback', 'page', 'normal', 'high');
}

function pixflow_pageMetaBox_callback($post)
{
    global $post;
    $onePageScroll = get_post_meta($post->ID, 'one_page_scroll', true);
    $disableOnePageScrollMobile = get_post_meta($post->ID, 'disable_one_page_scroll_mobile', true);
    ?>
    <br/>
    <input type="checkbox" name="one_page_scroll"
           value="yes" <?php echo esc_attr(($onePageScroll == 'yes') ? 'checked="checked"' : ''); ?>/> Section Scroll
    <br/>
    <br/>
    <input type="checkbox" name="disable_one_page_scroll_mobile"
           value="yes" <?php echo esc_attr(($disableOnePageScrollMobile == 'yes') ? 'checked="checked"' : ''); ?>/> Disable Section scroll on Mobile
    <br/>
    <br/>

    <?php
}


add_action('post_update', 'pixflow_savePageMetaBox');
add_action('save_post', 'pixflow_savePageMetaBox');
function pixflow_savePageMetaBox()
{

    global $post;
    if (isset($_POST['one_page_scroll'])) {
        update_post_meta($post->ID, 'one_page_scroll', $_POST['one_page_scroll']);
    }else{
        delete_post_meta( $post->ID, 'one_page_scroll');
    }

    if (isset($_POST['disable_one_page_scroll_mobile'])) {
        update_post_meta($post->ID, 'disable_one_page_scroll_mobile', $_POST['disable_one_page_scroll_mobile']);
    }else{
        delete_post_meta( $post->ID, 'disable_one_page_scroll_mobile');
    }

}

// Embed pixflow metabox to theme, so we deactivate pixflow metabox anymore
function pixflow_deactivatePixflowMetabox($plugin, $network_activation)
{
    if (defined('PX_Metabox_VER')) {
        deactivate_plugins(WP_PLUGIN_DIR . '/pixflow-metabox/pixflow-metabox.php');
    }
}

add_action('activated_plugin', 'pixflow_deactivatePixflowMetabox', 10, 2);

/*Set FrontPage post meta*/
function pixflow_setFrontPgaePostMeta($oldValue, $newValue)
{
    update_post_meta($oldValue, 'pixflow_front_page', 'false');
    update_post_meta($newValue, 'pixflow_front_page', 'true');
}
add_action('update_option_page_on_front', 'pixflow_setFrontPgaePostMeta', 10, 2);

/**
 * @summary Create pixflow sample page
 *
 *  @return int id of pixflow sample page and if created before return id of home page
 * @since 1.0.0
 */

function pixflow_create_sample_page(){
    if( get_option('pixflow_sample_page') == true ){
        $home_page_id = (int) get_option( 'page_on_front' );
        return $home_page_id ;
    }
    $contentMassivePage = "";

    global $user_ID;
    $page = array();
    $page['post_type'] = 'page';
    $page['post_content'] = $contentMassivePage;
    $page['post_parent'] = 0;
    $page['post_author'] = $user_ID;
    $page['post_status'] = 'publish';
    $page['post_title'] = esc_attr__('Test Page', 'massive-dynamic');
    $page_id = wp_insert_post($page);
    update_post_meta($page_id, 'pixflow_sample_page', 'true');
    update_option( 'pixflow_sample_page' , true );
    return $page_id;
}

add_filter( 'tiny_mce_before_init', 'pixflow_unsetAutoresizeOn' );
function pixflow_unsetAutoresizeOn( $init ) {
    unset( $init['wp_autoresize_on'] );
    return $init;
}

// Add massive link edit button to each page
function pixflow_render_edit_button($actions, $page_object){
    $page_object = (array) $page_object ;
    if( pixflow_is_builder_editable( $page_object["ID"] ) == true ){
        $actions['massive-dynamic-link']  = '<a href="'. get_site_url() . '/?page_id=' . $page_object["ID"] .'&mbuilder=true'
            .'" class="md-link">' . __('Edit with Massive Builder','massive-dynamic') . '</a>';
    }
    return $actions;
}
add_filter( 'page_row_actions', 'pixflow_render_edit_button' , 10 , 2 );
