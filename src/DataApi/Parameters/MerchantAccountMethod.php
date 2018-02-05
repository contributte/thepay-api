<?php
declare(strict_types=1);

namespace Tp\DataApi\Parameters;

use Tp\DataApi\DataApiObject;

class MerchantAccountMethod extends DataApiObject
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

	public function getId() : ?int
	{
		return $this->id;
	}

	public function setId(int $id = NULL) : void
	{
		$this->id = $id;
	}

	public function getName() : ?string
	{
		return $this->name;
	}

	public function setName(string $name = NULL) : void
	{
		$this->name = $name;
	}

	public function getActive() : ?bool
	{
		return $this->active;
	}

	public function setActive(bool $active = NULL) : void
	{
		$this->active = $active;
	}

}
