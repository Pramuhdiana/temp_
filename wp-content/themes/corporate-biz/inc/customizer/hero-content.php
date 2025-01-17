<?php
/**
 * Hero Content Options
 *
 * @package Corporate_Biz
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function corporate_biz_hero_content_options( $wp_customize ) {
	$wp_customize->add_section( 'corporate_biz_hero_content_options', array(
			'title' => esc_html__( 'Hero Content', 'corporate-biz' ),
			'panel' => 'corporate_biz_theme_options',
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_hero_content_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'corporate_biz_sanitize_select',
			'choices'           => corporate_biz_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'corporate-biz' ),
			'section'           => 'corporate_biz_hero_content_options',
			'type'              => 'select',
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_hero_content_sub_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'corporate_biz_is_hero_content_active',
			'label'             => esc_html__( 'Tagline', 'corporate-biz' ),
			'section'           => 'corporate_biz_hero_content_options',
			'type'              => 'text',
		)
	);

	corporate_biz_register_option( $wp_customize, array(
	        'name'              => 'corporate_biz_hero_content_description',
	        'sanitize_callback' => 'wp_kses_post',
	        'active_callback'   => 'corporate_biz_is_hero_content_active',
	        'label'             => esc_html__( 'Description', 'corporate-biz' ),
	        'section'           => 'corporate_biz_hero_content_options',
	        'type'              => 'textarea',
	    )
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_hero_content',
			'default'           => '0',
			'sanitize_callback' => 'corporate_biz_sanitize_post',
			'active_callback'   => 'corporate_biz_is_hero_content_active',
			'label'             => esc_html__( 'Page', 'corporate-biz' ),
			'section'           => 'corporate_biz_hero_content_options',
			'type'              => 'dropdown-pages',
		)
	);
}
add_action( 'customize_register', 'corporate_biz_hero_content_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'corporate_biz_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since Corporate Biz Pro 1.0
	*/
	function corporate_biz_is_hero_content_active( $control ) {
		$enable = $control->manager->get_setting( 'corporate_biz_hero_content_visibility' )->value();

		return corporate_biz_check_section( $enable );
	}
endif;
