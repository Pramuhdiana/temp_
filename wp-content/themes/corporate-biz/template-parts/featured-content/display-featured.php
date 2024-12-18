<?php
/**
 * The template for displaying featured content
 *
 * @package Corporate_Biz
 */
?>

<?php
$enable_content = get_theme_mod( 'corporate_biz_featured_content_option', 'disabled' );

if ( ! corporate_biz_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$corporate_biz_title       = get_option( 'featured_content_title', esc_html__( 'Contents', 'corporate-biz' ) );
$corporate_biz_description = get_option( 'featured_content_content' );

$corporate_biz_subtitle = get_theme_mod( 'corporate_biz_featured_content_sub_title' ); 

$classes[] = 'layout-three';
$classes[] = 'featured-content';
$classes[] = 'section';

if ( ! $corporate_biz_title && ! $corporate_biz_subtitle && ! $corporate_biz_description ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="featured-content-section" class="featured-content-section <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
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

		<div class="section-content-wrapper featured-content-wrapper layout-three">
			<?php
				get_template_part( 'template-parts/featured-content/content-featured' );
			?>
		</div><!-- .section-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- #featured-content-section -->
