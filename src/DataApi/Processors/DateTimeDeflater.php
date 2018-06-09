<?php
declare(strict_types=1);

namespace Tp\DataApi\Processors;

use DateTimeImmutable;
use DateTimeInterface;

class DateTimeDeflater extends ProcessorWithPaths
{
	protected function convertValue($value, array $itemPath)
	{
		$onPath = $this->onPath($itemPath);

		if (
			!is_null($value)
			&& $onPath
			&& $value instanceof DateTimeInterface
		) {
			return $value->format(DateTimeImmutable::ISO8601);
		}

		return $value;
	}
}
