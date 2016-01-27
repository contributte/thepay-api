<?php
TpUtils::requirePaths(array(
	array('dataApi', 'TpDataApiObject.php'),
	array('dataApi', 'TpValueFormatter.php')
));

class TpDataApiPaymentInfo extends TpDataApiObject {
	
	/**
	 * @var bool|null
	 */
	protected $isOffline;

	/**
	 * @var string|null
	 */
	protected $paymentPageUrl;

	/**
	 * Only applicable for unpaid payments.
	 * @var string|null
	 */
	protected $paymentInfoUrl;

	/**
	 * Only applicable for unpaid payments.
	 *
	 * @var string|null
	 */
	protected $methodChangeUrl;

	/**
	 * @var float|null
	 */
	protected $value;

	/**
	 * Only applicable for offline payments. 
	 *
	 * @var string|null
	 */
	protected $accountNumberPrefix;

	/**
	 * Only applicable for offline payments. 
	 *
	 * @var string|null
	 */
	protected $accountNumber;

	/**
	 * Only applicable for offline payments. 
	 *
	 * @var string|null
	 */
	protected $bankCode;

	/**
	 * Only applicable for offline payments. 
	 *
	 * @var string|null
	 */
	protected $vs;

	/**
	 * Only applicable for offline payments. 
	 *
	 * @var string|null
	 */
	protected $ss;

	/**
	 * Only applicable for offline payments. 
	 *
	 * @var string|null
	 */
	protected $ebankingUrl;
	
	/**
	 * Only for SuperCash.
	 * 
	 * @var string|null
	 */
	protected $scCode;
	
	/**
	 * Only for SuperCash.
	 * 
	 * @var string|null
	 */
	protected $scBarcodeUrl;

	/**
	 * @return bool|null
	 */
	public function getIsOffline() {
		return $this->isOffline;
	}

	/**
	 * @param bool|null $isOffline
	 */
	public function setIsOffline($isOffline = null) {
		$this->isOffline = TpValueFormatter::format('bool', $isOffline);
	}

	/**
	 * @return string|null
	 */
	public function getPaymentPageUrl() {
		return $this->paymentPageUrl;
	}

	/**
	 * @param string|null $paymentPageUrl
	 */
	public function setPaymentPageUrl($paymentPageUrl = null) {
		$this->paymentPageUrl = TpValueFormatter::format(
			'string', $paymentPageUrl
		);
	}

	/**
	 * @return string|null
	 */
	function getPaymentInfoUrl() {
		return $this->paymentInfoUrl;
	}

	/**
	 * @param string|null $paymentInfoUrl
	 */
	function setPaymentInfoUrl($paymentInfoUrl = null) {
		$this->paymentInfoUrl = TpValueFormatter::format(
			'string', $paymentInfoUrl
		);
	}

	/**
	 * @return string|null
	 */
	public function getMethodChangeUrl() {
		return $this->methodChangeUrl;
	}

	/**
	 * @param string|null $methodChangeUrl
	 */
	public function setMethodChangeUrl($methodChangeUrl = null) {
		$this->methodChangeUrl = TpValueFormatter::format(
			'string', $methodChangeUrl
		);
	}

	/**
	 * @return float|null
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @param float|null $value
	 */
	public function setValue($value) {
		$this->value = TpValueFormatter::format('float', $value);
	}

	/**
	 * @return string|null
	 */
	public function getAccountNumberPrefix() {
		return $this->accountNumberPrefix;
	}

	/**
	 * @param string|null $accountNumberPrefix
	 */
	public function setAccountNumberPrefix($accountNumberPrefix = null) {
		$this->accountNumberPrefix = TpValueFormatter::format(
			'string', $accountNumberPrefix
		);
	}

	/**
	 * @return string|null
	 */
	public function getAccountNumber() {
		return $this->accountNumber;
	}

	/**
	 * @param string|null $accountNumber
	 */
	public function setAccountNumber($accountNumber = null) {
		$this->accountNumber = TpValueFormatter::format(
			'string', $accountNumber
		);
	}

	/**
	 * @return string|null
	 */
	public function getBankCode() {
		return $this->bankCode;
	}

	/**
	 * @param string|null $bankCode
	 */
	public function setBankCode($bankCode = null) {
		$this->bankCode = TpValueFormatter::format('string', $bankCode);
	}

	/**
	 * @return string|null
	 */
	public function getVs() {
		return $this->vs;
	}

	/**
	 * @param string|null $vs
	 */
	public function setVs($vs = null) {
		$this->vs = TpValueFormatter::format('string', $vs);
	}

	/**
	 * @return string|null
	 */
	public function getSs() {
		return $this->ss;
	}

	/**
	 * @param string|null $ss
	 */
	public function setSs($ss = null) {
		$this->ss = TpValueFormatter::format('string', $ss);
	}

	/**
	 * @return string|null
	 */
	public function getEbankingUrl() {
		return $this->ebankingUrl;
	}

	/**
	 * @param string|null $ebankingUrl
	 */
	public function setEbankingUrl($ebankingUrl = null) {
		$this->ebankingUrl = TpValueFormatter::format('string', $ebankingUrl);
	}

	/**
	 * @return string|null
	 */
	public function getScCode() {
		return $this->scCode;
	}

	/**
	 * @param string|null $scCode
	 */
	public function setScCode($scCode = null) {
		$this->scCode = TpValueFormatter::format('string', $scCode);
	}

	/**
	 * @return string|null
	 */
	public function getScBarcodeUrl() {
		return $this->scBarcodeUrl;
	}

	/**
	 * @param string|null $scBarcodeUrl
	 */
	public function setScBarcodeUrl($scBarcodeUrl = null) {
		$this->scBarcodeUrl = TpValueFormatter::format('string', $scBarcodeUrl);
	}

}
