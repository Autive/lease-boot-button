<?php

namespace Autive\LeaseBootButton;

class Price {

	public static function get( $amount ): bool|string {
		$percentage = Cache::get( 'percentage' );
		$duration   = Cache::get( 'duration' );
		$amount = (int) $amount;
		$amount = str_replace( ',', '.', $amount );
		$price =  $amount * ($percentage / 1200) / (1 - (pow(1/(1 + ($percentage / 1200)), $duration)));
		return self::format( $price );
	}

	public static function format( $price ) : bool|string {
		$fmt    = new \NumberFormatter( 'nl_NL', \NumberFormatter::CURRENCY );
		$fmt->setTextAttribute( \NumberFormatter::CURRENCY_CODE, 'EUR' );
		$fmt->setAttribute( \NumberFormatter::FRACTION_DIGITS, 2 );
		return $fmt->formatCurrency( $price, 'EUR' );
	}
}