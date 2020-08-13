<?php
/**
* Plugin Name: Box Widget
* Plugin URI: http://galicea.org
* Description: Frontpage Box
* Version: 0.0.1
* Author: Jerzy Wawro
* Author URI: http://tenar.pl
* License: GPL2
*/

if ( ! function_exists('box_type_register') ) {

 // Register Custom Post Type
 function box_type_register() {
	$labels = array(
		'name' => 'WidgetBoxes',
		'singular_name' => 'WidgetBox',
		'menu_name' => 'WidgetBoxes',
		'name_admin_bar' => 'WidgetBoxes',
		'archives' => __( 'WidgetBox Archives', 'text_domain' ),
		'parent_item_colon' => __( 'Parent WidgetBoxes:', 'text_domain' ),
		'all_items' => __( 'All WidgetBoxes', 'text_domain' ),
		'add_new_item' => __( 'Add New WidgetBox', 'text_domain' ),
		'add_new' => __( 'Add New WidgetBox', 'text_domain' ),
		'new_item' => __( 'New WidgetBox', 'text_domain' ),
		'edit_item' => __( 'Edit WidgetBox', 'text_domain' ),
		'update_item' => __( 'Update WidgetBox', 'text_domain' ),
		'view_item' => __( 'View WidgetBox', 'text_domain' ),
		'search_items' => __( 'Search WidgetBoxes', 'text_domain' ),
		'not_found' => __( 'No examplars found', 'text_domain' ),
		'not_found_in_trash' => __( 'No WidgetBoxes in Trash', 'text_domain' ),
		'featured_image' => __( 'Featured Image', 'text_domain' ),
		'set_featured_image' => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image' => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item' => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list' => __( 'WidgetBox list', 'text_domain' ),
		'items_list_navigation' => __( 'WidgetBox list navigation', 'text_domain' ),
		'filter_items_list' => __( 'Filter WidgetBox list', 'text_domain' ),
	);
	$args = array(
		'label' => __( 'Widget Box', 'text_domain' ),
		'description' => __( 'WidgetBox posts are used to develop a widgets on front page', 'text_domain' ),
		'labels' => $labels,
		'supports' => array( 'title', 'editor', ),
		'taxonomies' => array( 'box_cat'),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-align-center',
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,		
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	register_post_type( 'box-widget', $args );
  }
  add_action( 'init', 'box_type_register', 0 );
}

// Register Custom Taxonomies
function bw_taxonomies() {
  register_taxonomy( 'box_cat', 'box-widget', array(
        'label' => 'Kategoria',
        'hierarchical' => false));
}

add_action('init', 'bw_taxonomies');

// meta field: box_url

function notice_meta_box_callback( $post /*, $metabox */) {
    wp_nonce_field( 'box_url_nonce', 'box_url_nonce' );
    $outline = '<label for="box_url" style="display:inline-block;">'. esc_html__('URL', 'text-domain') .'</label>';
    $box_url = get_post_meta( $post->ID, 'box_url', true );
    $outline .= '<input type="text" name="box_url" id="box_url" class="box_url" value="'. esc_attr($box_url) .'" style="width:300px;"/>';
     echo $outline;
}

// Save meta box content.
// @param int $post_id Post ID
add_action('save_post',function($post_id){
    if(isset($_POST['box_url'])){
        update_post_meta($post_id,'box_url',$_POST['box_url']);
    }
});

if ( ! function_exists('register_meta_box_widget') ) {
    // https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/
    /**
     * Register core post type meta boxes.
     */
    function register_meta_box_widget()
    {
        add_meta_box(
            'box_widget_options',     // Unique ID
            'Box Options',            // title
            'notice_meta_box_callback',  // Content callback, must be of type callable
            'box-widget'              // Post type
        );
    }
   add_action('add_meta_boxes', 'register_meta_box_widget');
}


?>
