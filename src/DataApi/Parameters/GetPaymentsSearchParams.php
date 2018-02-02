<?php
declare(strict_types=1);

namespace Tp\DataApi\Parameters;

use DateTime;
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
	public function getAccountId() : ?array
	{
		return $this->accountId;
	}

	/**
	 * @param int[]|null $accountId
	 */
	public function setAccountId(?array $accountId = []) : void
	{
		$this->accountId = ValueFormatter::formatList(
			'int', $accountId
		);
	}

	/**
	 * @return int[]|null
	 */
	public function getState() : ?array
	{
		return $this->state;
	}

	/**
	 * @param int[]|null $state
	 */
	public function setState(array $state = []) : void
	{
		$this->state = ValueFormatter::formatList(
			'int', $state
		);
	}

	/**
	 * @return int[]|null
	 */
	public function getCurrency() : ?array
	{
		return $this->currency;
	}

	/**
	 * @param int[]|null $currency
	 */
	public function setCurrency(array $currency = []) : void
	{
		$this->currency = ValueFormatter::formatList(
			'int', $currency
		);
	}

	/**
	 * @return float|null
	 */
	public function getValueFrom() : ?float
	{
		return $this->valueFrom;
	}

	/**
	 * @param float|null $valueFrom
	 */
	public function setValueFrom(?float $valueFrom = NULL) : void
	{
		$this->valueFrom = $valueFrom;
	}

	/**
	 * @return float|null
	 */
	public function getValueTo() : ?float
	{
		return $this->valueTo;
	}

	/**
	 * @param float|null $valueTo
	 */
	public function setValueTo(?float $valueTo = NULL) : void
	{
		$this->valueTo = $valueTo;
	}

	/**
	 * @return DateTime|null
	 */
	public function getCreatedOnFrom() : ?DateTime
	{
		return $this->createdOnFrom;
	}

	/**
	 * @param DateTime|string|null $createdOnFrom
	 */
	public function setCreatedOnFrom($createdOnFrom = NULL) : void
	{
		$this->createdOnFrom = ValueFormatter::format(
			'DateTime', $createdOnFrom
		);
	}

	public function getCreatedOnTo() : ?DateTime
	{
		return $this->createdOnTo;
	}

	/**
	 * @param DateTime|string|null $createdOnTo
	 */
	public function setCreatedOnTo($createdOnTo = NULL) : void
	{
		$this->createdOnTo = ValueFormatter::format(
			'DateTime', $createdOnTo
		);
	}

	public function getFinishedOnFrom() : ?DateTime
	{
		return $this->finishedOnFrom;
	}

	/**
	 * @param DateTime|string|null $finishedOnFrom
	 */
	public function setFinishedOnFrom($finishedOnFrom = NULL) : void
	{
		$this->finishedOnFrom = ValueFormatter::format(
			'DateTime', $finishedOnFrom
		);
	}

	public function getFinishedOnTo() : ?DateTime
	{
		return $this->finishedOnTo;
	}

	/**
	 * @param DateTime|string|null $finishedOnTo
	 */
	public function setFinishedOnTo(DateTime $finishedOnTo = NULL) : void
	{
		$this->finishedOnTo = ValueFormatter::format(
			'DateTime', $finishedOnTo
		);
	}

	/**
	 * @return int[]|null
	 */
	public function getAccounting() : ?array
	{
		return $this->accounting;
	}

	/**
	 * @param int[]|null $accounting
	 */
	public function setAccounting(?array $accounting = []) : void
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
	 * @return int[]|null
	 */
	public function getMethod() : ?array
	{
		return $this->method;
	}

	/**
	 * @param int[]|null $method
	 */
	public function setMethod(?array $method = [])
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
