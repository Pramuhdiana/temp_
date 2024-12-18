<?php
/**
 * Display Header Media
 *
 * @package Corporate_Biz
 */
?>

<?php
	$header_image = corporate_biz_featured_overall_image();

	if ( 'disable' === $header_image ) {
		// Bail if all header media are disabled.
		return;
	}
?>
<div class="custom-header header-media">
	<div class="wrapper">
		<?php if ( ( is_header_video_active() && has_header_video() ) || 'disable' !== $header_image ) : ?>
		<div class="custom-header-media">
			<?php
			if ( is_header_video_active() && has_header_video() ) {
				the_custom_header_markup();
			} elseif ( $header_image ) {
				echo '<div id="wp-custom-header" class="wp-custom-header"><img src="' . esc_url( $header_image ) . '"/></div>	';
			}
			?>

			<?php corporate_biz_header_media_text(); ?>

			<?php 
			$corporate_biz_header_form = get_theme_mod( 'corporate_biz_header_media_form' );
			if ( is_front_page() && $corporate_biz_header_form ) : ?>
			<div class="custom-header-form" data-simplebar>
				<?php echo do_shortcode( wp_kses_post( $corporate_biz_header_form ) ); ?>
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div><!-- .wrapper -->
	<div class="custom-header-overlay"></div><!-- .custom-header-overlay -->
</div><!-- .custom-header -->
