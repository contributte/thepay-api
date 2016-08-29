<?php
TpUtils::requirePaths(array(
	array('TpPayment.php')
));

/**
 * Base class for various ThePay Merchant components.
 */
abstract class TpMerchantHelper {
	/**
	 * Payment that should be rendered using the helper. Specify the
	 * payment as parameter to the helper constructor.
	 * @var TpPayment
	 */
	protected $payment;

	/**
	 * Constructor. Specify the payment object here.
	 * @param payment Instace of the TpPayment method, that contains
	 *   inforamtion about the payment to be made.
	 */
	function __construct(TpPayment $payment) {
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
	 * @param array $args Associative array of optional arguments that should
	 *   be appended to the URL.
	 * @return string Query part of the URL with all parameters correctly escaped
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

		return implode('&', $str);
	}
}
