<?php declare(strict_types = 1);

namespace Tp\DataApi\Parameters;

use Tp\DataApi\DataApiObject;

abstract class Pagination extends DataApiObject
{

	protected ?int $page = null;

	protected ?int $itemsOnPage = null;

	public function getPage(): ?int
	{
		return $this->page;
	}

	public function setPage(?int $page = null): void
	{
		$this->page = $page;
	}

	public function getItemsOnPage(): ?int
	{
		return $this->itemsOnPage;
	}

	public function setItemsOnPage(?int $itemsOnPage = null): void
	{
		$this->itemsOnPage = $itemsOnPage;
	}

}
