<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'TpCardPaymentResponse.php'));

/**
 * @author Michal Kandr
 */
class TpCardHelper {
	protected static function getSignature($data) {
		return md5(http_build_query(array_filter($data)));
	}

	public static function depositPayment(TpMerchantConfig $config, $merchantData){
		$client = new SoapClient($config->webServicesWsdl);
		$signature = static::getSignature([
			'merchantId'   => $config->merchantId,
			'accountId'    => $config->accountId,
			'merchantData' => $merchantData,
			'password'     => $config->password
		]);
		$result = $client->cardDepositPaymentRequest([
			'merchantId'   => $config->merchantId,
			'accountId'    => $config->accountId,
			'merchantData' => $merchantData,
			'signature'    => $signature
		]);
		if( ! $result){
			throw new TpException();
		}
		return new TpCardPaymentResponse($result);
	}

	public static function stornoPayment(TpMerchantConfig $config, $merchantData){
		$client = new SoapClient($config->webServicesWsdl);
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
			throw new TpException();
		}
		return new TpCardPaymentResponse($result);
	}

	public static function createNewRecurrentPayment(TpMerchantConfig $config, $merchantData, $newMerchantData, $value){
		$client = new SoapClient($config->webServicesWsdl);
		$signature = static::getSignature([
			'merchantId'      => $config->merchantId,
			'accountId'       => $config->accountId,
			'merchantData'    => $merchantData,
			'newMerchantData' => $newMerchantData,
			'value'           => $value,
			'password'        => $config->password,
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
			throw new TpException();
		}
		return new TpCardPaymentResponse($result);
	}

}
