<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . "TpInvalidParameterException.php";

class TpMissingParameterException extends TpInvalidParameterException {
	function __construct($parameter) {
		parent::__construct($parameter);

		$this->message = "Missing parameter ".$parameter;
	}
}
