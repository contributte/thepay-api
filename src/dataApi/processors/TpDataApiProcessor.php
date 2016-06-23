<?php
abstract class TpDataApiProcessor {

	/**
	 * @param array $input
	 * @return array
	 */
	public static function process(array $input) {
		$instance = new static;
		// Start with an empty path [].
		$processed = $instance->processHash($input, array());
		return $processed;
	}

	/**
	 * @param array $value
	 * @param string[] $currentPath
	 * @return mixed
	 */
	protected function processHash(array $value, array $currentPath) {
		$processed = array();
		foreach($value as $key => $item) {
			// Every level deeper appends the currenty key to the path.
			$itemPath = array_merge($currentPath, array($key));
			$processed[$key] = $this->processItem($item, $itemPath);
		}
		unset($key, $item, $itemPath);
		return $processed;
	}

	/**
	 * @param mixed $value
	 * @param string[] $currentPath
	 * @return mixed
	 */
	protected function processItem($value, array $currentPath) {
		$isArray = is_array($value);
		if($isArray) {
			$isList = TpUtils::isList($value);
			if($isList) {
				$processed = $this->processList($value, $currentPath);
			} else {
				$processed = $this->processHash($value, $currentPath);
			}
		} else {
			// Only arrays are treated specially.
			$processed = $value;
		}

		return $processed;
	}

	/**
	 * Seznamy položek mohou obsahovat složené hodnoty určené ku zjednodušení,
	 * avšak jejich číselné klíče se nevkládají jako součást cesty.
	 *
	 * @param array $list
	 * @param string[] $currentPath
	 * @return array
	 */
	protected function processList(array $list, array $currentPath) {
		$processed = array();
		foreach($list as $key => $value) {
			// Numeric list keys are not appended to the path.
			$processed[$key] = $this->processItem($value, $currentPath);
		}
		unset($key, $value);
		return $processed;
	}

}
