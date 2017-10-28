<?php
class TpPermanentPaymentResponseMethod {
	protected $methodId;
	protected $methodName;
	protected $url;
	protected $accountNumber;
	protected $vs;

	function __construct($methodId, $methodName, $url, $accountNumber, $vs) {
		$this->methodId = $methodId;
		$this->methodName = $methodName;
		$this->url = $url;
		$this->accountNumber = $accountNumber;
		$this->vs = $vs;
	}

	function getMethodId() {
		return $this->methodId;
	}

	function getMethodName() {
		return $this->methodName;
	}

	function getUrl() {
		return $this->url;
	}

	function getAccountNumber() {
		return $this->accountNumber;
	}

	function getVs() {
		return $this->vs;
	}
}
