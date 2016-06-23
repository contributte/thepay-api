<?php
class TpDataApiRequestFactory {

	/**
	 * @param string $operation
	 * @param array $data
	 * @return TpDataApiRequest
	 */
	public static function getRequest($operation, TpMerchantConfig $config, array $data) {
		/** @var TpDataApiRequest $className Only class name. */
		$className = preg_replace(
			'/^get(.+)$/', 'TpDataApiGet$1Request', $operation
		);

		$fileName = $className . '.php';
		TpUtils::requirePaths(array(
			array('dataApi', 'requests', $fileName)
		));

		$request = $className::createWithConfig($config, $data);
		return $request;
	}

}