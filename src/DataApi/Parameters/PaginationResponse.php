<?php declare(strict_types = 1);

namespace Tp\DataApi\Parameters;

class PaginationResponse extends Pagination
{

	protected ?int $totalPages = null;

	public function getTotalPages(): ?int
	{
		return $this->totalPages;
	}

	public function setTotalPages(?int $totalPages = null): void
	{
		$this->totalPages = $totalPages;
	}

}
