<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">

			<p class="meta-date color-ligthgray">
				<?php 
					$cat_name = get_the_category( $post->ID );
					echo  '<a href="'.get_category_link($cat_name[0]->term_id).'">'.$cat_name[0]->name.'</a><i class="fa fa-circle"></i>';
					the_date('m/d/Y'); 
				?>
			</p>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<div class="feature-img">
		<?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>
	</div>
	<div class="entry-content single-post">

		<?php the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<div class="row p-70">
			<div class="col-md-12 text-center">
		   <a href="<?php bloginfo("url"); ?>/news" class="btn btn-primary">Return to Blog</a>
		   </div>
	</div>

</article><!-- #post-## -->
