<?php declare(strict_types = 1);

namespace Tests\Cases\Helper;

use Contributte\Tester\Toolkit;
use Tester\Assert;
use Tp\Helper\DivMerchant;
use Tp\MerchantConfig;
use Tp\Payment;

require __DIR__ . '/../../bootstrap.php';

Toolkit::test(function (): void {
	$merchantConfig = new MerchantConfig();
	$payment = new Payment($merchantConfig);
	$divMerchant = new DivMerchant($payment);

	Assert::same(
		'merchantId=1&accountId=1&signature=ab12b518198f1ee13efcdda9721ae678',
		$divMerchant->buildQuery([])
	);
});
