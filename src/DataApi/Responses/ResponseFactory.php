<?php

namespace Tp\DataApi\Responses;

use stdClass;
use Tp\InvalidSignatureException;
use Tp\MissingParameterException;
use Tp\Utils;
use Tp\DataApi\Processors\DateTimeInflater;
use Tp\DataApi\Parameters\Signature;
use Tp\DataApi\Processors\SoapFlattener;
use Tp\MerchantConfig;

class ResponseFactory
{

	/**
	 * @param string             $operation
	 * @param \Tp\MerchantConfig $config
	 * @param stdClass           $data
	 *
	 * @return Response
	 * @throws MissingParameterException
	 * @throws InvalidSignatureException
	 */
	public static function getResponse($operation, MerchantConfig $config, stdClass $data)
	{
		/** @var string|Response $className Only class name. */
		$className = preg_replace(
			['/^get(.+)$/', '/^set(.+)$/'],
			['Tp\DataApi\Responses\Get$1Response', 'Tp\DataApi\Responses\Set$1Response'],
			$operation
		);

		$array = Utils::toArrayRecursive($data);

		$listPaths = $className::listPaths();
		$flattened = SoapFlattener::processWithPaths(
			$array, $listPaths
		);

		Signature::validate($flattened, $config->dataApiPassword);

		$dateTimePaths = $className::dateTimePaths();
		$inflated = DateTimeInflater::processWithPaths(
			$flattened, $dateTimePaths
		);

		$response = $className::createFromResponse($inflated);

		return $response;
	}

}
