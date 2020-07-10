<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php if(have_rows('carousel')): ?>
<div class="carousel">
	<div class="owl-carousel owl-theme">
		<?php while ( have_rows('carousel') ) : the_row(); ?>
			<div class="item">
				<?php
					$link = get_sub_field('banner_link');
					$link = ($link)? $link : '#';
				?>
				<a href="<?php echo $link ?>" data-web="<?php the_sub_field('images'); ?>" data-mobile="<?php the_sub_field('mobile_images'); ?>">
					<img src="<?php the_sub_field('images'); ?>">
				</a>
			</div>	
		<?php endwhile; ?>
	</div>
</div>
<?php endif; ?>
