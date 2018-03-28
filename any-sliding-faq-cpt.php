<?php defined('ABSPATH') or die(); 


// Register Custom Post Type

function any_slfq_custom_posts() {

	$labels = array(
		'name'					=> _x( 'FAQ', 'Post Type General Name', 'ad-sliding-faq' ),
		'singular_name'			=> _x( 'FAQ', 'Post Type Singular Name', 'ad-sliding-faq' ),
		'menu_name'				=> __( 'FAQ', 'ad-sliding-faq' ),
		'parent_item_colon'		=> __( 'Parent FAQ:', 'ad-sliding-faq' ),
		'all_items'				=> __( 'All FAQs', 'ad-sliding-faq' ),
		'view_item'				=> __( 'View FAQ', 'ad-sliding-faq' ),
		'add_new_item'			=> __( 'Add New FAQ', 'ad-sliding-faq' ),
		'add_new'				=> __( 'Add New', 'ad-sliding-faq' ),
		'edit_item'				=> __( 'Edit FAQ', 'ad-sliding-faq' ),
		'update_item'			=> __( 'Update FAQ', 'ad-sliding-faq' ),
		'search_items'			=> __( 'Search FAQ', 'ad-sliding-faq' ),
		'not_found'				=> __( 'Not found', 'ad-sliding-faq' ),
		'not_found_in_trash'	=> __( 'Not found in Trash', 'ad-sliding-faq' ),
	);
	$capabilities = array(
        'edit_posts'				=> 'edit_faq',
        'edit_others_posts'			=> 'edit_others_faq',
        'publish_posts'				=> 'publish_faq',
        'read_private_posts'		=> 'read_private_faq',
        'delete_posts'				=> 'delete_faq',
        'delete_private_posts'		=> 'delete_private_faq',
        'delete_published_posts'	=> 'delete_published_faq',
        'delete_others_posts'		=> 'delete_others_faq',
        'edit_private_posts'		=> 'edit_private_faq',
        'edit_published_posts'		=> 'edit_published_faq',
    );
	$args = array(
		'label'					=> __( 'faq', 'ad-sliding-faq' ),
		'description'			=> __( 'Here are the FAQs', 'ad-sliding-faq' ),
		'labels'				=> $labels,
		'supports'				=> array('title', 'editor', 'revisions', 'page-attributes'),
		'taxonomies'			=> array(),
		'hierarchical'			=> false,
		'public'				=> true,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'show_in_nav_menus'		=> true,
		'show_in_admin_bar'		=> true,
		'menu_position'			=> 30,
		'menu_icon'				=> 'dashicons-editor-help',
		'can_export'			=> true,
		'has_archive'			=> true,
		'exclude_from_search'	=> false,
		'publicly_queryable'	=> true,
		'capability_type'		=> 'post',
		'capabilities'			=> $capabilities,
        'map_meta_cap'			=> true,
	);
	register_post_type( 'faq-item', $args );

}
add_action( 'init', 'any_slfq_custom_posts' );
