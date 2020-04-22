<?php
/*
Plugin Name: AD Sliding FAQ
Description: Create a nice and accessible FAQ section with sliding Q/A. 
Version: 2.4
Author: Thomas Villain - Anybodesign
Author URI: https://anybodesign.com/
License: GPL2

Text Domain: ad-sliding-faq
Domain Path: /languages/

	
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined('ABSPATH') or die(); 



/* ------------------------------------------
// Some constants ---------------------------
--------------------------------------------- */


define ('SLFQ_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define ('SLFQ_NAME', 'AD Sliding FAQ');
define ('SLFQ_VERSION', '2.4');


/* ------------------------------------------
// On activation ----------------------------
--------------------------------------------- */

// Require the Custom post type

require_once('any-sliding-faq-cpt.php');

// Flush Rewrite

register_activation_hook( __FILE__, 'any_slfq_flush_rewrites' );

function any_slfq_flush_rewrites() {
	any_slfq_custom_posts();
	flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );



/* ------------------------------------------
// i18n -------------------------------------
--------------------------------------------- */

load_plugin_textdomain( 
	'ad-sliding-faq', 
	false, 
	plugin_basename( dirname( __FILE__ ) ) . '/languages/'
);



/* ------------------------------------------
// Enqueue JS -------------------------------
--------------------------------------------- */


function ad_slfq_add_js() {
    if (!is_admin()) {
	
	    wp_register_script(
		    	'js-faq', 
		    	plugins_url( '/js/sliding-faq.js' , __FILE__ ),
		    	array('jquery'), 
		    	'1.0', 
		    	true
	    );
	}
}    
add_action('wp_enqueue_scripts', 'ad_slfq_add_js');



/* ------------------------------------------
// Enqueue CSS ------------------------------
--------------------------------------------- */


function ad_slfq_add_css() {
	
	wp_enqueue_style(
		'css-faq', 
	    plugins_url( '/css/sliding-faq.css' , __FILE__ ),
		array(), 
		'1.1', 
	    'all'
	);

}    
add_action('wp_enqueue_scripts', 'ad_slfq_add_css');



/* ------------------------------------------
// Admin Options ----------------------------
--------------------------------------------- */
 
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'ad_slfq_plugin_settings_link' );

function ad_slfq_plugin_settings_link($links) {
	 $mylinks = array(
	 	'<a href="' . admin_url( 'edit.php?post_type=faq-item' ) . '">'.__('Create the FAQ','ad-sliding-faq').'</a>'
	 );
	return array_merge( $links, $mylinks );
}

// Nothing else so far :)



/* ------------------------------------------
// FAQ Post Type Output ---------------------
--------------------------------------------- */

 
function ad_slfq_get_faq($o) { ?>
 
    <?php 
	
	// Atts
	
	$h = $o['heading'];
	$t = $o['topic'];
	$s = $o['size'];
	
	// Query
	
	if ($t) {
		
		/**
		 * make an array if several topic separated by comma is given
		 */
		
		if ( strpos( $t, ',' ) >= 0 ) {
			$t = explode( ',', $t );
		}
		
		$faq_query = array(
		    'post_type' 		=> 'faq-item',
		    'posts_per_page' 	=> -1,
		    'orderby' 			=> 'menu_order',
	   	    'order' 			=> 'ASC',
	
			'tax_query' => array(
				array(
					'taxonomy' 	=> 'faq-topic',
					'terms' 	=> $t,
					'field' 	=> 'name',
				),
			),
	   	    
	    );
	    
	} else {
		
		$faq_query = array(
		    'post_type' 		=> 'faq-item',
		    'posts_per_page' 	=> -1,
		    'orderby' 			=> 'menu_order',
	   	    'order' 			=> 'ASC'
	    );
	}
    $query = new WP_Query($faq_query); ?>


    <?php
	
	// Output
	    
	if ($query->have_posts()) : ?>
	
 	<div class="faq-list">

	<?php 
	
	// Loop
	
 	$q = $a = 1;
 	while ($query->have_posts()) : $query->the_post(); ?>
	   
	    <div class="faq-list--item">
	        
	        <<?php echo $h; ?> class="faq-list--question">
				<button class="faq-list--title" aria-controls="faq_<?php echo $q++; ?>" aria-expanded="false">
				<?php if ( '' != get_the_post_thumbnail() ) {
					the_post_thumbnail($s);
				} ?>
				<span><?php the_title(); ?></span>
			</button>
	        </<?php echo $h; ?>>     
			
			<div class="faq-list--answer" id="faq_<?php echo $a++; ?>" aria-hidden="true">
				<?php the_content(); ?>
			</div>
			
		</div>
		
	<?php endwhile; ?> 
 
    </div>
	
	<?php endif; wp_reset_query(); ?>

 
<?php }


/* ------------------------------------------
// FAQ Shortcode  ---------------------------
--------------------------------------------- */ 
 
 
function ad_slfq_insert_faq($atts) {

	ob_start();

	wp_enqueue_script('js-faq');
	
	// Shortcode Params
	
	$o = shortcode_atts( array(
        'heading' 	=> 'h2',
        'topic'		=> null,
        'size'		=> 'thumbnail'
    ), $atts );
	
	
	// Output
	
	ad_slfq_get_faq($o);

	return ob_get_clean();

}
add_shortcode('sliding_faq', 'ad_slfq_insert_faq');


 
/* ------------------------------------------
// FAQ Template tag  ------------------------
--------------------------------------------- */ 

function sliding_faq($heading='h2', $topic=null, $size='thumbnail') {
    
    echo do_shortcode('[sliding_faq heading="'.$heading.'" topic="'.$topic.'" size="'.$size.'"]');
}


/* ------------------------------------------
// FAQ Roles  -------------------------------
--------------------------------------------- */ 

function ad_slfq_role() {
	
	$role = get_role('administrator');

	$role->add_cap('edit_faq');
	$role->add_cap('edit_others_faq');
	$role->add_cap('publish_faq');
	$role->add_cap('read_private_faq');
	$role->add_cap('delete_faq');
	$role->add_cap('delete_private_faq');
	$role->add_cap('delete_published_faq');
	$role->add_cap('delete_others_faq');
	$role->add_cap('edit_private_faq');
	$role->add_cap('edit_published_faq');
}
add_action('admin_init','ad_slfq_role');

