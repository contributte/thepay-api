<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, 'TpDataApiResponse.php'));
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, 'TpDataApiPaymentInfo.php'));

class TpDataApiGetPaymentInstructionsResponse extends TpDataApiResponse {

	/**
	 * @var TpDataApiPaymentInfo
	 */
	protected $paymentInfo;

	public function __construct(TpMerchantConfig $config, stdClass $result) {
		parent::__construct($config, $result);

		$this->paymentInfo = new TpDataApiPaymentInfo($result->paymentInfo);
	}

	public function getPaymentInfo() {
		return $this->paymentInfo;
	}

}