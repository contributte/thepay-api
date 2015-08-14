<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, "TpDataApiObject.php"));
class TpDataApiPaymentInfo extends TpDataApiObject {
	
	/**
	 * @var boolean
	 */
	protected $isOffline;

	/**
	 * @var string
	 */
	protected $paymentPageUrl;

	/**
	 * Only applicable for unpaid payments.
	 * @var string
	 */
	protected $paymentInfoUrl;

	/**
	 * Only applicable for unpaid payments.
	 *
	 * @var string
	 */
	protected $methodChangeUrl;

	/**
	 * @var float
	 */
	protected $value;

	/**
	 * Only applicable for offline payments. 
	 *
	 * @var string
	 */
	protected $accountNumberPrefix;

	/**
	 * Only applicable for offline payments. 
	 *
	 * @var string
	 */
	protected $accountNumber;

	/**
	 * Only applicable for offline payments. 
	 *
	 * @var string
	 */
	protected $bankCode;

	/**
	 * Only applicable for offline payments. 
	 *
	 * @var string
	 */
	protected $vs;

	/**
	 * Only applicable for offline payments. 
	 *
	 * @var string
	 */
	protected $ss;

	/**
	 * Only applicable for offline payments. 
	 *
	 * @var string
	 */
	protected $ebankingUrl;
	
	/**
	 * Only for SuperCash.
	 * 
	 * @var string
	 */
	protected $scCode;
	
	/**
	 * Only for SuperCash.
	 * 
	 * @var string
	 */
	protected $scBarcodeUrl;

	public function __construct(stdClass $result) {
		$this->isOffline = static::formatBool($result->isOffline, false);
		$this->paymentPageUrl = static::formatString($result->paymentPageUrl, false);
		$this->paymentInfoUrl = static::formatString($result->paymentInfoUrl, false);

		if(property_exists($result, 'methodChangeUrl')) {
			$this->methodChangeUrl = static::formatString($result->methodChangeUrl, true);
		}

		$this->value = static::formatFloat($result->value, false);

		if(property_exists($result, 'accountNumberPrefix')) {
			$this->accountNumberPrefix = static::formatString($result->accountNumberPrefix, false);
		}
		if(property_exists($result, 'accountNumber')) {
			$this->accountNumber = static::formatString($result->accountNumber, false);
		}
		if(property_exists($result, 'bankCode')) {
			$this->bankCode = static::formatString($result->bankCode, false);
		}
		if(property_exists($result, 'vs')) {
			$this->vs = static::formatString($result->vs, false);
		}
		if(property_exists($result, 'ss')) {
			$this->ss = static::formatString($result->ss, false);
		}
		if(property_exists($result, 'ebankingUrl')) {
			$this->ebankingUrl = static::formatString($result->ebankingUrl, false);
		}
		if(property_exists($result, 'scCode')) {
			$this->scCode = static::formatString($result->scCode, false);
		}
		if(property_exists($result, 'scBarcodeUrl')) {
			$this->scBarcodeUrl = static::formatString($result->scBarcodeUrl, false);
		}
	}

	/**
	 * @return boolean
	 */
	public function getIsOffline() {
		return $this->isOffline;
	}

	/**
	 * @return string
	 */
	public function getPaymentPageUrl() {
		return $this->paymentPageUrl;
	}

	/**
	 * @return string
	 */
	function getPaymentInfoUrl() {
		return $this->paymentInfoUrl;
	}

	/**
	 * @return string
	 */
	public function getMethodChangeUrl() {
		return $this->methodChangeUrl;
	}

	/**
	 * @return float
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @return string
	 */
	public function getAccountNumberPrefix() {
		return $this->accountNumberPrefix;
	}

	/**
	 * @return string
	 */
	public function getAccountNumber() {
		return $this->accountNumber;
	}

	/**
	 * @return string
	 */
	public function getBankCode() {
		return $this->bankCode;
	}

	/**
	 * @return string
	 */
	public function getVs() {
		return $this->vs;
	}

	/**
	 * @return string
	 */
	public function getSs() {
		return $this->ss;
	}

	/**
	 * @return string
	 */
	public function getEbankingUrl() {
		return $this->ebankingUrl;
	}

	/**
	 * @return string
	 */
	public function getScCode() {
		return $this->scCode;
	}

	/**
	 * @return string
	 */
	public function getScBarcodeUrl() {
		return $this->scBarcodeUrl;
	}

}