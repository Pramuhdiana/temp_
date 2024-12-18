<?php
/**
 * The template used for displaying hero content
 *
 * @package Corporate_Biz
 */

$enable_section = get_theme_mod( 'corporate_biz_hero_content_visibility', 'disabled' );

if ( ! corporate_biz_check_section( $enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}

get_template_part( 'template-parts/hero-content/post-type-hero' );
