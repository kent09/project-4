<?php
/**
 * Template Name: Home Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
$size = 'full';
?>
<?php get_template_part( 'section-templates/carousel' ); ?>

<div class="container container-left-right actual-product">
	<?php product_loop_item('actual_products'); ?>
	<div class="btn-holder text-center ptb-30">
		<a href="<?php bloginfo("url") ;?>/shop" class="btn btn-primary">Shop All Products</a>
    </div>
</div>

<div class="best-offer bg-light ptb-40">
	<div class="container">
		<div class="row">
			<?php
			$size = 'full';
			$banner1_image = get_field('best_offer_banner_1');
			$banner2_image  = get_field('best_offer_banner_2');
			?>
			<?php if($banner1_image): ?>
				<div class="col-lg-6 col-md-12">
					<a href="<?php bloginfo("url") . the_field('best_offer_banner_1_link');?>" ><?php echo wp_get_attachment_image( $banner1_image, $size ); ?></a>
				</div>
			<?php endif; ?>
			<?php if($banner2_image): ?>
				<div class="col-lg-6 col-md-12" >
					<a href="<?php bloginfo("url") . the_field('best_offer_banner_2_link');?>" ><?php echo wp_get_attachment_image( $banner2_image, $size ); ?></a>
				</div>
			<?php endif; ?>
	   </div>
</div>
</div>

<div class="container container-left-right popular-product">
	<div class="row">
	<?php 
		$terms = get_field('category_list'); 
		if($terms):
	?>
			<?php foreach( $terms as $term ): ?>
				<div class="col-lg-3 col-md-6 col-sm-6 pb-1-3">
					<a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="text-decor-none">
						<div class="item-holder border-4">
							<div class="item-img">
								<?php 
									$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true ); 
									$image = wp_get_attachment_image( $thumbnail_id, 'large', false, array( 'class' => 'img-responsive' )); 
									if(!$image): ?>
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dtmfav1.png" class="img-responsive">
									<?php else: ?>
										<?php echo $image; ?>
									<?php endif; ?>

							</div>
							<div class="popular_products">
								<div class="item-title text-center bg-black color-white"><?php echo esc_html( $term->name ); ?></div>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>

<div class="guarantee bg-black">
	<div class="container">
		<div class="row align-items-center">
			<?php echo guarantee_loop_query('quality_guarantee');?>	
		</div>	
    </div>
</div>	

<div class="container aboutus">
	<div class="row">
		<?php
		 $aboutus_image = get_field('about_section_image');
		 $aboutus_header_text = get_field('about_section_header');
		 $aboutus_text = get_field('about_section_text');
		?>

		<div class="col-lg-6 col-md-12">
			<div class="au-image">
				<?php echo wp_get_attachment_image( $aboutus_image, $size ); ?>
			</div>
		</div>
		<div class="col-lg-6 col-md-12 au-text-section" >
			<?php echo $aboutus_header_text; ?>
			<div class="au-text"><?php echo $aboutus_text; ?> </div>
			<div class="au-button"><a href="<?php bloginfo("url") . the_field('contact_link');?>" class="btn btn-primary">Contact Us</a></div>
		</div>
	</div>
</div>
<?php get_footer();
