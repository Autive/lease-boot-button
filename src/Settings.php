<?php

namespace Autive\LeaseBootButton;

class Settings {

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'add_admin_menu' ] );
		add_action( 'admin_init', [ $this, 'register_settings' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_color_picker' ] );
	}

	public function add_admin_menu() {
		add_options_page(
			'Leaseboot Button',
			'Leaseboot Button',
			'manage_options',
			'lease-boot-button',
			[ $this, 'render_settings_page' ]
		);
	}

	public function register_settings() {
		// General settings
		register_setting( 'lease-boot-button-general', 'lease-boot-general-example-bg' );
		register_setting( 'lease-boot-button-general', 'lease-boot-general-example-price' );
		register_setting( 'lease-boot-button-general', 'lease-boot-general-button-text' );
		register_setting( 'lease-boot-button-general', 'lease-boot-general-price-text' );
		register_setting( 'lease-boot-button-general', 'lease-boot-general-deactivate-style' );

		// Button styling settings
		register_setting( 'lease-boot-button-style', 'lease-boot-style-classes' );
		register_setting( 'lease-boot-button-style', 'lease-boot-style-alignment' );
		register_setting( 'lease-boot-button-style', 'lease-boot-style-bg-color' );
		register_setting( 'lease-boot-button-style', 'lease-boot-style-font-color' );
		register_setting( 'lease-boot-button-style', 'lease-boot-style-font-size' );
		register_setting( 'lease-boot-button-style', 'lease-boot-style-font-weight' );
		register_setting( 'lease-boot-button-style', 'lease-boot-style-border-color' );
		register_setting( 'lease-boot-button-style', 'lease-boot-style-border-thickness' );
		register_setting( 'lease-boot-button-style', 'lease-boot-style-border-radius' );
		register_setting( 'lease-boot-button-style', 'lease-boot-style-padding-x' );
		register_setting( 'lease-boot-button-style', 'lease-boot-style-padding-y' );

		// Text styling settings
		register_setting( 'lease-boot-text-style', 'lease-boot-text-deactivate' );
		register_setting( 'lease-boot-text-style', 'lease-boot-text-style-classes' );
		register_setting( 'lease-boot-text-style', 'lease-boot-text-style-alignment' );
		register_setting( 'lease-boot-text-style', 'lease-boot-text-style-color' );
		register_setting( 'lease-boot-text-style', 'lease-boot-text-style-font-size' );
		register_setting( 'lease-boot-text-style', 'lease-boot-text-style-font-weight' );
		register_setting( 'lease-boot-text-style', 'lease-boot-text-style-padding-x' );
		register_setting( 'lease-boot-text-style', 'lease-boot-text-style-padding-y' );

		// Dynamic settings
		register_setting( 'lease-boot-dynamic', 'lease-boot-dynamic-active' );
		register_setting( 'lease-boot-dynamic', 'lease-boot-dynamic-container' );
	}

	public function render_settings_page() {
		$current_tab = $this->get_tab();

		?>
        <div class="wrap" id="boat-settings-wrap">
            <form action="options.php" method="post">
                <h2><?php _e( 'Leaseboot Button Settings', 'autive-lbb' ); ?></h2>

				<?php $this->tabs(); ?>

                <table class="form-table">
					<?php switch ( $current_tab ) {
						case 'button-style':
							$this->render_button_style_settings();
							break;
						case 'text-style':
							$this->render_text_style_settings();
							break;
						case 'dynamic':
							$this->render_dynamic_settings();
							break;
						case 'how-to':
							$this->render_how_to();
							break;
						default:
							$this->render_general_settings();
							break;
					}
					?>
                </table>
				<?php if ( 'how-to' !== $current_tab ) : ?>
					<?php submit_button(); ?>
				<?php endif; ?>
            </form>
            <div id="lease-boat-example-area"
                 style="background-color: <?php echo get_option( 'lease-boot-general-example-bg',
				     '#FFFFFF' ); ?>">

				<?php ( new Button( get_option( 'lease-boot-general-example-price', '50000' ) ) )->html(); ?>
            </div>
        </div>
		<?php
	}

	public function render_general_settings() {
		?>
		<?php settings_fields( 'lease-boot-button-general' ); ?>
		<?php do_settings_sections( 'lease-boot-button-general' ); ?>
        <p><?php _e( 'Here you can change the general settings.',
				'autive-lbb' ) ?></p>
        <tr>
            <th scope="row"><?php _e( 'Example background', 'autive-lbb' ) ?></th>
            <td>
                <input type="text" name="lease-boot-general-example-bg"
                       value="<?php echo get_option( 'lease-boot-general-example-bg', '#FFFFFF' ); ?>"
                       class="lease-boot-general-example-bg" data-default-color="#FFFFFF"/>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Example price', 'autive-lbb' ) ?></th>
            <td>
                <input type="number" step="1" name="lease-boot-general-example-price"
                       value="<?php echo get_option( 'lease-boot-general-example-price', '50000' ); ?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Button text', 'autive-lbb' ) ?></th>
            <td>
                <input type="text" name="lease-boot-general-button-text"
                       value="<?php echo get_option( 'lease-boot-general-button-text', 'Financier nu!' ); ?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Price text', 'autive-lbb' ) ?></th>
            <td>
                <textarea name="lease-boot-general-price-text" id="lease-boot-general-price-text" cols="30"
                          rows="5"><?php echo get_option( 'lease-boot-general-price-text',
		                'Financiering vanaf {price} per maand' ); ?></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <small><?php _e( 'You can use {price} for the monthly price and {amount} for the total cost of the boat.',
						'autive-lbb' ) ?></small>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Deactivate plugin styling', 'autive-lbb' ) ?></th>
            <td>
                <input type="checkbox" name="lease-boot-general-deactivate-style" value="1" <?php checked( 1,
					get_option( 'lease-boot-general-deactivate-style', 0 ) ); ?> />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <small><?php _e( 'If you decide to deactivate the button styling make sure your theme does add the correct styling.',
						'autive-lbb' ) ?></small>
            </td>
        </tr>
		<?php
	}

	public function render_button_style_settings(): void {
		?>
		<?php settings_fields( 'lease-boot-button-style' ); ?>
		<?php do_settings_sections( 'lease-boot-button-style' ); ?>
        <p><?php _e( 'Here you can change the styling of the button.',
				'autive-lbb' ) ?></p>
        <tr>
            <th scope="row"><?php _e( 'Button classes', 'autive-lbb' ) ?></th>
            <td>
                <input type="text" name="lease-boot-style-classes"
                       value="<?php echo get_option( 'lease-boot-style-classes', '' ); ?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Button alignment', 'autive-lbb' ) ?></th>
            <td>
                <select name="lease-boot-style-alignment">
                    <option value="flex-start" <?php selected( 'flex-start',
						get_option( 'lease-boot-style-alignment', 'center' ) ); ?>>
						<?php _e( 'Left', 'autive-lbb' ) ?>
                    </option>
                    <option value="center" <?php selected( 'center',
						get_option( 'lease-boot-style-alignment', 'center' ) ); ?>>
						<?php _e( 'Center', 'autive-lbb' ) ?>
                    </option>
                    <option value="flex-end" <?php selected( 'flex-end',
						get_option( 'lease-boot-style-alignment', 'center' ) ); ?>>
						<?php _e( 'Right', 'autive-lbb' ) ?>
                    </option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Button background color', 'autive-lbb' ) ?></th>
            <td>
                <input type="text" name="lease-boot-style-bg-color"
                       value="<?php echo get_option( 'lease-boot-style-bg-color', '#FFFFFF' ); ?>"
                       class="lease-boot-style-bg-color" data-default-color="#FFFFFF"/>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Button font color', 'autive-lbb' ) ?></th>
            <td>
                <input type="text" name="lease-boot-style-font-color"
                       value="<?php echo get_option( 'lease-boot-style-font-color', '#000000' ); ?>"
                       class="lease-boot-style-text-color" data-default-color="#000000"/>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Button font size', 'autive-lbb' ) ?></th>
            <td>
                <input type="text" name="lease-boot-style-font-size"
                       value="<?php echo get_option( 'lease-boot-style-font-size', '1rem' ); ?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Button font weight', 'autive-lbb' ) ?></th>
            <td>
                <input type="text" name="lease-boot-style-font-weight"
                       value="<?php echo get_option( 'lease-boot-style-font-weight', '400' ); ?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Button border color', 'autive-lbb' ) ?></th>
            <td>
                <input type="text" name="lease-boot-style-border-color"
                       value="<?php echo get_option( 'lease-boot-style-border-color', '#000000' ); ?>"
                       class="lease-boot-style-border-color" data-default-color="#000000"/>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Button border thickness', 'autive-lbb' ) ?></th>
            <td>
                <input type="text" name="lease-boot-style-border-thickness"
                       value="<?php echo get_option( 'lease-boot-style-border-thickness', '1px' ); ?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Button border radius', 'autive-lbb' ) ?></th>
            <td>
                <input type="text" name="lease-boot-style-border-radius"
                       value="<?php echo get_option( 'lease-boot-style-border-radius', '0px' ); ?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Button padding x', 'autive-lbb' ) ?></th>
            <td>
                <input type="text" name="lease-boot-style-padding-x"
                       value="<?php echo get_option( 'lease-boot-style-padding-x', '20px' ); ?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Button padding y', 'autive-lbb' ) ?></th>
            <td>
                <input type="text" name="lease-boot-style-padding-y"
                       value="<?php echo get_option( 'lease-boot-style-padding-y', '10px' ); ?>"/>
            </td>
        </tr>
		<?php
	}

	public function render_text_style_settings(): void {
		settings_fields( 'lease-boot-text-style' );
		do_settings_sections( 'lease-boot-text-style' );
		?>
        <p><?php _e( 'Here you can change the styling of the text. If you decide to not activate the styling make sure your theme does style the text.',
				'autive-lbb' ) ?></p>
        <tr>
            <th scope="row"><?php _e( 'Deactivate text', 'autive-lbb' ) ?></th>
            <td>
                <input type="checkbox" name="lease-boot-text-deactivate" <?php checked( 1,
					get_option( 'lease-boot-text-deactivate', 0 ) ); ?> />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <small><?php _e( 'If you disable the text the monthly price is not shown anymore.',
						'autive-lbb' ) ?></small><br>

            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Text classes', 'autive-lbb' ) ?></th>
            <td>
                <input type="text" name="lease-boot-text-style-classes"
                       value="<?php echo get_option( 'lease-boot-text-style-classes', '' ); ?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Text alignment', 'autive-lbb' ) ?></th>
            <td>
                <select name="lease-boot-text-style-alignment">
                    <option value="left" <?php selected( 'left',
						get_option( 'lease-boot-text-style-alignment', 'center' ) ); ?>>
						<?php _e( 'Left', 'autive-lbb' ) ?>
                    </option>
                    <option value="center" <?php selected( 'center',
						get_option( 'lease-boot-text-style-alignment', 'center' ) ); ?>>
						<?php _e( 'Center', 'autive-lbb' ) ?>
                    </option>
                    <option value="right" <?php selected( 'right',
						get_option( 'lease-boot-text-style-alignment', 'center' ) ); ?>>
						<?php _e( 'Right', 'autive-lbb' ) ?>
                    </option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Text color', 'autive-lbb' ) ?></th>
            <td>
                <input type="text" name="lease-boot-text-style-color"
                       value="<?php echo get_option( 'lease-boot-text-style-color', '#000000' ); ?>"
                       class="lease-boot-text-style-color" data-default-color="#000000"/>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Text font size', 'autive-lbb' ) ?></th>
            <td>
                <input type="text" name="lease-boot-text-style-font-size"
                       value="<?php echo get_option( 'lease-boot-text-style-font-size', '1rem' ); ?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Text font weight', 'autive-lbb' ) ?></th>
            <td>
                <input type="text" name="lease-boot-text-style-font-weight"
                       value="<?php echo get_option( 'lease-boot-text-style-font-weight', '400' ); ?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Text padding x', 'autive-lbb' ) ?></th>
            <td>
                <input type="text" name="lease-boot-text-style-padding-x"
                       value="<?php echo get_option( 'lease-boot-text-style-padding-x', '20px' ); ?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Text padding y', 'autive-lbb' ) ?></th>
            <td>
                <input type="text" name="lease-boot-text-style-padding-y"
                       value="<?php echo get_option( 'lease-boot-text-style-padding-y', '10px' ); ?>"/>
            </td>
        </tr>
		<?php
	}

	public function render_dynamic_settings(): void {
		settings_fields( 'lease-boot-dynamic' );
		do_settings_sections( 'lease-boot-dynamic' );
		?>
        <p><?php _e( 'Here you can change the dynamic settings.', 'autive-lbb' ) ?></p>
        <tr>
            <th scope="row"><?php _e( 'Activate dynamic pricing', 'autive-lbb' ) ?></th>
            <td>
                <input type="checkbox" name="lease-boot-dynamic-active" value="1" <?php checked( 1,
		            get_option( 'lease-boot-dynamic-active', 0 ) ); ?> />

            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Container', 'autive-lbb' ) ?></th>
            <td>
                <input type="text" name="lease-boot-dynamic-container"
                       value="<?php echo get_option( 'lease-boot-dynamic-container', '' ); ?>"/>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <small><?php _e( 'Make sure to add a # or . in this field to be able to target either an id or class.',
						'autive-lbb' ) ?></small><br>
                <small><?php _e( 'We assume you use Dutch currency format (1.000,00) and will strip any non numerical content.',
						'autive-lbb' ) ?></small><br>

            </td>
        </tr>
		<?php
	}

	public function render_how_to() {
		?>
        <tr>
            <th scope="row"><?php _e( 'Shortcode', 'autive-lbb' ) ?></th>
            <td>
                <p><?php _e( 'You can use the shortcode [lease-boot-button] to add the button to your website with the following attributes:',
						'autive-lbb' ) ?></p>
                <p>
                <ul>
                    <li>price: <?php _e( 'The price of the boat', 'autive-lbb' ) ?></li>
                    <li>button_text: <?php _e( 'The text of the button (optional)', 'autive-lbb' ) ?></li>
                    <li>price_text: <?php _e( 'The text of the price (optional)', 'autive-lbb' ) ?></li>
                </ul>
                </p>
                <p>
                    example: <br>
                    <code>[lease-boot-button price="<?php echo get_option( 'lease-boot-general-example-price',
							'50000' ); ?>" button_text="<?php echo get_option( 'lease-boot-general-button-text',
							'Financier nu!' ); ?>"
                        price_text="<?php echo get_option( 'lease-boot-general-price-text',
							'Financiering vanaf {price} per maand' ); ?>"]</code>
                </p>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'PHP', 'autive-lbb' ) ?></th>
            <td>
                <p><?php _e( 'You can use the following PHP code to get an instance of the button:',
						'autive-lbb' ) ?></p>
                <p>
                    <code>&lt;?php $button = new \Autive\LeaseBootButton\Button( $price, $text, $button_txt, $button_classes, $text_deactivate, $text_classes ); ?&gt;</code>
                </p><br>
                <p>
	                <?php _e( 'You can use the following attributes in order to change the button:', 'autive-lbb' ) ?>
                </p>
                <p>
                    <ul>
                        <li><?php _e( '$price (int) the total price of the object, mandatory.', 'autive-lbb'); ?></li>
                        <li><?php _e( '$text (string) the text of the price, optional.', 'autive-lbb'); ?></li>
                        <li><?php _e( '$button_txt (string) the text of the button, optional.', 'autive-lbb'); ?></li>
                        <li><?php _e( '$button_classes (string) the classes of the button, optional.', 'autive-lbb'); ?></li>
                        <li><?php _e( '$text_deactivate (bool) deactivate the text, optional.', 'autive-lbb'); ?></li>
                        <li><?php _e( '$text_classes (string) the classes of the text container, optional.', 'autive-lbb'); ?></li>
                    </ul>
                </p>
                <p>
                    <?php _e( 'You need to add variables in order, so if you only want to disable the text use the following.', 'autive-lbb'); ?>
                </p>
                <p>
                    <code>&lt;?php $button = new \Autive\LeaseBootButton\Button( $price, null, null, null, true, null ); ?&gt;</code>
                </p>
            </td>
        </tr>

        <tr>
            <th scope="row"><?php _e( 'PHP - HTML', 'autive-lbb' ) ?></th>
            <td>
                <p><?php _e( 'Then you can use the following function to render the html:',
						'autive-lbb' ) ?></p>
                <p>
                    <code>&lt;?php $button->html(); ?&gt;</code>
                </p>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'PHP - price', 'autive-lbb' ) ?></th>
            <td>
                <p><?php _e( 'You can use the following PHP code to only get the monthly price:',
						'autive-lbb' ) ?></p>
                <p>
                    <code>&lt;?php $price = $button->get_price(); ?&gt;</code>
                </p>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'PHP - url', 'autive-lbb' ) ?></th>
            <td>
                <p><?php _e( 'You can use the following PHP code to only get the url:',
						'autive-lbb' ) ?></p>
                <p>
                    <code>&lt;?php $url = $button->get_url(); ?&gt;</code>
                </p>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Dynamic pricing', 'autive-lbb' ) ?></th>
            <td>
                <p><?php _e( 'You can use AJAX to make the button dynamic:', 'autive-lbb' ) ?></p>
                <p>
					<?php _e( 'To do this make sure to enable Dynamic pricing on the Dynamic tab,', 'autive-lbb' ) ?>
                    <br>
					<?php _e( 'This will add Javascript to your website which will listen to changes to the price inside the given container.',
						'autive-lbb' ) ?><br>
					<?php _e( 'When the price changes the button will be updated with the correct price, amount and url.',
						'autive-lbb' ) ?><br>
                </p>
            </td>
        </tr>
		<?php
	}

	public function get_tab() {
		if ( isset( $_GET['tab'] ) ) {
			$tab = $_GET['tab'];
		} else {
			$tab = 'general';
		}

		return $tab;
	}

	public function tabs(): void {
		$current = $this->get_tab();

		$tabs = array(
			'general'      => __( 'General', 'autive-lbb' ),
			'button-style' => __( 'Button styling', 'autive-lbb' ),
			'text-style'   => __( 'Text styling', 'autive-lbb' ),
			'dynamic'      => __( 'Dynamic', 'autive-lbb' ),
			'how-to'       => __( 'How to', 'autive-lbb' ),
		);

		?>
        <div id="icon-themes" class="icon32"><br></div>
        <h2 class="nav-tab-wrapper">
			<?php foreach ( $tabs as $tab => $name ) : ?>
                <a class='nav-tab<?php if ( $tab === $current ) {
					echo ' nav-tab-active';
				} ?>' href='?page=lease-boot-button&tab=<?php echo $tab; ?>'><?php echo $name; ?></a>
			<?php endforeach; ?>
        </h2>
		<?php
	}

	public function enqueue_color_picker( $hook_suffix ): void {
		if ( 'settings_page_lease-boot-button' !== $hook_suffix ) {
			return;
		}

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'lease-boot-button-settings',
            plugins_url( '../assets/settings.js', __FILE__ ),
			array( 'wp-color-picker' ),
			date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . '../assets/settings.js' ))
        );
	}
}