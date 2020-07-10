<?php
/**
 * Template Name: News Page
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


<div class="wrapper" id="full-width-page-wrapper">

	 <div class="container news" id="content"> 

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">
				    
            	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            		<header class="entry-header">
            			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            		</header><!-- .entry-header -->
                    
                    <div class="row mobile">
                        <?php get_template_part( 'sidebar-templates/sidebar-right' ); ?>
                    </div>
                  <div class="row mb-30">
                          <?php  
                                $row_start=1;
                                $args = array(
                                     'posts_per_page' =>1
                                );
                                query_posts($args);
            
                                while( have_posts() ) : the_post(); ?>
            
                                      <div class="col-lg-12">
                                            <a href="<?php echo esc_url(get_the_permalink());?>"><?php the_post_thumbnail(); ?></a>
                                            <p class="meta-date color-ligthgray">
                                                <?php  
            
                                                    foreach(get_the_category() as $key => $category) { 
                                                        echo $key > 0 ? ", " : "";
                                                        echo '<a href="'.get_category_link($category->term_id).'">'.$category->cat_name.'</a>';
                                                    }; 
                                                ?>
                                                <i class="fa fa-circle"></i>
                                                <?php the_date('m/d/Y'); ?>
                                            </p>
                                            <h5>
                                                <a href="<?php echo esc_url(get_the_permalink());?>"><?php the_title(); ?></a>
                                            </h5>
                                           <?php the_content(); ?>
                                        </div>
            
                        <?php endwhile; ?>
                  </div>
            	  <div class="row mb-30">
                    <div class="col-lg-8 col-md-12">
                        <div class="row">
                            <?php  
                                $args = array(
                                     'order' => 'DESC',
                                     'orderby' =>'post_date',
                                     'post__not_in' => array(get_the_ID())
                                );
                               
                               $query = new WP_Query($args);
                                while( $query->have_posts() ) : $query->the_post(); ?>
                                   
                                    <div class="col-lg-6 col-md-6 mb-30">
                                        <a href="<?php echo esc_url(get_the_permalink());?>"><?php the_post_thumbnail(); ?></a>
                                        <p class="meta-date color-ligthgray">
            
                                            <?php  foreach(get_the_category() as $key => $category) { 
                                                echo $key > 0 ? ", &nbsp;" : "";
                                                echo '<a href="'.get_category_link($category->term_id).'">'.$category->cat_name.'</a>';
                                            }; ?>
                                            <i class="fa fa-circle"></i>
                                            <?php the_date('m/d/Y'); ?>
                                        </p>
            
                                        <h5>
                                            <a href="<?php echo esc_url(get_the_permalink());?>"><?php the_title(); ?>
                                            </a>
                                        </h5>
                                       <?php the_content(); ?>
                                       
                                    </div>
                                 <?php   
                                endwhile;
                                //endIf;
                                wp_reset_query();
                                ?>
                         </div>
                     </div>
                    
                     <?php get_template_part( 'sidebar-templates/sidebar-right' ); ?>
                     
                </div>
            </article>
	        </main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div> <!-- #content -->

</div><!-- #full-width-page-wrapper -->
<?php 
get_footer();