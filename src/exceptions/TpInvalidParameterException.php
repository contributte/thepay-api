<?php
TpUtils::requirePaths(array(
	array('exceptions', 'TpException.php')
));

/**
 * Exception thrown when invalid parameter value has been received.
 */
class TpInvalidParameterException extends TpException {
	protected $parameter;

	public function __construct($parameter) {
		$this->parameter = $parameter;
		parent::__construct("Invalid parameter value.");
	}

	public function getParameter() {
		return $this->parameter;
	}
}
