<?php declare(strict_types = 1);

namespace Tests\Tp\Helper;

use Tester\Assert;
use Tester\TestCase;
use Tp\Helper\DivMerchant;
use Tp\MerchantConfig;
use Tp\Payment;

define('TESTS_ROOT', __DIR__ . '/../..');

require TESTS_ROOT . '/bootstrap.php';

final class DivMerchantTest extends TestCase
{

	/** @var MerchantConfig */
	private $merchantConfig;

	protected function setUp(): void
	{
		$this->merchantConfig = new MerchantConfig();
	}

	public function testMerchantBuildQuery(): void
	{
		$payment = new Payment($this->merchantConfig);
		$divMerchant = new DivMerchant($payment);

		Assert::same(
			'merchantId=1&accountId=1&signature=ab12b518198f1ee13efcdda9721ae678',
			$divMerchant->buildQuery([])
		);
	}

}

$test = new DivMerchantTest();
$test->run();
