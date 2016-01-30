<?php

namespace Tp\DataApi\Requests;

use Tp\Utils;
use Tp\MerchantConfig;

class RequestFactory
{

	/**
	 * @param string $operation
	 * @param array  $data
	 *
	 * @return Request
	 */
	public static function getRequest($operation, MerchantConfig $config, array $data)
	{
		/** @var Request $className Only class name. */
		$className = preg_replace(
			'/^get(.+)$/', 'Tp\DataApi\Requests\Get$1Request', $operation
		);

		$request = $className::createWithConfig($config, $data);

		return $request;
	}

}