<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
include 'incl/product-loop-query.php';
include  'inc/product-list-widget.php';

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();

    if(is_product()){
      wp_enqueue_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', [], $the_theme->get('Version'));
      wp_enqueue_style('owl-carousel-css-theme-default', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css', [], $the_theme->get('Version'));
      wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', [], $the_theme->get('Version'), true);

      wp_enqueue_style('single-product-custom-css',  get_stylesheet_directory_uri() . '/css/single-product.css', array(), $the_theme->get( 'Version' ) );
      wp_enqueue_script('single-product-custom-js',  get_stylesheet_directory_uri() . '/js/single-product-custom.js', array(), $the_theme->get( 'Version' ) );
    }

    if(is_page('checkout')){
      wp_enqueue_style('single-product-custom-css',  get_stylesheet_directory_uri() . '/css/custom-checkout.css', array(), $the_theme->get( 'Version' ) );
    }

    if(is_shop() || is_product_category()){
      wp_deregister_script('wc-price-slider');
     }

    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_style( 'owl-carousel-style', get_stylesheet_directory_uri() . '/css/owl.carousel.min.css', array(), $the_theme->get( 'Version' ) );
    // wp_enqueue_style( 'owl-carousel-default-style', get_stylesheet_directory_uri() . '/css/simplebar.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_style( 'custom-styles', get_stylesheet_directory_uri() . '/css/custom.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_style( 'media-styles', get_stylesheet_directory_uri() . '/css/media.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'simplebar-scripts', 'https://unpkg.com/simplebar@latest/dist/simplebar.min.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'owl-carousel-scripts', get_stylesheet_directory_uri() . '/js/owl.carousel.min.js', array(), $the_theme->get( 'Version' ), true );

    wp_enqueue_script( 'imageloaded-scripts', 'https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js', array(), $the_theme->get( 'Version' ), true );

    wp_enqueue_script( 'custom-scripts', get_stylesheet_directory_uri() . '/js/custom.js', array(), $the_theme->get( 'Version' ), true );


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

if( function_exists('acf_add_options_page') ) {
  // $option_page = acf_add_options_page(array(
  //   'page_title' 	=> 'Sitewide Settings',
  //   'menu_title' 	=> 'Sitewide Settings',
  //   'menu_slug' 	=> 'sitewide_settings',
  //   'capability' 	=> 'edit_posts',
  //   'redirect' 	=> false
  // ));
  acf_add_options_sub_page('Product Page');
  acf_add_options_sub_page('Order Received');
}

function product_type_brand_price($post_id) {

  $regular_price = get_post_meta( $post_id, '_regular_price', true );
  $recPrice = get_post_meta( $post_id, '_price', true);
  $regular_price = $regular_price > 0 ? $regular_price : $recPrice;
  $sale_price = get_post_meta( $post_id, '_sale_price', true );
  $actual_products = get_field('actual_products', $post_id); 
?>
  
  <div class="price-holder align-items-center color-white bg-black">
          <div class="text-center"><?php echo ($sale_price) ? wc_price($sale_price ) : wc_price( $regular_price ); ?></div>
  </div>

<?php 
}

function guarantee_loop_query($value, $option = false){
  $post_objects = $option ? get_field($value, 'option')  : get_field($value);
  if( $post_objects ){

      $last_key = array_keys($post_objects);
      $last_key = end($last_key);

      foreach( $post_objects as $key => $post){

        $col = "col-md-6";
        if($key == $last_key) {
            $col = "col-md-12";
        }

      ?>
      <div class="col-lg-4 <?php echo $col; ?>">
        <div class="holder">
            <?php $img = wp_get_attachment_image( $post['icon'], 'medium', false, array( 'class' => 'img-responsive' )); ?>
            <?php echo $img; ?>
            <div class="guarantee-text color-white"> 
              <?php echo $post['text'] ?>
            </div>
        </div>	
      </div>
      <?php    
   }
  }
}

if( function_exists('acf_options_page')){
  acf_add_options_page();
  acf_add_options_sub_page('Header');
  acf_add_options_sub_page('Footer');
}

if (! function_exists('footer_sidebars')){

  //Register Sidebar
  function footer_sidebars(){

      $args = array(
          'id' => 'first',
          'name' => __(' First Footer Menu'),
          'description' => __(' First Footer Menu'),
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget' => '</div>'
      );
      register_sidebar($args);

      $args = array(
          'id' => 'second',
          'name' => __(' Second Footer Menu'),
          'description' => __(' Second Footer Menu'),
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget' => '</div>'
      );
      register_sidebar($args);

      $args = array(
          'id' => 'third',
          'name' => __(' Third Footer Menu'),
          'description' => __(' Third Footer Menu'),
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget' => '</div>'
      );
      register_sidebar($args);

      $args = array(
          'id' => 'fourth',
          'name' => __(' Fourth Footer Logo Info'),
          'description' => __(' Fourth Footer Logo Info'),
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget' => '</div>'
      );
      register_sidebar($args);
  }
  add_action('widgets_init', 'footer_sidebars');
}

//Change number or products per row to 3 in Shop Page
add_filter('loop_shop_columns', 'loop_columns',999);
if(!function_exists('loop_columns')){
   function loop_columns(){
       return 3; // 3 products per row
   }
}

// Remove Empty Tabs
add_filter( 'woocommerce_product_tabs', 'yikes_woo_remove_empty_tabs', 20, 1 );
function yikes_woo_remove_empty_tabs( $tabs ) {
  global $product;

  if(empty($product->get_description()) && isset( $tabs['description'] )) {
    unset( $tabs['description'] );
    echo '<style type="text/css">body.woocommerce #page #tab-title-description { display:none; } </style>';
  }

  if(empty(get_field('specifications', $product->get_id())) ) {
    unset( $tabs['specifications'] );
    echo '<style type="text/css">body.woocommerce #page #tab-title-specifications { display: none; }</style>';
  }

  return $tabs;
}

add_filter( 'wpseo_breadcrumb_links', 'wpseo_breadcrumb_add_woo_shop_link' );

function wpseo_breadcrumb_add_woo_shop_link( $links ) {
    global $post;

    if ( is_woocommerce() && !is_product()) {
        foreach ($links as $key => $link) {

          if (isset($link['text']) && strpos($link['text'], 'Page') !== false) {
            $links[$key]['text'] = "";
          }
          
        }
    }
    return $links;
}

add_filter('wc_add_to_cart_message','dtm_custom_add_to_cart_message',10,2);

function dtm_custom_add_to_cart_message($message, $product_id=null){
 
    $titles[]= get_the_title($product_id);
    
    $titles = array_filter($titles);
    
    $added_text = sprintf(_n('%s has been added to your cart.', '%s have been added to your cart.', sizeof($titles),'woocommerce'),wc_format_list_of_items($titles));
    
    $message = sprintf ('<span class="add-to-cart-title-alert">%s</span><a href="%s" class="button add-to-cart-btn-alert">%s</a>',
        esc_html($added_text),
         esc_url(wc_get_page_permalink('cart')),
        esc_html__('View Cart', 'woocommerce')
       
    );
    return $message;
}

add_action('template_redirect','remove_woocommerce_breadcrumbs');
function remove_woocommerce_breadcrumbs(){
    remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20,0);
}

if ( ! function_exists( 'customer_bank_details' ) ) {
    function customer_bank_details($order) {
        $payment_method = $order->get_order_item_totals(); 
        if($payment_method['payment_method']['value'] == 'Direct bank transfer') { ?>

            <div>
                <?php if(get_field('bank_detail_header', 'option')): ?>
                    <h2><?php esc_html_e( get_field('bank_detail_header', 'option'), 'woocommerce' ); ?></h2>
                <?php endif; ?>

                <?php if( have_rows('bank_detail_content', 'option') ): ?>
                    <ul style="list-style: none; padding: 0;">

                        <?php while ( have_rows('bank_detail_content', 'option') ) : the_row(); ?>
                                <li style="margin-left: 0;">
                                    <label style="font-weight: bold;"><?php the_sub_field('label'); ?>:</label>
                                    <p style="margin-bottom: 8px;"><?php the_sub_field('details'); ?></p>
                                </li>
                        <?php endwhile; ?>

                    </ul>
                <?php endif; ?>

            </div> <?php
        }
    }

    add_action('woocommerce_email_customer_bank_details', 'customer_bank_details', 10, 2);
}


add_filter( 'get_the_archive_title', function ($title) {    
    if ( is_category() ) {    
            $title = single_cat_title( '', false );    
        } elseif ( is_tag() ) {    
            $title = single_tag_title( '', false );    
        } elseif ( is_author() ) {    
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;    
        } elseif ( is_tax() ) { //for custom post types
            $title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
        } elseif (is_post_type_archive()) {
            $title = post_type_archive_title( '', false );
        }
    return $title;    
});