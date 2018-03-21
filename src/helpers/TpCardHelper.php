<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'TpUtils.php'));

// …everything else can be loaded using TpUtils::requirePaths.
TpUtils::requirePaths(array(
	array('TpCardPaymentResponse.php'),
	array('TpCardInfoResponse.php'),
	array('exceptions', 'TpException.php')
));

/**
 * @author Michal Kandr
 */
class TpCardHelper {

	protected static function getSignature(array $data) {
		return md5(http_build_query(array_filter($data)));
	}

	/**
	 * @param TpMerchantConfig $config
	 * @param string $merchantData
	 * @return TpCardPaymentResponse
	 * @throws TpException
	 */
	public static function depositPayment(TpMerchantConfig $config, $merchantData){
		$client = new SoapClient($config->webServicesWsdl);
		$signature = static::getSignature(array(
			'merchantId'   => $config->merchantId,
			'accountId'    => $config->accountId,
			'merchantData' => $merchantData,
			'password'     => $config->password
		));
		$result = $client->cardDepositPaymentRequest(array(
			'merchantId'   => $config->merchantId,
			'accountId'    => $config->accountId,
			'merchantData' => $merchantData,
			'signature'    => $signature
		));
		if( ! $result){
			throw new TpException();
		}
		return new TpCardPaymentResponse($result);
	}

	/**
	 *
	 * @param TpMerchantConfig $config
	 * @param string $merchantData
	 * @return TpCardPaymentResponse
	 * @throws TpException
	 */
	public static function stornoPayment(TpMerchantConfig $config, $merchantData){
		$client = new SoapClient($config->webServicesWsdl);
		$signature = static::getSignature(array(
			'merchantId'   => $config->merchantId,
			'accountId'    => $config->accountId,
			'merchantData' => $merchantData,
			'password'     => $config->password
		));
		$result = $client->cardStornoPaymentRequest(array(
			'merchantId'   => $config->merchantId,
			'accountId'    => $config->accountId,
			'merchantData' => $merchantData,
			'signature'    => $signature
		));
		if( ! $result){
			throw new TpException();
		}
		return new TpCardPaymentResponse($result);
	}

	/**
	 *
	 * @param TpMerchantConfig $config
	 * @param string $merchantData
	 * @param string $newMerchantData
	 * @param float $value
	 * @return TpCardPaymentResponse
	 * @throws TpException
	 */
	public static function createNewRecurrentPayment(TpMerchantConfig $config, $merchantData, $newMerchantData, $value){
		$client = new SoapClient($config->webServicesWsdl);
		$signature = static::getSignature(array(
			'merchantId'      => $config->merchantId,
			'accountId'       => $config->accountId,
			'merchantData'    => $merchantData,
			'newMerchantData' => $newMerchantData,
			'value'           => $value,
			'password'        => $config->password,
		));

		$result = $client->cardCreateRecurrentPaymentRequest(array(
			'merchantId'      => $config->merchantId,
			'accountId'       => $config->accountId,
			'merchantData'    => $merchantData,
			'newMerchantData' => $newMerchantData,
			'value'           => $value,
			'signature'       => $signature
		));
		if( ! $result){
			throw new TpException();
		}
		return new TpCardPaymentResponse($result);
	}

	/**
	 *
	 * @param TpMerchantConfig $config
	 * @param integer $paymentId
	 * @return TpCardInfoResponse
	 * @throws TpException
	 */
	public static function getCardInfo(TpMerchantConfig $config, $paymentId) {
		$client = new SoapClient($config->webServicesWsdl);
		$signature = static::getSignature(array(
			'merchantId' => $config->merchantId,
			'accountId' => $config->accountId,
			'paymentId' => $paymentId,
			'password' => $config->password,
		));

		$result = $client->getCardInfoRequest(array(
			'merchantId' => $config->merchantId,
			'accountId' => $config->accountId,
			'paymentId' => $paymentId,
			'signature' => $signature
		));
		if (!$result) {
			throw new TpException();
		}
		return new TpCardInfoResponse($result);
	}
}
