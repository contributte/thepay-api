<?php
declare(strict_types=1);

namespace Tp;

use stdClass;

/**
 * @author Michal Kandr
 */
class PaymentReturnResponse
{
	protected $status;
	protected $errorDescription;

	function __construct(stdClass $data)
	{
		$this->status = $data->status;

		if (property_exists($data, 'errorDescription')) {
			$this->errorDescription = $data->errorDescription;
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
}
