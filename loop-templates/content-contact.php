<?php
/**
 * Blank content partial template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$address = get_field('location');
$opening_hours = get_field('opening_hours');
$background_image = get_field('contact_details_image_background');
$phonenumbers = get_field('telephone_number');
$address_link = get_field('map_link');
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->


        <div id="entry-content">
        	<div class="row">
        		<div class="col-lg-6">
        			<div class="cc-details">
        				<!-- <h2>Get In Touch</h2> -->
        				<div>
        					<i class="fa fa-map-marker"></i><span class="address"><a href="<?php echo $address_link; ?>"><p class="color-black"><?php echo $address; ?></p></a></span>
        				</div>
        				<div>
        					<i class="fa fa-phone"></i><span class="numbers"><?php echo $phonenumbers; ?></span>
        				</div>
        				<div>
        					 <span class="opening-hours"><?php echo $opening_hours; ?></span>
        				</div>
        				<div class="embed-container">
        					<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; margin-top:5%; }</style>
        					<div class='embed-container'><iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3160.5321579578854!2d144.94804661583967!3d-37.6131683303657!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad651e561e8fa83%3A0x423e65073fd9c419!2s11%20Rushwood%20Dr%2C%20Craigieburn%20VIC%203064%2C%20Australia!5e0!3m2!1sen!2sph!4v1585609269401!5m2!1sen!2sph' width='600' height='450' frameborder='0' style='border:0' allowfullscreen></iframe></div>
        				</div>
        			</div>
        		</div>
        		<div class="col-lg-6">
        			<?php echo get_field('contact_form'); ?>
        		</div>
        	</div>
        </div>
	</article>