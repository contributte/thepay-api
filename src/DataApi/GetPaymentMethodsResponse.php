<?php

namespace Tp\DataApi;

use Tp;

class GetPaymentMethodsResponse extends Response {

	protected static $arrayPaths = array(
		array('methods', 'method')
	);

	/**
	 * @var int
	 */
	protected $accountId;

	/**
	 * @var MerchantAccountMethod[]
	 */
	protected $methods = array();

	public function __construct(Tp\MerchantConfig $config, \stdClass $result) {
		parent::__construct($config, $result);

		$this->accountId = intval($result->accountId);

		if(isset($result->methods->method)) {
			$methods = is_array($result->methods->method) ?
				$result->methods->method :
				array($result->methods->method);
			foreach($methods as $method) {
				$this->methods[] = new MerchantAccountMethod($method);
			}
		}
	}

	public function getAccountId() {
		return $this->accountId;
	}

	public function getMethods() {
		return $this->methods;
	}
}
