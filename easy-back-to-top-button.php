<?php 

/*
 * Plugin Name:       Easy Back To Top Button
 * Plugin URI:        https://wordpress.org/plugins/easy-back-to-top-button/
 * Description:       It's a handy tool to add an easy back to top button in your website.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Sorinx
 * Author URI:        https://sorinx.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       easy-back-to-top-button
 */

 // Exit If Accessed Directly.

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * Enqueue Plugin Styles.
 */

function ebttb_enqueue_styles(){
    wp_enqueue_style('ebttb-fontawesome-style', plugins_url('assets/fontawesome/css/all.min.css', __FILE__), array(), '6.7.1');
    wp_enqueue_style('ebttb-style', plugins_url('assets/css/ebttb-style.css', __FILE__), array(), '1.0.0');
}

add_action("wp_enqueue_scripts", "ebttb_enqueue_styles" );

/**
 * Enqueue Plugin Scripts.
 */

function ebttb_enqueue_scripts() {
    wp_enqueue_script( 'ebttb-plugin-script', plugins_url( 'assets/js/ebttb-plugin.js', __FILE__ ), array(), '1.0.0', true );
}

add_action("wp_enqueue_scripts", "ebttb_enqueue_scripts");

/**
 * Add Back to Top Button to Footer.
 */

function ebttb_add_button() {
  ?>
  <button id="backToTop" title="<?php esc_attr_e( 'Back to Top', 'easy-back-to-top-button' ); ?>">
      <i class="fas fa-chevron-up"></i>
  </button>
  <?php
}
add_action( 'wp_footer', 'ebttb_add_button' );

/**
 * Register Customizer Settings.
 */

add_action( 'customize_register', 'ebttb_customizer_settings' );
function ebttb_customizer_settings( $wp_customize ) {
    $wp_customize->add_section( 'ebttb_top_section', array(
        'title'       => __( 'Easy Back To Top Button', 'easy-back-to-top-button' ),
        'description' => __( 'Customize the back-to-top button appearance.', 'easy-back-to-top-button' ),
    ) );

    // Background Color.

    $wp_customize->add_setting( 'ebttb_default_bg_color', array(
        'default'           => '#007bff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ebttb_default_bg_color', array(
        'label'   => __( 'Background Color', 'easy-back-to-top-button' ),
        'section' => 'ebttb_top_section',
    ) ) );

    // Border Radius.

    $wp_customize->add_setting( 'ebttb_border_radius', array(
        'default'           => '50%',
        'sanitize_callback' => 'ebttb_sanitize_dimension',
    ) );
    $wp_customize->add_control( 'ebttb_border_radius', array(
        'label'       => __( 'Border Radius', 'easy-back-to-top-button' ),
        'section'     => 'ebttb_top_section',
        'type'        => 'text',
    ) );

    // Width.

    $wp_customize->add_setting( 'ebttb_width', array(
        'default'           => '50px',
        'sanitize_callback' => 'ebttb_sanitize_dimension',
    ) );
    $wp_customize->add_control( 'ebttb_width', array(
        'label'       => __( 'Width', 'easy-back-to-top-button' ),
        'section'     => 'ebttb_top_section',
        'type'        => 'text',
    ) );

    // Height.

    $wp_customize->add_setting( 'ebttb_height', array(
        'default'           => '50px',
        'sanitize_callback' => 'ebttb_sanitize_dimension',
    ) );
    $wp_customize->add_control( 'ebttb_height', array(
        'label'       => __( 'Height', 'easy-back-to-top-button' ),
        'section'     => 'ebttb_top_section',
        'type'        => 'text',
    ) );

    // Icon Size.

    $wp_customize->add_setting( 'ebttb_icon_size', array(
        'default'           => '20px',
        'sanitize_callback' => 'ebttb_sanitize_dimension',
    ) );
    $wp_customize->add_control( 'ebttb_icon_size', array(
        'label'       => __( 'Icon Size', 'easy-back-to-top-button' ),
        'section'     => 'ebttb_top_section',
        'type'        => 'text',
    ) );

    // Icon Color.

    $wp_customize->add_setting( 'ebttb_icon_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ebttb_icon_color', array(
        'label'   => __( 'Icon Color', 'easy-back-to-top-button' ),
        'section' => 'ebttb_top_section',
    ) ) );
}

/**
 * Custom Sanitization Callback for Dimensions.
 */

function ebttb_sanitize_dimension( $value ) {
    return preg_match( '/^\d+(px|em|%|rem)?$/', $value ) ? $value : '';
}

/**
 * Custom CSS.
 */

function ebttb_add_inline_styles() {
    $custom_css = "
    #backToTop {
        width: " . esc_attr( get_theme_mod( 'ebttb_width', '50px' ) ) . ";
        height: " . esc_attr( get_theme_mod( 'ebttb_height', '50px' ) ) . ";
        background-color: " . esc_attr( get_theme_mod( 'ebttb_default_bg_color', '#007bff' ) ) . ";
        border-radius: " . esc_attr( get_theme_mod( 'ebttb_border_radius', '50%' ) ) . ";
        color: " . esc_attr( get_theme_mod( 'ebttb_icon_color', '#ffffff' ) ) . ";
    }
    #backToTop i {
        font-size: " . esc_attr( get_theme_mod( 'ebttb_icon_size', '20px' ) ) . ";
    }";
    wp_add_inline_style( 'ebttb-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'ebttb_add_inline_styles' );

?>