<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Corporate_Biz
 */

?>
		</div><!-- .wrapper -->
	</div><!-- #content -->

	<?php get_template_part( 'template-parts/footer/footer', 'instagram' ); ?>

	<footer id="colophon" class="site-footer<?php echo esc_attr( get_theme_mod( 'corporate_biz_footer_bg_image' ) ) ? ' has-background-image' : ''; ?>">
		
		<?php get_template_part( 'template-parts/footer/footer-widgets' ); ?>

		<div id="site-generator">
			<?php get_template_part('template-parts/navigation/navigation-footer'); ?>

			<?php get_template_part('template-parts/footer/site-info'); ?>
		</div><!-- #site-generator -->
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
