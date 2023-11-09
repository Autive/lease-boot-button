<?php

namespace Autive\LeaseBootButton;

/**
 * Class AJAX
 *
 * @package Autive\LeaseBootButton
 */
class AJAX
{
    public string $container;

    /**
     * AJAX constructor.
     */
    public function __construct()
    {

        $this->container = get_option('lease-boot-dynamic-container', false);

        if (empty($this->container)) {
            $this->admin_notice();
        } else {
            add_action('wp_enqueue_scripts', array( $this, 'enqueue_script' ));
            add_action('wp_ajax_lease_boot_button_get_price', array( $this, 'get_price' ));
            add_action('wp_ajax_nopriv_lease_boot_button_get_price', array( $this, 'get_price' ));
        }
    }

    /**
     * Enqueue the AJAX script
     */
    public function enqueue_script(): void
    {
        wp_enqueue_script(
            'lease-boot-dynamic',
            plugins_url('../assets/dynamic.js', __FILE__),
            array( 'wp-util' ),
            date('ymd-Gis', filemtime(plugin_dir_path(__FILE__) . '../assets/dynamic.js')),
            array( 'in_footer' => true )
        );

        wp_localize_script(
            'lease-boot-dynamic',
            'lbb_vars',
            array(
                'ajax_url'  => admin_url('admin-ajax.php'),
                'container' => $this->container,
            )
        );
    }

    /**
     * Get the price via AJAX
     */
    public function get_price(): void
    {
        $amount           = $_POST['amount'];
        $price            = Price::get($amount);
        $amount_formatted = Price::format($amount);

        wp_send_json_success(
            array(
                'price'            => $price,
                'amount'           => $amount,
                'amount_formatted' => $amount_formatted,
            )
        );
    }

    /**
     * Admin notice if the dynamic container is not set
     */
    public function admin_notice(): void
    {
        add_action(
            'admin_notices',
            function () {
                $class   = 'notice notice-error';
                $message = __(
                    'You need to set the Dynamic container in the Leaseboot plugin settings to make it work dynamically.',
                    'autive-lbb'
                );

                printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
            }
        );
    }
}
