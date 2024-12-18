<?php
/**
 * The template for displaying testimonial items
 *
 * @package Corporate_Biz
 */

$enable            = get_theme_mod( 'corporate_biz_testimonial_option', 'disabled' );
$corporate_biz_subtitle = get_theme_mod( 'corporate_biz_testimonial_sub_title' );

if ( ! corporate_biz_check_section( $enable ) ) {
	// Bail if featured content is disabled
	return;
}

// Get Jetpack options for testimonial.
$jetpack_defaults = array(
	'page-title' => esc_html__( 'Testimonials', 'corporate-biz' ),
);

// Get Jetpack options for testimonial.
$jetpack_options = get_theme_mod( 'jetpack_testimonials', $jetpack_defaults );

$corporate_biz_title       = isset( $jetpack_options['page-title'] ) ? $jetpack_options['page-title'] : esc_html__( 'Testimonials', 'corporate-biz' );
$corporate_biz_description = isset( $jetpack_options['page-content'] ) ? $jetpack_options['page-content'] : '';

$classes[] = 'section testimonial-content-section';

if ( ! $corporate_biz_subtitle && ! $corporate_biz_title && ! $corporate_biz_description ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="testimonial-content-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<div class="full-content-wrap full-width">

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

			<?php 
			
			$content_classes = 'section-content-wrapper testimonial-content-wrapper';

			$content_classes .= ' testimonial-slider owl-carousel';

			$content_classes .= ' owl-dots-enabled';
			?>

			<div class="<?php echo esc_attr( $content_classes ); ?>">
				<?php get_template_part( 'template-parts/testimonial/post-types-testimonial' ); ?>
			</div><!-- .section-content-wrapper -->
		</div><!-- .full-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- .testimonial-content-section -->
