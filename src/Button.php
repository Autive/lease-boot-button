<?php

namespace Autive\LeaseBootButton;

class Button {

	public int $amount;

	public string $text;

	private string $button_txt;

    private string $button_classes;

	public Cache $cache;

	public string $url;

	public bool $text_deactivate;
	public string $text_classes;

	public function __construct(
		$amount,
		$text = null,
		$button_txt = null,
		$button_classes = null,
		$text_deactive = null,
		$text_classes = null,
	) {
		$this->amount          = (int) $amount;
		$this->text            = $text ?? get_option( 'lease-boot-general-price-text',
			'Financiering vanaf {price} per maand' );
		$this->button_txt      = $button_txt ?? get_option( 'lease-boot-general-button-text', 'Financier nu!' );
		$this->button_classes  = $button_classes ?? get_option( 'lease-boot-general-button-classes', '' );
		$this->cache           = new Cache();
		$this->text_deactivate = $text_deactive ?? get_option( 'lease-boot-text-deactivate', false );
		$this->text_classes    = $text_classes ?? get_option( 'lease-boot-text-style-classes', '' );
		$this->url             = $this->get_url();
	}

	public function get_url(): string {
        // @TODO: replace with production url
		return "https://staging.leaseboot.com/leasecalculator/?amount=" . $this->amount;
	}

	public function get_price(): string {
		return Price::get( $this->amount );
	}

	public function html(): void {
		?>
        <div id="lbb-container">
			<?php if ( ! $this->text_deactivate ) : ?>
                <div id="lbb-text">
                    <p class="<?php echo $this->text_classes; ?>">
						<?php echo $this->format_text(); ?>
                    </p>
                </div>
			<?php endif; ?>
            <div id="lbb-button">
                <a id="lease-boot-button" href="<?php echo $this->get_url(); ?>" target="_blank"
                   class="<?php echo $this->button_classes; ?>"><?php echo $this->button_txt; ?></a>
            </div>
        </div>
		<?php
	}

	private function format_text() {
		$price  = Price::get( $this->amount );
		$amount = Price::format( $this->amount );
		$text   = str_replace( '{amount}', "<b id='lbb-amount'>$amount</b>", $this->text );

		return str_replace( '{price}', "<b id='lbb-price'>$price</b>", $text );
	}
}