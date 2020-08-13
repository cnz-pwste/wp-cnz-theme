<?php

$cnz_defaults = cnz_get_default_theme_options();

if( ! function_exists( 'cnz_panel_declaration' ) ) {

	function cnz_panel_declaration() {

		$panels = array(
			array(
				'id' => 'site_header',
				'title' => esc_html__( 'Header', 'cnz-pwste' ),
				'description' => '',
				'priority' => 2,
			),
			array(
				'id' => 'site_pages',
				'title' => esc_html__( 'Pages', 'cnz-pwste' ),
				'description' => '',
				'priority' => 2,
			),
			array(
				'id' => 'site_colors',
				'title' => esc_html__( 'Colors', 'cnz-pwste' ),
				'description' => '',
				'priority' => 2,
			),
		);

		if( !empty( $panels ) ) {

			foreach( $panels as $panel ) {

				cnz_add_panel( $panel['id'], $panel['title'], $panel['description'], $panel['priority'] );
			}
		}
	}
}
cnz_panel_declaration();


if( ! function_exists( 'cnz_section_declaration' ) ) {

	function cnz_section_declaration() {

		$sections = array(
			array(
				'id' => 'site_layout',
				'title' => esc_html__( 'Site Layout', 'cnz-pwste' ),
				'description' => '',
				'panel' => '',
				'priority' => 1,
			),
			array(
				'id' => 'site_logo',
				'title' => esc_html__( 'Site Identity', 'cnz-pwste' ),
				'description' => '',
				'panel' => 'site_header',
				'priority' => 10,
			),
			array(
				'id' => 'top_header',
				'title' => esc_html__( 'Top Header', 'cnz-pwste' ),
				'description' => '',
				'panel' => 'site_header',
				'priority' => '',
			),
			array(
				'id' => 'middle_header',
				'title' => esc_html__( 'Middle Header', 'cnz-pwste' ),
				'description' => '',
				'panel' => 'site_header',
				'priority' => '',
			),
			array(
				'id' => 'special_menu',
				'title' => esc_html__( 'Special Menu', 'cnz-pwste' ),
				'description' => '',
				'panel' => 'site_header',
				'priority' => '',
			),
			array(
				'id' => 'product_search',
				'title' => esc_html__( 'Search Form', 'cnz-pwste' ),
				'description' => '',
				'panel' => 'site_header',
				'priority' => '',
			),
			array(
				'id' => 'page_header',
				'title' => esc_html__( 'Page Header', 'cnz-pwste' ),
				'description' => '',
				'panel' => 'site_pages',
				'priority' => 3,
			),
			array(
				'id' => 'blog_page',
				'title' => esc_html__( 'Blog Page', 'cnz-pwste' ),
				'description' => '',
				'panel' => 'site_pages',
				'priority' => 3,
			),
			array(
				'id' => 'archive_page',
				'title' => esc_html__( 'Archive Page', 'cnz-pwste' ),
				'description' => '',
				'panel' => 'site_pages',
				'priority' => 3,
			),
			array(
				'id' => 'search_page',
				'title' => esc_html__( 'Search Page', 'cnz-pwste' ),
				'description' => '',
				'panel' => 'site_pages',
				'priority' => 3,
			),
			array(
				'id' => 'blog_archive_search_page',
				'title' => esc_html__( 'Blog/Archive/Search Common', 'cnz-pwste' ),
				'description' => '',
				'panel' => 'site_pages',
				'priority' => 3,
			),
			array(
				'id' => 'post_single',
				'title' => esc_html__( 'Post Single', 'cnz-pwste' ),
				'description' => '',
				'panel' => 'site_pages',
				'priority' => 3,
			),
			array(
				'id' => 'page_single',
				'title' => esc_html__( 'Page Single', 'cnz-pwste' ),
				'description' => '',
				'panel' => 'site_pages',
				'priority' => 3,
			),
			array(
				'id' => 'site_sidebar',
				'title' => esc_html__( 'Sidebar', 'cnz-pwste' ),
				'description' => '',
				'panel' => '',
				'priority' => 3,
			),
			array(
				'id' => 'site_footer',
				'title' => esc_html__( 'Footer', 'cnz-pwste' ),
				'description' => '',
				'panel' => '',
				'priority' => 3,
			),
			array(
				'id' => 'post_excerpt',
				'title' => esc_html__( 'Excerpt', 'cnz-pwste' ),
				'description' => '',
				'panel' => '',
				'priority' => 3,
			),
			array(
				'id' => 'theme_color',
				'title' => esc_html__( 'Theme Color', 'cnz-pwste' ),
				'description' => '',
				'panel' => 'site_colors',
				'priority' => 3,
			),
			array(
				'id' => 'theme_accessibility',
				'title' => esc_html__( 'Accessibility', 'cnz-pwste' ),
				'description' => '',
				'panel' => '',
				'priority' => 3,
			),
		);

		if( !empty( $sections ) ) {

			foreach( $sections as $section ) {

				cnz_add_section( $section['id'], $section['title'], $section['description'], $section['panel'], $section['priority'] );
			}
		}
	}
}
cnz_section_declaration();


cnz_add_image_field( 'logo_mobile', esc_html__( 'Logo - For Mobile', 'cnz-pwste' ), '', '', 'site_logo' );
$wp_customize->get_control( 'cnz_field_logo_mobile' )->priority = 5;


/*******************************************************************************************************
********************************** Home Page Control Fields Declaration *********************************
*******************************************************************************************************/
$wp_customize->add_setting( 
	'cnz_field_enable_home_content', 
	array(
		'sanitize_callback' => 'wp_validate_boolean',
		'default' => $cnz_defaults['cnz_field_enable_home_content' ],
	) 
);

$wp_customize->add_control( 
	new CNZ_Theme_Customizer_Toggle_Control( $wp_customize,
		'cnz_field_enable_home_content', 
		array(
			'label' => esc_html__( 'Enable Homepage Content', 'cnz-pwste' ),
			'section' => 'static_front_page',
			'type' => 'flat',
			'active_callback' => 'cnz_is_static_home_page_set',
		) 
	) 
);

/*******************************************************************************************************
********************************** Site Layout Control Fields Declaration *********************************
*******************************************************************************************************/
cnz_add_select_field( 'site_layout', esc_html__( 'Select Site Layout', 'cnz-pwste' ), '', array( 'boxed' => esc_html__( 'Boxed', 'cnz-pwste' ), 'fullwidth' => esc_html__( 'Full Width', 'cnz-pwste' ) ), '', 'site_layout' );


/*******************************************************************************************************
********************************** Header Control Fields Declaration *********************************
*******************************************************************************************************/
cnz_add_toggle_field( 'display_top_header', esc_html__( 'Display Top Header', 'cnz-pwste' ), '', '', 'top_header' );

cnz_add_select_field( 'display_menu_or_login_register_link', esc_html__( 'Select Top Header Left Element', 'cnz-pwste' ), '', array( 'header_menu' => esc_html__( 'Top Header Menu', 'cnz-pwste' ), 'login_register' => esc_html__( 'Login/Register Link', 'cnz-pwste' ) ), '', 'top_header' );

cnz_add_sortable_repeater_field( 'top_header_social_links', esc_html__( 'Social Links', 'cnz-pwste' ), '', 'cnz_active_top_header', 'top_header' );


/*******************************************************************************************************
********************************** Special Menu Control Fields Declaration *********************************
*******************************************************************************************************/
cnz_add_toggle_field( 'display_special_menu', esc_html__( 'Display Special Menu', 'cnz-pwste' ), '', '', 'special_menu' );

cnz_add_text_field( 'special_menu_title', esc_html__( 'Special Menu Title', 'cnz-pwste' ), '', 'cnz_active_special_menu', 'special_menu' );


/*******************************************************************************************************
********************************** Page Header Control Fields Declaration *********************************
*******************************************************************************************************/
cnz_add_toggle_field( 'display_page_header', esc_html__( 'Display Page Header', 'cnz-pwste' ), '', '', 'page_header' );
cnz_add_toggle_field( 'display_breadcrumb', esc_html__( 'Display Breadcrumbs', 'cnz-pwste' ), '', '', 'page_header' );
cnz_add_toggle_field( 'enable_parallax_page_header_background', esc_html__( 'Enable Parallax Background Image', 'cnz-pwste' ), '', 'cnz_is_page_header_enabled', 'page_header' );



/*******************************************************************************************************
************************************* Blog Page Control Fields Declaration *****************************
*******************************************************************************************************/
cnz_add_toggle_field( 'blog_featured_image', esc_html__( 'Display Featured Image', 'cnz-pwste' ), '', '', 'blog_page' );
cnz_add_toggle_field( 'blog_display_cats', esc_html__( 'Display Categories', 'cnz-pwste' ), '', '', 'blog_page' );
cnz_add_toggle_field( 'blog_display_date', esc_html__( 'Display Date', 'cnz-pwste' ), '', '', 'blog_page' );
cnz_add_toggle_field( 'blog_display_author', esc_html__( 'Display Author', 'cnz-pwste' ), '', '', 'blog_page' );
cnz_add_radio_image_field( 'blog_sidebar_position', esc_html__( 'Select Sidebar Position', 'cnz-pwste' ), '', cnz_all_sidebar_positions(), 'cnz_is_not_global_sidebar_position_active', 'blog_page' );




/*******************************************************************************************************
********************************** Archive Page Control Fields Declaration *****************************
*******************************************************************************************************/
cnz_add_toggle_field( 'archive_featured_image', esc_html__( 'Display Featured Image', 'cnz-pwste' ), '', '', 'archive_page' );
cnz_add_toggle_field( 'archive_display_cats', esc_html__( 'Display Categories', 'cnz-pwste' ), '', '', 'archive_page' );
cnz_add_toggle_field( 'archive_display_date', esc_html__( 'Display Date', 'cnz-pwste' ), '', '', 'archive_page' );
cnz_add_toggle_field( 'archive_display_author', esc_html__( 'Display Author', 'cnz-pwste' ), '', '', 'archive_page' );
cnz_add_radio_image_field( 'archive_sidebar_position', esc_html__( 'Select Sidebar Position', 'cnz-pwste' ), '', cnz_all_sidebar_positions(), 'cnz_is_not_global_sidebar_position_active', 'archive_page' );



/*******************************************************************************************************
*********************************** Search Page Control Fields Declaration *****************************
*******************************************************************************************************/
cnz_add_toggle_field( 'search_featured_image', esc_html__( 'Display Featured Image', 'cnz-pwste' ), '', '', 'search_page' );
cnz_add_toggle_field( 'search_display_cats', esc_html__( 'Display Categories', 'cnz-pwste' ), '', '', 'search_page' );
cnz_add_toggle_field( 'search_display_date', esc_html__( 'Display Date', 'cnz-pwste' ), '', '', 'search_page' );
cnz_add_toggle_field( 'search_display_author', esc_html__( 'Display Author', 'cnz-pwste' ), '', '', 'search_page' );
cnz_add_radio_image_field( 'search_sidebar_position', esc_html__( 'Select Sidebar Position', 'cnz-pwste' ), '', cnz_all_sidebar_positions(), 'cnz_is_not_global_sidebar_position_active', 'search_page' );



/*******************************************************************************************************
***************************** Blog/Archive/Search Page Control Fields Declaration **********************
*******************************************************************************************************/
cnz_add_select_field( 'blog_archive_search_col_align', esc_html__( 'Select Post Column Alignment', 'cnz-pwste' ), '', array( 'feat_img_content' => esc_html__( 'Featured Image/Content', 'cnz-pwste' ), 'content_feat_img' => esc_html__( 'Content/Featured Image', 'cnz-pwste' ) ), '', 'blog_archive_search_page' );

/*******************************************************************************************************
*********************************** Blog Single Control Fields Declaration *****************************
*******************************************************************************************************/
cnz_add_toggle_field( 'display_post_featured_image', esc_html__( 'Display Featured Image', 'cnz-pwste' ), '', '', 'post_single' );
cnz_add_toggle_field( 'display_post_cats', esc_html__( 'Display Categories', 'cnz-pwste' ), '', '', 'post_single' );
cnz_add_toggle_field( 'display_post_date', esc_html__( 'Display Date', 'cnz-pwste' ), '', '', 'post_single' );
cnz_add_toggle_field( 'display_post_author', esc_html__( 'Display Author', 'cnz-pwste' ), '', '', 'post_single' );
cnz_add_toggle_field( 'display_post_tags', esc_html__( 'Display Tags', 'cnz-pwste' ), '', '', 'post_single' );

cnz_add_toggle_field( 'enable_post_common_sidebar_position', esc_html__( 'Enable Common Sidebar Position', 'cnz-pwste' ), esc_html__( 'This option enables common sidebar position for all the posts.', 'cnz-pwste' ), 'cnz_is_not_global_sidebar_position_active', 'post_single' );
cnz_add_radio_image_field( 'post_sidebar_position', esc_html__( 'Select Common Sidebar Position', 'cnz-pwste' ), '', cnz_all_sidebar_positions(), 'cnz_is_post_common_sidebar_position_active', 'post_single' );



/*******************************************************************************************************
*********************************** Page Single Control Fields Declaration *****************************
*******************************************************************************************************/
cnz_add_toggle_field( 'display_page_featured_image', esc_html__( 'Display Featured image', 'cnz-pwste' ), '', '', 'page_single' );
cnz_add_toggle_field( 'enable_page_common_sidebar_position', esc_html__( 'Enable Common Sidebar Position', 'cnz-pwste' ), esc_html__( 'This option enables common sidebar position for all the pages.', 'cnz-pwste' ), 'cnz_is_not_global_sidebar_position_active', 'page_single' );
cnz_add_radio_image_field( 'page_sidebar_position', esc_html__( 'Select Common Sidebar Position', 'cnz-pwste' ), '', cnz_all_sidebar_positions(), 'cnz_is_page_common_sidebar_position_active', 'page_single' );




/*******************************************************************************************************
************************************ Sidebar Control Fields Declaration *********************************
*******************************************************************************************************/
cnz_add_toggle_field( 'enable_sticky_sidebar', esc_html__( 'Enable Sticky Sidebar', 'cnz-pwste' ), '', '', 'site_sidebar' );
cnz_add_toggle_field( 'enable_sidebar_small_devices', esc_html__( 'Enable Sidebar For Small Devices', 'cnz-pwste' ), esc_html__( 'This option lets you to display or do not display sidebar for devices with width smaller than 768px.', 'cnz-pwste' ), '', 'site_sidebar' );
cnz_add_toggle_field( 'enable_global_sidebar_position', esc_html__( 'Enable Global Sidebar Position', 'cnz-pwste' ), esc_html__( 'On checking this option, all the page templates of your website will have same sidebar position.', 'cnz-pwste' ), '', 'site_sidebar' );
cnz_add_radio_image_field( 'global_sidebar_position', esc_html__( 'Select Global Sidebar Position', 'cnz-pwste' ), '', cnz_all_sidebar_positions(), 'cnz_is_global_sidebar_position_active', 'site_sidebar' );



/*******************************************************************************************************
************************************ Footer Control Fields Declaration *********************************
*******************************************************************************************************/
cnz_add_toggle_field( 'display_scroll_top_button', esc_html__( 'Display Scroll Top Button', 'cnz-pwste' ), '', '', 'site_footer' );
cnz_add_toggle_field( 'display_footer_widget_area', esc_html__( 'Display Footer Widgets', 'cnz-pwste' ), '', '', 'site_footer' );
cnz_add_select_field( 'footer_widgets_area_columns', esc_html__( 'Select Footer Widget Area Columns', 'cnz-pwste' ), '', array( '1' => esc_html__( '1', 'cnz-pwste' ), '2' => esc_html__( '2', 'cnz-pwste' ), '3' => esc_html__( '3', 'cnz-pwste' ), '4' => esc_html__( '4', 'cnz-pwste' ) ), 'cnz_is_footer_widget_area_enabled', 'site_footer' );
cnz_add_text_field( 'copyright_text', esc_html__( 'Copyright Text', 'cnz-pwste' ), '', '', 'site_footer' );
cnz_add_image_field( 'payments_image', esc_html__( 'Image of payment processors', 'cnz-pwste' ), '', '', 'site_footer' );


/*******************************************************************************************************
***************************************** Excerpt Fields Declaration ***********************************
*******************************************************************************************************/
cnz_add_number_field( 'excerpt_length', esc_html__( 'Excerpt Length', 'cnz-pwste' ), esc_html__( 'Excerpt is the short content of post or page.', 'cnz-pwste' ), '', 'post_excerpt', '', '', '' );

/*******************************************************************************************************
***************************************** Accessibility Fields Declaration ***********************************
*******************************************************************************************************/
cnz_add_toggle_field( 'disable_ouline_on_focus', esc_html__( 'Disable Outline On Focus', 'cnz-pwste' ), '', '', 'theme_accessibility' );


/*******************************************************************************************************
***************************************** Theme Color Declaration ***********************************
*******************************************************************************************************/
cnz_add_color_field( 'primary_color', esc_html__( 'Primary Color', 'cnz-pwste' ), '', '', 'theme_color' );
cnz_add_color_field( 'secondary_color', esc_html__( 'Secondary Color', 'cnz-pwste' ), '', '', 'theme_color' );



