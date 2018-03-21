<?php
class TpPermanentPaymentResponseMethod {
	/**
	 * @var integer
	 */
	protected $methodId;
	/**
	 * @var string
	 */
	protected $methodName;
	/**
	 * @var string
	 */
	protected $url;
	/**
	 * @var string
	 */
	protected $accountNumber;
	/**
	 * @var string
	 */
	protected $vs;

	function __construct($methodId, $methodName, $url, $accountNumber, $vs) {
		$this->methodId = $methodId;
		$this->methodName = $methodName;
		$this->url = $url;
		$this->accountNumber = $accountNumber;
		$this->vs = $vs;
	}

	/**
	 * @return integer id of payment method
	 */
	function getMethodId() {
		return $this->methodId;
	}

	/**
	 * @return string name of method (in cyech language)
	 */
	function getMethodName() {
		return $this->methodName;
	}

	/**
	 * @return string return URL for notifications
	 */
	function getUrl() {
		return $this->url;
	}

	/**
	 * @return string ThePay's bank account number for this method
	 */
	function getAccountNumber() {
		return $this->accountNumber;
	}

	/**
	 * @return string VS for payment
	 */
	function getVs() {
		return $this->vs;
	}
}
