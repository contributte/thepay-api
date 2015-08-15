<?php

namespace Tp;

class CardPaymentResponse {
	protected $status;
	protected $errorDescription;

	function __construct(array $data) {
		$this->status = $data['status'];
		$this->errorDescription = $data['errorDescription'];
	}

	public function getStatus() {
		return $this->status;
	}

	public function getErrorDescription() {
		return $this->errorDescription;
	}
}
