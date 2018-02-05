<?php
declare(strict_types=1);

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
	public static function format(string $type, $value)
	{
		if (substr($type, -2) == '[]') {
			return static::formatList(substr($type, 0, -2), $value);
		}

		$isNull = is_null($value);
		if ($isNull) {
			return NULL;
		}
		else {
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
	}

	/**
	 * @param int|null $value
	 *
	 * @return int
	 */
	public static function formatInt($value) : ?int
	{
		if (is_null($value)) {
			return NULL;
		}
		else {
			return intval($value);
		}
	}

	/**
	 * @param float|null $value
	 *
	 * @return float
	 */
	public static function formatFloat($value) : ?float
	{
		if (is_null($value)) {
			return NULL;
		}
		else {
			return floatval($value);
		}
	}

	/**
	 * @param bool|null $value
	 *
	 * @return bool
	 */
	public static function formatBool($value) : ?bool
	{
		if (is_null($value)) {
			return NULL;
		}
		else {
			return boolval($value);
		}
	}

	/**
	 * @param mixed $value
	 *
	 * @return string
	 */
	public static function formatString($value) : ?string
	{
		if (is_null($value)) {
			return NULL;
		}
		else {
			return strval($value);
		}
	}

	/**
	 * @param DateTime|string|null $value
	 *
	 * @return DateTime|null
	 */
	public static function formatDateTime($value) : ?DateTime
	{
		if (is_null($value)) {
			return NULL;
		}
		else {
			if ($value === '0000-00-00 00:00:00') {
				return NULL;
			}
			else if ($value instanceof DateTime) {
				return $value;
			}
			else {
				return new DateTime($value);
			}
		}
	}

	/**
	 * @param string $type
	 * @param array  $list
	 *
	 * @return array
	 */
	public static function formatList(string $type, array $list) : array
	{
		$array = [];
		foreach ($list as $item) {
			$array[] = ValueFormatter::format($type, $item);
		}

		return $array;
	}

}
