<?php

namespace Autive\LeaseBootButton;

class Shortcode
{
    public function __construct()
    {
        add_shortcode('lease-boot-button', array( $this, 'shortcode' ));
    }

    public function shortcode($atts): string|bool
    {
        $atts = shortcode_atts(
            array(
                'price'       => '',
                'button_text' => get_option('lease-boot-general-button-text', 'Financier nu!'),
                'price_text'  => get_option('lease-boot-general-price-text', 'Financiering vanaf {price} per maand'),
            ),
            $atts,
            'lease-boot-button'
        );

        $price       = $atts['price'];
        $button_text = $atts['button_text'];
        $price_text  = $atts['price_text'];

        ob_start();
        ( new Button($price, $price_text, $button_text) )->html();
        return ob_get_clean();
    }
}
