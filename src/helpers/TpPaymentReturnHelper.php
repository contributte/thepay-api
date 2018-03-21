<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'TpUtils.php'));

// …everything else can be loaded using TpUtils::requirePaths.
TpUtils::requirePaths(array(
	array('TpPaymentReturnResponse.php'),
	array('exceptions', 'TpException.php')
));

/**
 * @author Michal Kandr
 */
class TpPaymentReturnHelper {
	protected static function getSignature($data) {
		return md5(http_build_query(array_filter($data)));
	}
	/**
	 * @param TpMerchantConfig $config
	 * @param integer $paymentId
	 * @param string $reason
	 * @return TpPaymentReturnResponse
	 * @throws TpException
	 */
	public static function returnPayment(TpMerchantConfig $config, $paymentId, $reason = null){
		$client = new SoapClient($config->webServicesWsdl, ['cache_wsdl' => WSDL_CACHE_NONE]);
		$signature = static::getSignature(array(
			'merchantId'   => $config->merchantId,
			'accountId'    => $config->accountId,
			'paymentId'    => $paymentId,
			'reason'       => $reason,
			'password'     => $config->password
		));
		$result = $client->returnPaymentRequest(array(
			'merchantId'   => $config->merchantId,
			'accountId'    => $config->accountId,
			'paymentId'    => $paymentId,
			'reason'       => $reason,
			'signature'    => $signature
		));
		if( ! $result){
			throw new TpException();
		}
		return new TpPaymentReturnResponse($result);
	}
}
