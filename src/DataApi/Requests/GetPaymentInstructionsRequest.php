<?php declare(strict_types = 1);

namespace Tp\DataApi\Requests;

class GetPaymentInstructionsRequest extends Request
{

	protected ?int $paymentId = null;

	public function getPaymentId(): ?int
	{
		return $this->paymentId;
	}

	public function setPaymentId(?int $paymentId = null): void
	{
		$this->paymentId = $paymentId;
	}

}
