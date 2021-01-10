<?php declare(strict_types = 1);

namespace Tp\Exceptions;

class MissingParameterException extends InvalidParameterException
{

	public function __construct(string $parameter)
	{
		parent::__construct($parameter);

		$this->message = 'Missing parameter ' . $parameter;
	}

}
