<?php
declare(strict_types=1);

namespace Tp\DataApi\Parameters;

class PaginationResponse extends Pagination
{

	/**
	 * @var int|null
	 */
	protected $totalPages;

	public function getTotalPages() : ?int
	{
		return $this->totalPages;
	}

	public function setTotalPages(?int $totalPages = null) : void
	{
		$this->totalPages = $totalPages;
	}
}
