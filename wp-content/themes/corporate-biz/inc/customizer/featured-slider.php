<?php
/**
 * Featured Slider Options
 *
 * @package Corporate_Biz
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function corporate_biz_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'corporate_biz_featured_slider', array(
			'panel' => 'corporate_biz_theme_options',
			'title' => esc_html__( 'Featured Slider', 'corporate-biz' ),
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'corporate_biz_sanitize_select',
			'choices'           => corporate_biz_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'corporate-biz' ),
			'section'           => 'corporate_biz_featured_slider',
			'type'              => 'select',
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_slider_number',
			'default'           => '4',
			'sanitize_callback' => 'corporate_biz_sanitize_number_range',

			'active_callback'   => 'corporate_biz_is_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'corporate-biz' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of Slides', 'corporate-biz' ),
			'section'           => 'corporate_biz_featured_slider',
			'type'              => 'number',
		)
	);

	$slider_number = get_theme_mod( 'corporate_biz_slider_number', 4 );

	for ( $i = 1; $i <= $slider_number ; $i++ ) {
		// Page Sliders
		corporate_biz_register_option( $wp_customize, array(
				'name'              => 'corporate_biz_slider_page_' . $i,
				'sanitize_callback' => 'corporate_biz_sanitize_post',
				'active_callback'   => 'corporate_biz_is_slider_active',
				'label'             => esc_html__( 'Page', 'corporate-biz' ) . ' # ' . $i,
				'section'           => 'corporate_biz_featured_slider',
				'type'              => 'dropdown-pages',
			)
		);

	} // End for().
}
add_action( 'customize_register', 'corporate_biz_slider_options' );

/** Active Callback Functions */

if ( ! function_exists( 'corporate_biz_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since Corporate Biz Pro 1.0
	*/
	function corporate_biz_is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'corporate_biz_slider_option' )->value();

		//return true only if previwed page on customizer matches the type option selected
		return corporate_biz_check_section( $enable );
	}
endif;
