<?php
declare(strict_types=1);

namespace Tp;

class PermanentPaymentResponseMethod
{
	protected $methodId;
	protected $methodName;
	protected $url;
	protected $accountNumber;
	protected $vs;

	function __construct(
		$methodId,
		$methodName,
		$url,
		$accountNumber,
		$vs
	) {
		$this->methodId = $methodId;
		$this->methodName = $methodName;
		$this->url = $url;
		$this->accountNumber = $accountNumber;
		$this->vs = $vs;
	}

	public function getMethodId()
	{
		return $this->methodId;
	}

	public function getMethodName()
	{
		return $this->methodName;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function getAccountNumber()
	{
		return $this->accountNumber;
	}

	public function getVs()
	{
		return $this->vs;
	}
}
