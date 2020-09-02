<?php
/**
 * Generated by the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */

class AnalyticsEventsForTawktoChat {
	private $tae_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'analytics_events_for_tawkto_chat_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'analytics_events_for_tawkto_chat_page_init' ) );
	}

	public function analytics_events_for_tawkto_chat_add_plugin_page() {
		add_options_page(
			__( 'Analytics Events for Tawk.to Chat Configuration', 'tawkto-analytics-event' ), // page_title
			__( 'Tawk.to Chat Analytics', 'tawkto-analytics-event' ), // menu_title
			'manage_options', // capability
			'analytics-events-for-tawkto-chat', // menu_slug
			array( $this, 'analytics_events_for_tawkto_chat_create_admin_page' ) // function
		);
	}

	public function analytics_events_for_tawkto_chat_create_admin_page() {
		$this->analytics_events_for_tawkto_chat_options = get_option( 'TAE_options' ); ?>

		<div class="wrap">
			<h2>Analytics Events for Tawkto Chat Configuration</h2>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'analytics_events_for_tawkto_chat_option_group' );
					do_settings_sections( 'analytics-events-for-tawkto-chat-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function analytics_events_for_tawkto_chat_page_init() {
		register_setting(
			'analytics_events_for_tawkto_chat_option_group', // option_group
			'TAE_options', // option_name
			array( $this, 'analytics_events_for_tawkto_chat_sanitize' ) // sanitize_callback
		);


		add_settings_section(
			'analytics_events_for_tawkto_chat_setting_section_ongoing', // id
			__( 'Ongoing Chat event', 'tawkto-analytics-event' ), // title
			array( $this, 'analytics_events_for_tawkto_chat_section_info' ), // callback
			'analytics-events-for-tawkto-chat-admin' // page
		);

		add_settings_field(
			'enable_ongoing', // id
			__( 'Enable sending Event when Chat is OnGoing for XX seconds', 'tawkto-analytics-event' ), // title
			array( $this, 'enable_ongoing_callback' ), // callback
			'analytics-events-for-tawkto-chat-admin', // page
			'analytics_events_for_tawkto_chat_setting_section_ongoing' // section
		);

		add_settings_field(
			'chat_duration', // id
			__( 'Minimum Chat duration for trigger the event (seconds)', 'tawkto-analytics-event' ), // title
			array( $this, 'chat_duration_callback' ), // callback
			'analytics-events-for-tawkto-chat-admin', // page
			'analytics_events_for_tawkto_chat_setting_section_ongoing' // section
		);

		add_settings_field(
			'analytics_event_category_for_ongoing', // id
			__( 'Analytics Event Category for Ongoing', 'tawkto-analytics-event' ), // title
			array( $this, 'analytics_event_category_for_ongoing_callback' ), // callback
			'analytics-events-for-tawkto-chat-admin', // page
			'analytics_events_for_tawkto_chat_setting_section_ongoing' // section
		);

		add_settings_field(
			'analytics_event_action_for_ongoing', // id
			__( 'Analytics Event Action for Ongoing', 'tawkto-analytics-event' ), // title
			array( $this, 'analytics_event_action_for_ongoing_callback' ), // callback
			'analytics-events-for-tawkto-chat-admin', // page
			'analytics_events_for_tawkto_chat_setting_section_ongoing' // section
		);

		add_settings_section(
			'analytics_events_for_tawkto_chat_setting_section_offline', // id
			__( 'Offline Chat event', 'tawkto-analytics-event' ), // title
			array( $this, 'analytics_events_for_tawkto_chat_section_info' ), // callback
			'analytics-events-for-tawkto-chat-admin' // page
		);

		add_settings_field(
			'enable_offline', // id
			__( 'Enable sending Event when a form from an offline Chat is submitted', 'tawkto-analytics-event' ), // title
			array( $this, 'enable_offline_callback' ), // callback
			'analytics-events-for-tawkto-chat-admin', // page
			'analytics_events_for_tawkto_chat_setting_section_offline' // section
		);

		add_settings_field(
			'analytics_event_category_for_offline', // id
			__( 'Analytics Event Category for Offline', 'tawkto-analytics-event' ), // title
			array( $this, 'analytics_event_category_for_offline_callback' ), // callback
			'analytics-events-for-tawkto-chat-admin', // page
			'analytics_events_for_tawkto_chat_setting_section_offline' // section
		);

		add_settings_field(
			'analytics_event_action_for_offline', // id
			__( 'Analytics Event Action for Offline', 'tawkto-analytics-event' ), // title
			array( $this, 'analytics_event_action_for_offline_callback' ), // callback
			'analytics-events-for-tawkto-chat-admin', // page
			'analytics_events_for_tawkto_chat_setting_section_offline' // section
		);
	}

	public function analytics_events_for_tawkto_chat_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['enable_ongoing'] ) ) {
			$sanitary_values['enable_ongoing'] = $input['enable_ongoing'];
		}

		if ( isset( $input['chat_duration'] ) ) {
			$sanitary_values['chat_duration'] = sanitize_text_field( $input['chat_duration'] );
		}

		if ( isset( $input['analytics_event_category_for_ongoing'] ) ) {
			$sanitary_values['analytics_event_category_for_ongoing'] = sanitize_text_field( $input['analytics_event_category_for_ongoing'] );
		}

		if ( isset( $input['analytics_event_action_for_ongoing'] ) ) {
			$sanitary_values['analytics_event_action_for_ongoing'] = sanitize_text_field( $input['analytics_event_action_for_ongoing'] );
		}

		if ( isset( $input['enable_offline'] ) ) {
			$sanitary_values['enable_offline'] = $input['enable_offline'];
		}

		if ( isset( $input['analytics_event_category_for_offline'] ) ) {
			$sanitary_values['analytics_event_category_for_offline'] = sanitize_text_field( $input['analytics_event_category_for_offline'] );
		}

		if ( isset( $input['analytics_event_action_for_offline'] ) ) {
			$sanitary_values['analytics_event_action_for_offline'] = sanitize_text_field( $input['analytics_event_action_for_offline'] );
		}

		return $sanitary_values;
	}

	public function analytics_events_for_tawkto_chat_section_info() {

	}

	public function enable_ongoing_callback() {
		printf(
			'<input type="checkbox" name="TAE_options[enable_ongoing]" id="enable_ongoing" value="1" %s>',
			( isset( $this->analytics_events_for_tawkto_chat_options['enable_ongoing'] ) && $this->analytics_events_for_tawkto_chat_options['enable_ongoing'] == '1' ) ? 'checked' : ''
		);
	}

	public function chat_duration_callback() {
		printf(
			'<input class="regular-text" type="text" name="TAE_options[chat_duration]" id="chat_duration" value="%s">',
			isset( $this->analytics_events_for_tawkto_chat_options['chat_duration'] ) ? esc_attr( $this->analytics_events_for_tawkto_chat_options['chat_duration']) : ''
		);
	}

	public function analytics_event_category_for_ongoing_callback() {
		printf(
			'<input class="regular-text" type="text" name="TAE_options[analytics_event_category_for_ongoing]" id="analytics_event_category_for_ongoing" value="%s">',
			isset( $this->analytics_events_for_tawkto_chat_options['analytics_event_category_for_ongoing'] ) ? esc_attr( $this->analytics_events_for_tawkto_chat_options['analytics_event_category_for_ongoing']) : ''
		);
	}

	public function analytics_event_action_for_ongoing_callback() {
		printf(
			'<input class="regular-text" type="text" name="TAE_options[analytics_event_action_for_ongoing]" id="analytics_event_action_for_ongoing" value="%s">',
			isset( $this->analytics_events_for_tawkto_chat_options['analytics_event_action_for_ongoing'] ) ? esc_attr( $this->analytics_events_for_tawkto_chat_options['analytics_event_action_for_ongoing']) : ''
		);
	}

	public function enable_offline_callback() {
		printf(
			'<input type="checkbox" name="TAE_options[enable_offline]" id="enable_offline" value="1" %s>',
			( isset( $this->analytics_events_for_tawkto_chat_options['enable_offline'] ) && $this->analytics_events_for_tawkto_chat_options['enable_offline'] == '1' ) ? 'checked' : ''
		);
	}

	public function analytics_event_category_for_offline_callback() {
		printf(
			'<input class="regular-text" type="text" name="TAE_options[analytics_event_category_for_offline]" id="analytics_event_category_for_offline" value="%s">',
			isset( $this->analytics_events_for_tawkto_chat_options['analytics_event_category_for_offline'] ) ? esc_attr( $this->analytics_events_for_tawkto_chat_options['analytics_event_category_for_offline']) : ''
		);
	}

	public function analytics_event_action_for_offline_callback() {
		printf(
			'<input class="regular-text" type="text" name="TAE_options[analytics_event_action_for_offline]" id="analytics_event_action_for_offline" value="%s">',
			isset( $this->analytics_events_for_tawkto_chat_options['analytics_event_action_for_offline'] ) ? esc_attr( $this->analytics_events_for_tawkto_chat_options['analytics_event_action_for_offline']) : ''
		);
	}

}
if ( is_admin() )
	$analytics_events_for_tawkto_chat = new AnalyticsEventsForTawktoChat();

/*
 * Retrieve this value with:
 * $tae_options = get_option( 'TAE_options' ); // Array of All Options
 * $enable_ongoing = $tae_options['enable_ongoing']; // Enable sending Event when Chat is OnGoing for XX seconds
 * $chat_duration = $tae_options['chat_duration']; // Minimum Chat duration for trigger the event
 * $analytics_event_category_for_ongoing = $tae_options['analytics_event_category_for_ongoing']; // Analytics Event Category for Ongoing
 * $analytics_event_action_for_ongoing = $tae_options['analytics_event_action_for_ongoing']; // Analytics Event Action for Ongoing
 * $enable_offline = $tae_options['enable_offline']; // Enable sending Event when a form from an offline Chat is submitted
 * $analytics_event_category_for_offline = $tae_options['analytics_event_category_for_offline']; // Analytics Event Category for Offline
 * $analytics_event_action_for_offline = $tae_options['analytics_event_action_for_offline']; // Analytics Event Action for Offline
 */
