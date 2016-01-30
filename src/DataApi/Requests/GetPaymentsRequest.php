<?php

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
	 * @var \Tp\DataApi\Parameters\Ordering|null
	 */
	protected $ordering;

	/**
	 * @return GetPaymentsSearchParams|null
	 */
	public function getSearchParams()
	{
		return $this->searchParams;
	}

	/**
	 * @param GetPaymentsSearchParams|null $searchParams
	 */
	public function setSearchParams(GetPaymentsSearchParams $searchParams = NULL)
	{
		$this->searchParams = ValueFormatter::format(
			'Tp\DataApi\Parameters\GetPaymentsSearchParams', $searchParams
		);
	}

	/**
	 * @return PaginationRequest|null
	 */
	public function getPagination()
	{
		return $this->pagination;
	}

	/**
	 * @param PaginationRequest|null $pagination
	 */
	public function setPagination(PaginationRequest $pagination = NULL)
	{
		$this->pagination = ValueFormatter::format(
			'PaginationRequest', $pagination
		);
	}

	/**
	 * @return \Tp\DataApi\Parameters\Ordering|null
	 */
	public function getOrdering()
	{
		return $this->ordering;
	}

	/**
	 * @param \Tp\DataApi\Parameters\Ordering|null $ordering
	 */
	public function setOrdering(Ordering $ordering = NULL)
	{
		$this->ordering = ValueFormatter::format(
			'Tp\DataApi\Parameters\Ordering', $ordering
		);
	}

}
