<?php
TpUtils::requirePaths(array(
	array('dataApi', 'TpDataApiObject.php'),
	array('dataApi', 'TpValueFormatter.php')
));

class TpDataApiGetPaymentsSearchParams extends TpDataApiObject {

	/**
	 * @var int[]
	 */
	protected $accountId = array();

	/**
	 * @var int[]
	 */
	protected $state = array();

	/**
	 * @var int[]
	 */
	protected $currency = array();

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
	protected $accounting = array();

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
	protected $method = array();

	/**
	 * @var string|null
	 */
	protected $specificSymbol;

	/**
	 * @return int[]|null
	 */
	public function getAccountId() {
		return $this->accountId;
	}

	/**
	 * @param int[]|null $accountId
	 */
	public function setAccountId(array $accountId = array()) {
		$this->accountId = TpValueFormatter::formatList('int', $accountId);
	}

	/**
	 * @return int[]|null
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * @param int[]|null $state
	 */
	public function setState(array $state = array()) {
		$this->state = TpValueFormatter::formatList('int', $state);
	}

	/**
	 * @return int[]|null
	 */
	public function getCurrency() {
		return $this->currency;
	}

	/**
	 * @param int[]|null $currency
	 */
	public function setCurrency(array $currency = array()) {
		$this->currency = TpValueFormatter::formatList('int', $currency);
	}

	/**
	 * @return float|null
	 */
	public function getValueFrom() {
		return $this->valueFrom;
	}

	/**
	 * @param float|null $valueFrom
	 */
	public function setValueFrom($valueFrom = null) {
		$this->valueFrom = $valueFrom;
	}

	/**
	 * @return float|null
	 */
	public function getValueTo() {
		return $this->valueTo;
	}

	/**
	 * @param float|null $valueTo
	 */
	public function setValueTo($valueTo = null) {
		$this->valueTo = $valueTo;
	}

	/**
	 * @return DateTime|null
	 */
	public function getCreatedOnFrom() {
		return $this->createdOnFrom;
	}

	/**
	 * @param DateTime|string|null $createdOnFrom
	 */
	public function setCreatedOnFrom($createdOnFrom = null) {
		$this->createdOnFrom = TpValueFormatter::format(
			'DateTime', $createdOnFrom
		);
	}

	/**
	 * @return DateTime|null
	 */
	public function getCreatedOnTo() {
		return $this->createdOnTo;
	}

	/**
	 * @param DateTime|string|null $createdOnTo
	 */
	public function setCreatedOnTo($createdOnTo = null) {
		$this->createdOnTo = TpValueFormatter::format('DateTime', $createdOnTo);
	}

	/**
	 * @return DateTime|null
	 */
	public function getFinishedOnFrom() {
		return $this->finishedOnFrom;
	}

	/**
	 * @param DateTime|string|null $finishedOnFrom
	 */
	public function setFinishedOnFrom($finishedOnFrom = null) {
		$this->finishedOnFrom = TpValueFormatter::format(
			'DateTime', $finishedOnFrom
		);
	}

	/**
	 * @return DateTime|null
	 */
	public function getFinishedOnTo() {
		return $this->finishedOnTo;
	}

	/**
	 * @param DateTime|string|null $finishedOnTo
	 */
	public function setFinishedOnTo($finishedOnTo = null) {
		$this->finishedOnTo = TpValueFormatter::format(
			'DateTime', $finishedOnTo
		);
	}

	/**
	 * @return int[]|null
	 */
	public function getAccounting() {
		return $this->accounting;
	}

	/**
	 * @param int[]|null $accounting
	 */
	public function setAccounting(array $accounting = array()) {
		$this->accounting = TpValueFormatter::formatList('int', $accounting);
	}

	/**
	 * @return null|string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param null|string $description
	 */
	public function setDescription($description = null) {
		$this->description = TpValueFormatter::format('string', $description);
	}

	/**
	 * @return null|string
	 */
	public function getMerchantData() {
		return $this->merchantData;
	}

	/**
	 * @param null|string $merchantData
	 */
	public function setMerchantData($merchantData = null) {
		$this->merchantData = TpValueFormatter::format('string', $merchantData);
	}

	/**
	 * @return int[]|null
	 */
	public function getMethod() {
		return $this->method;
	}

	/**
	 * @param int[]|null $method
	 */
	public function setMethod(array $method = array()) {
		$this->method = TpValueFormatter::formatList('int', $method);
	}

	/**
	 * @return null|string
	 */
	public function getSpecificSymbol() {
		return $this->specificSymbol;
	}

	/**
	 * @param string|null $specificSymbol
	 */
	public function setSpecificSymbol($specificSymbol = null) {
		$this->specificSymbol = TpValueFormatter::format(
			'string', $specificSymbol
		);
	}

}