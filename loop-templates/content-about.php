<?php
/**
 * Blank content partial template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$content = get_field('about_content');
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">','</h1>'); ?>
        </header>
   
    <div class="entry-content">
        <div id="au-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-content-holder">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </article>
