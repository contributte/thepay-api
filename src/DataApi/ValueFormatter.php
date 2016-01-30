<?php

namespace Tp\DataApi;

use DateTime;
use Tp\InvalidArgumentException;

class ValueFormatter
{

	/**
	 * @param string $type
	 * @param mixed  $value
	 *
	 * @return mixed
	 * @throws InvalidArgumentException
	 */
	public static function format($type, $value)
	{
		if (substr($type, -2) == '[]') {
			return static::formatList(substr($type, 0, -2), $value);
		}

		$isNull = is_null($value);
		if ($isNull) {
			return NULL;
		}
		else {
			$method = "format$type"; // Method names are case-insensitive.
			if (method_exists(__CLASS__, $method)) {
				return static::$method($value);
			}

			if (class_exists($type) && $value instanceof $type) {
				return $value;
			}

			$message = 'Unknown type ' . $type . '.';
			throw new InvalidArgumentException($message);
		}
	}

	/**
	 * @param int $value
	 *
	 * @return int
	 */
	public static function formatInt($value)
	{
		$isNull = is_null($value);
		if ($isNull) {
			return NULL;
		}
		else {
			return (int)$value;
		}
	}

	/**
	 * @param float $value
	 *
	 * @return float
	 */
	public static function formatFloat($value)
	{
		$isNull = is_null($value);
		if ($isNull) {
			return NULL;
		}
		else {
			return (float)$value;
		}
	}

	/**
	 * @param bool $value
	 *
	 * @return bool
	 */
	public static function formatBool($value)
	{
		$isNull = is_null($value);
		if ($isNull) {
			return NULL;
		}
		else {
			return (bool)$value;
		}
	}

	/**
	 * @param string $value
	 *
	 * @return string
	 */
	public static function formatString($value)
	{
		$isNull = is_null($value);
		if ($isNull) {
			return NULL;
		}
		else {
			return "$value";
		}
	}

	/**
	 * @param $value
	 *
	 * @return DateTime|null
	 */
	public static function formatDateTime($value)
	{
		$isNull = is_null($value);
		if ($isNull) {
			return NULL;
		}
		else {
			if ($value == "0000-00-00 00:00:00") {
				return NULL;
			}
			elseif ($value instanceof DateTime) {
				return $value;
			}
			else {
				return new DateTime($value);
			}
		}
	}

	/**
	 * @param string $type
	 * @param array  $value
	 *
	 * @return array
	 */
	public static function formatList($type, array $value)
	{
		$array = [];
		foreach ($value as $item) {
			$array[] = ValueFormatter::format($type, $item);
		}

		return $array;
	}

}
