<?php

namespace Tp;

use stdClass;

/**
 * @author Michal Kandr
 */
class PermanentPaymentResponse
{
	protected $status;
	protected $errorDescription;
	/** @var PermanentPaymentResponseMethod[] */
	protected $paymentMethods = [];

	function __construct(stdClass $data)
	{
		$this->status = $data->status;
		if (property_exists($data, 'errorDescription')) {
			$this->errorDescription = $data->errorDescription;
		}
		if (
			property_exists($data, 'paymentMethods') &&
			$data->paymentMethods instanceof stdClass &&
			property_exists($data->paymentMethods, 'paymentMethod') &&
			is_array($data->paymentMethods->paymentMethod)
		) {
			foreach ($data->paymentMethods->paymentMethod as $value) {
				$this->paymentMethods[] = new PermanentPaymentResponseMethod(
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


	public function getStatus()
	{
		return $this->status;
	}

	public function getErrorDescription()
	{
		return $this->errorDescription;
	}

	public function getPaymentMethods()
	{
		return $this->paymentMethods;
	}
}
