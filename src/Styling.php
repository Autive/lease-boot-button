<?php

namespace Autive\LeaseBootButton;

class Styling {

	public static function add(): void {
		// Add styling
		add_action( 'wp_head', array( self::class, 'head' ) );
		add_action( 'admin_head', array( self::class, 'head' ) );
	}

	public static function add_admin(): void {
		add_action( 'admin_head', array( self::class, 'head_admin' ) );
	}

	public static function head(): void {
		?>
		<style>
			#lbb-container {
				display: flex;
				flex-direction: column;
				justify-content: center;
				align-items: center;
				width: 100%;
			}

			#lbb-text {
				display: flex;
				width: 100%;
			}

			#lbb-text p {
				width: 100%;
				margin: 0;
				text-align: <?php echo get_option( 'lease-boot-text-style-alignment', 'center' ); ?>;
				color: <?php echo get_option( 'lease-boot-text-style-color', '#000000' ); ?>;
				font-size: <?php echo get_option( 'lease-boot-text-style-font-size', '1rem' ); ?>;
				font-weight: <?php echo get_option( 'lease-boot-text-style-font-weight', '400' ); ?>;
				padding: <?php echo get_option( 'lease-boot-text-style-padding-y', '10px' ); ?> <?php echo get_option( 'lease-boot-text-style-padding-x', '20px' ); ?>;
			}

			#lbb-button {
				display: flex;
				width: 100%;
				justify-content: <?php echo get_option( 'lease-boot-style-alignment', 'center' ); ?>;
			}

			#lbb-button a {
				background-color: <?php echo get_option( 'lease-boot-style-bg-color', '#FFFFFF' ); ?>;
				color: <?php echo get_option( 'lease-boot-style-font-color', '#000000' ); ?>;
				font-size: <?php echo get_option( 'lease-boot-style-font-size', '1rem' ); ?>;
				font-weight: <?php echo get_option( 'lease-boot-style-font-weight', '400' ); ?>;
				border-radius: <?php echo get_option( 'lease-boot-style-border-radius', '0px' ); ?>;
				border: <?php echo get_option( 'lease-boot-style-border-thickness', '1px' ); ?> solid<?php echo get_option( 'lease-boot-style-border-color', '#000000' ); ?>;
				padding: <?php echo get_option( 'lease-boot-style-padding-y', '10px' ); ?> <?php echo get_option( 'lease-boot-style-padding-x', '20px' ); ?>;
				text-decoration: none;
			}
		</style>
		<?php
	}

	public static function head_admin(): void {
		?>
		<style>
			#boat-settings-wrap {
				display: flex;
				flex-direction: row;
			}

			#boat-settings-wrap > form {
				display: inline-block;
				width: 50%;
			}

			#lease-boat-example-area {
				width: 40%;
				height: 70vh;
				padding: 5vh 5%;
				margin: 5vh 5%;
				display: flex;
				justify-content: center;
				align-items: center;
			}
		</style>
		<?php
	}
}