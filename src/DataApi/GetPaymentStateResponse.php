<?php

namespace Tp\DataApi;

use Tp;

class GetPaymentStateResponse extends Response {

	/**
	 * @var int
	 */
	protected $state;

	public function __construct(Tp\MerchantConfig $config, \stdClass $result) {
		parent::__construct($config, $result);

		$this->state = static::formatInt($result->state, false);
	}

	public function getState() {
		return $this->state;
	}
}
