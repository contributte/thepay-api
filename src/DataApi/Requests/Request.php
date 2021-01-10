<?php declare(strict_types = 1);

namespace Tp\DataApi\Requests;

use Tp\Exceptions\BadMethodCallException;
use Tp\DataApi\DataApiObject;
use Tp\DataApi\Parameters\Signature;
use Tp\DataApi\Processors\DateTimeDeflater;
use Tp\MerchantConfig;

abstract class Request extends DataApiObject
{

	/** @var MerchantConfig */
	protected $_config;

	protected static $dateTimePaths = [];

	public function __construct(
		MerchantConfig $config,
		array $data = []
	)
	{
		parent::__construct($data);

		$this->_config = $config;
	}

	/**
	 * @deprecated use constructor
	 */
	public static function createWithConfig(
		MerchantConfig $config,
		array $data = []
	): self
	{
		return new static($config, $data);
	}

	/**
	 * Merchant ID and in some request also account ID is prepeneded. Moreover,
	 * SOAP request must not contain DateTime timestamps: They must be cast as
	 * strings.
	 *
	 * @throws BadMethodCallException
	 */
	public function toSoapRequestArray(): array
	{
		$configArray = $this->configArray();
		$data = parent::toArray();
		$withConfig = array_merge($configArray, $data);

		return DateTimeDeflater::processWithPaths(
			$withConfig,
			static::$dateTimePaths
		);
	}

	/**
	 * @throws BadMethodCallException
	 */
	public function toSignedSoapRequestArray(): array
	{
		$array = $this->toSoapRequestArray();
		$signature = Signature::compute(
			$array,
			$this->_config->dataApiPassword
		);
		$signatureArray = ['signature' => $signature];

		return array_merge($array, $signatureArray);
	}

	/**
	 * @throws BadMethodCallException
	 */
	protected function configArray(): array
	{
		return ['merchantId' => $this->_config->merchantId];
	}

}
