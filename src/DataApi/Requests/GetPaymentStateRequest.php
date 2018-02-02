<?php
declare(strict_types=1);

namespace Tp\DataApi\Requests;

use Tp\DataApi\ValueFormatter;

class GetPaymentStateRequest extends Request
{
	/**
	 * @var int|null
	 */
	protected $paymentId;

	public function getPaymentId():?int
	{
		return $this->paymentId;
	}

	public function setPaymentId(int $paymentId = NULL) : void
	{
		$this->paymentId = ValueFormatter::format('int', $paymentId);
	}
}
