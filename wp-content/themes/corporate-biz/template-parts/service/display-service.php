<?php
/**
 * The template for displaying service content
 *
 * @package Corporate_Biz
 */
?>

<?php
$enable_content    = get_theme_mod( 'corporate_biz_service_option', 'disabled' );
$corporate_biz_subtitle = get_theme_mod( 'corporate_biz_service_sub_title' );

if ( ! corporate_biz_check_section( $enable_content ) ) {
	// Bail if service content is disabled.
	return;
}

$corporate_biz_title       = get_option( 'ect_service_title', esc_html__( 'Services', 'corporate-biz' ) );
$corporate_biz_description = get_option( 'ect_service_content' );

$classes[] = 'service-section';
$classes[] = 'section';
$classes[] = 'text-align-left';

if ( ! $corporate_biz_title && ! $corporate_biz_subtitle && ! $corporate_biz_description ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="service-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
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

		<div class="section-content-wrapper service-content-wrapper layout-three">
			<?php get_template_part( 'template-parts/service/content-service' ); ?>
		</div><!-- .service-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #service-section -->
