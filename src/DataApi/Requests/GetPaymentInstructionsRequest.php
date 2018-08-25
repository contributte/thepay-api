<?php declare(strict_types = 1);

namespace Tp\DataApi\Requests;

class GetPaymentInstructionsRequest extends Request
{

	/** @var int|null */
	protected $paymentId;

	public function getPaymentId(): ?int
	{
		return $this->paymentId;
	}

	public function setPaymentId(?int $paymentId = null): void
	{
		$this->paymentId = $paymentId;
	}

}
