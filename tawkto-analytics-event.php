<?php
/**
 * Plugin Name:     Analytics Events for Tawkto Chat
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     Send an event to Google Analytics when a visitor interacts with the Tawkto Chat widget.
 * Author:          Stefano Garuti
 * Author URI:      YOUR SITE HERE
 * Text Domain:     tawkto-analytics-event
 * Domain Path:     /languages
 * Version:         0.1.0
 * GitHub Plugin URI:
 *
 * @package         Tawkto_Analytics_Event
 */


define( 'TAE_VER', '0.1.0' );
define( 'TAE_URL', plugin_dir_url( __FILE__ ) );

function TAE_load_plugin_textdomain() {
    load_plugin_textdomain( 'tawkto-analytics-event', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'TAE_load_plugin_textdomain' );

add_action( 'wp_enqueue_scripts', 'TAE_enqueue_js' );
function TAE_enqueue_js(){
	wp_enqueue_script( 'tawkto_js', TAE_URL . '/public/js/tawkto-api-client.js', '', TAE_VER, true );
	wp_localize_script( 'tawkto_js', 'TAE_VAR', array(
		'chat_min_lenght' => 60, // seconds
		'eventCategory' => __( 'Chat', 'tawkto-analytics-event' ),
		'eventActionChatOngoing'	=> __( 'Ongoing chat', 'tawkto-analytics-event' ),
		'eventActiononOfflineSubmit' => __( 'Form sent from offline chat', 'tawkto-analytics-event' ),
		'debug'	=> WP_DEBUG,
	));
}
