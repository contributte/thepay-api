<?php
declare(strict_types=1);

namespace Tp\DataApi\Processors;

use DateTime;

class DateTimeDeflater extends ProcessorWithPaths
{
	protected function processItem($value, array $currentPath) : array
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
