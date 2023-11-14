<?php

namespace Autive\LeaseBootButton;

class Cache
{
    // The following options are hard coded and can be later on changed to be dynamic
    public const PERCENTAGE = 8; // Percentage
    public const DURATION   = 180; // Months
    // End of hard coded options

    private string $version = '1';

    private string $plugin_version = '1.0.0';

    public static function get($option)
    {

        switch ($option) {
            case 'percentage':
                return self::PERCENTAGE;
            case 'duration':
                return self::DURATION;
            default:
                self::check();
                return get_option('lease-boot-cache-' . $option, false);
        }
    }

    public static function check(): void
    {
        $current = time();
        $last    = get_option('lease-boot-cache-last-update', 0);
        $diff    = $current - $last;

        if ($diff > 60 * 60 * 24) {
            self::update();
        }
    }

    public static function update(): void
    {
		$json = @file_get_contents('https://bootfinancieringen.nl/wp-content/plugins/bootfinancieringen/leaseboot/info.json');
		if ( $json ) {
			$data = json_decode($json, true);
			update_option('lease-boot-cache-last-update', time());
			update_option('lease-boot-cache-version', $data['version'] ?? '1.0.0');
			update_option('lease-boot-cache-plugin-version', $data['plugin-version'] ?? '1.0.0');
		}
    }
}
