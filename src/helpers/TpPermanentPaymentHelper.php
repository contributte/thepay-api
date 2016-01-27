<?php
// Anonymous function prevents exposing global variables.
call_user_func(function() {
	// TpUtils must be loaded manually…
	$pathArray = array(__DIR__, '..', 'TpUtils.php');
	$pathString = implode(DIRECTORY_SEPARATOR, $pathArray);
	require_once $pathString;
});

// …everything else can be loaded using TpUtils::requirePaths.
TpUtils::requirePaths(array(
	array('TpPermanentPayment.php'),
	array('TpPermanentPaymentResponse.php'),
	array('exceptions', 'TpException.php')
));
/**
 *
 * @author Michal Kandr
 */
class TpPermanentPaymentHelper {
	public static function createPermanentPayment(TpPermanentPayment $payment){
		$config = $payment->getConfig();
		$client = new SoapClient(
			$config->webServicesWsdl,
			['features' => SOAP_SINGLE_ELEMENT_ARRAYS]
		);
		$result = $client->createPermanentPaymentRequest([
			'merchantId'   => $config->merchantId,
			'accountId'    => $config->accountId,
			'merchantData' => $payment->getMerchantData(),
			'description'  => $payment->getDescription(),
			'returnUrl'    => $payment->getReturnUrl(),
			'signature'    => $payment->getSignature()
		]);
		if( ! $result){
			throw new TpException();
		}
		return new TpPermanentPaymentResponse($result);
	}

	public static function getPermanentPayment(TpPermanentPayment $payment){
		$config = $payment->getConfig();
		$client = new SoapClient(
			$config->webServicesWsdl,
			['features' => SOAP_SINGLE_ELEMENT_ARRAYS]
		);
		$result = $client->getPermanentPaymentRequest([
			'merchantId'   => $config->merchantId,
			'accountId'    => $config->accountId,
			'merchantData' => $payment->getMerchantData(),
			'signature'    => $payment->getSignatureLite()
		]);
		if( ! $result){
			throw new TpException();
		}
		return new TpPermanentPaymentResponse($result);
	}
}
