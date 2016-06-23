<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'TpUtils.php'));

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
			array('features' => SOAP_SINGLE_ELEMENT_ARRAYS)
		);
		$result = $client->createPermanentPaymentRequest(array(
			'merchantId'   => $config->merchantId,
			'accountId'    => $config->accountId,
			'merchantData' => $payment->getMerchantData(),
			'description'  => $payment->getDescription(),
			'returnUrl'    => $payment->getReturnUrl(),
			'signature'    => $payment->getSignature()
		));
		if( ! $result){
			throw new TpException();
		}
		return new TpPermanentPaymentResponse($result);
	}

	public static function getPermanentPayment(TpPermanentPayment $payment){
		$config = $payment->getConfig();
		$client = new SoapClient(
			$config->webServicesWsdl,
			array('features' => SOAP_SINGLE_ELEMENT_ARRAYS)
		);
		$result = $client->getPermanentPaymentRequest(array(
			'merchantId'   => $config->merchantId,
			'accountId'    => $config->accountId,
			'merchantData' => $payment->getMerchantData(),
			'signature'    => $payment->getSignatureLite()
		));
		if( ! $result){
			throw new TpException();
		}
		return new TpPermanentPaymentResponse($result);
	}
}
