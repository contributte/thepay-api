<?php
declare(strict_types=1);

namespace Tp;

class PermanentPayment
{
	/**
	 * @var MerchantConfig
	 */
	protected $config;

	protected $merchantData;
	protected $description;
	protected $returnUrl;
	protected $signature;

	function __construct(
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

	public function getConfig()
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

	public function setConfig(MerchantConfig $config) : void
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
			'merchantId'   => $this->config->merchantId,
			'accountId'    => $this->config->accountId,
			'merchantData' => $this->getMerchantData(),
			'description'  => $this->getDescription(),
			'returnUrl'    => $this->getReturnUrl(),
			'password'     => $this->config->password,
		];

		return md5(http_build_query(array_filter($data)));
	}

	/**
	 * Version of the getSignature method. Used by getPermanentPayment call.
	 *
	 * @return string
	 */
	public function getSignatureLite() : string
	{
		$data = [
			'merchantId'   => $this->config->merchantId,
			'accountId'    => $this->config->accountId,
			'merchantData' => $this->getMerchantData(),
			'password'     => $this->config->password,
		];

		return md5(http_build_query(array_filter($data)));
	}
}
