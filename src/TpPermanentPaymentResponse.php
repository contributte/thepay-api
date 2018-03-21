<?php
TpUtils::requirePaths(array(
	array('TpPermanentPaymentResponseMethod.php')
));

/**
 *
 * @author Michal Kandr
 */
class TpPermanentPaymentResponse {
	/**
	 * @var boolean
	 */
	protected $status;
	/**
	 * @var string
	 */
	protected $errorDescription;
	/**
	 * @var TpPermanentPaymentResponseMethod[]
	 */
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
		}
	}

	/**
	 * @return boolean result of operation. True=OK, false = error
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @return string description of error if $status=false
	 */
	public function getErrorDescription() {
		return $this->errorDescription;
	}

	/**
	 * @return TpPermanentPaymentResponseMethod[]
	 */
	public function getPaymentMethods() {
		return $this->paymentMethods;
	}

}
