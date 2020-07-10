<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if ( $upsells ) : ?>
<div class="up-sells_wrapper" style="background-color: #f7f7f7;">
  <div class="container">
    <section class="up-sells upsells products pt-5 pb-5">
      <h2 class="text-center mb-4"><?php esc_html_e( 'You Might Also Like', 'woocommerce' ); ?></h2>
      <div class="owl-carousel owl-carousel-upsell owl-theme">
      <?php foreach ( $upsells as $upsell ) : ?>
        <?php
        $post_object = get_post( $upsell->get_id() );
        setup_postdata( $GLOBALS['post'] =& $post_object );
        // wc_get_template_part( 'content', 'product' );
        ?><div <?php wc_product_class( 'item product-loop', $product ); ?>>
            <?php
            /**
             * Hook: woocommerce_before_shop_loop_item.
             *
             * @hooked woocommerce_template_loop_product_link_open - 10
             */
            do_action( 'woocommerce_before_shop_loop_item' );

            /**
             * Hook: woocommerce_before_shop_loop_item_title.
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
            do_action( 'woocommerce_before_shop_loop_item_title' );

            /**
             * Hook: woocommerce_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_product_title - 10
             */
            do_action( 'woocommerce_shop_loop_item_title' );

            /**
             * Hook: woocommerce_after_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );
            /**
             * Hook: woocommerce_after_shop_loop_item.
             *
             * @hooked woocommerce_template_loop_product_link_close - 5
             * @hooked woocommerce_template_loop_add_to_cart - 10
             */
            remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
            do_action( 'woocommerce_after_shop_loop_item' );
            ?>
          </div>
      <?php endforeach; ?>
      </div>
    </section>
  </div>
</div>
  <script type="text/javascript">
    jQuery(document).ready(function($){
      $('.owl-carousel-upsell').owlCarousel({
        margin: 20,
        nav : false,
        dots: true,
        loop: false,
        autoplay:false,
        items: 4
      });
    });
  </script>
<?php endif;

wp_reset_postdata();
