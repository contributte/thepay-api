<?php

namespace Tp\Helper;

use Tp;

/**
 * @author Michal Kandr
 */
class Card {

	protected static function getSignature($data) {
		return md5(http_build_query(array_filter($data)));
	}

	public static function depositPayment(Tp\MerchantConfig $config, $merchantData){
		$client = new \SoapClient($config->webServicesWsdl);
		$signature = static::getSignature(array(
			'merchantId' => $config->merchantId,
			'accountId' => $config->accountId,
			'merchantData' => $merchantData,
			'password' => $config->password,
		));
		$result = $client->cardDepositPaymentRequest(
			$config->merchantId,
			$config->accountId,
			$merchantData,
			$signature);
		if( ! $result){
			throw new Tp\Exception();
		}
		return new Tp\CardPaymentResponse($result);
	}

	public static function stornoPayment(Tp\MerchantConfig $config, $merchantData){
		$client = new \SoapClient($config->webServicesWsdl);
		$signature = static::getSignature(array(
			'merchantId' => $config->merchantId,
			'accountId' => $config->accountId,
			'merchantData' => $merchantData,
			'password' => $config->password,
		));
		$result = $client->cardStornoPaymentRequest(
			$config->merchantId,
			$config->accountId,
			$merchantData,
			$signature);
		if( ! $result){
			throw new Tp\Exception();
		}
		return new Tp\CardPaymentResponse($result);
	}

	public static function createNewRecurrentPayment(Tp\MerchantConfig $config, $merchantData, $newMerchantData, $value){
		$client = new \SoapClient($config->webServicesWsdl);
		$signature = static::getSignature(array(
			'merchantId' => $config->merchantId,
			'accountId' => $config->accountId,
			'merchantData' => $merchantData,
			'newMerchantData' => $newMerchantData,
			'value' => $value,
			'password' => $config->password,
		));

		$result = $client->cardCreateRecurrentPaymentRequest(
			$config->merchantId,
			$config->accountId,
			$merchantData,
			$newMerchantData,
			$value,
			$signature);
		if( ! $result){
			throw new Tp\Exception();
		}
		return new Tp\CardPaymentResponse($result);
	}
}
