<?php

/**
 * Elementor Awesomesauce WordPress Plugin
 *
 * @package ElementorAwesomesauce
 *
 * Plugin Name: Widget Test
 * Description: Simple Elementor plugin example
 * Plugin URI:  https://www.google.com/
 * Version:     1.0.0
 * Author:      Saqib
 * Author URI:  https://www.google.com
 * Text Domain: widget-test
 */


if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}


/**
 * Register oEmbed Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_new_widgets( $widgets_manager) {

	require_once( __DIR__ . '/widgets/widget-slider.php' );
	require_once( __DIR__ . '/widgets/widget-post.php' );

	$widgets_manager->register( new \Elementor_slider_Widget() );
	$widgets_manager->register( new \Post_Widget() );

}


add_action( 'elementor/widgets/register', 'register_new_widgets' );






function elementor_test_widgets_dependencies() {

	/* Scripts */
	wp_register_script( 'widget-script-1', plugins_url( 'assets/main.js', __FILE__ ) );
	

	/* Styles */

	wp_register_style( 'widget-style-1', plugins_url( 'assets/style.css', __FILE__ ));

}
add_action( 'wp_enqueue_scripts', 'elementor_test_widgets_dependencies' );



?>