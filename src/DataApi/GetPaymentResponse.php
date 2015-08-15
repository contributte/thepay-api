<?php

namespace Tp\DataApi;

use Tp;

class GetPaymentResponse extends Response {

	/**
	 * @var Payment
	 */
	protected $payment;

	public function __construct(Tp\MerchantConfig $config, \stdClass $result) {
		parent::__construct($config, $result);

		$this->payment = new Payment($result->payment);
	}

	public function getPayment() {
		return $this->payment;
	}
}
