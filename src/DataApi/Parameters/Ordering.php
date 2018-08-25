<?php declare(strict_types = 1);

namespace Tp\DataApi\Parameters;

use Tp\DataApi\DataApiObject;

class Ordering extends DataApiObject
{

	/** @var string|null */
	protected $orderBy;

	/** @var string|null */
	protected $orderHow;

	public function getOrderBy(): ?string
	{
		return $this->orderBy;
	}

	public function setOrderBy(?string $orderBy = null): void
	{
		$this->orderBy = $orderBy;
	}

	public function getOrderHow(): ?string
	{
		return $this->orderHow;
	}

	public function setOrderHow(?string $orderHow = null): void
	{
		$this->orderHow = $orderHow;
	}

}
