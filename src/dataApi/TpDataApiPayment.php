<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, "TpDataApiObject.php"));
class TpDataApiPayment extends TpDataApiObject {

	/**
	 * @var int
	 */
	public $id;

	/**
	 * @var int
	 */
	public $account;

	/**
	 * @var int
	 */
	public $state;

	/**
	 * @var DateTime
	 */
	public $createdOn;

	/**
	 * @var DateTime
	 */
	public $finishedOn;

	/**
	 * @var DateTime
	 */
	public $canceledOn;

	/**
	 * @var int
	 */
	public $payOff;

	/**
	 * @var int
	 */
	public $payOffCancel;

	/**
	 * @var float
	 */
	public $value;

	/**
	 * @var float
	 */
	public $receivedValue;

	/**
	 * @var int
	 */
	public $currency;

	/**
	 * @var float
	 */
	public $fee;

	/**
	 * @var string
	 */
	public $description;

	/**
	 * @var string
	 */
	public $merchantData;

	/**
	 * @var int
	 */
	public $paymentMethod;

	/**
	 * @var string
	 */
	public $specificSymbol;

	/**
	 * @var string
	 */
	public $merchantSpecificSymbol;

	/**
	 * @var string
	 */
	public $accountNumber;

	/**
	 * @var string
	 */
	public $accountOwnerName;

	/**
	 * @var string
	 */
	public $returnUrl;

	/**
	 * @var int
	 */
	public $permanentPayment;

	/**
	 * @var bool
	 */
	public $deposit;

	/**
	 * @var bool
	 */
	public $recurring;

	/**
	 * @var string
	 */
	public $ip;

	/**
	 * @var string
	 */
	public $customerEmail;

	public function __construct(stdClass $payment) {
		$this->id = static::formatInt($payment->id, false);
		$this->account = static::formatInt($payment->account, false);
		$this->state = static::formatInt($payment->state, false);
		$this->createdOn = static::formatDateTime($payment->createdOn, false);
		$this->finishedOn = static::formatDateTime($payment->finishedOn, true);
		$this->canceledOn = static::formatDateTime($payment->canceledOn, true);
		$this->payOff = static::formatInt($payment->payOff, true);
		$this->payOffCancel = static::formatInt($payment->payOffCancel, true);
		$this->value = static::formatFloat($payment->value, false);
		$this->receivedValue = static::formatFloat($payment->receivedValue, true);
		$this->currency = static::formatInt($payment->currency, false);
		$this->fee = static::formatFloat($payment->fee, false);
		$this->description = static::formatString($payment->description, true);
		$this->merchantData = static::formatString($payment->merchantData, true);
		$this->paymentMethod = static::formatInt($payment->paymentMethod, false);
		$this->specificSymbol = static::formatString($payment->specificSymbol, true);
		$this->merchantSpecificSymbol = static::formatString($payment->merchantSpecificSymbol, true);
		$this->accountNumber = static::formatString($payment->accountNumber, true);
		$this->accountOwnerName = static::formatString($payment->accountOwnerName, true);
		$this->returnUrl = static::formatString($payment->returnUrl, false);
		$this->permanentPayment = static::formatInt($payment->permanentPayment, true);

		$this->deposit = static::formatBool($payment->deposit, false);
		$this->recurring = static::formatBool($payment->recurring, false);

		$this->ip = static::formatString($payment->ip, false);
		$this->customerEmail = static::formatString($payment->customerEmail, true);
	}

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return int
	 */
	public function getAccount() {
		return $this->account;
	}

	/**
	 * @return int
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * @return DateTime
	 */
	public function getCreatedOn() {
		return $this->createdOn;
	}

	/**
	 * @return DateTime
	 */
	public function getFinishedOn() {
		return $this->finishedOn;
	}

	/**
	 * @return DateTime
	 */
	public function getCanceledOn() {
		return $this->canceledOn;
	}

	/**
	 * @return int
	 */
	public function getPayOff() {
		return $this->payOff;
	}

	/**
	 * @return int
	 */
	public function getPayOffCancel() {
		return $this->payOffCancel;
	}

	/**
	 * @return float
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @return float
	 */
	public function getReceivedValue() {
		return $this->receivedValue;
	}

	/**
	 * @return int
	 */
	public function getCurrency() {
		return $this->currency;
	}

	/**
	 * @return float
	 */
	public function getFee() {
		return $this->fee;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @return string
	 */
	public function getMerchantData() {
		return $this->merchantData;
	}

	/**
	 * @return int
	 */
	public function getPaymentMethod() {
		return $this->paymentMethod;
	}

	/**
	 * @return string
	 */
	public function getSpecificSymbol() {
		return $this->specificSymbol;
	}

	/**
	 * @return string
	 */
	public function getMerchantSpecificSymbol() {
		return $this->merchantSpecificSymbol;
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
	public function getAccountOwnerName() {
		return $this->accountOwnerName;
	}

	/**
	 * @return string
	 */
	public function getReturnUrl() {
		return $this->returnUrl;
	}

	/**
	 * @return int
	 */
	public function getPermanentPayment() {
		return $this->permanentPayment;
	}

	/**
	 * @return boolean
	 */
	public function getDeposit() {
		return $this->deposit;
	}

	/**
	 * @return boolean
	 */
	public function getRecurring() {
		return $this->recurring;
	}

	/**
	 * @return string
	 */
	public function getIp() {
		return $this->ip;
	}

	/**
	 * @return string
	 */
	public function getCustomerEmail() {
		return $this->customerEmail;
	}
	
}