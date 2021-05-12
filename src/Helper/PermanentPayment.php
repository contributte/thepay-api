<?php declare(strict_types = 1);

namespace Tp\Helper;

use SoapClient;
use Tp\Exceptions\Exception as TpException;
use Tp\PermanentPayment as TpPermanentPayment;
use Tp\PermanentPaymentResponse;

class PermanentPayment
{

	public static function createPermanentPayment(
		TpPermanentPayment $payment
	): PermanentPaymentResponse
	{
		$config = $payment->getMerchantConfig();
		$client = new SoapClient(
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

		if ($result === false || $result === null) {
			throw new TpException();
		}

		return new PermanentPaymentResponse($result);
	}

	public static function getPermanentPayment(
		TpPermanentPayment $payment
	): PermanentPaymentResponse
	{
		$config = $payment->getMerchantConfig();
		$client = new SoapClient(
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

		if ($result === false || $result === null) {
			throw new TpException();
		}

		return new PermanentPaymentResponse($result);
	}

}
