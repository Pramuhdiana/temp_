<?php
/**
 * Services options
 *
 * @package Corporate_Biz
 */

/**
 * Add service content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function corporate_biz_service_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
    corporate_biz_register_option( $wp_customize, array(
            'name'              => 'corporate_biz_service_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Corporate_Biz_Note_Control',
            'label'             => sprintf( esc_html__( 'For all Services Options, go %1$shere%2$s', 'corporate-biz' ),
                '<a href="javascript:wp.customize.section( \'corporate_biz_service\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'corporate_biz_service', array(
			'title' => esc_html__( 'Services', 'corporate-biz' ),
			'panel' => 'corporate_biz_theme_options',
		)
	);

	$action = 'install-plugin';
    $slug   = 'essential-content-types';

    $install_url = wp_nonce_url(
        add_query_arg(
            array(
                'action' => $action,
                'plugin' => $slug
            ),
            admin_url( 'update.php' )
        ),
        $action . '_' . $slug
    );

    corporate_biz_register_option( $wp_customize, array(
            'name'              => 'corporate_biz_service_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Corporate_Biz_Note_Control',
            'active_callback'   => 'corporate_biz_is_ect_services_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Services, install %1$sEssential Content Types%2$s Plugin with Service Type Enabled', 'corporate-biz' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'corporate_biz_service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	// Add color scheme setting and control.
	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_service_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'corporate_biz_sanitize_select',
			'active_callback'   => 'corporate_biz_is_ect_services_active',
			'choices'           => corporate_biz_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'corporate-biz' ),
			'section'           => 'corporate_biz_service',
			'type'              => 'select',
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_service_sub_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'corporate_biz_is_service_active',
			'label'             => esc_html__( 'Tagline', 'corporate-biz' ),
			'section'           => 'corporate_biz_service',
			'type'              => 'text',
		)
	);

    corporate_biz_register_option( $wp_customize, array(
            'name'              => 'corporate_biz_service_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Corporate_Biz_Note_Control',
            'active_callback'   => 'corporate_biz_is_service_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'corporate-biz' ),
                 '<a href="javascript:wp.customize.control( \'ect_service_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'corporate_biz_service',
            'type'              => 'description',
        )
    );

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_service_number',
			'default'           => 6,
			'sanitize_callback' => 'corporate_biz_sanitize_number_range',
			'active_callback'   => 'corporate_biz_is_service_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Services is changed (Max no of Services is 20)', 'corporate-biz' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of items', 'corporate-biz' ),
			'section'           => 'corporate_biz_service',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'corporate_biz_service_number', 6 );

	//loop for service post content
	for ( $i = 1; $i <= $number ; $i++ ) {

		corporate_biz_register_option( $wp_customize, array(
				'name'              => 'corporate_biz_service_cpt_' . $i,
				'sanitize_callback' => 'corporate_biz_sanitize_post',
				'active_callback'   => 'corporate_biz_is_service_active',
				'label'             => esc_html__( 'Services', 'corporate-biz' ) . ' ' . $i ,
				'section'           => 'corporate_biz_service',
				'type'              => 'select',
                'choices'           => corporate_biz_generate_post_array( 'ect-service' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'corporate_biz_service_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'corporate_biz_is_service_active' ) ) :
	/**
	* Return true if service content is active
	*
	* @since Corporate Biz Pro 1.0
	*/
	function corporate_biz_is_service_active( $control ) {
		$enable = $control->manager->get_setting( 'corporate_biz_service_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( corporate_biz_is_ect_services_active( $control ) &&  corporate_biz_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'corporate_biz_is_ect_services_inactive' ) ) :
    /**
    * Return true if service is active
    *
    * @since Corporate Biz 1.0
    */
    function corporate_biz_is_ect_services_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;

if ( ! function_exists( 'corporate_biz_is_ect_services_active' ) ) :
    /**
    * Return true if service is active
    *
    * @since Corporate Biz 1.0
    */
    function corporate_biz_is_ect_services_active( $control ) {
        return ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;
