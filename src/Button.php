<?php

namespace Autive\LeaseBootButton;

class Button {

	public int $amount;

	public Cache $cache;

	public string $url;

	public string $text;
	public bool $text_deactivate;
	public string $text_classes;

	public function __construct(
		$amount,
		$cache = null,
		$text_deactive = null,
		$text_classes = null,
		$text = null
	) {
		$this->amount          = (int) $amount;
		$this->cache           = $cache ?? new Cache();
		$this->text_deactivate = $text_deactive ?? get_option( 'lease-boot-text-deactivate', false );
		$this->text_classes    = $text_classes ?? get_option( 'lease-boot-text-style-classes', '' );
		$this->text            = $text ?? get_option( 'lease-boot-general-price-text',
			'Financiering vanaf {price} per maand' );
		$this->url             = $this->get_url();
	}

	public function get_url(): string {
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
                <a id="lease-boot-button" href="#"
                   class="<?php echo get_option( 'lease-boot-style-classes' ); ?>"><?php echo get_option( 'lease-boot-general-button-text',
						'Financier nu!' ); ?></a>
            </div>
        </div>
		<?php
	}

	private function format_text() {
		$price  = Price::get( $this->amount );
		$amount = Price::format( $this->amount );
		$text   = str_replace( '{amount}', "<b class='lbb-amount'>$amount</b>", $this->text );

		return str_replace( '{price}', "<b class='lbb-price'>$price</b>", $text );
	}
}