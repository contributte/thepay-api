<?php
TpUtils::requirePaths(array(
	array('dataApi', 'responses',  'TpDataApiResponse.php')
));

class TpDataApiSetPaymentMethodsResponse extends TpDataApiResponse {
	const STATUS_OK = 'OK';
	const STATUS_ERROR = 'ERROR';
	
	/**
	 * @var int
	 */
	protected $accountId;
	/**
	 * @var string
	 */
	protected $status;
	
	/**
	 * @param array $response
	 * @return TpDataApiSetPaymentMethodsResponse
	 */
	public static function createFromResponse(array $response) {
		$keys = array('merchantId', 'accountId', 'status');
		$data = TpUtils::filterKeys($response, $keys);
		$instance = new static($data);
		return $instance;
	}

	/**
	 * @return int
	 */
	public function getAccountId() {
		return $this->accountId;
	}

	/**
	 * @param int $accountId
	 */
	public function setAccountId($accountId) {
		$this->accountId = TpValueFormatter::format('int', $accountId);
	}
	
	/**
	 * @return string
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @param string $status
	 */
	public function setStatus($status = null) {
		$this->status = TpValueFormatter::formatString($status);
	}
}
