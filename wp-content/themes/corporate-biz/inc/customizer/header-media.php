<?php
/**
 * Header Media Options
 *
 * @package Corporate_Biz
 */

/**
 * Add Header Media options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function corporate_biz_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'corporate-biz' );

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_header_media_option',
			'default'           => 'homepage',
			'sanitize_callback' => 'corporate_biz_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'corporate-biz' ),
				'entire-site'            => esc_html__( 'Entire Site', 'corporate-biz' ),
				'disable'                => esc_html__( 'Disabled', 'corporate-biz' ),
			),
			'label'             => esc_html__( 'Enable on', 'corporate-biz' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	/*Overlay Option for Header Media*/
	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_header_media_image_opacity',
			'default'           => '0',
			'sanitize_callback' => 'corporate_biz_sanitize_number_range',
			'label'             => esc_html__( 'Header Media Overlay', 'corporate-biz' ),
			'section'           => 'header_image',
			'type'              => 'number',
			'input_attrs'       => array(
				'style' => 'width: 60px;',
				'min'   => 0,
				'max'   => 100,
			),
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_header_media_logo',
			'sanitize_callback' => 'esc_url_raw',
			'custom_control'    => 'WP_Customize_Image_Control',
			'label'             => esc_html__( 'Header Media Logo', 'corporate-biz' ),
			'section'           => 'header_image',
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_header_media_logo_option',
			'default'           => 'homepage',
			'sanitize_callback' => 'corporate_biz_sanitize_select',
			'active_callback'   => 'corporate_biz_is_header_media_logo_active',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'corporate-biz' ),
				'entire-site'            => esc_html__( 'Entire Site', 'corporate-biz' ) ),
			'label'             => esc_html__( 'Enable Header Media logo on', 'corporate-biz' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_header_media_title',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Title', 'corporate-biz' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Site Header Text', 'corporate-biz' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_header_media_form',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Contact Form', 'corporate-biz' ),
			'desciption'        => esc_html__( 'Add shortcode for contact fomr here. You can also use this space to add some informative text.', 'corporate-biz' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_header_media_url',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'corporate-biz' ),
			'section'           => 'header_image',
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_header_media_url_text',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'corporate-biz' ),
			'section'           => 'header_image',
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_header_url_target',
			'sanitize_callback' => 'corporate_biz_sanitize_checkbox',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'corporate-biz' ),
			'section'           => 'header_image',
			'custom_control'    => 'Corporate_Biz_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'corporate_biz_header_media_options' );

/** Active Callback Functions */

if ( ! function_exists( 'corporate_biz_is_header_media_logo_active' ) ) :
	/**
	* Return true if header logo is active
	*
	* @since Corporate Biz Pro 1.0
	*/
	function corporate_biz_is_header_media_logo_active( $control ) {
		$logo = $control->manager->get_setting( 'corporate_biz_header_media_logo' )->value();
		if ( '' != $logo ) {
			return true;
		} else {
			return false;
		}
	}
endif;
