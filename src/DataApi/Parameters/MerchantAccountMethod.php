<?php

namespace Tp\DataApi\Parameters;

use Tp\DataApi\Object;
use Tp\DataApi\ValueFormatter;

class MerchantAccountMethod extends Object
{

	/**
	 * @var int|null
	 */
	protected $id;

	/**
	 * @var string|null
	 */
	protected $name;

	/**
	 * @var bool|null
	 */
	protected $active;

	/**
	 * @return int|null
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int|null $id
	 */
	public function setId($id = NULL)
	{
		$this->id = ValueFormatter::format('int', $id);
	}

	/**
	 * @return string|null
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string|null $name
	 */
	public function setName($name = NULL)
	{
		$this->name = ValueFormatter::format('string', $name);
	}

	/**
	 * @return bool
	 */
	public function getActive()
	{
		return $this->active;
	}

	/**
	 * @param bool|null $active
	 */
	public function setActive($active = NULL)
	{
		$this->active = ValueFormatter::format('bool', $active);
	}

}
