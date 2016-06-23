<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'TpUtils.php'));

// …everything else can be loaded using TpUtils::requirePaths.
TpUtils::requirePaths(array(
	array('TpMerchantConfig.php'),
	array('exceptions', 'TpSoapException.php'),
	array('dataApi',    'requests',   'TpDataApiRequestFactory.php'),
	array('dataApi',    'responses',  'TpDataApiResponseFactory.php'),
	array('dataApi',    'parameters', 'TpDataApiGetPaymentsSearchParams.php'),
	array('dataApi',    'parameters', 'TpDataApiPaginationRequest.php'),
	array('dataApi',    'parameters', 'TpDataApiOrdering.php')
));

class TpDataApiHelper {

	/**
	 * @param TpMerchantConfig $config
	 * @param bool|null $onlyActive
	 * @return TpDataApiGetPaymentMethodsResponse
	 * @throws TpSoapException
	 */
	public static function getPaymentMethods(TpMerchantConfig $config, $onlyActive = null) {
		$data = array('onlyActive' => $onlyActive);
		$request = TpDataApiRequestFactory::getRequest(
			__FUNCTION__, $config, $data
		);

		$response = self::call(__FUNCTION__, $config, $request);
		return $response;
	}

	/**
	 * @param TpMerchantConfig $config
	 * @param int $paymentId
	 * @return TpDataApiGetPaymentResponse
	 * @throws TpSoapException
	 */
	public static function getPayment(TpMerchantConfig $config, $paymentId) {
		$data = array('paymentId' => $paymentId);
		$request = TpDataApiRequestFactory::getRequest(
			__FUNCTION__, $config, $data
		);
		$response = self::call(__FUNCTION__, $config, $request);
		return $response;
	}

	/**
	 * @param TpMerchantConfig $config
	 * @param int $paymentId
	 * @return TpDataApiGetPaymentInstructionsResponse
	 * @throws TpSoapException
	 */
	public static function getPaymentInstructions(TpMerchantConfig $config, $paymentId) {
		$data = array('paymentId' => $paymentId);
		$request = TpDataApiRequestFactory::getRequest(
			__FUNCTION__, $config, $data
		);
		$response = self::call(__FUNCTION__, $config, $request);
		return $response;
	}

	/**
	 * @param TpMerchantConfig $config
	 * @param int $paymentId
	 * @return TpDataApiGetPaymentStateResponse
	 * @throws TpSoapException
	 */
	public static function getPaymentState(TpMerchantConfig $config, $paymentId) {
		$data = array('paymentId' => $paymentId);
		$request = TpDataApiRequestFactory::getRequest(
			__FUNCTION__, $config, $data
		);
		$response = self::call(__FUNCTION__, $config, $request);
		return $response;
	}

	/**
	 * @param TpMerchantConfig $config
	 * @param TpDataApiGetPaymentsSearchParams $searchParams
	 * @param TpDataApiPaginationRequest|null $pagination
	 * @param TpDataApiOrdering|null $ordering
	 * @return TpDataApiGetPaymentsResponse
	 * @throws TpSoapException
	 */
	public static function getPayments(TpMerchantConfig $config, TpDataApiGetPaymentsSearchParams $searchParams = null, TpDataApiPaginationRequest $pagination = null, TpDataApiOrdering $ordering = null) {
		$data = array(
			'searchParams' => $searchParams,
			'pagination'   => $pagination,
			'ordering'     => $ordering
		);
		$request = TpDataApiRequestFactory::getRequest(
			__FUNCTION__, $config, $data
		);
		$response = self::call(__FUNCTION__, $config, $request);
		return $response;
	}

	/**
	 * @param string $operation
	 * @param TpMerchantConfig $config
	 * @param TpDataApiRequest $request
	 * @return TpDataApiResponse
	 * @throws TpSoapException
	 */
	protected static function call($operation, TpMerchantConfig $config, TpDataApiRequest $request) {
		try {
			$options = array('features' => SOAP_SINGLE_ELEMENT_ARRAYS);
			$client = new SoapClient($config->dataWebServicesWsdl, $options);
			$signed = $request->toSignedSoapRequestArray();
			$rawResponse = $client->$operation($signed);
		} catch(SoapFault $e) {
			throw new TpSoapException($e->getMessage());
		}

		$response = TpDataApiResponseFactory::getResponse(
			$operation, $config, $rawResponse
		);
		return $response;
	}

}
