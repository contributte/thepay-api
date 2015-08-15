<?php

namespace Tp\Helper;

use Tp;

/**
 *
 * @author Michal Kandr
 */
class PermanentPayment {
	public static function createPermanentPayment(Tp\PermanentPayment $payment){
		$client = new \SoapClient($payment->getConfig()->webServicesWsdl);
		$result = $client->createPermanentPaymentRequest(
			$payment->getConfig()->merchantId,
			$payment->getConfig()->accountId,
			$payment->getMerchantData(),
			$payment->getDescription(),
			$payment->getReturnUrl(),
			$payment->getSignature());
		if( ! $result){
			throw new Tp\Exception();
		}
		return new Tp\PermanentPaymentResponse($result);
	}

	public static function getPermanentPayment(Tp\PermanentPayment $payment){
		$client = new \SoapClient($payment->getConfig()->webServicesWsdl);
		$result = $client->getPermanentPaymentRequest(
			$payment->getConfig()->merchantId,
			$payment->getConfig()->accountId,
			$payment->getMerchantData(),
			$payment->getSignatureLite());
		if( ! $result){
			throw new Tp\Exception();
		}
		return new Tp\PermanentPaymentResponse($result);
	}
}
