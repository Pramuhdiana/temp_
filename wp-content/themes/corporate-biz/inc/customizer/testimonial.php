<?php
/**
 * Add Testimonial Settings in Customizer
 *
 * @package Corporate_Biz
*/

/**
 * Add testimonial options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function corporate_biz_testimonial_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_jetpack_testimonial_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Corporate_Biz_Note_Control',
			'label'             => sprintf( esc_html__( 'For Testimonial Options for Corporate Bizazine Theme, go %1$shere%2$s', 'corporate-biz' ),
				'<a href="javascript:wp.customize.section( \'corporate_biz_testimonials\' ).focus();">',
				 '</a>'
			),
		   'section'            => 'jetpack_testimonials',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	$wp_customize->add_section( 'corporate_biz_testimonials', array(
			'panel'    => 'corporate_biz_theme_options',
			'title'    => esc_html__( 'Testimonials', 'corporate-biz' ),
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
	        'name'              => 'corporate_biz_testimonial_jetpack_note',
	        'sanitize_callback' => 'sanitize_text_field',
	        'custom_control'    => 'Corporate_Biz_Note_Control',
	        'active_callback'   => 'corporate_biz_is_ect_testimonial_inactive',
	        /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
	        'label'             => sprintf( esc_html__( 'For Testimonial, install %1$sEssential Content Types%2$s Plugin with testimonial Type Enabled', 'corporate-biz' ),
	            '<a target="_blank" href="' . esc_url( $install_url ) . '">',
	            '</a>'

	        ),
	       'section'            => 'corporate_biz_testimonials',
	        'type'              => 'description',
	        'priority'          => 1,
	    )
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_testimonial_option',
			'default'           => 'disabled',
			'active_callback'   => 'corporate_biz_is_ect_testimonial_active',
			'sanitize_callback' => 'corporate_biz_sanitize_select',
			'choices'           => corporate_biz_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'corporate-biz' ),
			'section'           => 'corporate_biz_testimonials',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_testimonial_transition_timeout',
			'default'           => 4,
			'sanitize_callback' => 'corporate_biz_sanitize_number_range',
			'active_callback'   => 'corporate_biz_is_testimonial_active',
			'input_attrs'       => array(
				'style'       => 'width: 100px;',
				'min'         => 0,
			),
			'label'             => esc_html__( 'Transition timeout', 'corporate-biz' ),
			'section'           => 'corporate_biz_testimonials',
			'type'              => 'number',
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_testimonial_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Corporate_Biz_Note_Control',
			'active_callback'   => 'corporate_biz_is_testimonial_active',
			/* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'corporate-biz' ),
				'<a href="javascript:wp.customize.section( \'jetpack_testimonials\' ).focus();">',
				'</a>'
			),
			'section'           => 'corporate_biz_testimonials',
			'type'              => 'description',
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_testimonial_sub_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'corporate_biz_is_testimonial_active',
			'label'             => esc_html__( 'Tagline', 'corporate-biz' ),
			'section'           => 'corporate_biz_testimonials',
			'type'              => 'text',
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_testimonial_number',
			'default'           => '3',
			'sanitize_callback' => 'corporate_biz_sanitize_number_range',
			'active_callback'   => 'corporate_biz_is_testimonial_active',
			'label'             => esc_html__( 'Number of items', 'corporate-biz' ),
			'section'           => 'corporate_biz_testimonials',
			'type'              => 'number',
			'input_attrs'       => array(
				'style'             => 'width: 100px;',
				'min'               => 0,
			),
		)
	);

	$number = get_theme_mod( 'corporate_biz_testimonial_number', 3 );

	for ( $i = 1; $i <= $number ; $i++ ) {
		//for CPT
		corporate_biz_register_option( $wp_customize, array(
				'name'              => 'corporate_biz_testimonial_cpt_' . $i,
				'sanitize_callback' => 'corporate_biz_sanitize_post',
				'active_callback'   => 'corporate_biz_is_testimonial_active',
				'label'             => esc_html__( 'Testimonial', 'corporate-biz' ) . ' ' . $i ,
				'section'           => 'corporate_biz_testimonials',
				'type'              => 'select',
				'choices'           => corporate_biz_generate_post_array( 'jetpack-testimonial' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'corporate_biz_testimonial_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'corporate_biz_is_testimonial_active' ) ) :
	/**
	* Return true if testimonial is active
	*
	* @since Corporate Biz 1.0
	*/
	function corporate_biz_is_testimonial_active( $control ) {
		$enable = $control->manager->get_setting( 'corporate_biz_testimonial_option' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( corporate_biz_is_ect_testimonial_active( $control ) &&  corporate_biz_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'corporate_biz_is_ect_testimonial_inactive' ) ) :
    /**
    *
    * @since Corporate Biz 1.0
    */
    function corporate_biz_is_ect_testimonial_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;

if ( ! function_exists( 'corporate_biz_is_ect_testimonial_active' ) ) :
    /**
    *
    * @since Corporate Biz 1.0
    */
    function corporate_biz_is_ect_testimonial_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;
