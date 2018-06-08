<?php
declare(strict_types=1);

namespace Tp\DataApi\Responses;

use Tp\DataApi\Parameters\Payment;

class GetPaymentResponse extends Response
{
	protected static $dateTimePaths = [
		['payment', 'createdOn'],
		['payment', 'finishedOn'],
		['payment', 'canceledOn'],
	];

	/**
	 * @var Payment|null
	 */
	protected $payment;

	public static function createFromResponse(
		array $response
	) : self {
		/** @var GetPaymentResponse $instance */
		$instance = parent::createFromResponse($response);

		$payment = new Payment($response['payment']);
		$instance->setPayment($payment);

		return $instance;
	}

	public function getPayment() : ?Payment
	{
		return $this->payment;
	}

	public function setPayment(?Payment $payment = null) : void
	{
		$this->payment = $payment;
	}
}
