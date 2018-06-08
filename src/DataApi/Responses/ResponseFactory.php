<?php
declare(strict_types=1);

namespace Tp\DataApi\Responses;

use stdClass;
use Tp\DataApi\Parameters\Signature;
use Tp\DataApi\Processors\DateTimeInflater;
use Tp\DataApi\Processors\SoapFlattener;
use Tp\InvalidSignatureException;
use Tp\MerchantConfig;
use Tp\MissingParameterException;
use Tp\Utils;

class ResponseFactory
{
	/**
	 * @throws MissingParameterException
	 * @throws InvalidSignatureException
	 */
	public static function getResponse(
		string $operation,
		MerchantConfig $config,
		stdClass $data
	) : Response {
		/** @var Response $className Only class name. */
		$className = preg_replace(
			['/^get(.+)$/', '/^set(.+)$/'],
			['Tp\DataApi\Responses\Get$1Response', 'Tp\DataApi\Responses\Set$1Response'],
			$operation
		);

		$array = Utils::toArrayRecursive((array)$data);

		$listPaths = $className::listPaths();
		$flattened = SoapFlattener::processWithPaths(
			$array,
			$listPaths
		);

		Signature::validate($flattened, $config->dataApiPassword);

		$dateTimePaths = $className::dateTimePaths();
		$inflated = DateTimeInflater::processWithPaths(
			$flattened,
			$dateTimePaths
		);

		return $className::createFromResponse($inflated);
	}
}
