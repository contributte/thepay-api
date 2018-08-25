<?php declare(strict_types = 1);

namespace Tp\DataApi\Responses;

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

	/** @var Payment[] */
	protected $payments = [];

	/** @var PaginationResponse|null */
	protected $pagination;

	public static function createFromResponse(
		array $response
	): self
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
	 * @return Payment[]
	 */
	public function getPayments(): array
	{
		return $this->payments;
	}

	/**
	 * @param Payment[] $payments
	 */
	public function setPayments(array $payments = []): void
	{
		$this->payments = ValueFormatter::formatList(
			'Tp\DataApi\Parameters\Payment',
			$payments
		);
	}

	public function getPagination(): ?PaginationResponse
	{
		return $this->pagination;
	}

	public function setPagination(?PaginationResponse $pagination): void
	{
		$this->pagination = $pagination;
	}

}
