<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, 'TpDataApiResponse.php'));

class TpDataApiResponseFactory {

	/**
	 * @param string $operation
	 * @param TpMerchantConfig $config
	 * @param stdClass $result
	 * @return TpDataApiResponse
	 */
	public static function getResponse($operation, TpMerchantConfig $config, stdClass $result) {
		$className = preg_replace("/^get(.+)$/", "TpDataApiGet$1Response", $operation);

		require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, "$className.php"));

		return new $className($config, $result);
	}

}