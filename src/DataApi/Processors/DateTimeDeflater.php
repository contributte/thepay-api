<?php declare(strict_types = 1);

namespace Tp\DataApi\Processors;

use DateTime;
use DateTimeInterface;

class DateTimeDeflater extends ProcessorWithPaths
{

	protected function convertValue($value, array $itemPath)
	{
		$onPath = $this->onPath($itemPath);

		if (
			$value !== null
			&& $onPath
			&& $value instanceof DateTimeInterface
		) {
			return $value->format(DateTime::ISO8601);
		}

		return $value;
	}

}
