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
		'enable_sending_event_when_chat_is_ongoing_for_xx_seconds_0' => 1,
		'minimum_chat_duration_for_trigger_the_event_1' => 60,
		'analytics_event_category_for_ongoing_2' => __( 'Chat', 'tawkto-analytics-event' ),
		'analytics_event_action_for_ongoing_3' => __( 'Chat', 'tawkto-analytics-event' ),
		'enable_sending_event_when_a_form_from_an_offline_chat_is_submitted_4' => 1,
		'analytics_event_category_for_offline_5' => __( 'Ongoing chat', 'tawkto-analytics-event' ),
		'analytics_event_action_for_offline_6' => __( 'Form sent from offline chat', 'tawkto-analytics-event' ),
	);
	add_option( 'analytics_events_for_tawkto_chat_option_name', $settings );
}

function TAE_deactivate(){
	delete_option( 'analytics_events_for_tawkto_chat_option_name' );
}

add_action( 'wp_enqueue_scripts', 'TAE_enqueue_js' );
function TAE_enqueue_js(){
	wp_enqueue_script( 'tawkto_js', TAE_URL . '/public/js/tawkto-api-client.js', '', TAE_VER, true );

	$analytics_events_for_tawkto_chat_options = get_option( 'analytics_events_for_tawkto_chat_option_name' ); // Array of All Options

	$analytics_events_for_tawkto_chat_options['enable_sending_event_when_chat_is_ongoing_for_xx_seconds_0']; // Enable sending Event when Chat is OnGoing for XX seconds
	$enable_sending_event_when_a_form_from_an_offline_chat_is_submitted_4 = $analytics_events_for_tawkto_chat_options['enable_sending_event_when_a_form_from_an_offline_chat_is_submitted_4']; // Enable sending Event when a form from an offline Chat is submitted

	wp_localize_script( 'tawkto_js', 'TAE_VAR', array(
		'chat_min_lenght' => $analytics_events_for_tawkto_chat_options['minimum_chat_duration_for_trigger_the_event_1'], // Minimum Chat duration for trigger the event
		'eventCategoryChatOngoing' => $analytics_events_for_tawkto_chat_options['analytics_event_category_for_ongoing_2'], // Analytics Event Category for Ongoing,
		'eventCategoryonOfflineSubmit' => $analytics_events_for_tawkto_chat_options['analytics_event_action_for_ongoing_3'], // Analytics Event Action for Ongoing,
		'eventActionChatOngoing'	=> $analytics_events_for_tawkto_chat_options['analytics_event_category_for_offline_5'], // Analytics Event Category for Offline
		'eventActiononOfflineSubmit' => $analytics_events_for_tawkto_chat_options['analytics_event_action_for_offline_6'], // Analytics Event Action for Offline
		'debug'	=> WP_DEBUG,
	));
}
