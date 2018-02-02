<?php
declare(strict_types=1);

namespace Tp\DataApi\Parameters;

use Tp\DataApi\DataApiObject;

abstract class Pagination extends DataApiObject
{

	/**
	 * @var int|null
	 */
	protected $page;

	/**
	 * @var int|null
	 */
	protected $itemsOnPage;

	public function getPage() : ?int
	{
		return $this->page;
	}

	public function setPage(int $page = NULL) : void
	{
		$this->page = $page;
	}

	public function getItemsOnPage() : ?int
	{
		return $this->itemsOnPage;
	}

	public function setItemsOnPage(int $itemsOnPage = NULL) : void
	{
		$this->itemsOnPage = $itemsOnPage;
	}

}
