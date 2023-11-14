<?php

namespace Autive\LeaseBootButton;

/**
 * Class Button
 *
 * @package Autive\LeaseBootButton
 */
class Button
{
    /**
     * @var int
     */
    public int $amount;

    /**
     * @var string|false|mixed|null
     */
    public string $text;

    /**
     * @var string|false|mixed|null
     */
    private string $button_txt;

    /**
     * @var string|false|mixed|null
     */
    private string $button_classes;

    /**
     * @var Cache
     */
    public Cache $cache;

    /**
     * @var string
     */
    public string $url;

    /**
     * @var bool|mixed|null
     */
    public bool $text_deactivate;
    /**
     * @var string|false|mixed|null
     */
    public string $text_classes;

    /**
     * Button constructor.
     *
     *
     *
     * @param $amount int|string The amount to finance
     * @param $text string|null The text to display
     * @param $button_txt string|null The text for the button
     * @param $button_classes string|null The classes for the button
     * @param $text_deactive bool|null Deactivate the text
     * @param $text_classes string|null The classes for the text
     */
    public function __construct(
        int|string $amount,
        string $text = null,
        string $button_txt = null,
        string $button_classes = null,
        bool $text_deactive = null,
        string $text_classes = null,
    ) {
        $this->amount          = (int) $amount;
        $this->text            = $text ?? get_option(
            'lease-boot-general-price-text',
            'Financiering vanaf {price} per maand'
        );
        $this->button_txt      = $button_txt ?? get_option('lease-boot-general-button-text', 'Financier nu!');
        $this->button_classes  = $button_classes ?? get_option('lease-boot-general-button-classes', '');
        $this->cache           = new Cache();
        $this->text_deactivate = $text_deactive ?? get_option('lease-boot-text-deactivate', false);
        $this->text_classes    = $text_classes ?? get_option('lease-boot-text-style-classes', '');
        $this->url             = $this->get_url();
    }

    /**
     * Get the url
     *
     * @return string
     */
    public function get_url(): string
    {
        return 'https://www.leaseboot.com/calculator/?amount=' . $this->amount;
    }

    /**
     * Get the price
     *
     * @return string
     */
    public function get_price(): string
    {
        return Price::get($this->amount);
    }

    /**
     * Render the button
     *
     * @return void
     */
    public function html(): void
    {
        ?>
        <div id="lbb-container">
            <?php if (! $this->text_deactivate) : ?>
                <div id="lbb-text">
                    <p class="<?php echo esc_html($this->text_classes); ?>">
                        <?php echo wp_kses_post($this->format_text()); ?>
                    </p>
                </div>
            <?php endif; ?>
            <div id="lbb-button">
                <a id="lease-boot-button" href="<?php echo esc_url($this->get_url()); ?>" target="_blank"
                    class="<?php echo esc_html($this->button_classes); ?>"><?php echo esc_html($this->button_txt); ?></a>
            </div>
        </div>
        <?php
    }

    /**
     * Format the text
     *
     * @return string
     */
    private function format_text(): string
    {
        $price  = Price::get($this->amount);
        $amount = Price::format($this->amount);
        $text   = str_replace('{amount}', "<b id='lbb-amount'>$amount</b>", $this->text);

        return str_replace('{price}', "<b id='lbb-price'>$price</b>", $text);
    }
}