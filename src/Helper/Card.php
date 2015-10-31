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
		$signature = static::getSignature([
			'merchantId' => $config->merchantId,
			'accountId' => $config->accountId,
			'merchantData' => $merchantData,
			'password' => $config->password
		]);
		$result = $client->cardDepositPaymentRequest([
			'merchantId'   => $config->merchantId,
			'accountId'    => $config->accountId,
			'merchantData' => $merchantData,
			'signature'    => $signature
		]);
		if( ! $result){
			throw new Tp\Exception();
		}
		return new Tp\CardPaymentResponse($result);
	}

	public static function stornoPayment(Tp\MerchantConfig $config, $merchantData){
		$client = new \SoapClient($config->webServicesWsdl);
		$signature = static::getSignature([
			'merchantId'   => $config->merchantId,
			'accountId'    => $config->accountId,
			'merchantData' => $merchantData,
			'password'     => $config->password
		]);
		$result = $client->cardStornoPaymentRequest([
			'merchantId'   => $config->merchantId,
			'accountId'    => $config->accountId,
			'merchantData' => $merchantData,
			'signature'    => $signature
		]);
		if( ! $result){
			throw new Tp\Exception();
		}
		return new Tp\CardPaymentResponse($result);
	}

	public static function createNewRecurrentPayment(Tp\MerchantConfig $config, $merchantData, $newMerchantData, $value){
		$client = new \SoapClient($config->webServicesWsdl);
		$signature = static::getSignature([
			'merchantId' => $config->merchantId,
			'accountId' => $config->accountId,
			'merchantData' => $merchantData,
			'newMerchantData' => $newMerchantData,
			'value' => $value,
			'password' => $config->password,
		]);
		$result = $client->cardCreateRecurrentPaymentRequest([
			'merchantId'      => $config->merchantId,
			'accountId'       => $config->accountId,
			'merchantData'    => $merchantData,
			'newMerchantData' => $newMerchantData,
			'value'           => $value,
			'signature'       => $signature
		]);
		if( ! $result){
			throw new Tp\Exception();
		}
		return new Tp\CardPaymentResponse($result);
	}
}
