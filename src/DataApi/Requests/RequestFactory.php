<?php
declare(strict_types=1);

namespace Tp\DataApi\Requests;

use Tp\MerchantConfig;

class RequestFactory
{
	public static function getRequest(
		string $operation,
		MerchantConfig $config,
		array $data
	) : Request {
		/** @var Request $className Only class name. */
		$className = preg_replace(
			['/^get(.+)$/', '/^set(.+)$/'],
			['Tp\DataApi\Requests\Get$1Request', 'Tp\DataApi\Requests\Set$1Request'],
			$operation
		);

		return $className::createWithConfig($config, $data);
	}
}
