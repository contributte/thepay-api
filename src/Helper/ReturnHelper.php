<?php declare(strict_types = 1);

namespace Tp\Helper;

use SoapClient;
use Tp\Exception;
use Tp\MerchantConfig;
use Tp\PaymentReturnResponse;

class ReturnHelper
{

	protected static function getSignature(array $data)
	{
		return md5(http_build_query(array_filter($data)));
	}

	public static function returnPayment(
		MerchantConfig $config,
		$paymentId,
		$reason = null
	): PaymentReturnResponse
	{
		$client = new SoapClient($config->webServicesWsdl, ['cache_wsdl' => WSDL_CACHE_NONE]);
		$signature = static::getSignature(
			[
				'merchantId' => $config->merchantId,
				'accountId'  => $config->accountId,
				'paymentId'  => $paymentId,
				'reason'     => $reason,
				'password'   => $config->password,
			]
		);

		$result = $client->returnPaymentRequest(
			[
				'merchantId' => $config->merchantId,
				'accountId'  => $config->accountId,
				'paymentId'  => $paymentId,
				'reason'     => $reason,
				'signature'  => $signature,
			]
		);

		if (!$result) {
			throw new Exception;
		}

		return new PaymentReturnResponse($result);
	}

}
