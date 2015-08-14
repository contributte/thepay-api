<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, 'TpDataApiSignedArray.php'));
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, 'TpDataApiObject.php'));
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'exceptions', 'TpInvalidSignatureException.php'));
class TpDataApiResponse extends TpDataApiObject {

	/**
	 * @var array
	 */
	protected static $arrayPaths = array();

	/**
	 * @var int
	 */
	protected $merchantId;

	public function __construct(TpMerchantConfig $config, stdClass $result) {
		$this->validateSignature($config, $result);

		$this->merchantId = static::formatInt($result->merchantId, false);
	}

	public function getMerchantId() {
		return $this->merchantId;
	}

	protected static function validateSignature(TpMerchantConfig $config, stdClass $result) {
		$resultSigned = TpDataApiSignedArray::createFromStdClass(
			$result,
			$config->dataApiPassword,
			static::$arrayPaths
		);
		if(!$resultSigned->valid()) {
			throw new TpInvalidSignatureException;
		}
	}

}