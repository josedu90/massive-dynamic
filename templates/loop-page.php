<?php
if (
    (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) || class_exists('WooCommerce'))
    && (is_product() || is_shop() || is_product_category() || is_product_tag())
) {
    do_action( 'woocommerce_before_main_content' );
    do_action( 'woocommerce_archive_description' );
    ?>
    <div class="container">
        <?php woocommerce_content(); ?>
    </div>
<?php
    do_action( 'woocommerce_after_main_content' );
} else {
    if (have_posts()) {
        do_action( 'woocommerce_before_shop_loop' );
        while (have_posts()) {
            the_post();
            ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class('content-container'); ?> >
                <?php the_content(); ?>
            </div>
            <?php
        }//While have_posts
        do_action( 'woocommerce_after_shop_loop' );
    }//If have_posts
    wp_reset_query();
    if( comments_open() || get_comments_number() ){ ?>
        <div class="comments">
            <?php comments_template('', true); ?>
        </div>
    <?php
    }
}