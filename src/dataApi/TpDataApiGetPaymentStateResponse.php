<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, 'TpDataApiResponse.php'));

class TpDataApiGetPaymentStateResponse extends TpDataApiResponse {

	/**
	 * @var int
	 */
	protected $state;

	public function __construct(TpMerchantConfig $config, stdClass $result) {
		parent::__construct($config, $result);

		$this->state = static::formatInt($result->state, false);
	}

	public function getState() {
		return $this->state;
	}

}