<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site"  data-wrap="main-wrap" id="page">

	<div class="top-notification color-white bg-black font-18">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6 col-6">
					<div class="desk">
						<span class="mr-2"><i class="fa fa-phone"></i> </span>
						<span><a href="tel:<?php the_field('phone_number','option');  ?>"><?php the_field('phone_number','option');  ?></a></span>
						<span class="ml-4 mr-2"> <i class="fa fa-mobile"></i></span>
						<span><a href="tel:<?php the_field('mobile_number','option');  ?>"><?php the_field('mobile_number','option');  ?></a></span>

					</div>
					<div href="#" class="mobile">
						<span class="cursor"><i class="fa fa-phone"></i> </span>
						<span><?php the_field('phone_number','option');  ?></span>

					</div>
				</div>
				<div class="col-lg-6 col-6 text-right">
						<div class="desk">
						   <ul class="userbar d-flex p-0 m-0 justify-content-end">
								<?php if (is_user_logged_in()): ?>
									<li>
										<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account'); ?>">
											<?php _e('My Account'); ?>
										</a>
									</li>
									<li><a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a></li>
								<?php else: ?>
									<li> 
										<a href="<?php echo bloginfo('url'); ?>/about/">About</a>
									</li>
									<li>
										<a href="<?php echo bloginfo('url'); ?>/contact/">Contact</a>
									</li>
								<?php endif; ?>
							</ul>
						</div>
						<div class="mobile">
							<ul class="userbar d-flex p-0 m-0 justify-content-end">
								<?php if (is_user_logged_in()): ?>
									<li>
										<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account'); ?>">
											<?php _e('My Account'); ?>
										</a>
									</li>
									<li><a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a></li>
								<?php else: ?>
									<li> 
										<a href="<?php echo bloginfo('url'); ?>/about/">About</a>
									</li>
									<li>
										<a href="<?php echo bloginfo('url'); ?>/contact/">Contact</a>
									</li>
								<?php endif; ?>
							</ul>
					 </div>
			     </div>
		    </div>
	</div>
	</div><!--top-notification end-->

	<div class="top-header bg-white">
		<div class="container">
			<div class="row align-items-center">
			   <div class="col-lg-6">
					<button class="navbar-toggler mobile" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
								<span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
					</button>
					<!-- Your site title as branding in the menu -->
					<?php if ( ! has_custom_logo() ) { ?>

						<?php if ( is_front_page() && is_home() ) : ?>

							<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

						<?php else : ?>

							<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

						<?php endif; ?>


						<?php } else {
						the_custom_logo();
						}?><!-- end custom logo -->

						<ul class="mobile">
						<li class="mycart">
							<a href="<?php echo bloginfo('url'); ?>/cart/">
								<i class="fa fa-shopping-cart" aria-hidden="true"></i>
								<?php 
								$item_count =  WC()->cart->get_cart_contents_count();
								if($item_count): ?>

									<span class="cart-count"><?php echo $item_count; ?></span>
									
								<?php endif; ?>
							</a>
						</li>
					</ul>
				</div><!--th col-6 1 end-->
				<div class="col-lg-6">
					<ul class="shopping-bar d-flex p-0 justify-content-end text-center">
					<li class="top-search" style="width:100%;"><?php echo do_shortcode('[aws_search_form id="1"]'); ?></li>
					<li class="mycart desk">
							<a href="<?php echo bloginfo('url'); ?>/cart/">
								<?php 
								$item_count =  WC()->cart->get_cart_contents_count();
								if($item_count): ?>

									<span class="cart-count"><?php echo $item_count; ?></span>
									
								<?php endif; ?>
							</a>
						</li>
					</ul>
				</div><!--th col-6 2 end-->
			</div>
	   </div>			
	</div><!--top-header end-->

	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

		<nav class="navbar navbar-expand-md navbar-dark bg-black">

		<?php if ( 'container' == $container ) : ?>
			<div class="container">
			<?php endif; ?>
					<!-- The WordPress Menu goes here -->
					<div id="navbarNavDropdown" class="collapse navbar-collapse">
					<?php wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => 'navbar-nav',
							'fallback_cb'     => '',
							'menu_id'         => 'main-menu',
							'depth'           => 2,
							'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
						)
					); ?>
					      <ul id="dtm-add-menu-mobile" class="navbar-nav">
								<?php if (is_user_logged_in()): ?>
									<li>
										<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account'); ?>" class="nav-link">
											<?php _e('My Account'); ?>
										</a>
									</li>
									<li><a href="<?php echo wp_logout_url(home_url()); ?>" class="nav-link">Logout</a></li>
								<?php else: ?>
									<li> 
										<a href="<?php echo bloginfo('url'); ?>/about/" class="nav-link">About</a>
									</li>
									<li>
										<a href="<?php echo bloginfo('url'); ?>/contact/" class="nav-link">Contact</a>
									</li>
								<?php endif; ?>
							</ul>
					</div>
				<?php if ( 'container' == $container ) : ?>
				</div><!-- .container -->
				<?php endif; ?>

		</nav><!-- .site-navigation -->
		<?php
		if ( function_exists('yoast_breadcrumb') && !is_front_page()) {
			yoast_breadcrumb( '<div class="container"><p id="breadcrumbs">','</p></div>' );
		 }elseif(is_single() && !is_product()){
			echo'<div class="container"><p id="breadcrumbs"><span><span><a href="https://dtmtrading.stageserve.com/">Home</a> > <span class="breadcrumb_last" aria-current="page">Blog</span></span></span></p></div>';
		 }
		?>
	</div><!-- #wrapper-navbar end -->
				