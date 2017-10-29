<?php

namespace Tp\DataApi\Responses;

use Tp\DataApi\Parameters\Payment;
use Tp\DataApi\ValueFormatter;

class GetPaymentResponse extends Response
{

	protected static $dateTimePaths = [
		['payment', 'createdOn'],
		['payment', 'finishedOn'],
		['payment', 'canceledOn'],
	];

	/**
	 * @var \Tp\DataApi\Parameters\Payment|null
	 */
	protected $payment;

	/**
	 * @param array $response
	 *
	 * @return GetPaymentResponse
	 */
	public static function createFromResponse(array $response)
	{
		/** @var GetPaymentResponse $instance */
		$instance = parent::createFromResponse($response);

		$payment = new Payment($response['payment']);
		$instance->setPayment($payment);

		return $instance;
	}

	/**
	 * @return Payment|null
	 */
	public function getPayment()
	{
		return $this->payment;
	}

	/**
	 * @param \Tp\DataApi\Parameters\Payment|null $payment
	 */
	public function setPayment(Payment $payment = NULL)
	{
		$this->payment = ValueFormatter::format('Tp\DataApi\Parameters\Payment', $payment);
	}

}
