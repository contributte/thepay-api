<?php declare(strict_types = 1);

namespace Tp\Helper;

use SoapClient;
use Tp\Card\InfoResponse;
use Tp\Card\PaymentResponse;
use Tp\Exceptions\Exception;
use Tp\MerchantConfig;

class Card
{

	protected static function getSignature(array $data)
	{
		return md5(http_build_query(array_filter($data)));
	}

	public static function depositPayment(
		MerchantConfig $config,
		$merchantData
	): PaymentResponse
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

		return new PaymentResponse($result);
	}

	public static function stornoPayment(
		MerchantConfig $config,
		$merchantData
	): PaymentResponse
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

		return new PaymentResponse($result);
	}

	public static function createNewRecurrentPayment(
		MerchantConfig $config,
		$merchantData,
		$newMerchantData,
		$value
	): PaymentResponse
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

		return new PaymentResponse($result);
	}

	public static function getCardInfo(
		MerchantConfig $config,
		int $paymentId
	): InfoResponse
	{
		$client = new SoapClient($config->webServicesWsdl);

		$signature = static::getSignature([
			'merchantId' => $config->merchantId,
			'accountId'  => $config->accountId,
			'paymentId'  => $paymentId,
			'password'   => $config->password,
		]);

		$result = $client->getCardInfoRequest([
			'merchantId' => $config->merchantId,
			'accountId'  => $config->accountId,
			'paymentId'  => $paymentId,
			'signature'  => $signature,
		]);

		if (!$result) {
			throw new Exception();
		}

		return new InfoResponse($result);
	}

}
