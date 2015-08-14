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

	public function setMethodId($methodId) {
		$this->methodId = $methodId;
	}

	public function setMethodName($methodName) {
		$this->methodName = $methodName;
	}

	public function setUrl($url) {
		$this->url = $url;
	}

	public function setAccountNumber($accountNumber) {
		$this->accountNumber = $accountNumber;
	}

	public function setVs($vs) {
		$this->vs = $vs;
	}
}
