<?php declare(strict_types = 1);

namespace Tp\DataApi\Parameters;

use Tp\DataApi\DataApiObject;

class MerchantAccountMethod extends DataApiObject
{

	protected ?int $id = null;

	protected ?string $name = null;

	protected ?bool $active = null;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function setId(?int $id = null): void
	{
		$this->id = $id;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setName(?string $name = null): void
	{
		$this->name = $name;
	}

	public function getActive(): ?bool
	{
		return $this->active;
	}

	public function setActive(?bool $active = null): void
	{
		$this->active = $active;
	}

}
