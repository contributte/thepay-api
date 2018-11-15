<?php declare(strict_types = 1);

namespace Tests\Tp\Helper;

use Tester\Assert;
use Tester\TestCase;
use Tp\DataApi\Parameters\MerchantAccountMethod;
use Tp\DataApi\Responses\GetPaymentMethodsResponse;
use Tp\Helper\DataApi;
use Tp\MerchantConfig;

require __DIR__ . '/../../bootstrap.php';

final class DataApiTest extends TestCase
{

	/** @var MerchantConfig */
	private $merchantConfig;

	protected function setUp(): void
	{
		$this->merchantConfig = new MerchantConfig();
	}

	public function testGetPaymentMethods(): void
	{
		$paymentMethodsResponse = DataApi::getPaymentMethods($this->merchantConfig);

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
	}

}

$test = new DataApiTest();
$test->run();
