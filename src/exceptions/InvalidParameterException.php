<?php
declare(strict_types=1);

namespace Tp;

/**
 * Exception thrown when invalid parameter value has been received.
 */
class InvalidParameterException extends Exception
{
	protected $parameter;

	public function __construct(string $parameter)
	{
		$this->parameter = $parameter;
		parent::__construct('Invalid parameter value.');
	}

	public function getParameter() : string
	{
		return $this->parameter;
	}
}
