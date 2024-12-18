<?php
/**
 * The template used for displaying projects on index view
 *
 * @package Corporate_Biz
 */

$layout       = get_theme_mod( 'corporate_biz_portfolio_content_layout', 'layout-three' );

global $post;

$categories_list = get_the_category();

$classes = 'grid-item';
foreach ( $categories_list as $corporate_biz_cat ) {
	$classes .= ' ' . $corporate_biz_cat->slug ;
}
?>

<article id="portfolio-post-<?php the_ID(); ?>" <?php post_class( esc_attr( $classes ) ); ?>>
	<div class="hentry-inner">
		<?php corporate_biz_post_thumbnail( 'corporate-biz-archive', 'html', true, true ); ?>
		
		<div class="entry-container caption">
			<div class="entry-container-inner-wrap">
				<header class="entry-header">
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

					<div class="entry-meta">
						<?php corporate_biz_posted_on(); ?>
					</div>
				</header>
			</div><!-- .entry-container-inner-wrap -->	
		</div><!-- .entry-container -->
	</div><!-- .hentry-inner -->
</article>
