<?php
/**
 * 
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cnz_widgets_init() {
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar 1', 'cnz-pwste' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'cnz-pwste' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Frontpage Widget Area', 'cnz-pwste' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'cnz-pwste' ),
		'before_widget' => '<section id="%1$s" class="section-spacing %2$s"><div class="section-inner"><div class="__os-container__">',
		'after_widget'  => '</div></div></section>',
		'before_title'  => '<div class="section-title"><h2>',
		'after_title'   => '</h2></div>',
	) );

	$footer_widget_areas = cnz_get_option( 'footer_widgets_area_columns' );

	if( !empty( $footer_widget_areas ) ) {

		for( $i = 1; $i <= $footer_widget_areas; $i++ ) {

			$sidebar_id = 'footer-'.$i;

			register_sidebar( array(
				/* translators: %s: number of footer widget area. */
				'name'          => sprintf( esc_html__( 'Footer %s', 'cnz-pwste' ), $i ),
				'id'            => $sidebar_id,
				'description'   => esc_html__( 'Add widgets here.', 'cnz-pwste' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title"><h3>',
				'after_title'   => '</h3></div>',
			) );
		}
	}

	register_widget( 'CNZ_Theme_Banner_Widget' );	

	register_widget( 'CNZ_Theme_Post_Widget' );

	register_widget( 'CNZ_Theme_Advertisement_Widget' );

	register_widget( 'CNZ_Theme_Services_Widget' );

	register_widget( 'CNZ_Theme_About_Widget' );

	register_widget( 'CNZ_Theme_Featured_Courses_Widget' );
	register_widget( 'CNZ_Theme_Boxes_Widget' );



}
add_action( 'widgets_init', 'cnz_widgets_init' );


/**
 * Widget to display product categories and page slider.
 */
require get_template_directory() . '/widget/widgets/banner-widget.php';

/**
 * Widget to display recent blog posts.
 */
require get_template_directory() . '/widget/widgets/posts-widget.php';

/**
 * Widget to display offer advertisement.
 */
require get_template_directory() . '/widget/widgets/advertisement-widget.php';

/**
 * Widget to display services offered.
 */
require get_template_directory() . '/widget/widgets/services-widget.php';


/**
 * Widget to display about store information
 */
require get_template_directory() . '/widget/widgets/about-widget.php';


require get_template_directory() . '/widget/widgets/featured-courses.php';

require get_template_directory() . '/widget/widgets/boxes-widget.php';



