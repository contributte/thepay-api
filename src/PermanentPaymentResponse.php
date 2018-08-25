<?php declare(strict_types = 1);

namespace Tp;

use stdClass;

class PermanentPaymentResponse
{

	/** @var bool */
	protected $status;

	/** @var string */
	protected $errorDescription;

	/** @var PermanentPaymentResponseMethod[] */
	protected $paymentMethods = [];

	public function __construct(stdClass $data)
	{
		$this->status = boolval($data->status);

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


	public function getStatus(): bool
	{
		return $this->status;
	}

	public function getErrorDescription(): ?string
	{
		return $this->errorDescription;
	}

	/**
	 * @return PermanentPaymentResponseMethod[]
	 */
	public function getPaymentMethods(): array
	{
		return $this->paymentMethods;
	}

}
