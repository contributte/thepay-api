<?php declare(strict_types = 1);

namespace Tp\DataApi\Parameters;

use Tp\DataApi\DataApiObject;

class PaymentInfo extends DataApiObject
{

	protected ?bool $isOffline = null;

	protected ?string $paymentPageUrl = null;

	/**
	 * Only applicable for unpaid payments.
	 */
	protected ?string $paymentInfoUrl = null;

	/**
	 * Only applicable for unpaid payments.
	 */
	protected ?string $methodChangeUrl = null;

	protected ?float $value = null;

	/**
	 * Only applicable for offline payments.
	 */
	protected ?string $accountNumberPrefix = null;

	/**
	 * Only applicable for offline payments.
	 */
	protected ?string $accountNumber = null;

	/**
	 * Only applicable for offline payments.
	 */
	protected ?string $bankCode = null;

	/**
	 * Only applicable for offline payments.
	 */
	protected ?string $vs = null;

	/**
	 * Only applicable for offline payments.
	 */
	protected ?string $ss = null;

	/**
	 * Only applicable for offline payments.
	 */
	protected ?string $ebankingUrl = null;

	/**
	 * Only for SuperCash.
	 */
	protected ?string $scCode = null;

	/**
	 * Only for SuperCash.
	 */
	protected ?string $scBarcodeUrl = null;

	public function getIsOffline(): ?bool
	{
		return $this->isOffline;
	}

	public function setIsOffline(?bool $isOffline = null): void
	{
		$this->isOffline = $isOffline;
	}

	public function getPaymentPageUrl(): ?string
	{
		return $this->paymentPageUrl;
	}

	public function setPaymentPageUrl(?string $paymentPageUrl = null): void
	{
		$this->paymentPageUrl = $paymentPageUrl;
	}

	public function getPaymentInfoUrl(): ?string
	{
		return $this->paymentInfoUrl;
	}

	public function setPaymentInfoUrl(?string $paymentInfoUrl = null): void
	{
		$this->paymentInfoUrl = $paymentInfoUrl;
	}

	public function getMethodChangeUrl(): ?string
	{
		return $this->methodChangeUrl;
	}

	public function setMethodChangeUrl(?string $methodChangeUrl = null): void
	{
		$this->methodChangeUrl = $methodChangeUrl;
	}

	public function getValue(): ?float
	{
		return $this->value;
	}

	public function setValue(?float $value): void
	{
		$this->value = $value;
	}

	public function getAccountNumberPrefix(): ?string
	{
		return $this->accountNumberPrefix;
	}

	public function setAccountNumberPrefix(?string $accountNumberPrefix = null): void
	{
		$this->accountNumberPrefix = $accountNumberPrefix;
	}

	public function getAccountNumber(): ?string
	{
		return $this->accountNumber;
	}

	public function setAccountNumber(?string $accountNumber = null): void
	{
		$this->accountNumber = $accountNumber;
	}

	public function getBankCode(): ?string
	{
		return $this->bankCode;
	}

	public function setBankCode(?string $bankCode = null): void
	{
		$this->bankCode = $bankCode;
	}

	public function getVs(): ?string
	{
		return $this->vs;
	}

	public function setVs(?string $vs = null): void
	{
		$this->vs = $vs;
	}

	public function getSs(): ?string
	{
		return $this->ss;
	}

	public function setSs(?string $ss = null): void
	{
		$this->ss = $ss;
	}

	public function getEbankingUrl(): ?string
	{
		return $this->ebankingUrl;
	}

	public function setEbankingUrl(?string $ebankingUrl = null): void
	{
		$this->ebankingUrl = $ebankingUrl;
	}

	public function getScCode(): ?string
	{
		return $this->scCode;
	}

	public function setScCode(?string $scCode = null): void
	{
		$this->scCode = $scCode;
	}

	public function getScBarcodeUrl(): ?string
	{
		return $this->scBarcodeUrl;
	}

	public function setScBarcodeUrl(?string $scBarcodeUrl = null): void
	{
		$this->scBarcodeUrl = $scBarcodeUrl;
	}

}
