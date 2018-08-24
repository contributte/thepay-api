<?php
declare(strict_types=1);

namespace Tp\DataApi;

use DateTimeImmutable;
use DateTimeInterface;
use Tp\InvalidArgumentException;

class ValueFormatter
{

	/**
	 * @param mixed  $value
	 *
	 * @return mixed
	 * @throws InvalidArgumentException
	 */
	public static function format(string $type, $value)
	{
		if (substr($type, -2) === '[]') {
			return static::formatList(substr($type, 0, -2), $value);
		}

		$isNull = is_null($value);
		if ($isNull) {
			return null;
		}
		$method = 'format' . ucfirst($type);
		if (method_exists(__CLASS__, $method)) {
			return static::$method($value);
		}

		if (class_exists($type) && $value instanceof $type) {
			return $value;
		}

		$message = 'Unknown type ' . $type . '.';
		throw new InvalidArgumentException($message);
	}

	/**
	 * @param int|null $value
	 *
	 * @return int
	 */
	public static function formatInt($value) : ?int
	{
		if (is_null($value)) {
			return null;
		}
		return intval($value);
	}

	/**
	 * @param float|null $value
	 *
	 * @return float
	 */
	public static function formatFloat($value) : ?float
	{
		if (is_null($value)) {
			return null;
		}
		return floatval($value);
	}

	/**
	 * @param bool|null $value
	 *
	 * @return bool
	 */
	public static function formatBool($value) : ?bool
	{
		if (is_null($value)) {
			return null;
		}
		return boolval($value);
	}

	/**
	 * @param mixed $value
	 *
	 * @return string
	 */
	public static function formatString($value) : ?string
	{
		if (is_null($value)) {
			return null;
		}
		return strval($value);
	}

	/**
	 * @param DateTimeInterface|string|null $value
	 */
	public static function formatDateTime($value) : ?DateTimeInterface
	{
		if (is_null($value)) {
			return null;
		}
		if ($value === '0000-00-00 00:00:00') {
			return null;
		} elseif ($value instanceof DateTimeInterface) {
			return $value;
		}
		return new DateTimeImmutable($value);
	}

	public static function formatList(string $type, array $list) : array
	{
		$array = [];
		foreach ($list as $item) {
			$array[] = self::format($type, $item);
		}

		return $array;
	}
}
