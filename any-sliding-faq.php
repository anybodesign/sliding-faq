<?php
/*
Plugin Name: AD Sliding FAQ
Description: Create a nice FAQ section with sliding Q/A. 
Plugin URI: https://github.com/anybodesign/sliding-faq/
Version: 1.6
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

defined('ABSPATH') or die('°_°’'); 



/* ------------------------------------------
// Some constants ---------------------------
--------------------------------------------- */


define ('SLFQ_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define ('SLFQ_NAME', 'Sliding FAQ');
define ('SLFQ_VERSION', '1.6');


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


function any_slfq_add_js() {
    if (!is_admin()) {
	
	    wp_enqueue_script( 
	    	'js-faq', 
	    	plugins_url( '/js/sliding-faq.js' , __FILE__ ),
	    	array('jquery'), 
	    	'1.0', 
	    	true
	    );
	}
}    
add_action('wp_enqueue_scripts', 'any_slfq_add_js');



/* ------------------------------------------
// Enqueue CSS ------------------------------
--------------------------------------------- */


function any_slfq_add_css() {
	
	wp_register_style(
		'css-faq', 
	    plugins_url( '/css/sliding-faq.css' , __FILE__ ),
		array(), 
		'1.0', 
		false
	);
	wp_enqueue_style( 'css-faq' );
}    
add_action('wp_enqueue_scripts', 'any_slfq_add_css');



/* ------------------------------------------
// Admin Options ----------------------------
--------------------------------------------- */
 
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'any_slfq_plugin_settings_link' );

function any_slfq_plugin_settings_link($links) {
	 $mylinks = array(
	 	'<a href="' . admin_url( 'edit.php?post_type=faq-item' ) . '">'.__('Create the FAQ','ad-sliding-faq').'</a>'
	 );
	return array_merge( $links, $mylinks );
}

// Nothing else so far :)



/* ------------------------------------------
// FAQ Post Type Output ---------------------
--------------------------------------------- */

 
function any_slfq_get_faq() { ?>

 
    <?php $faq_query = array(
	    'post_type' => 'faq-item',
	    'orderby' => 'menu_order',
   	    'order' => 'ASC',
    );
    $query = new WP_Query($faq_query); ?>

    <?php if ($query->have_posts()) : ?>

 	<div id="sliding_faq">
	 	<ul class="faq-list">
    
	 	<?php while ($query->have_posts()) : $query->the_post(); ?> 
        
	        <li class="faq-list--question">
				<button class="faq-list--title"><?php the_title(); ?></button>
				<div class="faq-list--answer">
					<?php the_content(); ?>
				</div>
	        </li>     
	    
		<?php endwhile; ?> 
 
    	</ul>
    </div>
	
	<?php endif; wp_reset_query(); ?>

 
<?php }


/* ------------------------------------------
// FAQ Shortcode  ---------------------------
--------------------------------------------- */ 
 
 
function any_slfq_insert_faq() {

	ob_start();
		any_slfq_get_faq();
	return ob_get_clean();
	
}
add_shortcode('sliding_faq', 'any_slfq_insert_faq');

 
/* ------------------------------------------
// FAQ Template tag  ------------------------
--------------------------------------------- */ 
 
function any_sliding_faq() { 
	
	print any_slfq_get_faq(); 

}