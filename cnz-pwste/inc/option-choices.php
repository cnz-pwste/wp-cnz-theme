<?php
/**
 * Collection of functions that returns array of different elements. 
 */

if( ! function_exists( 'cnz_all_post_categories' ) ) {
	/**
     * Get post categories.
     *
     * @since 1.0.0
     *
     * @param null.
     * @return array.
     */
	function cnz_all_post_categories() {

		$post_categories = array();
		$post_terms = get_terms( array( 'taxonomy' => 'category' ) );

		if( ! empty( $post_terms ) ) {
			foreach( $post_terms as $post_term ) {
				$post_categories[$post_term->slug] = $post_term->name;
			}
		}

		return $post_categories;
	}
}


if( ! function_exists( 'cnz_all_pages' ) ) {
	/**
     * Get pages.
     *
     * @since 1.0.0
     *
     * @param null.
     * @return array.
     */
	function cnz_all_pages() {

		$pages  =  get_pages();

		$page_list = array();

		if( !empty( $pages ) ) {

			foreach( $pages as $page ) {

				$page_list[ $page->post_name ] = $page->post_title;
			}
		}

		return $page_list;
	}
}

if( ! function_exists( 'cnz_sel_courses' ) ) {
	function cnz_sel_courses() {
          $product_terms=get_terms(  array('taxonomy' => 'technology','hide_empty' => false) );
  	  return $product_terms;
        }
}

if( ! function_exists( 'cnz_all_courses' ) ) {
	function cnz_all_courses() {
          $product_terms=get_terms(  array('taxonomy' => 'open','hide_empty' => false) );
  	  return $product_terms;
        }
}


if( ! function_exists( 'cnz_all_sidebar_positions' ) ) {
	/**
     * Get sidebar positions.
     *
     * @since 1.0.0
     *
     * @param null.
     * @return array.
     */
	function cnz_all_sidebar_positions() {

		return array(
			'left' => get_template_directory_uri() . '/customizer/assets/images/sidebar_left.png',
			'right' => get_template_directory_uri() . '/customizer/assets/images/sidebar_right.png',
			'none' => get_template_directory_uri() . '/customizer/assets/images/sidebar_none.png',
		);
	}
}