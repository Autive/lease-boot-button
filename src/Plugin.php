<?php

namespace Autive\LeaseBootButton;

class Plugin
{
    public function __construct()
    {
        $this->load_files();
        $this->load_plugin_text_domain();
        new Settings();

        if (is_admin()) {
            Styling::add_admin();
        }

        if (! get_option('lease-boot-general-deactivate-style', false)) {
            Styling::add();
        }

        new Shortcode();

        if (get_option('lease-boot-dynamic-active', false)) {
            new AJAX();
        }
    }

    public function load_files(): void
    {
        require_once trailingslashit(__DIR__) . 'Styling.php';
        require_once trailingslashit(__DIR__) . 'Price.php';
        require_once trailingslashit(__DIR__) . 'Cache.php';
        require_once trailingslashit(__DIR__) . 'Shortcode.php';
        require_once trailingslashit(__DIR__) . 'Settings.php';
        require_once trailingslashit(__DIR__) . 'AJAX.php';
        require_once trailingslashit(__DIR__) . 'Button.php';
        require_once trailingslashit(__DIR__) . 'Plugin.php';
    }

    public function load_plugin_text_domain(): void
    {
        // Set language domain.
        load_plugin_textdomain(
            'autive-lbb',
            false,
	        dirname( plugin_basename( __FILE__ ) ) . '/../languages'
        );
    }
}
