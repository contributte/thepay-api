<?php

namespace Tp\DataApi;

use Tp;

class Response extends Object {

	/**
	 * @var array
	 */
	protected static $arrayPaths = array();

	/**
	 * @var int
	 */
	protected $merchantId;

	public function __construct(Tp\MerchantConfig $config, \stdClass $result) {
		$this->validateSignature($config, $result);

		$this->merchantId = static::formatInt($result->merchantId, false);
	}

	public function getMerchantId() {
		return $this->merchantId;
	}

	protected static function validateSignature(Tp\MerchantConfig $config, \stdClass $result) {
		$resultSigned = SignedArray::createFromStdClass(
			$result,
			$config->dataApiPassword,
			static::$arrayPaths
		);
		if(!$resultSigned->valid()) {
			throw new Tp\InvalidSignatureException;
		}
	}
}
