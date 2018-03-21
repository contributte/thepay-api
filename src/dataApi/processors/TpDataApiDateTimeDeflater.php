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
		if(is_null($value)) {
			$processed = null;
		} else {
			if($this->onPath($currentPath)) {
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
