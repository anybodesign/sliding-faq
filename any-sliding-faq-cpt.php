<?php defined('ABSPATH') or die(); 


// Register Custom Post Type

function any_slfq_custom_posts() {

	$labels = array(
		'name'                => _x( 'FAQ', 'Post Type General Name', 'sliding-faq' ),
		'singular_name'       => _x( 'FAQ', 'Post Type Singular Name', 'sliding-faq' ),
		'menu_name'           => __( 'FAQ', 'sliding-faq' ),
		'parent_item_colon'   => __( 'Parent FAQ:', 'sliding-faq' ),
		'all_items'           => __( 'All FAQs', 'sliding-faq' ),
		'view_item'           => __( 'View FAQ', 'sliding-faq' ),
		'add_new_item'        => __( 'Add New FAQ', 'sliding-faq' ),
		'add_new'             => __( 'Add New', 'sliding-faq' ),
		'edit_item'           => __( 'Edit FAQ', 'sliding-faq' ),
		'update_item'         => __( 'Update FAQ', 'sliding-faq' ),
		'search_items'        => __( 'Search FAQ', 'sliding-faq' ),
		'not_found'           => __( 'Not found', 'sliding-faq' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'sliding-faq' ),
	);
	$args = array(
		'label'               => __( 'faq', 'sliding-faq' ),
		'description'         => __( 'Here are the FAQs', 'sliding-faq' ),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'revisions', 'page-attributes'),
		'taxonomies'          => array(),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 30,
		'menu_icon'			  => 'dashicons-editor-help',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'faq-item', $args );

}
add_action( 'init', 'any_slfq_custom_posts' );
