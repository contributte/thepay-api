<?php declare(strict_types = 1);

namespace Tests\Cases\Helper;

use Contributte\Tester\Toolkit;
use Tester\Assert;
use Tp\DataApi\Parameters\MerchantAccountMethod;
use Tp\DataApi\Responses\GetPaymentMethodsResponse;
use Tp\Helper\DataApi;
use Tp\MerchantConfig;

require __DIR__ . '/../../bootstrap.php';

Toolkit::test(function (): void {
	$merchantConfig = new MerchantConfig();
	$paymentMethodsResponse = DataApi::getPaymentMethods($merchantConfig);

	Assert::type(
		GetPaymentMethodsResponse::class,
		$paymentMethodsResponse
	);

	Assert::same(1, $paymentMethodsResponse->getAccountId());
	Assert::same(1, $paymentMethodsResponse->getMerchantId());

	$paymentMethods = $paymentMethodsResponse->getMethods();

	Assert::true(count($paymentMethods) > 0);

	foreach ($paymentMethods as $_paymentMethod) {
		Assert::type(
			MerchantAccountMethod::class,
			$_paymentMethod
		);
	}
});
