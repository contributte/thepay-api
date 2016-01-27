<?php
TpUtils::requirePaths(array(
	array('exceptions', 'TpInvalidParameterException.php')
));

class TpMissingParameterException extends TpInvalidParameterException {
	function __construct($parameter) {
		parent::__construct($parameter);

		$this->message = "Missing parameter ".$parameter;
	}
}
