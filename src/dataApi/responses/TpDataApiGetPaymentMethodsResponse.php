<?php
TpUtils::requirePaths(array(
	array('dataApi', 'responses',  'TpDataApiResponse.php'),
	array('dataApi', 'parameters', 'TpDataApiMerchantAccountMethod.php')
));

class TpDataApiGetPaymentMethodsResponse extends TpDataApiResponse {

	protected static $listPaths = array(
		array('methods', 'method')
	);

	/**
	 * @var int|null
	 */
	protected $accountId;

	/**
	 * @var TpDataApiMerchantAccountMethod[]
	 */
	protected $methods = array();

	/**
	 * @param array $response
	 * @return TpDataApiGetPaymentMethodsResponse
	 */
	public static function createFromResponse(array $response) {
		/** @var TpDataApiGetPaymentMethodsResponse $instance */
		$instance = parent::createFromResponse($response);
		$instance->setAccountId($response['accountId']);

		$methods = array();
		foreach($response['methods'] as $method) {
			$methods[] = new TpDataApiMerchantAccountMethod($method);
		}
		unset($method);
		$instance->setMethods($methods);

		return $instance;
	}

	/**
	 * @return int
	 */
	public function getAccountId() {
		return $this->accountId;
	}

	/**
	 * @param int|null $accountId
	 */
	public function setAccountId($accountId = null) {
		$this->accountId = TpValueFormatter::format('int', $accountId);
	}

	/**
	 * @return TpDataApiMerchantAccountMethod[]
	 */
	public function getMethods() {
		return $this->methods;
	}

	/**
	 * @param TpDataApiMerchantAccountMethod[] $methods
	 */
	public function setMethods(array $methods = array()) {
		$this->methods = TpValueFormatter::formatList(
			'TpDataApiMerchantAccountMethod', $methods
		);
	}

}
