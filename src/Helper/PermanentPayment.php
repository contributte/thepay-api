<?php
declare(strict_types=1);

namespace Tp\Helper;

use Tp;

/**
 * @author Michal Kandr
 */
class PermanentPayment
{
	public static function createPermanentPayment(
		Tp\PermanentPayment $payment
	) : Tp\PermanentPaymentResponse {
		$config = $payment->getMerchantConfig();
		$client = new \SoapClient(
			$config->webServicesWsdl,
			['features' => SOAP_SINGLE_ELEMENT_ARRAYS]
		);

		$result = $client->createPermanentPaymentRequest(
			[
				'merchantId'   => $config->merchantId,
				'accountId'    => $config->accountId,
				'merchantData' => $payment->getMerchantData(),
				'description'  => $payment->getDescription(),
				'returnUrl'    => $payment->getReturnUrl(),
				'signature'    => $payment->getSignature(),
			]
		);

		if (!$result) {
			throw new Tp\Exception;
		}

		return new Tp\PermanentPaymentResponse($result);
	}

	public static function getPermanentPayment(
		Tp\PermanentPayment $payment
	) : Tp\PermanentPaymentResponse {
		$config = $payment->getMerchantConfig();
		$client = new \SoapClient(
			$config->webServicesWsdl,
			['features' => SOAP_SINGLE_ELEMENT_ARRAYS]
		);

		$result = $client->getPermanentPaymentRequest(
			[
				'merchantId'   => $config->merchantId,
				'accountId'    => $config->accountId,
				'merchantData' => $payment->getMerchantData(),
				'signature'    => $payment->getSignatureLite(),
			]
		);

		if (!$result) {
			throw new Tp\Exception;
		}

		return new Tp\PermanentPaymentResponse($result);
	}
}
