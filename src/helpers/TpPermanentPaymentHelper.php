<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'TpPermanentPayment.php'));
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'TpPermanentPaymentResponse.php'));
/**
 *
 * @author Michal Kandr
 */
class TpPermanentPaymentHelper {
	public static function createPermanentPayment(TpPermanentPayment $payment){
		$client = new SoapClient($payment->getConfig()->webServicesWsdl);
		$result = $client->createPermanentPaymentRequest(
			$payment->getConfig()->merchantId,
			$payment->getConfig()->accountId,
			$payment->getMerchantData(),
			$payment->getDescription(),
			$payment->getReturnUrl(),
			$payment->getSignature());
		if( ! $result){
			throw new TpException();
		}
		return new TpPermanentPaymentResponse($result);
	}

	public static function getPermanentPayment(TpPermanentPayment $payment){
		$client = new SoapClient($payment->getConfig()->webServicesWsdl);
		$result = $client->getPermanentPaymentRequest(
			$payment->getConfig()->merchantId,
			$payment->getConfig()->accountId,
			$payment->getMerchantData(),
			$payment->getSignatureLite());
		if( ! $result){
			throw new TpException();
		}
		return new TpPermanentPaymentResponse($result);
	}
}
