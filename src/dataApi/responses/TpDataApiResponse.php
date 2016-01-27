<?php
TpUtils::requirePaths(array(
	array('dataApi', 'TpDataApiObject.php'),
	array('dataApi', 'TpValueFormatter.php')
));

class TpDataApiResponse extends TpDataApiObject {

	/**
	 * @var array[]
	 */
	protected static $listPaths = array();

	/**
	 * @var array[]
	 */
	protected static $dateTimePaths = array();

	/**
	 * @var int
	 */
	protected $merchantId;

	/**
	 * @param array $response
	 * @return TpDataApiResponse
	 * @throws TpInvalidSignatureException
	 */
	public static function createFromResponse(array $response) {
		$keys = array('merchantId');
		$data = TpUtils::filterKeys($response, $keys);
		$instance = new static($data);
		return $instance;
	}

	/**
	 * @return array[]
	 */
	public static function listPaths() {
		return static::$listPaths;
	}

	/**
	 * @return array[]
	 */
	public static function dateTimePaths() {
		return static::$dateTimePaths;
	}

	/**
	 * @return int
	 */
	public function getMerchantId() {
		return $this->merchantId;
	}

	/**
	 * @param int $merchantId
	 */
	public function setMerchantId($merchantId) {
		$this->merchantId = TpValueFormatter::format('int', $merchantId);
	}

}
