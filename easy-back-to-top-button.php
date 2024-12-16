<?php 

/*
 * Plugin Name:       Easy Back To Top Button
 * Plugin URI:        https://wordpress.org/plugins/easy-back-to-top-button/
 * Description:       It's a handy tool to add an easy back to top button in your website.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Adnan Khan
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://github.com/SorifulIslamAdnanKhan/easy-back-to-top-button
 * Text Domain:       ebttb
 */



// Include CSS

function ebttb_enqueue_style(){
  wp_enqueue_style('ebttb-fontawesome-style', plugins_url('assets/fontawesome/css/all.min.css', __FILE__), array(), '6.7.1');
  wp_enqueue_style('ebttb-style', plugins_url('assets/css/ebttb-style.css', __FILE__));
}

add_action("wp_enqueue_scripts", "ebttb_enqueue_style" );

// Include JavaScript

function ebttb_enqueue_scripts(){
  wp_enqueue_script('ebttb-gsap-script', plugins_url('assets/js/gsap.min.js.js', __FILE__), array(), '3.12.5', true);
  wp_enqueue_script('ebttb-scroll-to-plugin-script', plugins_url('assets/js/scroll-to-plugin.min.js', __FILE__), array(), '3.12.5', true);
  wp_enqueue_script('ebttb-plugin-script', plugins_url('assets/js/ebttb-plugin.js', __FILE__), array(), '1.0.0', 'true');
}

add_action("wp_enqueue_scripts", "ebttb_enqueue_scripts");

// Add Back To Top Button
function ebttb_add_button() {
  echo '<button id="backToTop" title="Back to Top"><i class="fas fa-chevron-up"></i></button>';
}
add_action('wp_footer', 'ebttb_add_button');
?>