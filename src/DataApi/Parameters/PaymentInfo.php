<?php
declare(strict_types=1);

namespace Tp\DataApi\Parameters;

use Tp\DataApi\DataApiObject;
use Tp\DataApi\ValueFormatter;

class PaymentInfo extends DataApiObject
{

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
	 *
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

	public function getIsOffline() : ?bool
	{
		return $this->isOffline;
	}

	public function setIsOffline(bool $isOffline = NULL) : void
	{
		$this->isOffline = $isOffline;
	}

	public function getPaymentPageUrl() : ?string
	{
		return $this->paymentPageUrl;
	}

	public function setPaymentPageUrl(string $paymentPageUrl = NULL) : void
	{
		$this->paymentPageUrl = $paymentPageUrl;
	}

	public function getPaymentInfoUrl() : ?string
	{
		return $this->paymentInfoUrl;
	}

	public function setPaymentInfoUrl(string $paymentInfoUrl = NULL) : void
	{
		$this->paymentInfoUrl = $paymentInfoUrl;
	}

	public function getMethodChangeUrl() : ?string
	{
		return $this->methodChangeUrl;
	}

	public function setMethodChangeUrl(string $methodChangeUrl = NULL) : void
	{
		$this->methodChangeUrl = $methodChangeUrl;
	}

	public function getValue() : ?float
	{
		return $this->value;
	}

	public function setValue(?float $value) : void
	{
		$this->value = $value;
	}

	public function getAccountNumberPrefix() : ?string
	{
		return $this->accountNumberPrefix;
	}

	public function setAccountNumberPrefix(string $accountNumberPrefix = NULL) : void
	{
		$this->accountNumberPrefix = $accountNumberPrefix;
	}

	public function getAccountNumber() : ?string
	{
		return $this->accountNumber;
	}

	public function setAccountNumber(string $accountNumber = NULL) : void
	{
		$this->accountNumber = $accountNumber;
	}

	public function getBankCode() : ?string
	{
		return $this->bankCode;
	}

	public function setBankCode(string $bankCode = NULL) : void
	{
		$this->bankCode = $bankCode;
	}

	public function getVs() : ?string
	{
		return $this->vs;
	}

	public function setVs(string $vs = NULL) : void
	{
		$this->vs = $vs;
	}

	public function getSs() : ?string
	{
		return $this->ss;
	}

	public function setSs(string $ss = NULL) : void
	{
		$this->ss = $ss;
	}

	public function getEbankingUrl() : ?string
	{
		return $this->ebankingUrl;
	}

	public function setEbankingUrl(string $ebankingUrl = NULL) : void
	{
		$this->ebankingUrl = $ebankingUrl;
	}

	public function getScCode() : ?string
	{
		return $this->scCode;
	}

	public function setScCode(string $scCode = NULL) : void
	{
		$this->scCode = $scCode;
	}

	public function getScBarcodeUrl() : ?string
	{
		return $this->scBarcodeUrl;
	}

	public function setScBarcodeUrl(string $scBarcodeUrl = NULL) : void
	{
		$this->scBarcodeUrl = $scBarcodeUrl;
	}
}
