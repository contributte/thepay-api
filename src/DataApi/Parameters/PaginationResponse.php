<?php

namespace Tp\DataApi\Parameters;

use Tp\DataApi\ValueFormatter;

class PaginationResponse extends Pagination
{

	/**
	 * @var int|null
	 */
	protected $totalPages;

	/**
	 * @return int
	 */
	public function getTotalPages()
	{
		return $this->totalPages;
	}

	/**
	 * @param int|null $totalPages
	 */
	public function setTotalPages($totalPages = NULL)
	{
		$this->totalPages = ValueFormatter::format('int', $totalPages);
	}

}
