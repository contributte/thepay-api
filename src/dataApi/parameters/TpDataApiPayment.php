<?php
TpUtils::requirePaths(array(
	array('dataApi', 'TpDataApiObject.php'),
	array('dataApi', 'TpValueFormatter.php')
));

class TpDataApiPayment extends TpDataApiObject {

	/**
	 * @var int|null
	 */
	public $id;

	/**
	 * @var int|null
	 */
	public $account;

	/**
	 * @var int|null
	 */
	public $state;

	/**
	 * @var DateTime|null
	 */
	public $createdOn;

	/**
	 * @var DateTime|null
	 */
	public $finishedOn;

	/**
	 * @var DateTime|null
	 */
	public $canceledOn;

	/**
	 * @var int|null
	 */
	public $payOff;

	/**
	 * @var int|null
	 */
	public $payOffCancel;

	/**
	 * @var float|null
	 */
	public $value;

	/**
	 * @var float|null
	 */
	public $receivedValue;

	/**
	 * @var int|null
	 */
	public $currency;

	/**
	 * @var float|null
	 */
	public $fee;

	/**
	 * @var string|null
	 */
	public $description;

	/**
	 * @var string|null
	 */
	public $merchantData;

	/**
	 * @var int|null
	 */
	public $paymentMethod;

	/**
	 * @var string|null
	 */
	public $specificSymbol;

	/**
	 * @var string|null
	 */
	public $merchantSpecificSymbol;

	/**
	 * @var string|null
	 */
	public $accountNumber;

	/**
	 * @var string|null
	 */
	public $accountOwnerName;

	/**
	 * @var string|null
	 */
	public $returnUrl;

	/**
	 * @var int|null
	 */
	public $permanentPayment;

	/**
	 * @var bool|null
	 */
	public $deposit;

	/**
	 * @var bool|null
	 */
	public $recurring;

	/**
	 * @var string|null
	 */
	public $ip;

	/**
	 * @var string|null
	 */
	public $customerEmail;

	/**
	 * @return int|null
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param int|null $id
	 */
	public function setId($id = null) {
		$this->id = TpValueFormatter::format('int', $id);
	}

	/**
	 * @return int|null
	 */
	public function getAccount() {
		return $this->account;
	}

	/**
	 * @param int|null $account
	 */
	public function setAccount($account = null) {
		$this->account = TpValueFormatter::format('int', $account);
	}

	/**
	 * @return int|null
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * @param int|null $state
	 */
	public function setState($state = null) {
		$this->state = TpValueFormatter::format('int', $state);
	}

	/**
	 * @return DateTime|null
	 */
	public function getCreatedOn() {
		return $this->createdOn;
	}

	/**
	 * @param string|null $createdOn
	 */
	public function setCreatedOn($createdOn = null) {
		$this->createdOn = TpValueFormatter::format('DateTime', $createdOn);
	}

	/**
	 * @return DateTime|null
	 */
	public function getFinishedOn() {
		return $this->finishedOn;
	}

	/**
	 * @param DateTime|null $finishedOn
	 */
	public function setFinishedOn($finishedOn = null) {
		$this->finishedOn = TpValueFormatter::format('DateTime', $finishedOn);
	}

	/**
	 * @return DateTime|null
	 */
	public function getCanceledOn() {
		return $this->canceledOn;
	}

	/**
	 * @param DateTime|null $canceledOn
	 */
	public function setCanceledOn($canceledOn = null) {
		$this->canceledOn = TpValueFormatter::format('DateTime', $canceledOn);
	}

	/**
	 * @return int|null
	 */
	public function getPayOff() {
		return $this->payOff;
	}

	/**
	 * @param int|null $payOff
	 */
	public function setPayOff($payOff = null) {
		$this->payOff = TpValueFormatter::format('int', $payOff);
	}

	/**
	 * @return int|null
	 */
	public function getPayOffCancel() {
		return $this->payOffCancel;
	}

	/**
	 * @param int|null $payOffCancel
	 */
	public function setPayOffCancel($payOffCancel = null) {
		$this->payOffCancel = TpValueFormatter::format('int', $payOffCancel);
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
	public function setValue($value = null) {
		$this->value = TpValueFormatter::format('float', $value);
	}

	/**
	 * @return float|null
	 */
	public function getReceivedValue() {
		return $this->receivedValue;
	}

	/**
	 * @param float|null $receivedValue
	 */
	public function setReceivedValue($receivedValue = null) {
		$this->receivedValue = TpValueFormatter::format('float', $receivedValue);
	}

	/**
	 * @return int|null
	 */
	public function getCurrency() {
		return $this->currency;
	}

	/**
	 * @param int|null $currency
	 */
	public function setCurrency($currency) {
		$this->currency = TpValueFormatter::format('int', $currency);
	}

	/**
	 * @return float|null
	 */
	public function getFee() {
		return $this->fee;
	}

	/**
	 * @param float|null $fee
	 */
	public function setFee($fee) {
		$this->fee = TpValueFormatter::format('float', $fee);
	}

	/**
	 * @return string|null
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param string|null $description
	 */
	public function setDescription($description = null) {
		$this->description = TpValueFormatter::format('string', $description);
	}

	/**
	 * @return string|null
	 */
	public function getMerchantData() {
		return $this->merchantData;
	}

	/**
	 * @param string|null $merchantData
	 */
	public function setMerchantData($merchantData = null) {
		$this->merchantData = TpValueFormatter::format('string', $merchantData);
	}

	/**
	 * @return int|null
	 */
	public function getPaymentMethod() {
		return $this->paymentMethod;
	}

	/**
	 * @param int|null $paymentMethod
	 */
	public function setPaymentMethod($paymentMethod) {
		$this->paymentMethod = TpValueFormatter::format('int', $paymentMethod);
	}

	/**
	 * @return string|null
	 */
	public function getSpecificSymbol() {
		return $this->specificSymbol;
	}

	/**
	 * @param string|null $specificSymbol
	 */
	public function setSpecificSymbol($specificSymbol = null) {
		$this->specificSymbol = TpValueFormatter::format('string', $specificSymbol);
	}

	/**
	 * @return string|null
	 */
	public function getMerchantSpecificSymbol() {
		return $this->merchantSpecificSymbol;
	}

	/**
	 * @param $merchantSpecificSymbol = null
	 */
	public function setMerchantSpecificSymbol($merchantSpecificSymbol = null) {
		$this->merchantSpecificSymbol = TpValueFormatter::format(
			'string', $merchantSpecificSymbol
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
	public function getAccountOwnerName() {
		return $this->accountOwnerName;
	}

	/**
	 * @param string|null $accountOwnerName
	 */
	public function setAccountOwnerName($accountOwnerName = null) {
		$this->accountOwnerName = TpValueFormatter::format(
			'string', $accountOwnerName
		);
	}

	/**
	 * @return string|null
	 */
	public function getReturnUrl() {
		return $this->returnUrl;
	}

	/**
	 * @param string|null
	 */
	public function setReturnUrl($returnUrl) {
		$this->returnUrl = TpValueFormatter::format('string', $returnUrl);
	}

	/**
	 * @return int|null
	 */
	public function getPermanentPayment() {
		return $this->permanentPayment;
	}

	/**
	 * @param int|null $permanentPayment
	 */
	public function setPermanentPayment($permanentPayment = null) {
		$this->permanentPayment = TpValueFormatter::format(
			'int', $permanentPayment
		);
	}

	/**
	 * @return bool|null
	 */
	public function getDeposit() {
		return $this->deposit;
	}

	/**
	 * @param bool|null $deposit
	 */
	public function setDeposit($deposit = null) {
		$this->deposit = TpValueFormatter::format('bool', $deposit);
	}

	/**
	 * @return bool|null
	 */
	public function getRecurring() {
		return $this->recurring;
	}

	/**
	 * @param bool|null $recurring
	 */
	public function setRecurring($recurring = null) {
		$this->recurring = TpValueFormatter::format('bool', $recurring);
	}

	/**
	 * @return string|null
	 */
	public function getIp() {
		return $this->ip;
	}

	/**
	 * @param string|null $ip
	 */
	public function setIp($ip = null) {
		$this->ip = TpValueFormatter::format('string', $ip);
	}

	/**
	 * @return string|null
	 */
	public function getCustomerEmail() {
		return $this->customerEmail;
	}
	
	/**
	 * @return string|null
	 */
	public function setCustomerEmail($customerEmail = null) {
		$this->customerEmail = TpValueFormatter::format(
			'string', $customerEmail
		);
	}

}
