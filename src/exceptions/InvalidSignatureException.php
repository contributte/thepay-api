<?php

namespace Tp;

/**
 * Exception thrown when payment signature validation failed.
 */
class InvalidSignatureException extends Exception
{
	function __construct()
	{
		parent::__construct("Invalid signature");
	}
}
