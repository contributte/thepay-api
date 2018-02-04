<?php
declare(strict_types=1);

namespace Tp\DataApi\Requests;

use Tp\BadMethodCallException;
use Tp\DataApi\DataApiObject;
use Tp\DataApi\Processors\DateTimeDeflater;
use Tp\DataApi\Parameters\Signature;
use Tp\MerchantConfig;

abstract class Request extends DataApiObject
{
	/**
	 * @var MerchantConfig
	 */
	protected $_config;

	protected static $dateTimePaths = [];

	/**
	 * Request must contain merchant config data alongside its own: merchant ID,
	 * account ID, password. Thus, requests must be instantiating by this call
	 * instead of their constructor.
	 *
	 * @param MerchantConfig $config
	 * @param array          $data
	 *
	 * @return Request
	 */
	public static function createWithConfig(
		MerchantConfig $config,
		array $data = []
	) : self {
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
	public function toSoapRequestArray() : array
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
	public function toSignedSoapRequestArray() : array
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
	 * @throws BadMethodCallException
	 */
	protected function configArray() : array
	{
		$this->assertConfig();

		$configArray = ['merchantId' => $this->_config->merchantId];

		return $configArray;
	}

	/**
	 * @throws BadMethodCallException
	 */
	protected function assertConfig() : void
	{
		if ( !$this->_config) {
			$message = 'Tp\DataApi\Requests\Request instantiated without providing Tp\TpMerchantConfig. Use Tp\DataApi\Requests\Request::createWithConfig method instead of new Tp\DataApi\Requests\Request constructor.';
			throw new BadMethodCallException($message);
		}
	}
}
