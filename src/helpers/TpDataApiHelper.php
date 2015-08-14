<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'dataApi', 'TpDataApiSignedArray.php'));
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'dataApi', 'TpDataApiResponseFactory.php'));
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'exceptions', 'TpSoapException.php'));

class TpDataApiHelper {

	/**
	 * @param TpMerchantConfig $config
	 * @param bool $onlyActive
	 * @return TpDataApiGetPaymentMethodsResponse
	 * @throws TpSoapException
	 */
	public static function getPaymentMethods(TpMerchantConfig $config, $onlyActive = null) {
		$request = array_merge(
			array('accountId' => $config->accountId),
			(is_null($onlyActive) || $onlyActive === "") ? array() : array('onlyActive' => $onlyActive)
		);
		return self::call(__FUNCTION__, $config, $request);
	}

	/**
	 * @param TpMerchantConfig $config
	 * @param int $paymentId
	 * @return TpDataApiGetPaymentResponse
	 * @throws TpSoapException
	 */
	public static function getPayment(TpMerchantConfig $config, $paymentId) {
		$request = array('paymentId' => $paymentId);
		return self::call(__FUNCTION__, $config, $request);
	}

	public static function getPaymentInstructions(TpMerchantConfig $config, $paymentId) {
		$request = array('paymentId' => $paymentId);
		return self::call(__FUNCTION__, $config, $request);
	}

	public static function getPaymentState(TpMerchantConfig $config, $paymentId) {
		$request = array('paymentId' => $paymentId);
		return self::call(__FUNCTION__, $config, $request);
	}

	/**
	 * @param string $operation
	 * @param TpMerchantConfig $config
	 * @param array $request
	 * @return TpDataApiResponse
	 * @throws TpSoapException
	 */
	protected static function call($operation, TpMerchantConfig $config, array $request) {
		$request = array_merge(
			array('merchantId' => $config->merchantId),
			$request
		);

		try {
			$client = new SoapClient($config->dataWebServicesWsdl);
			$signedRequest = new TpDataApiSignedArray($request, $config->dataApiPassword);
			$result = $client->$operation($signedRequest->signed());
		} catch(SoapFault $e) {
			throw new TpSoapException($e->getMessage());
		}

		return TpDataApiResponseFactory::getResponse($operation, $config, $result);
	}

}