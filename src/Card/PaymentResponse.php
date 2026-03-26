<?php declare(strict_types = 1);

namespace Tp\Card;

use stdClass;

class PaymentResponse
{

	protected bool $status;

	protected ?string $errorDescription = null;

	public function __construct(stdClass $data)
	{
		$this->status = boolval($data->status);

		if (property_exists($data, 'errorDescription')) {
			$this->errorDescription = $data->errorDescription;
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

}
