<?php

/**
 * @author Michal Kandr
 */
class TpPaymentReturnResponse {
	/**
	 * @var boolean
	 */
	protected $status;
	/**
	 * @var string|null
	 */
	protected $errorDescription;

	function __construct(stdClass $data) {
		$this->status = $data->status;
		if(property_exists($data, 'errorDescription')) {
			$this->errorDescription = $data->errorDescription;
		}
	}

	/**
	 * @return boolean result of operation. True=OK, false = error
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @return string description of error if $status=false
	 */
	public function getErrorDescription() {
		return $this->errorDescription;
	}
}
