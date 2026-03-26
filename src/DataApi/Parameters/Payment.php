<?php declare(strict_types = 1);

namespace Tp\DataApi\Parameters;

use DateTimeImmutable;
use Tp\DataApi\DataApiObject;

class Payment extends DataApiObject
{

	protected ?int $id = null;

	protected ?int $account = null;

	protected ?int $state = null;

	protected ?DateTimeImmutable $createdOn = null;

	protected ?DateTimeImmutable $finishedOn = null;

	protected ?DateTimeImmutable $canceledOn = null;

	protected ?int $payOff = null;

	protected ?int $payOffCancel = null;

	protected ?float $value = null;

	protected ?float $receivedValue = null;

	protected ?int $currency = null;

	protected ?float $fee = null;

	protected ?string $description = null;

	protected ?string $merchantData = null;

	protected ?int $paymentMethod = null;

	protected ?string $specificSymbol = null;

	protected ?string $merchantSpecificSymbol = null;

	protected ?string $accountNumber = null;

	protected ?string $accountOwnerName = null;

	protected ?string $returnUrl = null;

	protected ?int $permanentPayment = null;

	protected ?bool $deposit = null;

	protected ?bool $recurring = null;

	protected ?string $ip = null;

	protected ?string $customerEmail = null;

	protected ?string $fik = null;

	protected ?string $bkp = null;

	protected ?string $pkp = null;

	protected ?string $receiptUrl = null;

	protected ?bool $firstSuccess = null;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function setId(?int $id = null): void
	{
		$this->id = $id;
	}

	public function getAccount(): ?int
	{
		return $this->account;
	}

	public function setAccount(?int $account = null): void
	{
		$this->account = $account;
	}

	public function getState(): ?int
	{
		return $this->state;
	}

	public function setState(?int $state = null): void
	{
		$this->state = $state;
	}

	public function getCreatedOn(): ?DateTimeImmutable
	{
		return $this->createdOn;
	}

	public function setCreatedOn(?DateTimeImmutable $createdOn = null): void
	{
		$this->createdOn = $createdOn;
	}

	public function getFinishedOn(): ?DateTimeImmutable
	{
		return $this->finishedOn;
	}

	public function setFinishedOn(?DateTimeImmutable $finishedOn = null): void
	{
		$this->finishedOn = $finishedOn;
	}

	public function getCanceledOn(): ?DateTimeImmutable
	{
		return $this->canceledOn;
	}

	public function setCanceledOn(?DateTimeImmutable $canceledOn = null): void
	{
		$this->canceledOn = $canceledOn;
	}

	public function getPayOff(): ?int
	{
		return $this->payOff;
	}

	public function setPayOff(?int $payOff = null): void
	{
		$this->payOff = $payOff;
	}

	public function getPayOffCancel(): ?int
	{
		return $this->payOffCancel;
	}

	public function setPayOffCancel(?int $payOffCancel = null): void
	{
		$this->payOffCancel = $payOffCancel;
	}

	public function getValue(): ?float
	{
		return $this->value;
	}

	public function setValue(?float $value = null): void
	{
		$this->value = $value;
	}

	public function getReceivedValue(): ?float
	{
		return $this->receivedValue;
	}

	public function setReceivedValue(?float $receivedValue = null): void
	{
		$this->receivedValue = $receivedValue;
	}

	public function getCurrency(): ?int
	{
		return $this->currency;
	}

	public function setCurrency(?int $currency): void
	{
		$this->currency = $currency;
	}

	public function getFee(): ?float
	{
		return $this->fee;
	}

	public function setFee(?float $fee): void
	{
		$this->fee = $fee;
	}

	public function getDescription(): ?string
	{
		return $this->description;
	}

	public function setDescription(?string $description = null): void
	{
		$this->description = $description;
	}

	public function getMerchantData(): ?string
	{
		return $this->merchantData;
	}

	public function setMerchantData(?string $merchantData = null): void
	{
		$this->merchantData = $merchantData;
	}

	public function getPaymentMethod(): ?int
	{
		return $this->paymentMethod;
	}

	public function setPaymentMethod(?int $paymentMethod): void
	{
		$this->paymentMethod = $paymentMethod;
	}

	public function getSpecificSymbol(): ?string
	{
		return $this->specificSymbol;
	}

	public function setSpecificSymbol(?string $specificSymbol = null): void
	{
		$this->specificSymbol = $specificSymbol;
	}

	public function getMerchantSpecificSymbol(): ?string
	{
		return $this->merchantSpecificSymbol;
	}

	public function setMerchantSpecificSymbol(?string $merchantSpecificSymbol = null): void
	{
		$this->merchantSpecificSymbol = $merchantSpecificSymbol;
	}

	public function getAccountNumber(): ?string
	{
		return $this->accountNumber;
	}

	public function setAccountNumber(?string $accountNumber = null): void
	{
		$this->accountNumber = $accountNumber;
	}

	public function getAccountOwnerName(): ?string
	{
		return $this->accountOwnerName;
	}

	public function setAccountOwnerName(?string $accountOwnerName = null): void
	{
		$this->accountOwnerName = $accountOwnerName;
	}

	public function getReturnUrl(): ?string
	{
		return $this->returnUrl;
	}

	public function setReturnUrl(?string $returnUrl = null): void
	{
		$this->returnUrl = $returnUrl;
	}

	public function getPermanentPayment(): ?int
	{
		return $this->permanentPayment;
	}

	public function setPermanentPayment(?int $permanentPayment = null): void
	{
		$this->permanentPayment = $permanentPayment;
	}

	public function getDeposit(): ?bool
	{
		return $this->deposit;
	}

	public function setDeposit(?bool $deposit = null): void
	{
		$this->deposit = $deposit;
	}

	public function getRecurring(): ?bool
	{
		return $this->recurring;
	}

	public function setRecurring(?bool $recurring = null): void
	{
		$this->recurring = $recurring;
	}

	public function getIp(): ?string
	{
		return $this->ip;
	}

	public function setIp(?string $ip = null): void
	{
		$this->ip = $ip;
	}

	public function getCustomerEmail(): ?string
	{
		return $this->customerEmail;
	}

	public function setCustomerEmail(?string $customerEmail = null): void
	{
		$this->customerEmail = $customerEmail;
	}

	public function getFik(): ?string
	{
		return $this->fik;
	}

	public function setFik(?string $fik = null): void
	{
		$this->fik = $fik;
	}

	public function getBkp(): ?string
	{
		return $this->bkp;
	}

	public function setBkp(?string $bkp = null): void
	{
		$this->bkp = $bkp;
	}

	public function getPkp(): ?string
	{
		return $this->pkp;
	}

	public function setPkp(?string $pkp = null): void
	{
		$this->pkp = $pkp;
	}

	public function getReceiptUrl(): ?string
	{
		return $this->receiptUrl;
	}

	public function setReceiptUrl(?string $receiptUrl = null): void
	{
		$this->receiptUrl = $receiptUrl;
	}

	public function getFirstSuccess(): ?bool
	{
		return $this->firstSuccess;
	}

	public function setFirstSuccess(?bool $firstSuccess = null): void
	{
		$this->firstSuccess = $firstSuccess;
	}

}
