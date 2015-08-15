<?php

namespace Tp;

/**
 *
 * @author Michal Kandr
 */
class PermanentPaymentResponse {
	protected $status;
	protected $errorDescription;
	/** @var PermanentPaymentResponseMethod[] */
	protected $paymentMethods = array();

	function __construct(array $data) {
		$this->status = $data['status'];
		$this->errorDescription = $data['errorDescription'];
		if( !empty($data['paymentMethods']) && is_array($data['paymentMethods'])){
			foreach ($data['paymentMethods'] as $value) {
				$this->paymentMethods[] = new PermanentPaymentResponseMethod(
					$value['methodId'],
					$value['methodName'],
					$value['url'],
					$value['accountNumber'],
					$value['vs']);
			}
		}
	}


	public function getStatus() {
		return $this->status;
	}

	public function getErrorDescription() {
		return $this->errorDescription;
	}

	public function getPaymentMethods() {
		return $this->paymentMethods;
	}
}
