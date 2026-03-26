<?php declare(strict_types = 1);

namespace Tp\DataApi\Responses;

use Tp\DataApi\Parameters\PaginationResponse;
use Tp\DataApi\Parameters\Payment;
use Tp\DataApi\ValueFormatter;

class GetPaymentsResponse extends Response
{

	protected static array $listPaths = [
		['payments', 'payment'],
	];

	protected static array $dateTimePaths = [
		['payments', 'createdOn'],
		['payments', 'finishedOn'],
		['payments', 'canceledOn'],
	];

	/** @var Payment[] */
	protected array $payments = [];

	protected ?PaginationResponse $pagination = null;

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
			Payment::class,
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
