<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Corporate_Biz
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="singular-content-wrap">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content/content', 'single' );

					//the_post_navigation();

                    the_post_navigation( array(
                    	'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'corporate-biz' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Prev Post', 'corporate-biz' ) . '</span> <span class="nav-title">%title</span>',
                    	'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'corporate-biz' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next Post', 'corporate-biz' ) . '</span> <span class="nav-title">%title</span>',
                    ) );


					get_template_part( 'template-parts/content/content', 'comment' );

				endwhile; // End of the loop.
				?>
			</div><!-- .singular-content-wrap -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
