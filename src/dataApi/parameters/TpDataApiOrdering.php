<?php
TpUtils::requirePaths(array(
	array('dataApi', 'TpDataApiObject.php'),
	array('dataApi', 'TpValueFormatter.php')
));

class TpDataApiOrdering extends TpDataApiObject {

	/**
	 * @var string|null
	 */
	protected $orderBy;

	/**
	 * @var string|null
	 */
	protected $orderHow;

	/**
	 * @return string|null
	 */
	public function getOrderBy() {
		return $this->orderBy;
	}

	/**
	 * @param string|null $orderBy
	 */
	public function setOrderBy($orderBy = null) {
		$this->orderBy = TpValueFormatter::format('string', $orderBy);
	}

	/**
	 * @return string|null
	 */
	public function getOrderHow() {
		return $this->orderHow;
	}

	/**
	 * @param string|null $orderHow
	 */
	public function setOrderHow($orderHow = null) {
		$this->orderHow = TpValueFormatter::format('string', $orderHow);
	}

}
