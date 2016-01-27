<?php
TpUtils::requirePaths(array(
	array('dataApi', 'processors', 'TpDataApiSoapFlattener.php'),
	array('dataApi', 'processors', 'TpDataApiDateTimeInflater.php'),
	array('dataApi', 'parameters', 'TpDataApiSignature.php'),
));

class TpDataApiResponseFactory {

	/**
	 * @param string $operation
	 * @param TpMerchantConfig $config
	 * @param stdClass $data
	 * @return TpDataApiResponse
	 * @throws TpInvalidSignatureException
	 */
	public static function getResponse($operation, TpMerchantConfig $config, stdClass $data) {
		/** @var string|TpDataApiResponse $className Only class name. */
		$className = preg_replace(
			'/^get(.+)$/', 'TpDataApiGet$1Response', $operation
		);

		$fileName = $className . '.php';
		TpUtils::requirePaths(array(
			array('dataApi', 'responses', $fileName)
		));

		$array = TpUtils::toArrayRecursive($data);

		$listPaths = $className::listPaths();
		$flattened = TpDataApiSoapFlattener::processWithPaths(
			$array, $listPaths
		);

		TpDataApiSignature::validate($flattened, $config->dataApiPassword);

		$dateTimePaths = $className::dateTimePaths();
		$inflated = TpDataApiDateTimeInflater::processWithPaths(
			$flattened, $dateTimePaths
		);

		$response = $className::createFromResponse($inflated);
		return $response;
	}

}
