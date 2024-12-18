<?php
/**
 * Corporate Biz Pro functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Corporate_Biz
 */

if ( ! function_exists( 'corporate_biz_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function corporate_biz_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Corporate Biz Pro, use a find and replace
		 * to change 'corporate-biz' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'corporate-biz', get_parent_theme_file_path( '/languages' ) );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
		 *
		 * Google fonts url addition
		 *
		 * Font Awesome addition
		 */
		add_editor_style( array(
			'assets/css/editor-style.css',
			corporate_biz_fonts_url(),
			trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/css/font-awesome/css/font-awesome.css' )
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Used in Portfolio
		set_post_thumbnail_size( 666, 666, true ); // Ratio 1:1

		// Used in Archive: Excerpt image
		add_image_size( 'corporate-biz-archive', 1920, 9999, true ); // Flexible Height

		// Used in Archive: Excerpt image
		add_image_size( 'corporate-biz-content', 666, 488, true ); // 15:11

		// Used in featured slider
		add_image_size( 'corporate-biz-slider', 1920, 1080, true );

		// Used in testimonials
		add_image_size( 'corporate-biz-testimonial', 720, 720, true ); // Ratio 1:1

		// Used in team and service
		add_image_size( 'corporate-biz-team', 1160, 670, true ); // Ratio 16:10

		// Used in logo slider and Stats Section
		add_image_size( 'corporate-biz-logo-slider', 140, 80, true ); // Ratio 4:3

		// Used in Stats Section
		add_image_size( 'corporate-biz-stats', 80, 80, true ); // Ratio 1:1

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1'              => esc_html__( 'Primary', 'corporate-biz' ),
			'social-menu'         => esc_html__( 'Header Social Menu', 'corporate-biz' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		 * Add support for essential widget image.
		 *
		 */
		add_theme_support( 'ew-newsletter-image' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Small', 'corporate-biz' ),
					'shortName' => esc_html__( 'S', 'corporate-biz' ),
					'size'      => 13,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'corporate-biz' ),
					'shortName' => esc_html__( 'M', 'corporate-biz' ),
					'size'      => 18,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'corporate-biz' ),
					'shortName' => esc_html__( 'L', 'corporate-biz' ),
					'size'      => 42,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'corporate-biz' ),
					'shortName' => esc_html__( 'XL', 'corporate-biz' ),
					'size'      => 56,
					'slug'      => 'huge',
				),
			)
		);

		// Add support for custom color scheme.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'White', 'corporate-biz' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html__( 'Black', 'corporate-biz' ),
				'slug'  => 'black',
				'color' => '#000000',
			),
			array(
				'name'  => esc_html__( 'Eighty Black', 'corporate-biz' ),
				'slug'  => 'eighty-black',
				'color' => '#151515',
			),
			array(
				'name'  => esc_html__( 'Sixty Five Black', 'corporate-biz' ),
				'slug'  => 'sixty-five-black',
				'color' => '#151515',
			),
			array(
				'name'  => esc_html__( 'Gray', 'corporate-biz' ),
				'slug'  => 'gray',
				'color' => '#444444',
			),
			array(
				'name'  => esc_html__( 'Medium Gray', 'corporate-biz' ),
				'slug'  => 'medium-gray',
				'color' => '#7b7b7b',
			),
			array(
				'name'  => esc_html__( 'Light Gray', 'corporate-biz' ),
				'slug'  => 'light-gray',
				'color' => '#f8f8f8',
			),
			array(
				'name'  => esc_html__( 'Dark Yellow', 'corporate-biz' ),
				'slug'  => 'dark-yellow',
				'color' => '#ffa751',
			),
			array(
				'name'  => esc_html__( 'Yellow', 'corporate-biz' ),
				'slug'  => 'yellow',
				'color' => '#f9a926',
			),
		) );

		/**
		 * Adds support for Catch Breadcrumb.
		 */
		add_theme_support( 'catch-breadcrumb', array(
			'content_selector' => '.site-content .wrapper .content-area',
			'breadcrumb_dynamic' => 'before',
		) );
	}
endif;
add_action( 'after_setup_theme', 'corporate_biz_setup' );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 */
function corporate_biz_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-4' ) ) {
		$count++;
	}

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class ) {
		echo 'class="widget-area footer-widget-area ' . esc_attr( $class ) . '"';
	}
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function corporate_biz_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'corporate_biz_content_width', 920 );
}
add_action( 'after_setup_theme', 'corporate_biz_content_width', 0 );

if ( ! function_exists( 'corporate_biz_template_redirect' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet for different value other than the default one
	 *
	 * @global int $content_width
	 */
	function corporate_biz_template_redirect() {
		$layout = corporate_biz_get_theme_layout();

		if ( 'no-sidebar-full-width' === $layout ) {
			$GLOBALS['content_width'] = 1510;
		}
	}
endif;
add_action( 'template_redirect', 'corporate_biz_template_redirect' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function corporate_biz_widgets_init() {
	$args = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s"> <div class="widget-wrap">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Sidebar', 'corporate-biz' ),
		'id'          => 'sidebar-1',
		'description' => esc_html__( 'Add widgets here.', 'corporate-biz' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 1', 'corporate-biz' ),
		'id'          => 'sidebar-2',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'corporate-biz' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 2', 'corporate-biz' ),
		'id'          => 'sidebar-3',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'corporate-biz' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 3', 'corporate-biz' ),
		'id'          => 'sidebar-4',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'corporate-biz' ),
		) + $args
	);

	if ( class_exists( 'Catch_Instagram_Feed_Gallery_Widget' ) ||  class_exists( 'Catch_Instagram_Feed_Gallery_Widget_Pro' ) ) {
		register_sidebar( array(
			'name'        => esc_html__( 'Instagram', 'corporate-biz' ),
			'id'          => 'sidebar-instagram',
			'description' => esc_html__( 'Appears above footer. This sidebar is only for Widget from plugin Catch Instagram Feed Gallery Widget and Catch Instagram Feed Gallery Widget Pro', 'corporate-biz' ),
			) + $args
		);
	}
}
add_action( 'widgets_init', 'corporate_biz_widgets_init' );

if ( ! function_exists( 'corporate_biz_fonts_url' ) ) :
	/**
	 * Register Google fonts for Corporate Biz Pro
	 *
	 * Create your own corporate_biz_fonts_url() function to override in a child theme.
	 *
	 * @since Corporate Biz Pro 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function corporate_biz_fonts_url() {
		/* Translators: If there are characters in your language that are not
		* supported by Open Sans, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$open_sans = _x( 'on', 'Open Sans: on or off', 'corporate-biz' );

		if ( 'off' === $open_sans ) {
			return;
		}

		return 'https://fonts.googleapis.com/css?family=Open Sans:300,400,500,600,700,400italic,700italic';
	}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Corporate Biz Pro 1.0
 */
function corporate_biz_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'corporate_biz_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 */
function corporate_biz_scripts() {
	$min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	$path = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? 'assets/js/source/' : 'assets/js/';

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'corporate-biz-fonts', corporate_biz_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'corporate-biz-style', get_stylesheet_uri(), null, date( 'Ymd-Gis', filemtime( get_template_directory() . '/style.css' ) ) );

	// Theme block stylesheet.
	wp_enqueue_style( 'corporate-biz-block-style', get_theme_file_uri( '/assets/css/blocks.css' ), array( 'corporate-biz-style' ), date( 'Ymd-Gis', filemtime( get_template_directory() . '/assets/css/blocks.css' ) ) );

	// Load the html5 shiv.
	wp_enqueue_script( 'corporate-biz-html5',  get_theme_file_uri() . $path . 'html5' . $min . '.js', array(), '3.7.3' );

	wp_script_add_data( 'corporate-biz-html5', 'conditional', 'lt IE 9' );

	// Font Awesome
	wp_enqueue_style( 'fontawesome', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/css/font-awesome/css/all.min.css', array(), '5.14.0', 'all' );

	wp_enqueue_script( 'corporate-biz-skip-link-focus-fix', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'skip-link-focus-fix' . $min . '.js', array(), '201800703', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$deps[] = 'jquery';

	//Slider Scripts
	$enable_slider      = corporate_biz_check_section( get_theme_mod( 'corporate_biz_slider_option', 'disabled' ) );
	$enable_testimonial_slider      = corporate_biz_check_section( get_theme_mod( 'corporate_biz_testimonial_option', 'disabled' ) );

	if ( $enable_slider || $enable_testimonial_slider ) {
		// Enqueue owl carousel css. Must load CSS before JS.
		wp_enqueue_style( 'owl-carousel-core', get_theme_file_uri( 'assets/css/owl-carousel/owl.carousel.min.css' ), null, '2.3.4' );
		wp_enqueue_style( 'owl-carousel-default', get_theme_file_uri( 'assets/css/owl-carousel/owl.theme.default.min.css' ), null, '2.3.4' );

		// Enqueue script
		wp_enqueue_script( 'owl-carousel', get_theme_file_uri( $path . 'owl.carousel' . $min . '.js'), array( 'jquery' ), '2.3.4', true );

		$deps[] = 'owl-carousel';

	}

	$header_form = get_theme_mod( 'corporate_biz_header_media_form' );

	if ( $header_form ) {

		wp_enqueue_script( 'jquery-simplebar', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'simplebar' . $min . '.js', array( 'jquery' ), '4.0.0-alpha.5', true );

		wp_enqueue_style( 'jquery-simplebar', get_theme_file_uri( 'assets/css/simplebar.css' ), null );
	}

	// Add masonry to dependent scripts of main script.
	$deps[] = 'jquery-masonry';
	
	wp_enqueue_script( 'corporate-biz-script', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'functions' . $min . '.js', $deps, date( 'Ymd-Gis', filemtime( get_template_directory() . '/' . $path . 'functions' . $min . '.js' ) ), true );

	wp_localize_script( 'corporate-biz-script', 'corporateBizOptions', array(
		'screenReaderText' => array(
			'expand'   => esc_html__( 'expand child menu', 'corporate-biz' ),
			'collapse' => esc_html__( 'collapse child menu', 'corporate-biz' ),
		),
		'rtl' => is_rtl(),
	) );

	// Remove Media CSS, we have ouw own CSS for this.
	wp_deregister_style('wp-mediaelement');
}
add_action( 'wp_enqueue_scripts', 'corporate_biz_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 */
function corporate_biz_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'corporate-biz-block-editor-style', get_theme_file_uri( 'assets/css/editor-blocks.css' ) );

	// Add custom fonts.
	wp_enqueue_style( 'corporate-biz-fonts', corporate_biz_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'corporate_biz_block_editor_styles' );

if ( ! function_exists( 'corporate_biz_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since Corporate Biz Pro 1.0
	 */
	function corporate_biz_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		// Getting data from Customizer Options
		$length	= get_theme_mod( 'corporate_biz_excerpt_length', 20 );

		return absint( $length );
	}
endif; //corporate_biz_excerpt_length
add_filter( 'excerpt_length', 'corporate_biz_excerpt_length', 999 );

if ( ! function_exists( 'corporate_biz_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a option from customizer
	 *
	 * @return string option from customizer prepended with an ellipsis.
	 */
	function corporate_biz_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		$more_tag_text = get_theme_mod( 'corporate_biz_excerpt_more_text',  esc_html__( 'Continue reading', 'corporate-biz' ) );

		$link = sprintf( '<p><a href="%1$s" class="more-link">%2$s</a></p>',
			esc_url( get_permalink() ),
			/* translators: %s: Name of current post */
			wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
			);

		return $link;
	}
endif;
add_filter( 'excerpt_more', 'corporate_biz_excerpt_more' );

if ( ! function_exists( 'corporate_biz_custom_excerpt' ) ) :
	/**
	 * Adds Continue reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 *
	 * @since Corporate Biz Pro 1.0
	 */
	function corporate_biz_custom_excerpt( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$more_tag_text = get_theme_mod( 'corporate_biz_excerpt_more_text', esc_html__( 'Continue reading', 'corporate-biz' ) );

			$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
				esc_url( get_permalink() ),
				/* translators: %s: Name of current post */
				wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
			);

			$output = $link;
		}

		return $output;
	}
endif; //corporate_biz_custom_excerpt
add_filter( 'get_the_excerpt', 'corporate_biz_custom_excerpt' );

if ( ! function_exists( 'corporate_biz_more_link' ) ) :
	/**
	 * Replacing Continue reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 *
	 * @since Corporate Biz Pro 1.0
	 */
	function corporate_biz_more_link( $more_link, $more_link_text ) {
		$more_tag_text = get_theme_mod( 'corporate_biz_excerpt_more_text', esc_html__( 'Continue reading', 'corporate-biz' ) );

		return ' &hellip; ' . str_replace( $more_link_text, wp_kses_data( $more_tag_text ), $more_link );
	}
endif; //corporate_biz_more_link
add_filter( 'the_content_more_link', 'corporate_biz_more_link', 10, 2 );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function corporate_biz_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// Catch Web Tools.
		array(
			'name' => 'Catch Web Tools', // Plugin Name, translation not required.
			'slug' => 'catch-web-tools',
		),
		// Catch IDs
		array(
			'name' => 'Catch IDs', // Plugin Name, translation not required.
			'slug' => 'catch-ids',
		),
		// To Top.
		array(
			'name' => 'To top', // Plugin Name, translation not required.
			'slug' => 'to-top',
		),
		// Catch Gallery.
		array(
			'name' => 'Catch Gallery', // Plugin Name, translation not required.
			'slug' => 'catch-gallery',
		),
	);

	if ( ! class_exists( 'Catch_Infinite_Scroll_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Catch Infinite Scroll', // Plugin Name, translation not required.
			'slug' => 'catch-infinite-scroll',
		);
	}

	if ( ! class_exists( 'Essential_Content_Types_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Essential Content Types', // Plugin Name, translation not required.
			'slug' => 'essential-content-types',
		);
	}

	if ( ! class_exists( 'Essential_Widgets_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Essential Widgets', // Plugin Name, translation not required.
			'slug' => 'essential-widgets',
		);
	}

	if ( ! class_exists( 'Catch_Instagram_Feed_Gallery_Widget_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Catch Instagram Feed Gallery & Widget', // Plugin Name, translation not required.
			'slug' => 'catch-instagram-feed-gallery-widget',
		);
	}

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'corporate-biz',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'corporate_biz_register_required_plugins' );

/**
 * Checks if there are options already present from free version and adds it to the Pro theme options
 *
 * @since Corporate Biz Pro 1.0
 * @hook after_theme_switch
 */
function corporate_biz_setup_options( $old_theme_name ) {
	if ( $old_theme_name ) {
		$old_theme_slug = sanitize_title( $old_theme_name );
		$free_version_slug = array(
			'corporate_biz',
		);

		$pro_version_slug  = 'corporate-biz';

		$free_options = get_option( 'theme_mods_' . $old_theme_slug );

		// Perform action only if theme_mods_corporate_biz free version exists.
		if ( in_array( $old_theme_slug, $free_version_slug ) && $free_options && '1' !== get_theme_mod( 'free_pro_migration' ) ) {
			$new_options = wp_parse_args( get_theme_mods(), $free_options );

			if ( update_option( 'theme_mods_' . $pro_version_slug, $free_options ) ) {
				// Set Migration Parameter to true so that this script does not run multiple times.
				set_theme_mod( 'free_pro_migration', '1' );
			}
		}
	}
}
add_action( 'after_switch_theme', 'corporate_biz_setup_options' );

/**
 * Implement the Custom Header feature
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Functions which enhance the theme by hooking into WordPress
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions
 */
require get_parent_theme_file_path( '/inc/customizer/customizer.php' );

/**
 * Color Scheme additions
 */
require get_parent_theme_file_path( '/inc/header-background-color.php' );

/**
 * Load Jetpack compatibility file
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_parent_theme_file_path( '/inc/jetpack.php' );
}

/**
 * Load Social Widgets
 */
require get_parent_theme_file_path( '/inc/widget-social-icons.php' );

/**
 * Load TGMPA
 */
require get_parent_theme_file_path( '/inc/class-tgm-plugin-activation.php' );

/**
 * Load Theme About Page
 */
require get_parent_theme_file_path( '/inc/about.php' );
