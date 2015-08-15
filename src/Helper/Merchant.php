<?php

namespace Tp\Helper;

use Tp;

/**
 * Base class for various ThePay Merchant components.
 */
abstract class Merchant {
	/**
	 * Payment that should be rendered using the helper. Specify the
	 * payment as parameter to the helper constructor.
	 * @var Tp\Payment
	 */
	protected $payment;

	/**
	 * Constructor. Specify the payment object here.
	 * @param payment Instace of the Tp\Payment method, that contains
	 *   inforamtion about the payment to be made.
	 */
	function __construct(Tp\Payment $payment) {
		$this->payment = $payment;
	}

	/**
	 * Call this function to render the code for the component. This
	 * is abstract function prototype, that should be implemented in
	 * derived classes to provide custom HTML (or other) code.
	 */
	abstract function render();

	/**
	 * Build the query part of the URL from payment data and optional
	 * helper data.
	 * @param args Associative array of optional arguments that should
	 *   be appended to the URL.
	 * @return Query part of the URL with all parameters correctly escaped
	 *
	 */
	function buildQuery($args = array()) {
		$out = array_merge(
			$this->payment->getArgs(), // Arguments of the payment
			$args, // Optional helper arguments
			array("signature" => $this->payment->getSignature()) // Signature
		);

		$str = array();
		foreach ($out as $key=>$val) {
			$str[] = rawurlencode($key)."=".rawurlencode($val);
		}

		return implode("&amp;", $str);
	}
}
