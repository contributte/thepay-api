<?php
declare(strict_types=1);

namespace Tp\DataApi\Parameters;

use DateTimeImmutable;
use DateTimeInterface;
use Tp\DataApi\DataApiObject;
use Tp\DataApi\ValueFormatter;

class GetPaymentsSearchParams extends DataApiObject
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
	 * @var DateTimeImmutable|null
	 */
	protected $createdOnFrom;

	/**
	 * @var DateTimeImmutable|null
	 */
	protected $createdOnTo;

	/**
	 * @var DateTimeImmutable|null
	 */
	protected $finishedOnFrom;

	/**
	 * @var DateTimeImmutable|null
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
	 * @return int[]
	 */
	public function getAccountId() : array
	{
		return $this->accountId;
	}

	/**
	 * @param int[] $accountId
	 */
	public function setAccountId(array $accountId = []) : void
	{
		$this->accountId = ValueFormatter::formatList(
			'int', $accountId
		);
	}

	/**
	 * @return int[]
	 */
	public function getState() : array
	{
		return $this->state;
	}

	/**
	 * @param int[] $state
	 */
	public function setState(array $state = []) : void
	{
		$this->state = ValueFormatter::formatList(
			'int', $state
		);
	}

	/**
	 * @return int[]
	 */
	public function getCurrency() : array
	{
		return $this->currency;
	}

	/**
	 * @param int[] $currency
	 */
	public function setCurrency(array $currency = []) : void
	{
		$this->currency = ValueFormatter::formatList(
			'int', $currency
		);
	}

	public function getValueFrom() : ?float
	{
		return $this->valueFrom;
	}

	public function setValueFrom(?float $valueFrom = NULL) : void
	{
		$this->valueFrom = $valueFrom;
	}

	public function getValueTo() : ?float
	{
		return $this->valueTo;
	}

	public function setValueTo(?float $valueTo = NULL) : void
	{
		$this->valueTo = $valueTo;
	}

	public function getCreatedOnFrom() : ?DateTimeImmutable
	{
		return $this->createdOnFrom;
	}

	public function setCreatedOnFrom(DateTimeImmutable $createdOnFrom = NULL) : void
	{
		$this->createdOnFrom = $createdOnFrom;
	}

	public function getCreatedOnTo() : ?DateTimeImmutable
	{
		return $this->createdOnTo;
	}

	public function setCreatedOnTo(DateTimeImmutable $createdOnTo = NULL) : void
	{
		$this->createdOnTo = $createdOnTo;
	}

	public function getFinishedOnFrom() : ?DateTimeImmutable
	{
		return $this->finishedOnFrom;
	}

	public function setFinishedOnFrom(DateTimeImmutable $finishedOnFrom = NULL) : void
	{
		$this->finishedOnFrom = $finishedOnFrom;
	}

	public function getFinishedOnTo() : ?DateTimeImmutable
	{
		return $this->finishedOnTo;
	}

	public function setFinishedOnTo(\DateTimeImmutable $finishedOnTo = NULL) : void
	{
		$this->finishedOnTo = $finishedOnTo;
	}

	/**
	 * @return int[]
	 */
	public function getAccounting() : array
	{
		return $this->accounting;
	}

	/**
	 * @param int[] $accounting
	 */
	public function setAccounting(array $accounting = []) : void
	{
		$this->accounting = ValueFormatter::formatList(
			'int', $accounting
		);
	}

	public function getDescription() : ?string
	{
		return $this->description;
	}

	public function setDescription(string $description = NULL) : void
	{
		$this->description = $description;
	}

	public function getMerchantData() : ?string
	{
		return $this->merchantData;
	}

	public function setMerchantData(string $merchantData = NULL) : void
	{
		$this->merchantData = $merchantData;
	}

	/**
	 * @return int[]
	 */
	public function getMethod() : array
	{
		return $this->method;
	}

	/**
	 * @param int[] $method
	 */
	public function setMethod(array $method = [])
	{
		$this->method = ValueFormatter::formatList(
			'int', $method
		);
	}

	public function getSpecificSymbol() : ?string
	{
		return $this->specificSymbol;
	}

	public function setSpecificSymbol(string $specificSymbol = NULL) : void
	{
		$this->specificSymbol = $specificSymbol;
	}

}
