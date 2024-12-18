<?php
/**
 * The template used for displaying hero content
 *
 * @package Corporate_Biz
 */

$corporate_biz_id = get_theme_mod( 'corporate_biz_hero_content' );
$args['page_id'] = absint( $corporate_biz_id );

$args['posts_per_page'] = 1;

// If $args is empty return false
if ( empty( $args ) ) {
	return;
}

// Create a new WP_Query using the argument previously created
$hero_query = new WP_Query( $args );
if ( $hero_query->have_posts() ) :
	while ( $hero_query->have_posts() ) :
		$hero_query->the_post();
		?>
		<div id="hero-section" class="hero-section section content-align-right text-align-left">
			<div class="wrapper">
				<div class="section-content-wrapper hero-content-wrapper">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="hentry-inner">
							<?php $post_thumbnail = corporate_biz_post_thumbnail( 'post-thumbnail', 'html-with-bg', false ); 

						if ( $post_thumbnail ) :
							echo $post_thumbnail;
							?>
							<div class="entry-container">
						<?php else : ?>
							<div class="entry-container full-width">
						<?php endif; ?>
							<?php
							$corporate_biz_subtitle = get_theme_mod( 'corporate_biz_hero_content_sub_title' );
							$corporate_biz_description = get_theme_mod( 'corporate_biz_hero_content_description' ); 

							if( $corporate_biz_subtitle ) : ?>
								<div class="section-subtitle">
									<?php echo esc_html( $corporate_biz_subtitle ); ?>
								</div>
							<?php endif; ?>

							<header class="entry-header">
								<h2 class="section-title">
									<?php the_title(); ?>
								</h2>
							</header><!-- .entry-header -->

							<?php if ( $corporate_biz_description ) : ?>
								<div class="section-description">
									<p>
										<?php
										echo wp_kses_post( $corporate_biz_description );
										?>
									</p>
								</div><!-- .section-description-wrapper -->
							<?php endif; ?>

							<div class="entry-content">
								<?php
									the_content();
									
									wp_link_pages( array(
										'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'corporate-biz' ) . '</span>',
										'after'       => '</div>',
										'link_before' => '<span class="page-number">',
										'link_after'  => '</span>',
										'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'corporate-biz' ) . ' </span>%',
										'separator'   => '<span class="screen-reader-text">, </span>',
									) );
								?>
							</div><!-- .entry-content -->

							<?php if ( get_edit_post_link() ) : ?>
								<footer class="entry-footer">
									<div class="entry-meta">
										<?php
											edit_post_link(
												sprintf(
													/* translators: %s: Name of current post */
													esc_html__( 'Edit %s', 'corporate-biz' ),
													the_title( '<span class="screen-reader-text">"', '"</span>', false )
												),
												'<span class="edit-link">',
												'</span>'
											);
										?>
									</div>	<!-- .entry-meta -->
								</footer><!-- .entry-footer -->
							<?php endif; ?>
						</div><!-- .hentry-inner -->
					</article>
				</div><!-- .section-content-wrapper -->
			</div><!-- .wrapper -->
		</div><!-- .section -->
	<?php
	endwhile;

	wp_reset_postdata();
endif;
