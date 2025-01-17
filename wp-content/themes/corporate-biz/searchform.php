<?php
/**
 * Template for displaying search forms in Corporate Biz
 *
* @package Corporate_Biz
 */
?>

<?php
$unique_id   = esc_attr( uniqid( 'search-form-' ) );
$search_text = get_theme_mod( 'corporate_biz_search_text', esc_html__( 'Search', 'corporate-biz' ) );
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo $unique_id; ?>">
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'corporate-biz' ); ?></span>
		<input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr( $search_text ); ?>" value="<?php the_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'corporate-biz' ); ?></span></button>
</form>
