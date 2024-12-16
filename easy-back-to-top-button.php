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


// Plugin Customization Settings

add_action("customize_register", 'ebttb_customization');

function ebttb_customization ($wp_customize){
  $wp_customize->add_section('ebttb_top_section', array(
    'title' =>__('Easy Back To Top Button','ebttb'),
    'description' => 'It is a handy tool to add an easy back to top button in your website.'
  ));

  // Change Button Background Color

  $wp_customize->add_setting('ebttb_default_bg_color', array(
    'default' => '#007bff',
    'sanitize_callback' => 'sanitize_text_field',
  ));

  $wp_customize->add_control (new WP_Customize_Color_Control ($wp_customize,'ebttb_default_bg_color', array(
    'label' => 'Background Color',
    'description' => 'You can change the button background color.',
    'section' => 'ebttb_top_section',
    'type' => 'color',
  )));

  // Change Button Border Radius

  $wp_customize->add_setting('ebttb_border_radius', array(
    'default' => '50%',
    'sanitize_callback' => 'sanitize_text_field',
  ));

  $wp_customize->add_control('ebttb_border_radius', array(
    'label'       => 'Border Radius',
    'description' => 'You can change the border radius of the button using both percentage and pixel.',
    'section'     => 'ebttb_top_section',
    'type'        => 'text',
));

  // Change Button Width

  $wp_customize->add_setting('ebttb_width', array(
    'default' => '50px',
    'sanitize_callback' => 'sanitize_text_field',
  ));

  $wp_customize->add_control('ebttb_width', array(
    'label'       => 'Width',
    'description' => 'You can change the button width.',
    'section'     => 'ebttb_top_section',
    'type'        => 'text',
));

  // Change Button Height

  $wp_customize->add_setting('ebttb_height', array(
    'default'           => '50px',
    'sanitize_callback' => 'sanitize_text_field',
  ));

  $wp_customize->add_control('ebttb_height', array(
      'label'       => 'Height',
      'description' => 'You can change the button height.',
      'section'     => 'ebttb_top_section',
      'type'        => 'text',
  ));

  // Change Icon Size

  $wp_customize->add_setting('ebttb_icon_size', array(
    'default'           => '20px',
    'sanitize_callback' => 'sanitize_text_field',
  ));

  $wp_customize->add_control('ebttb_icon_size', array(
      'label'       => 'Icon Size',
      'description' => 'You can change the icon size.',
      'section'     => 'ebttb_top_section',
      'type'        => 'text',
  ));

  // Change Icon Color

  $wp_customize->add_setting('ebttb_icon_color', array(
    'default' => '#ffffff',
  ));

  $wp_customize->add_control (new WP_Customize_Color_Control ($wp_customize,'ebttb_icon_color', array(
    'label' => 'Icon Color',
    'description' => 'You can change the icon color.',
    'section' => 'ebttb_top_section',
    'type' => 'color',
  )));
}

// Plugin CSS Customization

function ebttb_bg_color_customization (){
  ?>
  <style>
    #backToTop {
      width: <?php print get_theme_mod('ebttb_width')?>;
      height: <?php print get_theme_mod('ebttb_height')?>;
      color: <?php print get_theme_mod('ebttb_icon_color')?>;
      background-color: <?php print get_theme_mod('ebttb_default_bg_color')?>;
      border-radius: <?php print get_theme_mod('ebttb_border_radius')?>;
    }
    #backToTop i {
    font-size: <?php print get_theme_mod('ebttb_icon_size')?>;;
    }
  </style>
  
  
  <?php
}

add_action('wp_head','ebttb_bg_color_customization')


?>