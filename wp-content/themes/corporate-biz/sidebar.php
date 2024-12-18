<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Corporate_Biz
 */

$sidebar = corporate_biz_get_sidebar_id();

if ( '' === $sidebar ) {
    return;
}
?>

<aside id="secondary" class="widget-area sidebar">
	<?php dynamic_sidebar( $sidebar ); ?>
</aside><!-- #secondary -->
