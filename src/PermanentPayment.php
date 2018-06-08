<?php
declare(strict_types=1);

namespace Tp;

class PermanentPayment
{
	/**
	 * @var MerchantConfig
	 */
	protected $config;

	/**
	 * @var string|null
	 */
	protected $merchantData;
	/**
	 * @var string|null
	 */
	protected $description;
	/**
	 * @var string|null
	 */
	protected $returnUrl;

	public function __construct(
		MerchantConfig $config,
		?string $merchantData,
		?string $description,
		?string $returnUrl
	) {
		$this->config = $config;
		$this->merchantData = $merchantData;
		$this->description = $description;
		$this->returnUrl = $returnUrl;
	}

	public function getMerchantConfig()
	{
		return $this->config;
	}

	public function getMerchantData() : ?string
	{
		return $this->merchantData;
	}

	public function getDescription() : ?string
	{
		return $this->description;
	}

	public function getReturnUrl() : ?string
	{
		return $this->returnUrl;
	}

	public function setMerchantConfig(MerchantConfig $config) : void
	{
		$this->config = $config;
	}

	public function setMerchantData(string $merchantData) : void
	{
		$this->merchantData = $merchantData;
	}

	public function setDescription(string $description) : void
	{
		$this->description = $description;
	}

	public function setReturnUrl(string $returnUrl) : void
	{
		$this->returnUrl = $returnUrl;
	}

	public function getSignature() : string
	{
		$data = [
			'merchantId'   => $this->getMerchantConfig()->merchantId,
			'accountId'    => $this->getMerchantConfig()->accountId,
			'merchantData' => $this->getMerchantData(),
			'description'  => $this->getDescription(),
			'returnUrl'    => $this->getReturnUrl(),
			'password'     => $this->getMerchantConfig()->password,
		];

		return md5(
			http_build_query(
				array_filter($data)
			)
		);
	}

	/**
	 * Version of the getSignature method. Used by getPermanentPayment call.
	 */
	public function getSignatureLite() : string
	{
		$data = [
			'merchantId'   => $this->getMerchantConfig()->merchantId,
			'accountId'    => $this->getMerchantConfig()->accountId,
			'merchantData' => $this->getMerchantData(),
			'password'     => $this->getMerchantConfig()->password,
		];

		return md5(
			http_build_query(
				array_filter($data)
			)
		);
	}
}
