<?php
TpUtils::requirePaths(array(
	array('dataApi', 'processors', 'TpDataApiProcessorWithPaths.php')
));

class TpDataApiSoapFlattener extends TpDataApiProcessorWithPaths {

	/**
	 * @param array $value
	 * @param string[] $currentPath
	 * @return mixed
	 */
	protected function processHash(array $value, array $currentPath) {
		// If the hash contains only one item and its key appended to the path
		// is on the list of list paths, this one item is skipped and the list
		// is processed directly.
		$count = count($value);
		if($count == 1) {
			list($key) = array_keys($value);
			$itemPath = array_merge($currentPath, array($key));
			$onPath = $this->onPath($itemPath);
			if($onPath) {
				list($item) = array_values($value);
				$processed = $this->processItem($item, $currentPath);
			} else {
				$processed = parent::processHash($value, $currentPath);
			}
		} else {
			$processed = parent::processHash($value, $currentPath);
		}

		return $processed;
	}

}
