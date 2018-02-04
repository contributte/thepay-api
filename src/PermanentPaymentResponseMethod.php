<?php
declare(strict_types=1);

namespace Tp;

class PermanentPaymentResponseMethod
{
	/**
	 * @var int
	 */
	protected $methodId;
	/**
	 * @var string
	 */
	protected $methodName;
	/**
	 * @var string
	 */
	protected $url;
	/**
	 * @var string
	 */
	protected $accountNumber;
	/**
	 * @var int
	 */
	protected $vs;

	function __construct(
		int $methodId,
		string $methodName,
		string $url,
		string $accountNumber,
		int $vs
	) {
		$this->methodId = $methodId;
		$this->methodName = $methodName;
		$this->url = $url;
		$this->accountNumber = $accountNumber;
		$this->vs = $vs;
	}

	public function getMethodId() : int
	{
		return $this->methodId;
	}

	public function getMethodName() : string
	{
		return $this->methodName;
	}

	public function getUrl() : string
	{
		return $this->url;
	}

	public function getAccountNumber() : string
	{
		return $this->accountNumber;
	}

	public function getVs() : int
	{
		return $this->vs;
	}
}
