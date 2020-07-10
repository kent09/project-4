<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


function product_loop_item($value, $option = false) {
	$post_objects = $option ? get_field($value, 'option')  : get_field($value);
	if($value =="actual_products"){
		$pb64 = "pb-64";
		$pb10 = "pb-10";
		$class_style = "color-black";
	}else{
		$class_style ="bg-black color-white";
	}
	if( $post_objects ): ?>
   		<div class="row">
	
	   	<?php foreach( $post_objects as $post): ?>

	        <div class="col-lg-3 col-md-6 col-sm-6 pb-1-3">
				<a href="<?php the_permalink($post->ID); ?>" class="text-decor-none">
					<div class="item-holder border-4">
						<div class="item-img">
							<?php echo get_the_post_thumbnail($post->ID, 'medium', array( 'class' => 'img-responsive' )); ?>
						</div>
						<div class="<?php echo $value;?>">
							<div class="item-title text-center <?php echo $class_style;?>"><?php echo get_the_title($post->ID); ?></div>
						</div>
						<?php 
							if($value =="actual_products"){
								product_type_brand_price($post->ID); 
							}
						?>
					</div>
				</a>
			</div>
	    <?php endforeach; ?>
		</div>
	<?php endif;
}
