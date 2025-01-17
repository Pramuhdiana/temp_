<?php
/**
 * The template for displaying portfolio items
 *
 * @package Corporate_Biz
 */
?>

<?php
$enable = get_theme_mod( 'corporate_biz_portfolio_option', 'disabled' );

if ( ! corporate_biz_check_section( $enable ) ) {
	// Bail if portfolio section is disabled.
	return;
}

$corporate_biz_subtitle = get_theme_mod( 'corporate_biz_portfolio_sub_title' );
$corporate_biz_title       = get_option( 'jetpack_portfolio_title', esc_html__( 'Projects', 'corporate-biz' ) );
$corporate_biz_description = get_option( 'jetpack_portfolio_content' );

if ( ! $corporate_biz_title && ! $corporate_biz_description && ! $corporate_biz_subtitle ) {
	$classes[] = 'no-section-heading';
}

$classes[] = 'layout-three';
$classes[] = 'jetpack-portfolio';
$classes[] = 'section';
?>

<div id="portfolio-content-section" class="portfolio-content-section <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php if ( $corporate_biz_subtitle || $corporate_biz_title || $corporate_biz_description ) : ?>
			<div class="section-heading-wrapper">

				<?php if( $corporate_biz_subtitle ) : ?>
					<div class="section-subtitle">
						<?php echo esc_html( $corporate_biz_subtitle ); ?>
					</div>
				<?php endif; ?>

				<?php if ( $corporate_biz_title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"corporate_biz_><?php echo wp_kses_post( $corporate_biz_title ); ?></h2>
					</div><!-- .page-title-wrapper -->
				<?php endif; ?>

				<?php if ( $corporate_biz_description ) : ?>
					<div class="section-description">
						<p>
							<?php
								echo wp_kses_post( $corporate_biz_description );
							?>
						</p>
					</div><!-- .section-description-wrapper -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper portfolio-content-wrapper layout-three">
			<div class="grid">
				<?php get_template_part( 'template-parts/portfolio/post-types', 'portfolio' ); ?>
			</div><!-- .grid -->
		</div><!-- .section-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- #portfolio-section -->
