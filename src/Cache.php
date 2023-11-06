<?php

namespace Autive\LeaseBootButton;

class Cache {

	// The following options are hard coded and can be later on changed to be dynamic
	const percentage = 8; // Percentage
	const duration = 180; // Months
	// End of hard coded options

	private string $version = '1';

	private string $plugin_version = '1.0.0';


	public static function get( $option ) {

		switch ( $option ) {
			case 'percentage':
				return self::percentage;
			case 'duration':
				return self::duration;
			default:
				self::check();
				return get_option( 'lease-boot-cache-' . $option, false );
		}

	}

	public static function check(): void {
		$current = time();
		$last    = get_option( 'lease-boot-cache-last-update', 0 );
		$diff    = $current - $last;

		if ( $diff > 60 * 60 * 24 ) {
			self::update();
		}
	}

	public static function update(): void {
		update_option( 'lease-boot-cache-last-update', time() );

		// TODO: Update the cache
		update_option( 'lease-boot-cache-version', 1 );
		update_option( 'lease-boot-cache-plugin-version', '1.0.0' );
	}

}