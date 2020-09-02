<?php
/**
 * Plugin Name:     Analytics Events for Tawkto Chat
 * Plugin URI:      https://github.com/garubi/tawkto-analytics-event
 * Description:     Send an event to Google Analytics when a visitor interacts with the Tawkto Chat widget.
 * Author:          Stefano Garuti
 * Author URI:      https://garuti.it
 * Text Domain:     tawkto-analytics-event
 * Domain Path:     /languages
 * Version:         1.0.1
 * GitHub Plugin URI: https://github.com/garubi/tawkto-analytics-event
 *
 * @package         Tawkto_Analytics_Event
 */


define( 'TAE_VER', '1.0.1' );
define( 'TAE_URL', plugin_dir_url( __FILE__ ) );
define( 'TAE_PATH', trailingslashit(plugin_dir_path(__FILE__) ) );

require_once( TAE_PATH . 'admin/settings.php');

function TAE_load_plugin_textdomain() {
    load_plugin_textdomain( 'tawkto-analytics-event', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'TAE_load_plugin_textdomain' );

register_activation_hook( __FILE__, 'TAE_activate' );
register_deactivation_hook( __FILE__, 'TAE_deactivate');

function TAE_activate(){
	$settings = array (
		'enable_ongoing' => 1,
		'chat_duration' => 60,
		'analytics_event_category_for_ongoing' => __( 'Chat', 'tawkto-analytics-event' ),
		'analytics_event_action_for_ongoing' => __( 'Chat', 'tawkto-analytics-event' ),
		'enable_offline' => 1,
		'analytics_event_category_for_offline' => __( 'Ongoing chat', 'tawkto-analytics-event' ),
		'analytics_event_action_for_offline' => __( 'Form sent from offline chat', 'tawkto-analytics-event' ),
	);
	add_option( 'TAE_options', $settings );
}

function TAE_deactivate(){
	delete_option( 'TAE_options' );
}

add_action( 'wp_enqueue_scripts', 'TAE_enqueue_js' );
function TAE_enqueue_js(){
	wp_enqueue_script( 'tawkto_js', TAE_URL . '/public/js/tawkto-api-client.js', '', TAE_VER, true );

	$tae_options = get_option( 'TAE_options' ); // Array of All Options



	wp_localize_script( 'tawkto_js', 'TAE_VAR', array(
		'enable_ongoing'	=> $tae_options['enable_ongoing'], // Enable sending Event when Chat is OnGoing for XX seconds
		'enable_offline'	=> $tae_options['enable_offline'], // Enable sending Event when a form from an offline Chat is submitted
		'chat_min_lenght'	=> $tae_options['chat_duration'], // Minimum Chat duration for trigger the event
		'eventCategoryChatOngoing' => $tae_options['analytics_event_category_for_ongoing'], // Analytics Event Category for Ongoing,
		'eventCategoryonOfflineSubmit' => $tae_options['analytics_event_action_for_ongoing'], // Analytics Event Action for Ongoing,
		'eventActionChatOngoing'	=> $tae_options['analytics_event_category_for_offline'], // Analytics Event Category for Offline
		'eventActiononOfflineSubmit' => $tae_options['analytics_event_action_for_offline'], // Analytics Event Action for Offline
		'debug'	=> WP_DEBUG,
	));
}
