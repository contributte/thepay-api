<?php
TpUtils::requirePaths(array(
	array('dataApi', 'responses',  'TpDataApiResponse.php'),
	array('dataApi', 'parameters', 'TpDataApiPaginationResponse.php'),
	array('dataApi', 'parameters', 'TpDataApiPayment.php')
));

class TpDataApiGetPaymentsResponse extends TpDataApiResponse {

	protected static $listPaths = array(
		array('payments', 'payment')
	);

	protected static $dateTimePaths = array(
		array('payments', 'createdOn'),
		array('payments', 'finishedOn'),
		array('payments', 'canceledOn')
	);

	/**
	 * @var TpDataApiPayment[]
	 */
	protected $payments = array();

	/**
	 * @var TpDataApiPaginationResponse|null
	 */
	protected $pagination;

	/**
	 * @param array $response
	 * @return TpDataApiGetPaymentsResponse
	 */
	public static function createFromResponse(array $response) {
		/** @var TpDataApiGetPaymentsResponse $instance */
		$instance = parent::createFromResponse($response);

		$payments = array();
		foreach($response['payments'] as $payment) {
			$payments[] = new TpDataApiPayment($payment);
		}
		unset($payment);
		$instance->setPayments($payments);

		$pagination = new TpDataApiPaginationResponse($response['pagination']);
		$instance->setPagination($pagination);

		return $instance;
	}

	/**
	 * @return TpDataApiPayment[]
	 */
	public function getPayments() {
		return $this->payments;
	}

	/**
	 * @param TpDataApiPayment[] $payments
	 */
	public function setPayments(array $payments = array()) {
		$this->payments = TpValueFormatter::formatList(
			'TpDataApiPayment', $payments
		);
	}

	/**
	 * @return TpDataApiPaginationResponse|null
	 */
	public function getPagination() {
		return $this->pagination;
	}

	/**
	 * @param TpDataApiPaginationResponse|null $pagination
	 */
	public function setPagination(TpDataApiPaginationResponse $pagination) {
		$this->pagination = TpValueFormatter::format(
			'TpDataApiPaginationResponse', $pagination
		);
	}

}
