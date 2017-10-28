<?php
TpUtils::requirePaths(array(
	array('dataApi', 'requests', 'TpDataApiRequest.php'),
	array('dataApi', 'TpValueFormatter.php')
));

class TpDataApiSetPaymentMethodsRequest extends TpDataApiRequest {
	const TYPE_ALL = 'all';
	const TYPE_WHITELIST = 'whitelist';
	
	/**
	 * @var string
	 */
	protected $type = self::TYPE_WHITELIST;
	/**
	 * @var int[]|null
	 */
	protected $paymentMethods = null;

	/**
	 * @return string
	 */
	function getType() {
		return $this->type;
	}
	/**
	 * @param string $type one of TYPE_* constants
	 */
	function setType($type) {
		$this->type = $type;
	}

	/**
	 * @return int[]
	 */
	function getPaymentMethods() {
		return $this->paymentMethods;
	}

	/**
	 * Payment methods which should be available to merchant account
	 * @param int[] $paymentMethods id's of payment methods
	 */
	function setPaymentMethods(array $paymentMethods = null) {
		if($paymentMethods){
			$this->paymentMethods = TpValueFormatter::formatList('int', $paymentMethods);
		}
	}


	/**
	 * @return array
	 */
	protected function configArray() {
		$configArray = parent::configArray();
		$configArray['accountId'] = $this->_config->accountId;
		return $configArray;
	}

}
