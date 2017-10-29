<?php

namespace Tp\DataApi\Parameters;

use Tp\DataApi\DataApiObject;
use Tp\DataApi\ValueFormatter;

class Ordering extends DataApiObject
{

	/**
	 * @var string|null
	 */
	protected $orderBy;

	/**
	 * @var string|null
	 */
	protected $orderHow;

	/**
	 * @return string|null
	 */
	public function getOrderBy()
	{
		return $this->orderBy;
	}

	/**
	 * @param string|null $orderBy
	 */
	public function setOrderBy($orderBy = NULL)
	{
		$this->orderBy = ValueFormatter::format('string', $orderBy);
	}

	/**
	 * @return string|null
	 */
	public function getOrderHow()
	{
		return $this->orderHow;
	}

	/**
	 * @param string|null $orderHow
	 */
	public function setOrderHow($orderHow = NULL)
	{
		$this->orderHow = ValueFormatter::format('string', $orderHow);
	}

}
