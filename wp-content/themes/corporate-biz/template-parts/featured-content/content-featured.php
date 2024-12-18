<?php
/**
 * The template for displaying featured posts on the front page
 *
 * @package Corporate_Biz
 */
$number        = get_theme_mod( 'corporate_biz_featured_content_number', 3 );
$post_list     = array();
$no_of_post    = 0;

$args = array(
	'post_type'           => 'post',
	'ignore_sticky_posts' => 1, // ignore sticky posts.
);

// Get valid number of posts.
$args['post_type'] = 'featured-content';

for ( $i = 1; $i <= $number; $i++ ) {
	$corporate_biz_post_id = '';

	$corporate_biz_post_id = get_theme_mod( 'corporate_biz_featured_content_cpt_' . $i );
	
	if ( $corporate_biz_post_id && '' !== $corporate_biz_post_id ) {
		$post_list = array_merge( $post_list, array( $corporate_biz_post_id ) );

		$no_of_post++;
	}
}

$args['post__in'] = $post_list;
$args['orderby']  = 'post__in';

if ( ! $no_of_post ) {
	return;
}

$args['posts_per_page'] = $no_of_post;

$loop = new WP_Query( $args );

while ( $loop->have_posts() ) :
	
	$loop->the_post();

	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="hentry-inner">
			<?php corporate_biz_post_thumbnail( 'corporate-biz-content' ); ?>

			<div class="entry-container">
				<header class="entry-header">
					<?php if ( 'post' === get_post_type() || 'featured-content' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php corporate_biz_by_line(); ?>

						<?php corporate_biz_cat_list(); ?>
					</div><!-- .entry-meta -->
					<?php endif; ?>
					
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>
				</header>

				<div class="entry-summary"><?php the_excerpt(); ?></div><!-- .entry-summary -->
				?>
			</div><!-- .entry-container -->
		</div><!-- .hentry-inner -->
	</article>
<?php
endwhile;

wp_reset_postdata();
