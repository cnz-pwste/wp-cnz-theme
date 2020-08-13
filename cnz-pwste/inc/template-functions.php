<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package CNZ_Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function cnz_body_classes( $classes ) {

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {

		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {

		$classes[] = 'no-sidebar';
	}

	// Adds a class of boxed.
	if( cnz_get_option( 'site_layout' ) == 'boxed' ) {

		$classes[] = 'boxed';
	}

	return $classes;
}
add_filter( 'body_class', 'cnz_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function cnz_pingback_header() {

	if ( is_singular() && pings_open() ) {

		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'cnz_pingback_header' );


/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post article element.
 * @return array
 */
function cnz_post_classes( $classes ) {

	$show_featured_image = '';

	if( is_home() ) {

		$show_featured_image = cnz_get_option( 'blog_featured_image' );
	}

	if( is_archive() ) {

		$show_featured_image = cnz_get_option( 'archive_featured_image' );
	}

	if( is_search() ) {

		$show_featured_image = cnz_get_option( 'search_featured_image' );
	}

	if( $show_featured_image == false ) {

		$class_key = array_search( 'has-post-thumbnail', $classes );

		unset( $classes[$class_key] );
	}

	return $classes;
}
add_filter( 'post_class', 'cnz_post_classes' );


if( ! function_exists( 'cnz_sidebar_class' ) ) {

	function cnz_sidebar_class() {

		$sidebar_class = 'col-desktop-4 sidebar-col col-tab-100 col-mob-100';

		$sidebar_position = cnz_sidebar_position();

		$is_sticky = cnz_get_option( 'enable_sticky_sidebar' );

		$enable_on_small_devices = cnz_get_option( 'enable_sidebar_small_devices' );

		if( $is_sticky == true && $sidebar_position != 'none' ) {
			$sidebar_class .= ' sticky-portion';
		}

		if( $enable_on_small_devices == false && $sidebar_position != 'none' ) {
			$sidebar_class .= ' hide-in-small';
		}

		if( $sidebar_position == 'left' ) {
			$sidebar_class .= ' order-first';
		}

		echo esc_attr( $sidebar_class );
	}
}


if( ! function_exists( 'cnz_content_container_class' ) ) {

	function cnz_content_container_class() {

		$container_class = '';

		$sidebar_position = cnz_sidebar_position();

		if( $sidebar_position == 'none' ) {

			$container_class = 'col-lg-12';

		} else {

			$container_class = 'col-desktop-8 content-col col-tab-100 col-mob-100';

			$is_sticky = cnz_get_option( 'enable_sticky_sidebar' );

			if( $is_sticky == true && $sidebar_position != 'none' ) {

				$container_class .= ' sticky-portion';
			}

			if( $sidebar_position == 'left' ) {

				$container_class .= ' order-last';
			}
		}

		echo esc_attr( $container_class );
	}
}


if( ! function_exists( 'cnz_content_entry_class' ) ) {

	function cnz_content_entry_class() {

		$content_entry_class = '';

        if( is_single() || is_page() ) {

        	$content_entry_class = 'editor-entry';

        	echo esc_attr( $content_entry_class );

        	return;
        }
	}
}


if( ! function_exists( 'cnz_menu_row_class' ) ) {

	function cnz_menu_row_class() {

		$menu_row_class = '';

		$display_special_menu = cnz_get_option( 'display_special_menu' );

		if( $display_special_menu == false ) {

			$menu_row_class = 'no-special-menu';
		}

		echo esc_attr( $menu_row_class );
	}
}

if( ! function_exists( 'cnz_logo_row_class' ) ) {

	function cnz_logo_row_class() {

		$display_product_search = cnz_get_option( 'display_product_search_form' );
        $display_wishlist_icon = cnz_get_option( 'display_wishlist' );
        $display_minicart = cnz_get_option( 'display_mini_cart' );

        $logo_row_class = '';

        if( function_exists( 'YITH_WCWL' ) ) {

        	if( $display_wishlist_icon == false ) {

        		$logo_row_class = 'no-wishlist-icon';
        	}
        } else {

        	$logo_row_class = 'no-wishlist-icon';
        }


        $logo_row_class .= ' no-product-search-form no-mini-cart';
        

        echo esc_attr( $logo_row_class );
	}
}