<?php
declare(strict_types=1);

namespace Tp;

use stdClass;

/**
 * @author Michal Kandr
 */
class PaymentReturnResponse
{
	/**
	 * @var bool
	 */
	protected $status;
	/**
	 * @var string
	 */
	protected $errorDescription;

	public function __construct(stdClass $data)
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
