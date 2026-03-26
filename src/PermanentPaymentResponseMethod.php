<?php declare(strict_types = 1);

namespace Tp;

class PermanentPaymentResponseMethod
{

	protected int $methodId;

	protected string $methodName;

	protected string $url;

	protected string $accountNumber;

	protected int $vs;

	public function __construct(
		int $methodId,
		string $methodName,
		string $url,
		string $accountNumber,
		int $vs
	)
	{
		$this->methodId = $methodId;
		$this->methodName = $methodName;
		$this->url = $url;
		$this->accountNumber = $accountNumber;
		$this->vs = $vs;
	}

	public function getMethodId(): int
	{
		return $this->methodId;
	}

	public function getMethodName(): string
	{
		return $this->methodName;
	}

	public function getUrl(): string
	{
		return $this->url;
	}

	public function getAccountNumber(): string
	{
		return $this->accountNumber;
	}

	public function getVs(): int
	{
		return $this->vs;
	}

}
