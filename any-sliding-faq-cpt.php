<?php defined('ABSPATH') or die(); 


// Register Custom Post Type

function any_slfq_custom_posts() {
		
	$labels = array(
		'name'					=> _x( 'FAQ', 'Post Type General Name', 'ad-sliding-faq' ),
		'singular_name'			=> _x( 'FAQ', 'Post Type Singular Name', 'ad-sliding-faq' ),
		'menu_name'				=> __( 'FAQ', 'ad-sliding-faq' ),
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
	$rewrite = array(
		'slug'					=> 'faq-item',
		'with_front'			=> true,
		'pages'					=> true,
		'feeds'					=> true,
	);    
	$args = array(
		'label'					=> __( 'faq', 'ad-sliding-faq' ),
		'description'			=> __( 'Here are the FAQs', 'ad-sliding-faq' ),
		'labels'					=> $labels,
		'supports'				=> array('title', 'editor', 'revisions', 'page-attributes', 'thumbnail'),
		'taxonomies'			=> array('faq-topic'),
		'hierarchical'			=> false,
		'public'					=> true,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'show_in_nav_menus'		=> true,
		'show_in_admin_bar'		=> true,
		'menu_position'			=> 30,
		'menu_icon'				=> 'dashicons-editor-help',
		'can_export'			=> true,
		'has_archive'			=> false,
		'exclude_from_search'	=> false,
		'publicly_queryable'	=> true,
		//'rewrite'				=> $rewrite,
		'capability_type'		=> 'post',
		'capabilities'			=> $capabilities,
        'map_meta_cap'			=> true,
        	'show_in_rest'			=> true
	);
	register_post_type( 'faq-item', $args );

}
add_action( 'init', 'any_slfq_custom_posts' );


// Taxonomies

function any_slfq_custom_taxonomies() {

	$labels = array(
		'name'							=> _x( 'FAQ Topics', 'Taxonomy General Name', 'ad-sliding-faq' ),
		'singular_name'					=> _x( 'FAQ Topic', 'Taxonomy Singular Name', 'ad-sliding-faq' ),
		'menu_name'						=> __( 'FAQ Topics', 'ad-sliding-faq' ),
		'all_items'						=> __( 'All FAQ Topics', 'ad-sliding-faq' ),
		'new_item_name'					=> __( 'New FAQ Topic', 'ad-sliding-faq' ),
		'add_new_item'					=> __( 'Add New FAQ Topic', 'ad-sliding-faq' ),
		'edit_item'						=> __( 'Edit FAQ Topic', 'ad-sliding-faq' ),
		'update_item'					=> __( 'Update FAQ Topic', 'ad-sliding-faq' ),
		'view_item'						=> __( 'View FAQ Topic', 'ad-sliding-faq' ),
		'popular_items'					=> __( 'Popular FAQ Topic', 'ad-sliding-faq' ),
		'search_items'					=> __( 'Search FAQ Topic', 'ad-sliding-faq' ),
	);
	$args = array(
		'labels'					=> $labels,
		'hierarchical'			=> true,
		'public'					=> true,
		'show_ui'				=> true,
		'show_admin_column'		=> true,
		'show_in_nav_menus'		=> true,
		'show_tagcloud'			=> false,
		'rewrite'				=> array( 'slug' => 'topic' ),		
		'show_in_rest'			=> true,
	);
	register_taxonomy( 'faq-topic', array( 'faq-item' ), $args );	

}
add_action( 'init', 'any_slfq_custom_taxonomies', 0 );


// Admin Columns

function add_new_columns_faq( $wp_columns ) {
	$column_before = array();
	$column_after['picture'] = __('Picture','ad-sliding-faq');
	$wp_columns = array_merge( $column_before, $wp_columns, $column_after );
	//unset( $wp_columns['date'] );
	return $wp_columns;
}
function manage_columns_faq( $column_name ) {
	global $wpdb, $post;

	switch( $column_name ) {
		case 'picture':
			if( has_post_thumbnail( $post->ID ) ){
				echo get_the_post_thumbnail( $post->ID, array(60,60) );
			}
			break;
		
		default:
			break;
	}
}
add_filter( 'manage_edit-faq-item_columns', 'add_new_columns_faq' );
add_filter( 'manage_faq-item_posts_custom_column', 'manage_columns_faq' );


// Custom titles

function change_title_text( $title ) {
	$screen = get_current_screen();

	if  ( 'faq-item' == $screen->post_type ) {
		$title = __('Enter the question here','ad-sliding-faq');
	}

	return $title;
}
add_filter( 'enter_title_here', 'change_title_text' );