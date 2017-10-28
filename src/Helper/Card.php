<?php

namespace Tp\Helper;

use SoapClient;
use Tp\Exception;
use Tp\CardPaymentResponse;
use Tp\MerchantConfig;

/**
 * @author Michal Kandr
 */
class Card
{
	protected static function getSignature($data)
	{
		return md5(http_build_query(array_filter($data)));
	}

	public static function depositPayment(MerchantConfig $config, $merchantData)
	{
		$client = new SoapClient($config->webServicesWsdl);
		$signature = static::getSignature(
			[
				'merchantId'   => $config->merchantId,
				'accountId'    => $config->accountId,
				'merchantData' => $merchantData,
				'password'     => $config->password,
			]
		);
		$result = $client->cardDepositPaymentRequest(
			[
				'merchantId'   => $config->merchantId,
				'accountId'    => $config->accountId,
				'merchantData' => $merchantData,
				'signature'    => $signature,
			]
		);
		if (!$result) {
			throw new Exception();
		}

		return new CardPaymentResponse($result);
	}

	public static function stornoPayment(MerchantConfig $config, $merchantData)
	{
		$client = new SoapClient($config->webServicesWsdl);
		$signature = static::getSignature(
			[
				'merchantId'   => $config->merchantId,
				'accountId'    => $config->accountId,
				'merchantData' => $merchantData,
				'password'     => $config->password,
			]
		);
		$result = $client->cardStornoPaymentRequest(
			[
				'merchantId'   => $config->merchantId,
				'accountId'    => $config->accountId,
				'merchantData' => $merchantData,
				'signature'    => $signature,
			]
		);
		if (!$result) {
			throw new Exception();
		}

		return new CardPaymentResponse($result);
	}

	public static function createNewRecurrentPayment(MerchantConfig $config, $merchantData, $newMerchantData, $value)
	{
		$client = new SoapClient($config->webServicesWsdl);
		$signature = static::getSignature(
			[
				'merchantId'      => $config->merchantId,
				'accountId'       => $config->accountId,
				'merchantData'    => $merchantData,
				'newMerchantData' => $newMerchantData,
				'value'           => $value,
				'password'        => $config->password,
			]
		);

		$result = $client->cardCreateRecurrentPaymentRequest(
			[
				'merchantId'      => $config->merchantId,
				'accountId'       => $config->accountId,
				'merchantData'    => $merchantData,
				'newMerchantData' => $newMerchantData,
				'value'           => $value,
				'signature'       => $signature,
			]
		);
		if (!$result) {
			throw new Exception();
		}

		return new CardPaymentResponse($result);
	}

}
