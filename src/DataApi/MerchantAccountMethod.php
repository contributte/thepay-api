<?php

namespace Tp\DataApi;

use Tp;

class MerchantAccountMethod extends Object {

	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var bool
	 */
	protected $active;

	public function __construct(\stdClass $method) {
		$this->id = static::formatInt($method->id, false);
		$this->name = static::formatString($method->name, false);
		$this->active = static::formatBool($method->active, false);
	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function getActive() {
		return $this->active;
	}
}
