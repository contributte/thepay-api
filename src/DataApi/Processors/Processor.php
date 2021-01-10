<?php declare(strict_types = 1);

namespace Tp\DataApi\Processors;

use Tp\Utils;

abstract class Processor
{

	public static function process(array $input): array
	{
		$instance = new static(); /* @phpstan-ignore-line */
		// Start with an empty path [].
		return $instance->processHash($input, []);
	}

	/**
	 * @param string[]|int[] $currentPath
	 */
	protected function processHash(array $value, array $currentPath): array
	{
		$processed = [];
		foreach ($value as $key => $item) {
			// Every level deeper appends the currenty key to the path.
			$itemPath = array_merge($currentPath, [$key]);
			$processed[$key] = is_array($item)
				? $this->processItem($item, $itemPath)
				: $this->convertValue($item, $itemPath);
		}

		return $processed;
	}

	/**
	 * @param string[]|int[] $currentPath
	 */
	protected function processItem(array $value, array $currentPath): array
	{
		if (Utils::isList($value)) {
			return $this->processList($value, $currentPath);
		}

		return $this->processHash($value, $currentPath);
	}

	/**
	 * Seznamy položek mohou obsahovat složené hodnoty určené ku zjednodušení,
	 * avšak jejich číselné klíče se nevkládají jako součást cesty.
	 *
	 * @param string[]|int[] $currentPath
	 */
	protected function processList(array $list, array $currentPath): array
	{
		$processed = [];
		foreach ($list as $key => $value) {
			// Numeric list keys are not appended to the path.
			$processed[$key] = is_array($value)
				? $this->processItem($value, $currentPath)
				: $this->convertValue($value, $currentPath);
		}

		return $processed;
	}

	abstract protected function convertValue($value, array $itemPath);

}
