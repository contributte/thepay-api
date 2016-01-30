<?php

namespace Tp\DataApi\Requests;

use Tp\DataApi\ValueFormatter;

class GetPaymentRequest extends Request
{

	/**
	 * @var int|null
	 */
	protected $paymentId;

	/**
	 * @return int|null
	 */
	public function getPaymentId()
	{
		return $this->paymentId;
	}

	/**
	 * @param int|null $paymentId
	 */
	public function setPaymentId($paymentId = NULL)
	{
		$this->paymentId = ValueFormatter::format('int', $paymentId);
	}

}
