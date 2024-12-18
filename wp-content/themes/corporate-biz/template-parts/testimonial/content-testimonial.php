<?php
/**
 * The template used for displaying testimonial on front page
 *
 * @package Corporate_Biz
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<div class="entry-container">
			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div>

			<?php $position = get_post_meta( get_the_id(), 'ect_testimonial_position', true ); ?>
			
			<div class="author-thumb">
				<?php corporate_biz_post_thumbnail( 'corporate-biz-stats', 'html', true ); ?>
			
				<header class="entry-header">
					<?php the_title( '<h2 class="entry-title">', '</h2>' ); 
					
					if ( $position ) : ?>
						<div class="entry-meta"><span class="position">
							<?php echo esc_html( $position ); ?></span>
						</div>
					<?php endif; ?>
				</header>
			</div> <!-- .author-thumb -->
		</div><!-- .entry-container -->	
	</div><!-- .hentry-inner -->
</article>
