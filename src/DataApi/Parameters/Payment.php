<?php

namespace Tp\DataApi\Parameters;

use DateTime;
use Tp\DataApi\Object;
use Tp\DataApi\ValueFormatter;

class Payment extends Object
{

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
	 * @var string|null
	 */
	protected $fik;

	/**
	 * @var string|null
	 */
	protected $bkp;

	/**
	 * @var string|null
	 */
	protected $pkp;

	/**
	 * @var string|null
	 */
	protected $receiptUrl;

	/**
	 * @var bool|null
	 */
	protected $firstSuccess;

	/**
	 * @return int|null
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int|null $id
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setId($id = NULL)
	{
		$this->id = ValueFormatter::format('int', $id);
	}

	/**
	 * @return int|null
	 */
	public function getAccount()
	{
		return $this->account;
	}

	/**
	 * @param int|null $account
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setAccount($account = NULL)
	{
		$this->account = ValueFormatter::format('int', $account);
	}

	/**
	 * @return int|null
	 */
	public function getState()
	{
		return $this->state;
	}

	/**
	 * @param int|null $state
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setState($state = NULL)
	{
		$this->state = ValueFormatter::format('int', $state);
	}

	/**
	 * @return DateTime|null
	 */
	public function getCreatedOn()
	{
		return $this->createdOn;
	}

	/**
	 * @param string|null $createdOn
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setCreatedOn($createdOn = NULL)
	{
		$this->createdOn = ValueFormatter::format('DateTime', $createdOn);
	}

	/**
	 * @return DateTime|null
	 */
	public function getFinishedOn()
	{
		return $this->finishedOn;
	}

	/**
	 * @param DateTime|null $finishedOn
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setFinishedOn($finishedOn = NULL)
	{
		$this->finishedOn = ValueFormatter::format('DateTime', $finishedOn);
	}

	/**
	 * @return DateTime|null
	 */
	public function getCanceledOn()
	{
		return $this->canceledOn;
	}

	/**
	 * @param DateTime|null $canceledOn
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setCanceledOn($canceledOn = NULL)
	{
		$this->canceledOn = ValueFormatter::format('DateTime', $canceledOn);
	}

	/**
	 * @return int|null
	 */
	public function getPayOff()
	{
		return $this->payOff;
	}

	/**
	 * @param int|null $payOff
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setPayOff($payOff = NULL)
	{
		$this->payOff = ValueFormatter::format('int', $payOff);
	}

	/**
	 * @return int|null
	 */
	public function getPayOffCancel()
	{
		return $this->payOffCancel;
	}

	/**
	 * @param int|null $payOffCancel
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setPayOffCancel($payOffCancel = NULL)
	{
		$this->payOffCancel = ValueFormatter::format('int', $payOffCancel);
	}

	/**
	 * @return float|null
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @param float|null $value
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setValue($value = NULL)
	{
		$this->value = ValueFormatter::format('float', $value);
	}

	/**
	 * @return float|null
	 */
	public function getReceivedValue()
	{
		return $this->receivedValue;
	}

	/**
	 * @param float|null $receivedValue
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setReceivedValue($receivedValue = NULL)
	{
		$this->receivedValue = ValueFormatter::format('float', $receivedValue);
	}

	/**
	 * @return int|null
	 */
	public function getCurrency()
	{
		return $this->currency;
	}

	/**
	 * @param int|null $currency
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setCurrency($currency)
	{
		$this->currency = ValueFormatter::format('int', $currency);
	}

	/**
	 * @return float|null
	 */
	public function getFee()
	{
		return $this->fee;
	}

	/**
	 * @param float|null $fee
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setFee($fee)
	{
		$this->fee = ValueFormatter::format('float', $fee);
	}

	/**
	 * @return string|null
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param string|null $description
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setDescription($description = NULL)
	{
		$this->description = ValueFormatter::format('string', $description);
	}

	/**
	 * @return string|null
	 */
	public function getMerchantData()
	{
		return $this->merchantData;
	}

	/**
	 * @param string|null $merchantData
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setMerchantData($merchantData = NULL)
	{
		$this->merchantData = ValueFormatter::format('string', $merchantData);
	}

	/**
	 * @return int|null
	 */
	public function getPaymentMethod()
	{
		return $this->paymentMethod;
	}

	/**
	 * @param int|null $paymentMethod
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setPaymentMethod($paymentMethod)
	{
		$this->paymentMethod = ValueFormatter::format('int', $paymentMethod);
	}

	/**
	 * @return string|null
	 */
	public function getSpecificSymbol()
	{
		return $this->specificSymbol;
	}

	/**
	 * @param string|null $specificSymbol
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setSpecificSymbol($specificSymbol = NULL)
	{
		$this->specificSymbol = ValueFormatter::format('string', $specificSymbol);
	}

	/**
	 * @return string|null
	 */
	public function getMerchantSpecificSymbol()
	{
		return $this->merchantSpecificSymbol;
	}

	/**
	 * @param string|null $merchantSpecificSymbol
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setMerchantSpecificSymbol($merchantSpecificSymbol = NULL)
	{
		$this->merchantSpecificSymbol = ValueFormatter::format(
			'string', $merchantSpecificSymbol
		);
	}

	/**
	 * @return string|null
	 */
	public function getAccountNumber()
	{
		return $this->accountNumber;
	}

	/**
	 * @param string|null $accountNumber
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setAccountNumber($accountNumber = NULL)
	{
		$this->accountNumber = ValueFormatter::format(
			'string', $accountNumber
		);
	}

	/**
	 * @return string|null
	 */
	public function getAccountOwnerName()
	{
		return $this->accountOwnerName;
	}

	/**
	 * @param string|null $accountOwnerName
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setAccountOwnerName($accountOwnerName = NULL)
	{
		$this->accountOwnerName = ValueFormatter::format(
			'string', $accountOwnerName
		);
	}

	/**
	 * @return string|null
	 */
	public function getReturnUrl()
	{
		return $this->returnUrl;
	}

	/**
	 * @param string|null
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setReturnUrl($returnUrl = NULL)
	{
		$this->returnUrl = ValueFormatter::format('string', $returnUrl);
	}

	/**
	 * @return int|null
	 */
	public function getPermanentPayment()
	{
		return $this->permanentPayment;
	}

	/**
	 * @param int|null $permanentPayment
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setPermanentPayment($permanentPayment = NULL)
	{
		$this->permanentPayment = ValueFormatter::format(
			'int', $permanentPayment
		);
	}

	/**
	 * @return bool|null
	 */
	public function getDeposit()
	{
		return $this->deposit;
	}

	/**
	 * @param bool|null $deposit
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setDeposit($deposit = NULL)
	{
		$this->deposit = ValueFormatter::format('bool', $deposit);
	}

	/**
	 * @return bool|null
	 */
	public function getRecurring()
	{
		return $this->recurring;
	}

	/**
	 * @param bool|null $recurring
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setRecurring($recurring = NULL)
	{
		$this->recurring = ValueFormatter::format('bool', $recurring);
	}

	/**
	 * @return string|null
	 */
	public function getIp()
	{
		return $this->ip;
	}

	/**
	 * @param string|null $ip
	 *
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setIp($ip = NULL)
	{
		$this->ip = ValueFormatter::format('string', $ip);
	}

	/**
	 * @return string|null
	 */
	public function getCustomerEmail()
	{
		return $this->customerEmail;
	}

	/**
	 * @var string|null $customerEmail
	 * @throws \Tp\InvalidArgumentException
	 */
	public function setCustomerEmail($customerEmail = NULL)
	{
		$this->customerEmail = ValueFormatter::format(
			'string', $customerEmail
		);
	}

	/**
	 * @return string|null
	 */
	public function getFik()
	{
		return $this->fik;
	}

	/**
	 * @param string|null $fik
	 */
	public function setFik($fik = NULL)
	{
		$this->fik = ValueFormatter::formatString($fik);
	}

	/**
	 * @return string|null
	 */
	public function getBkp()
	{
		return $this->bkp;
	}

	/**
	 * @param string|null $bkp
	 */
	public function setBkp($bkp = NULL)
	{
		$this->bkp = ValueFormatter::formatString($bkp);
	}

	/**
	 * @return string|null
	 */
	public function getPkp()
	{
		return $this->pkp;
	}

	/**
	 * @param string|null $pkp
	 */
	public function setPkp($pkp = NULL)
	{
		$this->pkp = ValueFormatter::formatString($pkp);
	}

	/**
	 * @return string|null
	 */
	public function getReceiptUrl()
	{
		return $this->receiptUrl;
	}

	/**
	 * @param string|null $receiptUrl
	 */
	public function setReceiptUrl($receiptUrl = NULL)
	{
		$this->receiptUrl = ValueFormatter::formatString($receiptUrl);
	}

	/**
	 * @return bool|null
	 */
	public function getFirstSuccess()
	{
		return $this->firstSuccess;
	}

	/**
	 * @param bool|null $firstSuccess
	 */
	public function setFirstSuccess($firstSuccess = NULL)
	{
		$this->firstSuccess = ValueFormatter::formatBool($firstSuccess);
	}
}
