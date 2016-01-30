<?php

namespace Tp\DataApi\Responses;

use Tp\DataApi\Response;
use Tp\DataApi\Parameters\PaginationResponse;
use Tp\DataApi\Parameters\Payment;
use Tp\DataApi\ValueFormatter;

class GetPaymentsResponse extends Response
{

	protected static $listPaths = [
		['payments', 'payment'],
	];

	protected static $dateTimePaths = [
		['payments', 'createdOn'],
		['payments', 'finishedOn'],
		['payments', 'canceledOn'],
	];

	/**
	 * @var Payment[]
	 */
	protected $payments = [];

	/**
	 * @var PaginationResponse|null
	 */
	protected $pagination;

	/**
	 * @param array $response
	 *
	 * @return GetPaymentsResponse
	 */
	public static function createFromResponse(array $response)
	{
		/** @var GetPaymentsResponse $instance */
		$instance = parent::createFromResponse($response);

		$payments = [];
		foreach ($response['payments'] as $payment) {
			$payments[] = new Payment($payment);
		}
		unset($payment);
		$instance->setPayments($payments);

		$pagination = new PaginationResponse($response['pagination']);
		$instance->setPagination($pagination);

		return $instance;
	}

	/**
	 * @return \Tp\DataApi\Parameters\Payment[]
	 */
	public function getPayments()
	{
		return $this->payments;
	}

	/**
	 * @param Payment[] $payments
	 */
	public function setPayments(array $payments = [])
	{
		$this->payments = ValueFormatter::formatList(
			'Tp\DataApi\Parameters\Payment', $payments
		);
	}

	/**
	 * @return PaginationResponse|null
	 */
	public function getPagination()
	{
		return $this->pagination;
	}

	/**
	 * @param \Tp\DataApi\Parameters\PaginationResponse|null $pagination
	 */
	public function setPagination(PaginationResponse $pagination)
	{
		$this->pagination = ValueFormatter::format(
			'PaginationResponse', $pagination
		);
	}

}
