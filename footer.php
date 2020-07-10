<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php 
	if(get_query_var('brand')) {
		echo "</div></div>";
	}
?>
	<div class="wrapper" id="wrapper-footer">
		<div class="subscribe bg-black text-center color-white ptb-40">
			<div class="container">
			<?php  echo  do_shortcode(get_field('subscription_form','option')); ?>
			</div>
		</div>

		 <div class="<?php echo esc_attr( $container ); ?> footer-widget">
			<div class="row">
				<div class="col-lg-10 col-md-8">
					<div class="row">
						<div class="col-lg-5 col-md-6 pt-3 footer-menu">
							<div class="holder pt-0">
								<?php dynamic_sidebar('first'); ?>
							</div>
						</div>
						<div class="col-lg-2 col-md-3 pt-3 footer-menu">
							<div class="holder pt-0">
								<?php dynamic_sidebar('second'); ?>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 pt-3 footer-menu">
							<div class="holder pt-0">
								<?php dynamic_sidebar('third'); ?>
							</div>
						</div>
						<div class="col-lg-2 col-md-12 pt-3 footer-menu">
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-4">
					<div class="holder pt-0">
						<?php dynamic_sidebar('fourth'); ?>
					</div>
				</div>
			 </div>
		</div>
		<div class="copy-right bg-light">
			<ul class="d-flex p-0 m-0 justify-content-center color-black">
				<li><?php the_field('copyright','option');  ?></li>
				<li><a href="<?php bloginfo('url').the_field('private_link','option'); ?>"><?php the_field('private_text','option'); ?></a></li>
				<li><a href="<?php bloginfo('url').the_field('terms_link','option'); ?>"><?php the_field('terms','option'); ?></a></li>
			</ul>
		</div>
</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

