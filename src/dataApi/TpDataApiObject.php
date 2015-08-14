<?php
abstract class TpDataApiObject {
	private static function format($value, $nullable, $callback) {
		return ($nullable && (is_null($value) || $value === "")) ?
			null :
			call_user_func($callback, $value);
	}

	protected static function formatInt($value, $nullable) {
		return self::format($value, $nullable, function($value) {
			return intval($value);
		});
	}

	protected static function formatFloat($value, $nullable) {
		return self::format($value, $nullable, function($value) {
			return floatval($value);
		});
	}

	protected static function formatString($value, $nullable) {
		return self::format($value, $nullable, function($value) {
			return "$value";
		});
	}

	protected static function formatDateTime($value, $nullable) {
		return self::format($value, $nullable, function($value) {
			return new DateTime($value);
		});
	}

	protected static function formatBool($value, $nullable) {
		return self::format($value, $nullable, function($value) {
			return !!$value;
		});
	}

}