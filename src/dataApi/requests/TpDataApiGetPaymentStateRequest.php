<?php
TpUtils::requirePaths(array(
	array('dataApi', 'requests', 'TpDataApiRequest.php'),
	array('dataApi', 'TpValueFormatter.php')
));

class TpDataApiGetPaymentStateRequest extends TpDataApiRequest {

	/**
	 * @var int|null
	 */
	protected $paymentId;

	/**
	 * @return int|null
	 */
	public function getPaymentId() {
		return $this->paymentId;
	}

	/**
	 * @param int|null $paymentId
	 */
	public function setPaymentId($paymentId = null) {
		$this->paymentId = TpValueFormatter::format('int', $paymentId);
	}

}
