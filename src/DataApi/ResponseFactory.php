<?php

namespace Tp\DataApi;

use Tp;

class ResponseFactory {

	/**
	 * @param string $operation
	 * @param Tp\MerchantConfig $config
	 * @param \stdClass $result
	 * @return Response
	 */
	public static function getResponse($operation, Tp\MerchantConfig $config, \stdClass $result) {
		$className = preg_replace("/^get(.+)$/", 'Tp\DataApi\Get$1Response', $operation);

		//require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, "$className.php"));

		return new $className($config, $result);
	}
}
