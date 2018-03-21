<?php
declare(strict_types=1);

namespace Tp\Card;

use stdClass;

class PaymentResponse
{
	/**
	 * @var bool
	 */
	protected $status;
	/**
	 * @var string|null
	 */
	protected $errorDescription;

	function __construct(stdClass $data)
	{
		$this->status = boolval($data->status);

		if (property_exists($data, 'errorDescription')) {
			$this->errorDescription = $data->errorDescription;
		}
	}

	public function getStatus() : bool
	{
		return $this->status;
	}

	public function getErrorDescription() : ?string
	{
		return $this->errorDescription;
	}
}
