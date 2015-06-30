<?php
/**
 * Plugin Name: Sliding FAQ
 * Description: Create a nice FAQ section with sliding Q/A. 
 * Version: 1.0
 * Author: Thomas Villain - Anybodesign
 * Author URI: http://anybodesign.com/
 */

defined('ABSPATH') or die(); 



/* ------------------------------------------
// Some constants ---------------------------
--------------------------------------------- */


define('SFAQ_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('SFAQ_NAME', 'Sliding FAQ');
define ('SFAQ_VERSION', '1.0');


/* ------------------------------------------
// On activation -------------------------------
--------------------------------------------- */

// Require the Custom post type

require_once('any-sliding-faq-cpt.php');

// Flush Rewrite

register_activation_hook( __FILE__, 'faq_flush_rewrites' );

function faq_flush_rewrites() {
	faq_custom_posts();
	flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );



/* ------------------------------------------
// i18n -------------------------------------
--------------------------------------------- */

load_plugin_textdomain( 'sliding-faq', false, basename( dirname( __FILE__ ) ) . '/languages' );



/* ------------------------------------------
// Enqueue JS -------------------------------
--------------------------------------------- */


function add_faq_js() {
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
add_action('wp_enqueue_scripts', 'add_faq_js');



/* ------------------------------------------
// Enqueue CSS ------------------------------
--------------------------------------------- */


function add_faq_css() {
	
	wp_register_style(
		'css-faq', 
	    plugins_url( '/css/sliding-faq.css' , __FILE__ ),
		array(), 
		'1.0', 
		false
	);
	wp_enqueue_style( 'css-faq' );
}    
add_action('wp_enqueue_scripts', 'add_faq_css');



/* ------------------------------------------
// Admin Options ----------------------------
--------------------------------------------- */
 

// Nothing so far :)



/* ------------------------------------------
// FAQ Post Type Output ---------------------
--------------------------------------------- */

 
function get_faq() { ?>

 
    <?php $faq_query = array(
	    'post_type' => 'faq-item'
    );
    $query = new WP_Query($faq_query); ?>

    <?php if ($query->have_posts()) : ?>

 	<div id="sliding_faq">
	 	<ul class="faq-list">
    
	 	<?php while ($query->have_posts()) : $query->the_post(); ?> 
        
	        <li class="faq-list--question">
	        <span class="faq-list--title"><?php the_title(); ?></span>
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
 
 
function insert_faq($atts, $content=null) {
	get_faq();
}
add_shortcode('sliding_faq', 'insert_faq');
 
 
/* ------------------------------------------
// FAQ Template tag  ------------------------
--------------------------------------------- */ 
 
function sliding_faq() { print get_faq(); }


