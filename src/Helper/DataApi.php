<?php

namespace Tp\Helper;

use SoapClient;
use SoapFault;
use Tp\DataApi\Parameters\GetPaymentsSearchParams;
use Tp\DataApi\Parameters\Ordering;
use Tp\DataApi\Parameters\PaginationRequest;
use Tp\DataApi\Requests\Request;
use Tp\DataApi\Requests\RequestFactory;
use Tp\DataApi\Response;
use Tp\DataApi\Responses\GetPaymentResponse;
use Tp\DataApi\Responses\GetPaymentInstructionsResponse;
use Tp\DataApi\Responses\GetPaymentMethodsResponse;
use Tp\DataApi\Responses\GetPaymentsResponse;
use Tp\DataApi\Responses\GetPaymentStateResponse;
use Tp\DataApi\Responses\ResponseFactory;
use Tp\SoapException;
use Tp\MerchantConfig;

class DataApi
{

	/**
	 * @param \Tp\MerchantConfig $config
	 * @param bool|null          $onlyActive
	 *
	 * @return GetPaymentMethodsResponse
	 * @throws SoapException
	 */
	public static function getPaymentMethods(MerchantConfig $config, $onlyActive = NULL)
	{
		$data = ['onlyActive' => $onlyActive];
		$request = RequestFactory::getRequest(
			__FUNCTION__, $config, $data
		);

		$response = self::call(__FUNCTION__, $config, $request);

		return $response;
	}

	/**
	 * @param \Tp\MerchantConfig $config
	 * @param int                $paymentId
	 *
	 * @return GetPaymentResponse
	 * @throws SoapException
	 */
	public static function getPayment(MerchantConfig $config, $paymentId)
	{
		$data = ['paymentId' => $paymentId];
		$request = RequestFactory::getRequest(
			__FUNCTION__, $config, $data
		);
		$response = self::call(__FUNCTION__, $config, $request);

		return $response;
	}

	/**
	 * @param MerchantConfig $config
	 * @param int            $paymentId
	 *
	 * @return GetPaymentInstructionsResponse
	 * @throws SoapException
	 */
	public static function getPaymentInstructions(MerchantConfig $config, $paymentId)
	{
		$data = ['paymentId' => $paymentId];
		$request = RequestFactory::getRequest(
			__FUNCTION__, $config, $data
		);
		$response = self::call(__FUNCTION__, $config, $request);

		return $response;
	}

	/**
	 * @param \Tp\MerchantConfig $config
	 * @param int                $paymentId
	 *
	 * @return GetPaymentStateResponse
	 * @throws SoapException
	 */
	public static function getPaymentState(MerchantConfig $config, $paymentId)
	{
		$data = ['paymentId' => $paymentId];
		$request = RequestFactory::getRequest(
			__FUNCTION__, $config, $data
		);
		$response = self::call(__FUNCTION__, $config, $request);

		return $response;
	}

	/**
	 * @param MerchantConfig          $config
	 * @param GetPaymentsSearchParams $searchParams
	 * @param PaginationRequest|null  $pagination
	 * @param Ordering|null           $ordering
	 *
	 * @return GetPaymentsResponse
	 * @throws SoapException
	 */
	public static function getPayments(MerchantConfig $config, GetPaymentsSearchParams $searchParams = NULL, PaginationRequest $pagination = NULL, Ordering $ordering = NULL)
	{
		$data = [
			'searchParams' => $searchParams,
			'pagination'   => $pagination,
			'ordering'     => $ordering,
		];
		$request = RequestFactory::getRequest(
			__FUNCTION__, $config, $data
		);
		$response = self::call(__FUNCTION__, $config, $request);

		return $response;
	}

	/**
	 * @param string         $operation
	 * @param MerchantConfig $config
	 * @param Request        $request
	 *
	 * @return Response
	 * @throws SoapException
	 */
	protected static function call($operation, MerchantConfig $config, Request $request)
	{
		try {
			$options = ['features' => SOAP_SINGLE_ELEMENT_ARRAYS];
			$client = new SoapClient($config->dataWebServicesWsdl, $options);
			$signed = $request->toSignedSoapRequestArray();
			$rawResponse = $client->$operation($signed);
		}
		catch (SoapFault $e) {
			throw new SoapException($e->getMessage());
		}

		$response = ResponseFactory::getResponse(
			$operation, $config, $rawResponse
		);

		return $response;
	}

}
