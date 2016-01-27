<?php
TpUtils::requirePaths(array(
	array('dataApi', 'TpDataApiObject.php'),
	array('dataApi', 'parameters', 'TpDataApiSignature.php'),
	array('dataApi', 'processors', 'TpDataApiDateTimeDeflater.php'),
	array('exceptions', 'TpBadMethodCallException.php')
));

abstract class TpDataApiRequest extends TpDataApiObject {

	/**
	 * @var TpMerchantConfig|null
	 */
	protected $_config;

	protected static $dateTimePaths = array();

	/**
	 * Request must contain merchant config data alongside its own: merchant ID,
	 * account ID, password. Thus, requests must be instantiating by this call
	 * instead of their constructor.
	 *
	 * @param TpMerchantConfig $config
	 * @param array $data
	 * @return TpDataApiRequest
	 */
	public static function createWithConfig(TpMerchantConfig $config, $data = array()) {
		$instance = new static($data);
		$instance->_config = $config;
		return $instance;
	}

	/**
	 * Merchant ID and in some request also account ID is prepeneded. Moreover,
	 * SOAP request must not contain DateTime timestamps: They must be cast as
	 * strings.
	 *
	 * @return array
	 * @throws TpBadMethodCallException
	 */
	public function toSoapRequestArray() {
		$configArray = $this->configArray();
		$data = parent::toArray();
		$withConfig = array_merge($configArray, $data);

		$deflated = TpDataApiDateTimeDeflater::processWithPaths(
			$withConfig, static::$dateTimePaths
		);

		return $deflated;
	}

	/**
	 * @return array
	 * @throws TpBadMethodCallException
	 */
	public function toSignedSoapRequestArray() {
		$this->assertConfig();

		$array = $this->toSoapRequestArray();
		$signature = TpDataApiSignature::compute(
			$array, $this->_config->dataApiPassword
		);
		$signatureArray = array('signature' => $signature);

		$signed = array_merge($array, $signatureArray);
		return $signed;
	}

	/**
	 * @return array
	 */
	protected function configArray() {
		$this->assertConfig();

		$configArray = array('merchantId' => $this->_config->merchantId);
		return $configArray;
	}

	/**
	 * @throws TpBadMethodCallException
	 */
	protected function assertConfig() {
		if(!$this->_config) {
			$message = 'TpDataApiRequest instantiated without providing TpMerchantConfig. Use TpDataApiRequest::createWithConfig method instead of new TpDataApiRequest constructor.';
			throw new TpBadMethodCallException($message);
		}
	}

}
