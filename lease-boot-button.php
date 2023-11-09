<?php
/**
 * Autive - Lease Boot Button plugin
 *
 * @package   Autive_LeaseBootButton
 * @version   1.0.0
 * @author    Autive <info@autive.nl>
 * @license   GPL-2.0+
 * @link      https://www.autive.nl
 * @copyright 2023 Autive
 *
 * @wordpress-plugin
 *
 * Plugin Name:       Lease Boot Button plugin
 * Plugin URI:        https://www.leaseboot.com
 * Description:       A plugin to add the leaseboot.com button to a website.
 * Version:           1.0.0
 * Requires at least: 5.8
 * Requires PHP:      8.0
 * Author:            Autive
 * Author URI:        https://autive.nl
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       autive-lbb
 * Domain Path:       /languages
 */

use Autive\LeaseBootButton\Plugin;

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

const LEASE_BOOT_BUTTON_VERSION = '1.0.0';

try {
	require_once trailingslashit(__DIR__) . 'src/Plugin.php';
	new Plugin();
} catch (Exception $exception) {
	error_log( print_r( [
		'plugin' => 'lease-boot-button',
		'exception' => $exception,
		'class' => get_class($exception),
	], true ) );
}

