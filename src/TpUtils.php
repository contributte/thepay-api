<?php
class TpUtils {

	/**
	 * Filters out all keys that are not in the $keys list.
	 *
	 * @param array $array
	 * @param string[] $keys
	 * @return array
	 */
	public static function filterKeys(array $array, $keys) {
		$keysKeys = array_flip($keys);
		$presentKeysKeys = array_intersect_key($keysKeys, $array);
		$presentKeys = array_flip($presentKeysKeys);

		$filtered = array();
		foreach($presentKeys as $key) {
			$filtered[$key] = $array[$key];
		}
		unset($key);

		return $filtered;
	}

	/**
	 * @param stdClass|array $value
	 * @return array
	 */
	public static function toArrayRecursive($value) {
		$array = array();
		foreach($value as $k => $v) {
			$item =& $array[$k];

			$isArray = is_array($v);
			if($isArray || $v instanceof stdClass) {
				$item = static::toArrayRecursive($v);
			} else {
				$item = $v;
			}
		}
		return $array;
	}

	/**
	 * Checks wherether given $array is a list – keys are only numeric,
	 * sequential from zero without gaps. Returns true for empty arrays.
	 *
	 * @param array $array
	 * @return bool
	 */
	public static function isList(array $array) {
		$count = count($array);
		if($count) {
			$range = range(0, $count - 1);
		} else {
			$range = array();
		}
		$keys = array_keys($array);
		return $keys === $range;
	}

	/**
	 * @param string[][] $paths
	 */
	public static function requirePaths(array $paths) {
		$basePath = array(__DIR__);
		foreach($paths as $path) {
			$fullPathArray = array_merge($basePath, $path);
			$fullPathString = implode(DIRECTORY_SEPARATOR, $fullPathArray);
			require_once $fullPathString;
		}
		unset($path, $fullPathArray, $fullPathString);
	}

}
