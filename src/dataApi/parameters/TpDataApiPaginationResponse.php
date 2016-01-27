<?php
TpUtils::requirePaths(array(
	array('dataApi', 'parameters', 'TpDataApiPagination.php')
));

class TpDataApiPaginationResponse extends TpDataApiPagination {

	/**
	 * @var int|null
	 */
	protected $totalPages;

	/**
	 * @return int
	 */
	public function getTotalPages() {
		return $this->totalPages;
	}

	/**
	 * @param int|null $totalPages
	 */
	public function setTotalPages($totalPages = null) {
		$this->totalPages = TpValueFormatter::format('int', $totalPages);
	}

}
