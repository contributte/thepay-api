<?php
TpUtils::requirePaths(array(
	array('exceptions', 'TpInvalidArgumentException.php')
));

class TpValueFormatter {

	/**
	 * @param string $type
	 * @param mixed $value
	 * @return mixed
	 * @throws TpInvalidArgumentException
	 */
	public static function format($type, $value) {
		if(substr($type, -2) == '[]') {
			return static::formatList(substr($type, 0, -2), $value);
		}

		if(is_null($value)) {
			return null;
		} else {
			$method = "format$type"; // Method names are case-insensitive.
			if(method_exists(__CLASS__, $method)) {
				return static::$method($value);
			}

			if(class_exists($type) && $value instanceof $type) {
				return $value;
			}

			throw new TpInvalidArgumentException('Unknown type ' . $type . '.');
		}
	}

	/**
	 * @param int $value
	 * @return int
	 */
	public static function formatInt($value) {
		if(is_null($value)) {
			return null;
		} else {
			return (int) $value;
		}
	}

	/**
	 * @param float $value
	 * @return float
	 */
	public static function formatFloat($value) {
		if(is_null($value)) {
			return null;
		} else {
			return (float) $value;
		}
	}

	/**
	 * @param bool $value
	 * @return bool
	 */
	public static function formatBool($value) {
		if(is_null($value)) {
			return null;
		} else {
			return (bool) $value;
		}
	}

	/**
	 * @param string $value
	 * @return string
	 */
	public static function formatString($value) {
		if(is_null($value)) {
			return null;
		} else {
			return "$value";
		}
	}

	/**
	 * @param $value
	 * @return DateTime|null
	 */
	public static function formatDateTime($value) {
		if(is_null($value)) {
			return null;
		} else {
			if($value == "0000-00-00 00:00:00") {
				return null;
			} elseif($value instanceof DateTime) {
				return $value;
			} else {
				return new DateTime($value);
			}
		}
	}

	/**
	 * @param string $type
	 * @param array $value
	 * @return array
	 */
	public static function formatList($type, array $value) {
		$array = array();
		foreach($value as $item) {
			$array[] = TpValueFormatter::format($type, $item);
		}
		return $array;
	}

}
