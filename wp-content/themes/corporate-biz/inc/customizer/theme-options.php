<?php
/**
 * Theme Options
 *
 * @package Corporate_Biz
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function corporate_biz_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'corporate_biz_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'corporate-biz' ),
		'priority' => 130,
	) );

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_latest_posts_title',
			'default'           => esc_html__( 'News', 'corporate-biz' ),
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Latest Posts Title', 'corporate-biz' ),
			'section'           => 'corporate_biz_theme_options',
		)
	);

	// Layout Options
	$wp_customize->add_section( 'corporate_biz_layout_options', array(
		'title' => esc_html__( 'Layout Options', 'corporate-biz' ),
		'panel' => 'corporate_biz_theme_options',
		)
	);

	/* Default Layout */
	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_default_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'corporate_biz_sanitize_select',
			'label'             => esc_html__( 'Default Layout', 'corporate-biz' ),
			'section'           => 'corporate_biz_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'corporate-biz' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'corporate-biz' ),
			),
		)
	);

	/* Homepage/Archive Layout */
	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_homepage_archive_layout',
			'default'           => 'no-sidebar-full-width',
			'sanitize_callback' => 'corporate_biz_sanitize_select',
			'label'             => esc_html__( 'Homepage/Archive Layout', 'corporate-biz' ),
			'section'           => 'corporate_biz_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'corporate-biz' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'corporate-biz' ),
			),
		)
	);

	/* Single Page/Post Image */
	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_single_layout',
			'default'           => 'disabled',
			'sanitize_callback' => 'corporate_biz_sanitize_select',
			'label'             => esc_html__( 'Single Page/Post Image', 'corporate-biz' ),
			'section'           => 'corporate_biz_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'disabled'              => esc_html__( 'Disabled', 'corporate-biz' ),
				'post-thumbnail'        => esc_html__( 'Post Thumbnail', 'corporate-biz' ),
			),
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'corporate_biz_excerpt_options', array(
		'panel'     => 'corporate_biz_theme_options',
		'title'     => esc_html__( 'Excerpt Options', 'corporate-biz' ),
	) );

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_excerpt_length',
			'default'           => '20',
			'sanitize_callback' => 'absint',
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 200,
				'step'  => 5,
				'style' => 'width: 60px;',
			),
			'label'    => esc_html__( 'Excerpt Length (words)', 'corporate-biz' ),
			'section'  => 'corporate_biz_excerpt_options',
			'type'     => 'number',
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_excerpt_more_text',
			'default'           => esc_html__( 'Continue reading...', 'corporate-biz' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Read More Text', 'corporate-biz' ),
			'section'           => 'corporate_biz_excerpt_options',
			'type'              => 'text',
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'corporate_biz_search_options', array(
		'panel'     => 'corporate_biz_theme_options',
		'title'     => esc_html__( 'Search Options', 'corporate-biz' ),
	) );

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_search_text',
			'default'           => esc_html__( 'Search', 'corporate-biz' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Search Text', 'corporate-biz' ),
			'section'           => 'corporate_biz_search_options',
			'type'              => 'text',
		)
	);

	// Homepage / Frontpage Options.
	$wp_customize->add_section( 'corporate_biz_homepage_options', array(
		'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'corporate-biz' ),
		'panel'       => 'corporate_biz_theme_options',
		'title'       => esc_html__( 'Homepage / Frontpage Options', 'corporate-biz' ),
	) );

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_recent_posts_tagline',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Tagline', 'corporate-biz' ),
			'section'           => 'corporate_biz_homepage_options',
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_recent_posts_heading',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'News', 'corporate-biz' ),
			'label'             => esc_html__( 'Recent Posts Heading', 'corporate-biz' ),
			'section'           => 'corporate_biz_homepage_options',
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_static_page_heading',
			'sanitize_callback' => 'sanitize_text_field',
			//'active_callback'	=> 'corporate_biz_is_static_page_enabled',
			'default'           => esc_html__( 'Archives', 'corporate-biz' ),
			'label'             => esc_html__( 'Posts Page Header Text', 'corporate-biz' ),
			'section'           => 'corporate_biz_homepage_options',
		)
	);

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_front_page_category',
			'sanitize_callback' => 'corporate_biz_sanitize_category_list',
			'custom_control'    => 'Corporate_Biz_Multi_Cat',
			//'active_callback'   => 'corporate_biz_is_homepage_posts_enabled',
			'label'             => esc_html__( 'Categories', 'corporate-biz' ),
			'section'           => 'corporate_biz_homepage_options',
			'type'              => 'dropdown-categories',
		)
	);

	// Pagination Options.
	$pagination_type = get_theme_mod( 'corporate_biz_pagination_type', 'default' );

	$nav_desc = '';

	/**
	* Check if navigation type is Jetpack Infinite Scroll and if it is enabled
	*/
	$nav_desc = sprintf(
		wp_kses(
			__( 'For infinite scrolling, use %1$sCatch Infinite Scroll Plugin%2$s with Infinite Scroll module Enabled.', 'corporate-biz' ),
			array(
				'a' => array(
					'href' => array(),
					'target' => array(),
				),
				'br'=> array()
			)
		),
		'<a target="_blank" href="https://wordpress.org/plugins/catch-infinite-scroll/">',
		'</a>'
	);

	$wp_customize->add_section( 'corporate_biz_pagination_options', array(
		'description'     => $nav_desc,
		'panel'           => 'corporate_biz_theme_options',
		'title'           => esc_html__( 'Pagination Options', 'corporate-biz' ),
		'active_callback' => 'corporate_biz_scroll_plugins_inactive'
	) );

	corporate_biz_register_option( $wp_customize, array(
			'name'              => 'corporate_biz_pagination_type',
			'default'           => 'default',
			'sanitize_callback' => 'corporate_biz_sanitize_select',
			'choices'           => corporate_biz_get_pagination_types(),
			'label'             => esc_html__( 'Pagination type', 'corporate-biz' ),
			'section'           => 'corporate_biz_pagination_options',
			'type'              => 'select',
		)
	);

	/* Scrollup Options */
	$wp_customize->add_section( 'corporate_biz_scrollup', array(
		'panel'    => 'corporate_biz_theme_options',
		'title'    => esc_html__( 'Scrollup Options', 'corporate-biz' ),
	) );

	$action = 'install-plugin';
	$slug   = 'to-top';

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

	// Add note to Scroll up Section
    corporate_biz_register_option( $wp_customize, array(
            'name'              => 'corporate_biz_to_top_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Corporate_Biz_Note_Control',
            'active_callback'   => 'corporate_biz_is_to_top_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Scroll Up, install %1$sTo Top%2$s Plugin', 'corporate-biz' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'corporate_biz_scrollup',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    corporate_biz_register_option( $wp_customize, array(
            'name'              => 'corporate_biz_to_top_option_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Corporate_Biz_Note_Control',
            'active_callback'   => 'corporate_biz_is_to_top_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For Scroll Up Options, go %1$shere%2$s', 'corporate-biz'  ),
                 '<a href="javascript:wp.customize.panel( \'to_top_panel\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'corporate_biz_scrollup',
            'type'              => 'description',
        )
    );

}
add_action( 'customize_register', 'corporate_biz_theme_options' );

/** Active Callback Functions */

if ( ! function_exists( 'corporate_biz_is_homepage_posts_enabled' ) ) :
	/**
	* Return true if hommepage posts/content is enabled
	*
	* @since Corporate Biz Pro 1.0
	*/
	function corporate_biz_is_homepage_posts_enabled( $control ) {
		return ( $control->manager->get_setting( 'corporate_biz_display_homepage_posts' )->value() );
	}
endif;

if ( ! function_exists( 'corporate_biz_scroll_plugins_inactive' ) ) :
	/**
	* Return true if infinite scroll functionality exists
	*
	* @since Corporate Biz Pro 1.0
	*/
	function corporate_biz_scroll_plugins_inactive( $control ) {
		if ( ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) || class_exists( 'Catch_Infinite_Scroll' ) ) {
			// Support infinite scroll plugins.
			return false;
		}

		return true;
	}
endif;

if ( ! function_exists( 'corporate_biz_is_static_page_enabled' ) ) :
	/**
	* Return true if A Static Page is enabled
	*
	* @since Corporate Biz Pro 1.1.2
	*/
	function corporate_biz_is_static_page_enabled( $control ) {
		$enable = $control->manager->get_setting( 'show_on_front' )->value();
		if ( 'page' === $enable ) {
			return true;
		}
		return false;
	}
endif;

if ( ! function_exists( 'corporate_biz_is_to_top_inactive' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Simclick 0.1
    */
    function corporate_biz_is_to_top_inactive( $control ) {
        return ! ( class_exists( 'To_Top' ) );
    }
endif;

if ( ! function_exists( 'corporate_biz_is_to_top_active' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Simclick 0.1
    */
    function corporate_biz_is_to_top_active( $control ) {
        return ( class_exists( 'To_Top' ) );
    }
endif;
