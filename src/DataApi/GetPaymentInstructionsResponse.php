<?php

namespace Tp\DataApi;

use Tp;

class GetPaymentInstructionsResponse extends Response {

	/**
	 * @var PaymentInfo
	 */
	protected $paymentInfo;

	public function __construct(Tp\MerchantConfig $config, \stdClass $result) {
		parent::__construct($config, $result);

		$this->paymentInfo = new PaymentInfo($result->paymentInfo);
	}

	public function getPaymentInfo() {
		return $this->paymentInfo;
	}
}
