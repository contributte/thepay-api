<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, 'TpDataApiResponse.php'));
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, 'TpDataApiMerchantAccountMethod.php'));
class TpDataApiGetPaymentMethodsResponse extends TpDataApiResponse {

	protected static $arrayPaths = array(
		array('methods', 'method')
	);

	/**
	 * @var int
	 */
	protected $accountId;

	/**
	 * @var TpDataApiMerchantAccountMethod[]
	 */
	protected $methods = array();

	public function __construct(TpMerchantConfig $config, stdClass $result) {
		parent::__construct($config, $result);

		$this->accountId = intval($result->accountId);

		if(isset($result->methods->method)) {
			$methods = is_array($result->methods->method) ?
				$result->methods->method :
				array($result->methods->method);
			foreach($methods as $method) {
				$this->methods[] = new TpDataApiMerchantAccountMethod($method);
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