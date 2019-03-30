<?php declare(strict_types = 1);

namespace Tp\Helper;

use Tp\Payment;

/**
 * Base class for various ThePay Merchant components.
 */
abstract class Merchant
{

	/**
	 * Payment that should be rendered using the helper. Specify the
	 * payment as parameter to the helper constructor.
	 *
	 * @var Payment
	 */
	protected $payment;

	/**
	 * Constructor. Specify the payment object here.
	 *
	 * @param Payment $payment Instace of the Tp\TpPayment method, that contains
	 *                         inforamtion about the payment to be made.
	 */
	public function __construct(Payment $payment)
	{
		$this->payment = $payment;
	}

	/**
	 * Call this function to render the code for the component. This
	 * is abstract function prototype, that should be implemented in
	 * derived classes to provide custom HTML (or other) code.
	 */
	abstract public function render(): string;

	/**
	 * Build the query part of the URL from payment data and optional
	 * helper data.
	 *
	 * @param array $args Associative array of optional arguments that should
	 *                    be appended to the URL.
	 * @return string Query part of the URL with all parameters correctly escaped
	 */
	public function buildQuery(array $args = []): string
	{
		$out = array_merge(
			$this->payment->getArgs(), // Arguments of the payment
			$args, // Optional helper arguments
			['signature' => $this->payment->getSignature()] // Signature
		);

		$str = [];
		/** @var string|int $val */
		foreach ($out as $key => $val) {
			$str[] = rawurlencode((string) $key) . '=' . rawurlencode((string) $val);
		}

		return implode('&', $str);
	}

}
