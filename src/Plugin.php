<?php

namespace Autive\LeaseBootButton;

class Plugin {

	public function __construct() {
		$this->load_plugin_text_domain();
		new Settings();

		if ( is_admin() ) {
			Styling::add_admin();
		}

		if ( ! get_option( 'lease-boot-general-deactivate-style', false ) ) {
            Styling::add();
		}

		new Shortcode();

		if ( get_option( 'lease-boot-dynamic-active', false ) ) {
			new AJAX();
		}

		// Add settings
		// add cache settings

		// Shortcode
		// PHP function echo
		// PHP functions to get price / url
		// Ajax update price
		// Ajax hook to get price
	}

	public function load_plugin_text_domain(): void {
		// Set language domain.
		load_plugin_textdomain(
			'autive-lbb',
			false,
			'/languages'
		);
	}


}