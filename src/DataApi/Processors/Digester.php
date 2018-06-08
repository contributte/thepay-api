<?php
declare(strict_types=1);

namespace Tp\DataApi\Processors;

use DateTimeInterface;
use Tp\Utils;

class Digester
{
	public static function process(array $input) : string
	{
		$instance = new static;
		// Start with an empty path [].
		$processed = $instance->processHash($input);

		return $processed;
	}

	/**
	 * Hashes are converted to a SHA256 digest of its string representation
	 * consisting of &-concatenated “key=value” parts. Nested hashes are
	 * digested without a password.
	 */
	protected function processHash(array $data) : string
	{
		$processed = [];
		foreach ($data as $key => $item) {
			$processed[$key] = is_array($item)
				? $this->processItem($item)
				: $this->convertValue($item);
		}

		$stringParts = [];
		foreach ($processed as $key => $value) {
			if (
				is_null($value)
				|| $value === ''
			) {
				// Empty values are not part of the digest. Not even its key.
				continue;
			}

			if ($value instanceof DateTimeInterface) {
				$value = $value->format(DateTimeInterface::ISO8601);
			}

			$stringParts[] = "{$key}={$value}";
		}

		$string = implode('&', $stringParts);

		return hash('sha256', $string);
	}

	/**
	 * Lists are |-concatenated digested values: Booleans converted to integers,
	 * hashes digested, strings left as they are.
	 */
	protected function processList(array $list) : string
	{
		$processedArray = [];
		foreach ($list as $key => $value) {
			// Numeric list keys are not appended to the path.
			$processedArray[$key] = is_array($value)
				? $this->processItem($value)
				: $this->convertValue($value);
		}

		return implode('|', $processedArray);
	}

	/**
	 * Hashes, lists and booleans are treated specially. Other values are simply
	 * converted to strings, strings are left untouched.
	 *
	 * @param mixed $value
	 */
	protected function processItem($value) : string
	{
		if (Utils::isList($value)) {
			return $this->processList($value);
		}
		return $this->processHash($value);
	}

	protected function convertValue($value) : string
	{
		if (is_bool($value)) {
			if ($value) {
				return '1';
			}
			return '0';
		}

		return strval($value);
	}
}
