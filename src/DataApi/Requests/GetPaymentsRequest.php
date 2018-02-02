<?php
declare(strict_types=1);

namespace Tp\DataApi\Requests;

use Tp\DataApi\Parameters\GetPaymentsSearchParams;
use Tp\DataApi\Parameters\Ordering;
use Tp\DataApi\Parameters\PaginationRequest;
use Tp\DataApi\ValueFormatter;

class GetPaymentsRequest extends Request
{
	protected static $dateTimePaths = [
		['searchParams', 'createdOnFrom'],
		['searchParams', 'createdOnTo'],
		['searchParams', 'finishedOnFrom'],
		['searchParams', 'finishedOnTo'],
	];

	/**
	 * @var GetPaymentsSearchParams|null
	 */
	protected $searchParams;

	/**
	 * @var PaginationRequest|null
	 */
	protected $pagination;

	/**
	 * @var Ordering|null
	 */
	protected $ordering;

	public function getSearchParams() : ?GetPaymentsSearchParams
	{
		return $this->searchParams;
	}

	public function setSearchParams(GetPaymentsSearchParams $searchParams = NULL) : void
	{
		$this->searchParams = ValueFormatter::format(
			'Tp\DataApi\Parameters\GetPaymentsSearchParams', $searchParams
		);
	}

	public function getPagination() : ?PaginationRequest
	{
		return $this->pagination;
	}

	public function setPagination(PaginationRequest $pagination = NULL) : void
	{
		$this->pagination = ValueFormatter::format(
			'Tp\DataApi\Parameters\PaginationRequest', $pagination
		);
	}

	public function getOrdering() : ?Ordering
	{
		return $this->ordering;
	}

	public function setOrdering(Ordering $ordering = NULL) : void
	{
		$this->ordering = ValueFormatter::format(
			'Tp\DataApi\Parameters\Ordering', $ordering
		);
	}
}
