<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, 'TpDataApiResponse.php'));
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, 'TpDataApiPayment.php'));

class TpDataApiGetPaymentResponse extends TpDataApiResponse {

	/**
	 * @var TpDataApiPayment
	 */
	protected $payment;

	public function __construct(TpMerchantConfig $config, stdClass $result) {
		parent::__construct($config, $result);

		$this->payment = new TpDataApiPayment($result->payment);
	}

	public function getPayment() {
		return $this->payment;
	}

}