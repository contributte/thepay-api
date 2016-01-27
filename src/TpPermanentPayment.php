<?php
TpUtils::requirePaths(array(
	array('TpMerchantConfig.php')
));
class TpPermanentPayment {
	/**
	 * @var TpMerchantConfig
	 */
	protected $config;

	protected $merchantData;
	protected $description;
	protected $returnUrl;
	protected $signature;

	function __construct(TpMerchantConfig $config, $merchantData, $description, $returnUrl) {
		$this->config = $config;
		$this->merchantData = $merchantData;
		$this->description = $description;
		$this->returnUrl = $returnUrl;
	}

	public function getConfig() {
		return $this->config;
	}

	public function getMerchantData() {
		return $this->merchantData;
	}

	public function getDescription() {
		return $this->description;
	}

	public function getReturnUrl() {
		return $this->returnUrl;
	}

	public function setConfig(TpMerchantConfig $config) {
		$this->config = $config;
	}

	public function setMerchantData($merchantData) {
		$this->merchantData = $merchantData;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function setReturnUrl($returnUrl) {
		$this->returnUrl = $returnUrl;
	}

	public function getSignature() {
		$data = array(
			'merchantId'   => $this->config->merchantId,
			'accountId'    => $this->config->accountId,
			'merchantData' => $this->merchantData,
			'description'  => $this->description,
			'returnUrl'    => $this->returnUrl,
			'password'     => $this->config->password,
		);
		return md5(http_build_query(array_filter($data)));
	}

	/**
	 * Version of the getSignature method. Used by getPermanentPayment call.
	 *
	 * @return string
	 */
	public function getSignatureLite() {
		$data = array(
			'merchantId' => $this->config->merchantId,
			'accountId' => $this->config->accountId,
			'merchantData' => $this->merchantData,
			'password' => $this->config->password,
		);
		return md5(http_build_query(array_filter($data)));
	}
}
