<?php

namespace Tp\DataApi\Responses;

use Tp\DataApi\Parameters\PaymentInfo;
use Tp\DataApi\ValueFormatter;

class GetPaymentInstructionsResponse extends Response
{

	/**
	 * @var PaymentInfo|null
	 */
	protected $paymentInfo;

	/**
	 * @param array $response
	 *
	 * @return GetPaymentInstructionsResponse
	 */
	public static function createFromResponse(array $response)
	{
		/** @var GetPaymentInstructionsResponse $instance */
		$instance = parent::createFromResponse($response);

		$paymentInfo = new PaymentInfo($response['paymentInfo']);
		$instance->setPaymentInfo($paymentInfo);

		return $instance;
	}

	/**
	 * @return PaymentInfo|null
	 */
	public function getPaymentInfo()
	{
		return $this->paymentInfo;
	}

	/**
	 * @param PaymentInfo|null $paymentInfo
	 */
	public function setPaymentInfo(PaymentInfo $paymentInfo = NULL)
	{
		$this->paymentInfo = ValueFormatter::format(
			'Tp\DataApi\Parameters\PaymentInfo', $paymentInfo
		);
	}

}
