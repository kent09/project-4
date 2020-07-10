<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'loop-templates/content', 'single' ); ?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->
</div>
<?php 
	$cat = wp_get_post_categories(get_the_ID());
	$args = array(
			'posts_per_page' => 3,
			'category__in' => array($cat[0]),
			'orderby' =>'post_date',
			'post__not_in' => array(get_the_ID()),
			'caller_get_posts'=>1
        );
					
	$query = new WP_Query($args);

	if($query->have_posts()): ?>

<footer class="entry-footer bg-light p-50 single-post">
	<div class="<?php echo esc_attr( $container ); ?>">
		<div class="row">
			<div class="col-md-12 text-center mb-30">
				<h3>You Might Also Like</h3>
			</div>
		</div>
		<div class="row">
			<?php  

					while( $query->have_posts() ) : $query->the_post(); ?>
				
						<div class="col-lg-4 col-md-12">
							<div class="thumbnail-medium">
								<a href="<?php echo esc_url(get_the_permalink());?>"><?php the_post_thumbnail(); ?></a>
							</div>
							<p class="meta-date color-ligthgray">
								<?php 
									$cat_name = get_the_category( $post->ID );
									echo  '<a href="'.get_category_link($cat_name[0]->term_id).'">'.$cat_name[0]->name.'</a><i class="fa fa-circle"></i>';
									the_date('m/d/Y'); 
								?>
							</p>
							<h5>
								<a href="<?php echo esc_url(get_the_permalink());?>">
									<?php the_title(); ?>
								</a>
							</h5>
						</div>
				<?php		
					endwhile;
                    //endIf;
                    wp_reset_query(); ?>    
	    </div>	
	</div>
</footer><!-- .entry-footer -->

<?php endif; ?>
<!-- </div>#single-wrapper -->

<?php get_footer(); ?>
