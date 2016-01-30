<?php

namespace Tp\DataApi\Requests;

use Tp\BadMethodCallException;
use Tp\DataApi\Object;
use Tp\DataApi\Processors\DateTimeDeflater;
use Tp\DataApi\Parameters\Signature;
use Tp\MerchantConfig;

abstract class Request extends Object
{

	/**
	 * @var \Tp\MerchantConfig|null
	 */
	protected $_config;

	protected static $dateTimePaths = [];

	/**
	 * Request must contain merchant config data alongside its own: merchant ID,
	 * account ID, password. Thus, requests must be instantiating by this call
	 * instead of their constructor.
	 *
	 * @param \Tp\MerchantConfig $config
	 * @param array              $data
	 *
	 * @return Request
	 */
	public static function createWithConfig(MerchantConfig $config, $data = [])
	{
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
	 * @throws BadMethodCallException
	 */
	public function toSoapRequestArray()
	{
		$configArray = $this->configArray();
		$data = parent::toArray();
		$withConfig = array_merge($configArray, $data);

		$deflated = DateTimeDeflater::processWithPaths(
			$withConfig, static::$dateTimePaths
		);

		return $deflated;
	}

	/**
	 * @return array
	 * @throws BadMethodCallException
	 */
	public function toSignedSoapRequestArray()
	{
		$this->assertConfig();

		$array = $this->toSoapRequestArray();
		$signature = Signature::compute(
			$array, $this->_config->dataApiPassword
		);
		$signatureArray = ['signature' => $signature];

		$signed = array_merge($array, $signatureArray);

		return $signed;
	}

	/**
	 * @return array
	 */
	protected function configArray()
	{
		$this->assertConfig();

		$configArray = ['merchantId' => $this->_config->merchantId];

		return $configArray;
	}

	/**
	 * @throws BadMethodCallException
	 */
	protected function assertConfig()
	{
		if ( !$this->_config) {
			$message = 'Tp\DataApi\Requests\Request instantiated without providing Tp\TpMerchantConfig. Use Tp\DataApi\Requests\Request::createWithConfig method instead of new Tp\DataApi\Requests\Request constructor.';
			throw new BadMethodCallException($message);
		}
	}

}
