<?php

namespace Tp\DataApi\Parameters;

use DateTime;
use Tp\DataApi\Object;
use Tp\DataApi\ValueFormatter;

class GetPaymentsSearchParams extends Object
{

	/**
	 * @var int[]
	 */
	protected $accountId = [];

	/**
	 * @var int[]
	 */
	protected $state = [];

	/**
	 * @var int[]
	 */
	protected $currency = [];

	/**
	 * @var float|null
	 */
	protected $valueFrom;

	/**
	 * @var float|null
	 */
	protected $valueTo;

	/**
	 * @var DateTime|null
	 */
	protected $createdOnFrom;

	/**
	 * @var DateTime|null
	 */
	protected $createdOnTo;

	/**
	 * @var DateTime|null
	 */
	protected $finishedOnFrom;

	/**
	 * @var DateTime|null
	 */
	protected $finishedOnTo;

	/**
	 * @var int[]
	 */
	protected $accounting = [];

	/**
	 * @var string|null
	 */
	protected $description;

	/**
	 * @var string|null
	 */
	protected $merchantData;

	/**
	 * @var int[]
	 */
	protected $method = [];

	/**
	 * @var string|null
	 */
	protected $specificSymbol;

	/**
	 * @return int[]|null
	 */
	public function getAccountId()
	{
		return $this->accountId;
	}

	/**
	 * @param int[]|null $accountId
	 */
	public function setAccountId(array $accountId = [])
	{
		$this->accountId = ValueFormatter::formatList('int', $accountId);
	}

	/**
	 * @return int[]|null
	 */
	public function getState()
	{
		return $this->state;
	}

	/**
	 * @param int[]|null $state
	 */
	public function setState(array $state = [])
	{
		$this->state = ValueFormatter::formatList('int', $state);
	}

	/**
	 * @return int[]|null
	 */
	public function getCurrency()
	{
		return $this->currency;
	}

	/**
	 * @param int[]|null $currency
	 */
	public function setCurrency(array $currency = [])
	{
		$this->currency = ValueFormatter::formatList('int', $currency);
	}

	/**
	 * @return float|null
	 */
	public function getValueFrom()
	{
		return $this->valueFrom;
	}

	/**
	 * @param float|null $valueFrom
	 */
	public function setValueFrom($valueFrom = NULL)
	{
		$this->valueFrom = $valueFrom;
	}

	/**
	 * @return float|null
	 */
	public function getValueTo()
	{
		return $this->valueTo;
	}

	/**
	 * @param float|null $valueTo
	 */
	public function setValueTo($valueTo = NULL)
	{
		$this->valueTo = $valueTo;
	}

	/**
	 * @return DateTime|null
	 */
	public function getCreatedOnFrom()
	{
		return $this->createdOnFrom;
	}

	/**
	 * @param DateTime|string|null $createdOnFrom
	 */
	public function setCreatedOnFrom($createdOnFrom = NULL)
	{
		$this->createdOnFrom = ValueFormatter::format(
			'DateTime', $createdOnFrom
		);
	}

	/**
	 * @return DateTime|null
	 */
	public function getCreatedOnTo()
	{
		return $this->createdOnTo;
	}

	/**
	 * @param DateTime|string|null $createdOnTo
	 */
	public function setCreatedOnTo($createdOnTo = NULL)
	{
		$this->createdOnTo = ValueFormatter::format('DateTime', $createdOnTo);
	}

	/**
	 * @return DateTime|null
	 */
	public function getFinishedOnFrom()
	{
		return $this->finishedOnFrom;
	}

	/**
	 * @param DateTime|string|null $finishedOnFrom
	 */
	public function setFinishedOnFrom($finishedOnFrom = NULL)
	{
		$this->finishedOnFrom = ValueFormatter::format(
			'DateTime', $finishedOnFrom
		);
	}

	/**
	 * @return DateTime|null
	 */
	public function getFinishedOnTo()
	{
		return $this->finishedOnTo;
	}

	/**
	 * @param DateTime|string|null $finishedOnTo
	 */
	public function setFinishedOnTo($finishedOnTo = NULL)
	{
		$this->finishedOnTo = ValueFormatter::format(
			'DateTime', $finishedOnTo
		);
	}

	/**
	 * @return int[]|null
	 */
	public function getAccounting()
	{
		return $this->accounting;
	}

	/**
	 * @param int[]|null $accounting
	 */
	public function setAccounting(array $accounting = [])
	{
		$this->accounting = ValueFormatter::formatList('int', $accounting);
	}

	/**
	 * @return null|string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param null|string $description
	 */
	public function setDescription($description = NULL)
	{
		$this->description = ValueFormatter::format('string', $description);
	}

	/**
	 * @return null|string
	 */
	public function getMerchantData()
	{
		return $this->merchantData;
	}

	/**
	 * @param null|string $merchantData
	 */
	public function setMerchantData($merchantData = NULL)
	{
		$this->merchantData = ValueFormatter::format('string', $merchantData);
	}

	/**
	 * @return int[]|null
	 */
	public function getMethod()
	{
		return $this->method;
	}

	/**
	 * @param int[]|null $method
	 */
	public function setMethod(array $method = [])
	{
		$this->method = ValueFormatter::formatList('int', $method);
	}

	/**
	 * @return null|string
	 */
	public function getSpecificSymbol()
	{
		return $this->specificSymbol;
	}

	/**
	 * @param string|null $specificSymbol
	 */
	public function setSpecificSymbol($specificSymbol = NULL)
	{
		$this->specificSymbol = ValueFormatter::format(
			'string', $specificSymbol
		);
	}

}