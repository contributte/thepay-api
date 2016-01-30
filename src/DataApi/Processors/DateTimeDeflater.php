<?php

namespace Tp\DataApi\Processors;

use DateTime;

class DateTimeDeflater extends ProcessorWithPaths
{

	/**
	 * @param mixed $value
	 * @param array $currentPath
	 *
	 * @return mixed
	 */
	protected function processItem($value, array $currentPath)
	{
		$isNull = is_null($value);
		if ($isNull) {
			$processed = NULL;
		}
		else {
			$onPath = $this->onPath($currentPath);
			if ($onPath) {
				/** @var DateTime $value */
				$processed = $value->format('c');
			}
			else {
				$processed = parent::processItem(
					$value, $currentPath
				);
			}
		}

		return $processed;
	}

}
