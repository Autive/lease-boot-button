<?php

namespace Autive\LeaseBootButton;

class Plugin
{
    public function __construct()
    {
        $this->load_files();
        $this->load_plugin_text_domain();
		$this->check_version();

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

	public function check_version(): void
	{

		$version = Cache::get('version');
		$plugin_version = Cache::get('plugin-version');

		if ($plugin_version !== 'asdqew') {
			add_action(
				'admin_notices',
				function () {
					?>
					<div class="notice notice-warning">
						<p>
							<b><?php _e('There is a new version of the Bootlease plugin.', 'autive-lbb'); ?></b>
						</p>
						<p>
							<?php _e('There is a new version available for the Bootlease plugin. Download the zip file, 
							go to the plugins page. Click on the button "Add new" and then on the button
							"Upload plugin". Select the downloaded zip file and click on the button "Install now". 
							You will be asked to replace the current plugin with the new version accept when all requirements are met.
							', 'autive-lbb'); ?>
						</p>
						<p>
							<a href="https://bootfinancieringen.nl/wp-content/plugins/bootfinancieringen/leaseboot/lease-boot-button.zip"
							   target="_blank" class="button button-primary">Download plugin</a>
						</p>
					</div>
					<?php
				}
			);
		}
	}
}
