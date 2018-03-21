<?php
TpUtils::requirePaths(array(
	array('dataApi', 'processors', 'TpDataApiProcessorWithPaths.php'),
	array('exceptions', 'TpInvalidParameterException.php')
));

class TpDataApiDateTimeInflater extends TpDataApiProcessorWithPaths {

	/**
	 * @param mixed $value
	 * @param string[] $currentPath
	 * @return mixed
	 * @throws TpInvalidParameterException
	 */
	protected function processItem($value, array $currentPath) {
		if(is_null($value)) {
			$processed = parent::processItem($value, $currentPath);
		} else {
			if($this->onPath($currentPath)) {
				// Pozor, neprojde, pokud časové razítko obsahuje desetinnou část
				// vteřin. Viz https://bugs.php.net/bug.php?id=51950.
				$processed = DateTime::createFromFormat(DateTime::ISO8601, $value);
				if($processed === false) {
					$errorPathArray = $currentPath;
					array_unshift($errorPathArray, '');
					$errorPathString = implode('/', $errorPathArray);
					throw new TpInvalidParameterException($errorPathString);
				}
			} else {
				$processed = parent::processItem($value, $currentPath);
			}
		}

		return $processed;
	}

}
