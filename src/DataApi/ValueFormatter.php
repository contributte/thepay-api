<?php declare(strict_types = 1);

namespace Tp\DataApi;

use DateTimeImmutable;
use DateTimeInterface;
use Tp\Exceptions\InvalidArgumentException;

class ValueFormatter
{

	/**
	 * @param string $type
	 * @param mixed  $value
	 * @return mixed
	 * @throws InvalidArgumentException
	 */
	public static function format(string $type, $value)
	{
		if (substr($type, -2) === '[]') {
			return static::formatList(substr($type, 0, -2), $value);
		}

		$isNull = $value === null;
		if ($isNull) {
			return null;
		}

		$method = 'format' . ucfirst($type);
		if (method_exists(self::class, $method)) {
			return static::$method($value); /* @phpstan-ignore-line */
		}

		if (class_exists($type) && $value instanceof $type) {
			return $value;
		}

		$message = 'Unknown type ' . $type . '.';
		throw new InvalidArgumentException($message);
	}

	public static function formatInt(?int $value): ?int
	{
		if ($value === null) {
			return null;
		}

		return intval($value);
	}

	public static function formatFloat(?float $value): ?float
	{
		if ($value === null) {
			return null;
		}

		return floatval($value);
	}

	public static function formatBool(?bool $value): ?bool
	{
		if ($value === null) {
			return null;
		}

		return boolval($value);
	}

	/**
	 * @param mixed $value
	 */
	public static function formatString($value): ?string
	{
		if ($value === null) {
			return null;
		}

		return strval($value);
	}

	/**
	 * @param DateTimeInterface|string|null $value
	 */
	public static function formatDateTime($value): ?DateTimeInterface
	{
		if ($value === null) {
			return null;
		}

		if ($value === '0000-00-00 00:00:00') {
			return null;
		} elseif ($value instanceof DateTimeInterface) {
			return $value;
		}

		return new DateTimeImmutable($value);
	}

	public static function formatList(string $type, array $list): array
	{
		$array = [];
		foreach ($list as $item) {
			$array[] = self::format($type, $item);
		}

		return $array;
	}

}
