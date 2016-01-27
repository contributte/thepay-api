<?php
TpUtils::requirePaths(array(
	array('exceptions', 'TpException.php')
));

class TpInvalidArgumentException extends TpException {
	public $defaultMessage = "ThePay invalid argument exception";
}