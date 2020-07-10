<?php
/**
 * Add WooCommerce support
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', 'understrap_woocommerce_support' );
if ( ! function_exists( 'understrap_woocommerce_support' ) ) {
  /**
   * Declares WooCommerce theme support.
   */
  function understrap_woocommerce_support() {
    add_theme_support( 'woocommerce' );

    // Add New Woocommerce 3.0.0 Product Gallery support.
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-slider' );

    // hook in and customizer form fields.
    add_filter( 'woocommerce_form_field_args', 'understrap_wc_form_field_args', 10, 3 );
  }
}

/**
 * First unhook the WooCommerce wrappers
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

/**
 * Then hook in your own functions to display the wrappers your theme requires
 */
add_action( 'woocommerce_before_main_content', 'understrap_woocommerce_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'understrap_woocommerce_wrapper_end', 10 );
if ( ! function_exists( 'understrap_woocommerce_wrapper_start' ) ) {
  function understrap_woocommerce_wrapper_start() {
    $container = get_theme_mod( 'understrap_container_type' );
    echo '<div class="wrapper" id="woocommerce-wrapper">';
    echo '<div class="' . esc_attr( $container ) . '" id="content" tabindex="-1">';
    echo '<div class="row">';
    if(!is_product()) {
      get_template_part( 'global-templates/left-sidebar-check' );
    }
    echo '<div class="col-12">';
    echo '<main class="site-main" id="main">';
  }
}
if ( ! function_exists( 'understrap_woocommerce_wrapper_end' ) ) {
  function understrap_woocommerce_wrapper_end() {
    echo '</main><!-- #main -->';
    echo '</div><!-- .row -->';
    if(!is_product()) {
      get_template_part( 'global-templates/right-sidebar-check' );
    }
    echo '</div><!-- .row -->';
    echo '</div><!-- Container end -->';
    echo '</div><!-- Wrapper end -->';
  }
}


/**
 * Filter hook function monkey patching form classes
 * Author: Adriano Monecchi http://stackoverflow.com/a/36724593/307826
 *
 * @param string $args Form attributes.
 * @param string $key Not in use.
 * @param null   $value Not in use.
 *
 * @return mixed
 */
if ( ! function_exists( 'understrap_wc_form_field_args' ) ) {
  function understrap_wc_form_field_args( $args, $key, $value = null ) {
    // Start field type switch case.
    switch ( $args['type'] ) {
      /* Targets all select input type elements, except the country and state select input types */
      case 'select':
        // Add a class to the field's html element wrapper - woocommerce
        // input types (fields) are often wrapped within a <p></p> tag.
        $args['class'][] = 'form-group';
        // Add a class to the form input itself.
        $args['input_class']       = array( 'form-control', 'input-lg' );
        $args['label_class']       = array( 'control-label' );
        $args['custom_attributes'] = array(
          'data-plugin'      => 'select2',
          'data-allow-clear' => 'true',
          'aria-hidden'      => 'true',
          // Add custom data attributes to the form input itself.
        );
        break;
      // By default WooCommerce will populate a select with the country names - $args
      // defined for this specific input type targets only the country select element.
      case 'country':
        $args['class'][]     = 'form-group single-country';
        $args['label_class'] = array( 'control-label' );
        break;
      // By default WooCommerce will populate a select with state names - $args defined
      // for this specific input type targets only the country select element.
      case 'state':
        // Add class to the field's html element wrapper.
        $args['class'][] = 'form-group';
        // add class to the form input itself.
        $args['input_class']       = array( '', 'input-lg' );
        $args['label_class']       = array( 'control-label' );
        $args['custom_attributes'] = array(
          'data-plugin'      => 'select2',
          'data-allow-clear' => 'true',
          'aria-hidden'      => 'true',
        );
        break;
      case 'password':
      case 'text':
      case 'email':
      case 'tel':
      case 'number':
        $args['class'][]     = 'form-group';
        $args['input_class'] = array( 'form-control', 'input-lg' );
        $args['label_class'] = array( 'control-label' );
        break;
      case 'textarea':
        $args['input_class'] = array( 'form-control', 'input-lg' );
        $args['label_class'] = array( 'control-label' );
        break;
      case 'checkbox':
        $args['label_class'] = array( 'custom-control custom-checkbox' );
        $args['input_class'] = array( 'custom-control-input', 'input-lg' );
        break;
      case 'radio':
        $args['label_class'] = array( 'custom-control custom-radio' );
        $args['input_class'] = array( 'custom-control-input', 'input-lg' );
        break;
      default:
        $args['class'][]     = 'form-group';
        $args['input_class'] = array( 'form-control', 'input-lg' );
        $args['label_class'] = array( 'control-label' );
        break;
    } // end switch ($args).
    return $args;
  }
}

if ( ! is_admin() && ! function_exists( 'wc_review_ratings_enabled' ) ) {
  /**
   * Check if reviews are enabled.
   *
   * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
   *
   * @return bool
   */
  function wc_reviews_enabled() {
    return 'yes' === get_option( 'woocommerce_enable_reviews' );
  }

  /**
   * Check if reviews ratings are enabled.
   *
   * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
   *
   * @return bool
   */
  function wc_review_ratings_enabled() {
    return wc_reviews_enabled() && 'yes' === get_option( 'woocommerce_enable_review_rating' );
  }
}

remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
// remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

function additional_remove_product_tabs( $tabs ) {
  unset( $tabs['additional_information'] );
  unset( $tabs['reviews'] );
  return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'additional_remove_product_tabs', 98 );

function woo_description_tabs( $tabs ) {
  $tabs['description']['title'] = __( 'Product Details' );    // Rename the additional information tab
  return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'woo_description_tabs', 98 );
add_filter( 'woocommerce_product_tabs', 'custom_product_tabs', 100 );

function custom_product_tabs( $tabs ) {
  global $product;
  // Ensure it doesn't show for virtual products
  if ( ! $product->is_virtual() ) {
    $tabs['specifications'] = array(
      'title'    => __('Specifications'),
      'callback' => 'specs_tab'
    );
    $tabs['ask'] = array(
      'title'    => __( 'Ask a Question'),
      'callback' => 'ask_tab'
    );
  }
  return $tabs;
} 

function specs_tab( $slug, $tab ) {

  if(get_field('speficications_title', get_the_ID())):
    echo '<h5>'.get_field('speficications_title', get_the_ID()).'</h5>';
  endif;
  if( have_rows('specifications', get_the_ID()) ): 
    echo '<div class="table-responsive"><table class="table-bordered"><tbody>';
    while (have_rows('specifications',  get_the_ID())): the_row();
      if(get_row_layout() == 'add_specification'):
        echo '<tr><td>'.get_sub_field('field').'</td><td>'.get_sub_field('value').'</td></tr>';
      endif;
    endwhile;
    echo '</tbody></table></div>';
  endif;
  // $specs = get_field('speficications', get_the_ID());
  // echo $specs;
}


function ask_tab() {
  $form = get_field('form_shortcode', 'option');
  echo do_shortcode($form);
}

add_action( 'woocommerce_after_main_content', 'dtm_woocommerce_output_upsells', 5 );
function dtm_woocommerce_output_upsells () {
  add_action( 'woocommerce_after_main_content', 'woocommerce_upsell_display', 15 );
}

add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
  // Change the breadcrumb delimeter from '/' to '>'
  $defaults['delimiter'] = ' &gt; ';
  return $defaults;
}

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

add_filter( 'woocommerce_output_related_products_args', 'change_number_related_products', 9999 );
function change_number_related_products( $args ) {
 $args['posts_per_page'] = 8; // # of related products
 $args['columns'] = 4; // # of columns per row
 return $args;
}