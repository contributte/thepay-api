<?php
TpUtils::requirePaths(array(
	array('TpPermanentPaymentResponseMethod.php')
));

/**
 *
 * @author Michal Kandr
 */
class TpPermanentPaymentResponse {
	protected $status;
	protected $errorDescription;
	/** @var TpPermanentPaymentResponseMethod[] */
	protected $paymentMethods = array();

	function __construct(stdClass $data) {
		$this->status = $data->status;
		if(property_exists($data, 'errorDescription')) {
			$this->errorDescription = $data->errorDescription;
		}
		if(
			property_exists($data, 'paymentMethods') &&
			$data->paymentMethods instanceof stdClass &&
			property_exists($data->paymentMethods, 'paymentMethod') &&
			is_array($data->paymentMethods->paymentMethod)
		) {
			foreach($data->paymentMethods->paymentMethod as $value) {
				$this->paymentMethods[] = new TpPermanentPaymentResponseMethod(
					$value->methodId,
					$value->methodName,
					$value->url,
					$value->accountNumber,
					$value->vs
				);
			}
			unset($value);
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
