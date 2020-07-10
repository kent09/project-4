<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$size = 'full';
?>
<?php /* if(have_rows('carousel')): ?>
<div class="carousel">
	<div class="owl-carousel owl-theme">
		<?php while ( have_rows('carousel') ) : the_row(); ?>
			<div class="item">
				<?php   
					$link = get_sub_field('banner_link');
					$link = ($link)? $link : '#';
					$banner_text = get_sub_field('banner_text');
					$banner_text_alignmnet = get_sub_field('banner_text_alignment');
					$banner_btn_text = get_sub_field('banner_button_text');
					$banner_btn_alignment = get_sub_field('banner_button_alignment');

					$image = wp_get_attachment_image( get_sub_field('images'), 'large', false, array( 'class' => 'img-responsive' ));
					$image_url = wp_get_attachment_image_src(get_sub_field('images'), 'large', false);
					$image_mobile_url = wp_get_attachment_image_src(get_sub_field('mobile_images'), 'large', false);


                    if($banner_btn_alignment == "left"){
                       $btn_style ="pull-left";
					}else if($banner_btn_alignment == "right"){
						$btn_style ="pull-right";
					}elseif($banner_btn_alignment == "center"){
						$btn_style ="justify-content-center";
					}

					if($banner_text == ""){
						$display ="display:none";
					}else{
						$display ="display:visible";
						if($banner_text_alignmnet == "left"){
							$banner_align = "pull-left";
						}elseif($banner_text_alignmnet == "right"){
							$banner_align = "pull-right";
						}
					}
				?>
				<?php if($image): ?>
					<a href="<?php echo $link ?>" data-web="<?php echo $image_url[0]; ?>" data-mobile="<?php echo $image_mobile_url[0]; ?>">
						<?php echo $image; ?>
					</a>
				<?php endif; ?>
				<div class="banner-text color-white <?php echo $banner_align; ?>" style="<?php echo $display; ?>">
						<p><?php echo $banner_text; ?></p>
				</div>
				
				<div class="row <?php echo $btn_style; ?>">
				<?php if($banner_btn_text != "" && $banner_text == ""): ?>
					   <div class="slider-btn-3">
						<a href="<?php echo $link ?>" class="btn btn-primary " href="" role="button"><?php echo $banner_btn_text; ?> </a>
				       </div>
					<?php endif; ?>
					<?php if($banner_btn_text != "" && $banner_text != ""): ?>
						<div class="slider-btn-2">
						<a href="<?php echo $link ?>" class="btn btn-primary" href="" role="button"><?php echo $banner_btn_text; ?> </a>
						</div>
					<?php endif; ?>
				</div>
              </div>	
		<?php endwhile; ?>
	</div>
</div>
<?php endif; */ ?>


<div class="hero-banner">
	<?php  if(have_rows('carousel')): ?>
		
		<?php while ( have_rows('carousel') ) : the_row(); ?>
			<?php 
				$desktop = get_sub_field('images');
				$mobile = get_sub_field('mobile_images') ?: '1847';
				$link = get_sub_field('banner_link');
			?>
			<a href="<?php echo $link ?: '/'; ?>">
				<?php echo wp_get_attachment_image( $desktop, $size, "", array( "class" => "img-responsive desktop")); ?>
				<?php echo wp_get_attachment_image( $mobile, $size, "", array( "class" => "img-responsive mobile")); ?>
			</a>

		<?php endwhile; ?>
	<?php endif; ?>
</div>




