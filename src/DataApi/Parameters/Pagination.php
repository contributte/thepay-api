<?php

namespace Tp\DataApi\Parameters;

use Tp\DataApi\DataApiObject;
use Tp\DataApi\ValueFormatter;

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

	/**
	 * @return int|null
	 */
	public function getPage()
	{
		return $this->page;
	}

	/**
	 * @param int|null $page
	 */
	public function setPage($page = NULL)
	{
		$this->page = ValueFormatter::format('int', $page);
	}

	/**
	 * @return int|null
	 */
	public function getItemsOnPage()
	{
		return $this->itemsOnPage;
	}

	/**
	 * @param int|null $itemsOnPage
	 */
	public function setItemsOnPage($itemsOnPage = NULL)
	{
		$this->itemsOnPage = ValueFormatter::format('int', $itemsOnPage);
	}

}
