<?php declare(strict_types = 1);

namespace Tp\DataApi\Requests;

use Tp\DataApi\Parameters\GetPaymentsSearchParams;
use Tp\DataApi\Parameters\Ordering;
use Tp\DataApi\Parameters\PaginationRequest;

class GetPaymentsRequest extends Request
{

	protected static $dateTimePaths = [
		['searchParams', 'createdOnFrom'],
		['searchParams', 'createdOnTo'],
		['searchParams', 'finishedOnFrom'],
		['searchParams', 'finishedOnTo'],
	];

	/** @var GetPaymentsSearchParams|null */
	protected $searchParams;

	/** @var PaginationRequest|null */
	protected $pagination;

	/** @var Ordering|null */
	protected $ordering;

	public function getSearchParams(): ?GetPaymentsSearchParams
	{
		return $this->searchParams;
	}

	public function setSearchParams(?GetPaymentsSearchParams $searchParams = null): void
	{
		$this->searchParams = $searchParams;
	}

	public function getPagination(): ?PaginationRequest
	{
		return $this->pagination;
	}

	public function setPagination(?PaginationRequest $pagination = null): void
	{
		$this->pagination = $pagination;
	}

	public function getOrdering(): ?Ordering
	{
		return $this->ordering;
	}

	public function setOrdering(?Ordering $ordering = null): void
	{
		$this->ordering = $ordering;
	}

}
