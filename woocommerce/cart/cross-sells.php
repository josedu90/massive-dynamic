<?php
/**
 * Cross-sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


if ( $cross_sells ) : ?>

    <div class="cross-sells">

        <h2><?php _e( 'You may be interested in&hellip;', 'woocommerce' ) ?></h2>

        <?php woocommerce_product_loop_start(); ?>

        <?php foreach ( $cross_sells as $cross_sell ) : ?>

            <?php
            $post_object = get_post( $cross_sell->get_id() );

            setup_postdata( $GLOBALS['post'] =& $post_object );

            wc_get_template_part( 'content', 'product' ); ?>

        <?php endforeach; ?>

        <?php woocommerce_product_loop_end(); ?>

    </div>

<?php endif;

wp_reset_postdata();
