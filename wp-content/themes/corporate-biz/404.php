<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Corporate_Biz
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<section class="error-404 not-found">
				<div class="singular-content-wrap">
				<?php
					$header_image = corporate_biz_featured_overall_image();

					if ( 'disable' === $header_image ) : ?>

					<header class="page-header">
						<h2 class="page-title section-title"><?php esc_html_e( 'Nothing Found', 'corporate-biz' ); ?></h2>

						<div class="section-description-wrapper section-subtitle">
							<p><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'corporate-biz' ); ?></p>
						</div>
					</header><!-- .entry-header -->

				<?php endif; ?>
					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'corporate-biz' ); ?></p>

						<?php get_search_form(); ?>
					</div><!-- .page-content -->
				</div>	<!-- .singular-content-wrap -->
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
