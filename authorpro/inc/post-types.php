<?php
/**
 * Custom Post Type Definitions
 *
 * @package AuthorPro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register custom post types.
 */
function authorpro_register_post_types() {

	/**
	 * Post Type: Books.
	 */
	$labels_book = array(
		'name'                  => _x( 'Books', 'Post Type General Name', 'authorpro' ),
		'singular_name'         => _x( 'Book', 'Post Type Singular Name', 'authorpro' ),
		'menu_name'             => __( 'Books', 'authorpro' ),
		'name_admin_bar'        => __( 'Book', 'authorpro' ),
		'archives'              => __( 'Book Archives', 'authorpro' ),
		'attributes'            => __( 'Book Attributes', 'authorpro' ),
		'parent_item_colon'     => __( 'Parent Book:', 'authorpro' ),
		'all_items'             => __( 'All Books', 'authorpro' ),
		'add_new_item'          => __( 'Add New Book', 'authorpro' ),
		'add_new'               => __( 'Add New', 'authorpro' ),
		'new_item'              => __( 'New Book', 'authorpro' ),
		'edit_item'             => __( 'Edit Book', 'authorpro' ),
		'update_item'           => __( 'Update Book', 'authorpro' ),
		'view_item'             => __( 'View Book', 'authorpro' ),
		'view_items'            => __( 'View Books', 'authorpro' ),
		'search_items'          => __( 'Search Book', 'authorpro' ),
		'not_found'             => __( 'Not found', 'authorpro' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'authorpro' ),
		'featured_image'        => __( 'Book Cover', 'authorpro' ),
		'set_featured_image'    => __( 'Set book cover', 'authorpro' ),
		'remove_featured_image' => __( 'Remove book cover', 'authorpro' ),
		'use_featured_image'    => __( 'Use as book cover', 'authorpro' ),
		'insert_into_item'      => __( 'Insert into book', 'authorpro' ),
		'uploaded_to_this_item' => __( 'Uploaded to this book', 'authorpro' ),
		'items_list'            => __( 'Books list', 'authorpro' ),
		'items_list_navigation' => __( 'Books list navigation', 'authorpro' ),
		'filter_items_list'     => __( 'Filter books list', 'authorpro' ),
	);
	$args_book = array(
		'label'                 => __( 'Book', 'authorpro' ),
		'description'           => __( 'A post type for books.', 'authorpro' ),
		'labels'                => $labels_book,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-book',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'books',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'book', $args_book );

	/**
	 * Post Type: Events.
	 */
	$labels_event = array(
		'name'                  => _x( 'Events', 'Post Type General Name', 'authorpro' ),
		'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'authorpro' ),
		'menu_name'             => __( 'Events', 'authorpro' ),
		'name_admin_bar'        => __( 'Event', 'authorpro' ),
		'archives'              => __( 'Event Archives', 'authorpro' ),
		'attributes'            => __( 'Event Attributes', 'authorpro' ),
		'parent_item_colon'     => __( 'Parent Event:', 'authorpro' ),
		'all_items'             => __( 'All Events', 'authorpro' ),
		'add_new_item'          => __( 'Add New Event', 'authorpro' ),
		'add_new'               => __( 'Add New', 'authorpro' ),
		'new_item'              => __( 'New Event', 'authorpro' ),
		'edit_item'             => __( 'Edit Event', 'authorpro' ),
		'update_item'           => __( 'Update Event', 'authorpro' ),
		'view_item'             => __( 'View Event', 'authorpro' ),
		'view_items'            => __( 'View Events', 'authorpro' ),
		'search_items'          => __( 'Search Event', 'authorpro' ),
		'not_found'             => __( 'Not found', 'authorpro' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'authorpro' ),
		'featured_image'        => __( 'Event Image', 'authorpro' ),
		'set_featured_image'    => __( 'Set event image', 'authorpro' ),
		'remove_featured_image' => __( 'Remove event image', 'authorpro' ),
		'use_featured_image'    => __( 'Use as event image', 'authorpro' ),
		'insert_into_item'      => __( 'Insert into event', 'authorpro' ),
		'uploaded_to_this_item' => __( 'Uploaded to this event', 'authorpro' ),
		'items_list'            => __( 'Events list', 'authorpro' ),
		'items_list_navigation' => __( 'Events list navigation', 'authorpro' ),
		'filter_items_list'     => __( 'Filter events list', 'authorpro' ),
	);
	$args_event = array(
		'label'                 => __( 'Event', 'authorpro' ),
		'description'           => __( 'A post type for events.', 'authorpro' ),
		'labels'                => $labels_event,
		'supports'              => array( 'title', 'editor' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'menu_icon'             => 'dashicons-calendar-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'events',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'event', $args_event );
}
add_action( 'init', 'authorpro_register_post_types', 0 );
