<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
  return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
  'woocommerce-product-gallery',
  'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
  'woocommerce-product-gallery--columns-' . absint( $columns ),
  'images',
) );
$attachment_ids = [];
if($post_thumbnail_id) {
  array_push($attachment_ids, $post_thumbnail_id);
}
$gallery_ids = $product->get_gallery_image_ids();
if(!empty($gallery_ids)) {
  $attachment_ids = array_merge($attachment_ids, $gallery_ids);
}
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
  <div class="p-0">
    <?php // $div = '<div class="feature-product-image">'; ?>
    <?php //if(count($attachment_ids) > 1): 
      $div = '<div class="owl-carousel owl-theme owl-carousel-product-image">';
    // endif; ?>
      <?php echo $div ?>
      <?php
      if(!empty($attachment_ids)) {
        foreach($attachment_ids as $attachment_id) {
      ?>
      <div class="item">
        <div class="woocommerce-product-gallery__wrapper_ ">
          <?php $html = wc_get_gallery_image_html( $attachment_id, true ); ?>
          <?php echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id ); ?>
        </div>
      </div>
      <?php } } ?>
    </div>
  </div>
</div>
<script type="text/javascript">
  jQuery(document).ready(function($){
    $('.owl-carousel-product-image').owlCarousel({
      margin: 10,
      nav : false,
      dots: true,
      loop: true,
      items: 1,
      autoplay:true,
      autoplaySpeed: 4000,
      autoplayHoverPause:true,
      responsiveClass:true
    });
  });
</script>

