<?php
TpUtils::requirePaths(array(
	array('dataApi', 'processors', 'TpDataApiProcessorWithPaths.php')
));

class TpDataApiDateTimeDeflater extends TpDataApiProcessorWithPaths {

	/**
	 * @param mixed $value
	 * @param array $currentPath
	 * @return mixed
	 */
	protected function processItem($value, array $currentPath) {
		$isNull = is_null($value);
		if($isNull) {
			$processed = null;
		} else {
			$onPath = $this->onPath($currentPath);
			if($onPath) {
				/** @var DateTime $value */
				$processed = $value->format('c');
			} else {
				$processed = parent::processItem(
					$value, $currentPath
				);
			}
		}

		return $processed;
	}

}
