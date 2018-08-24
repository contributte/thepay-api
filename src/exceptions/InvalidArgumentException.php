<?php
declare(strict_types=1);

namespace Tp;

class InvalidArgumentException extends Exception
{
	public $defaultMessage = 'ThePay invalid argument exception';
}
