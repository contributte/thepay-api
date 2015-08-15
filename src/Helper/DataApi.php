<?php

namespace Tp\Helper;

use Tp;

class DataApi {

	/**
	 * @param Tp\MerchantConfig $config
	 * @param bool $onlyActive
	 * @return Tp\DataApi\GetPaymentMethodsResponse
	 * @throws Tp\SoapException
	 */
	public static function getPaymentMethods(Tp\MerchantConfig $config, $onlyActive = null) {
		$request = array_merge(
			array('accountId' => $config->accountId),
			(is_null($onlyActive) || $onlyActive === "") ? array() : array('onlyActive' => $onlyActive)
		);
		return self::call(__FUNCTION__, $config, $request);
	}

	/**
	 * @param Tp\MerchantConfig $config
	 * @param int $paymentId
	 * @return Tp\DataApi\GetPaymentResponse
	 * @throws Tp\SoapException
	 */
	public static function getPayment(Tp\MerchantConfig $config, $paymentId) {
		$request = array('paymentId' => $paymentId);
		return self::call(__FUNCTION__, $config, $request);
	}

	public static function getPaymentInstructions(Tp\MerchantConfig $config, $paymentId) {
		$request = array('paymentId' => $paymentId);
		return self::call(__FUNCTION__, $config, $request);
	}

	public static function getPaymentState(Tp\MerchantConfig $config, $paymentId) {
		$request = array('paymentId' => $paymentId);
		return self::call(__FUNCTION__, $config, $request);
	}

	/**
	 * @param string $operation
	 * @param Tp\MerchantConfig $config
	 * @param array $request
	 * @return Tp\DataApi\Response
	 * @throws Tp\SoapException
	 */
	protected static function call($operation, Tp\MerchantConfig $config, array $request) {
		$request = array_merge(
			array('merchantId' => $config->merchantId),
			$request
		);

		try {
			$client = new \SoapClient($config->dataWebServicesWsdl);
			$signedRequest = new Tp\DataApi\SignedArray($request, $config->dataApiPassword);
			$result = $client->$operation($signedRequest->signed());
		} catch(\SoapFault $e) {
			throw new Tp\SoapException($e->getMessage());
		}

		return Tp\DataApi\ResponseFactory::getResponse($operation, $config, $result);
	}
}
