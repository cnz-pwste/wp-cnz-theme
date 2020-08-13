<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CNZ_Theme
 */

$sidebar_position = cnz_sidebar_position();

if ( ! is_active_sidebar( 'sidebar-1' ) || $sidebar_position == 'none' ) {
	return;
}
?>
<div class="<?php cnz_sidebar_class(); ?>">
	<aside id="secondary" class="secondary-widget-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- #secondary -->

</div><!-- .col -->
