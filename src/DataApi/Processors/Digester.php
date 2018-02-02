<?php
declare(strict_types=1);

namespace Tp\DataApi\Processors;

use Tp\Utils;

class Digester
{
	public static function process(array $input) : string
	{
		$instance = new static;
		// Start with an empty path [].
		$processed = $instance->processHash($input, []);

		return $processed;
	}

	/**
	 * Hashes are converted to a SHA256 digest of its string representation
	 * consisting of &-concatenated “key=value” parts. Nested hashes are
	 * digested without a password.
	 *
	 * @param array    $data
	 * @param string[] $currentPath
	 *
	 * @return string
	 */
	protected function processHash(array $data, array $currentPath) : string
	{
		$processed = [];
		foreach ($data as $key => $item) {
			// Every level deeper appends the currenty key to the path.
			$itemPath = array_merge($currentPath, [$key]);
			$processed[$key] = is_array($item)
				? $this->processItem($item, $itemPath)
				: $item;
		}

		$stringParts = [];
		foreach ($processed as $key => $value) {
			if ($value === '') {
				// Empty values are not part of the digest. Not even its key.
				continue;
			}

			$stringParts[] = $key . '=' . $value;
		}

		$string = implode('&', $stringParts);

		return hash('sha256', $string);
	}

	/**
	 * Lists are |-concatenated digested values: Booleans converted to integers,
	 * hashes digested, strings left as they are.
	 *
	 * @param array    $list
	 * @param string[] $currentPath
	 *
	 * @return string
	 */
	protected function processList(array $list, array $currentPath) : string
	{
		$processedArray = [];
		foreach ($list as $key => $value) {
			// Numeric list keys are not appended to the path.
			$processedArray[$key] = is_array($value)
				? $this->processItem($value, $currentPath)
				: $value;
		}

		$processedString = implode('|', $processedArray);

		return $processedString;
	}

	/**
	 * Hashes, lists and booleans are treated specially. Other values are simply
	 * converted to strings, strings are left untouched.
	 *
	 * @param mixed    $value
	 * @param string[] $currentPath
	 *
	 * @return string
	 */
	protected function processItem($value, array $currentPath) : string
	{
		if (Utils::isList($value)) {
			return $this->processList($value, $currentPath);
		}
		else {
			return $this->processHash($value, $currentPath);
		}
	}

}
