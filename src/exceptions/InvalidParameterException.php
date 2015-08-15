<?php

namespace Tp;

use Tp;

/**
 * Exception thrown when invalid parameter value has been received.
 */
class InvalidParameterException extends Exception {
	protected $parameter;

	public function __construct($parameter) {
		$this->parameter = $parameter;
		parent::__construct("Invalid parameter value.");
	}

	public function getParameter() {
		return $this->parameter;
	}
}
