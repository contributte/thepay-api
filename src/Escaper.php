<?php
declare(strict_types=1);

namespace Tp;

class Escaper
{

	/**
	 * JSON-encode with all hex options enabled. Results in values insertable
	 * into inline <scripts>. Note that if used in a HTML attribute (e. g.
	 * onclick), the JSON string must be encoded to HTML entities as well.
	 *
	 * @param $value
	 *
	 * @return string
	 */
	public static function jsonEncode($value)
	{
		return json_encode($value, self::jsonEncodeOptions());
	}

	/**
	 * Every HTML special characters converted to \u entities. Thus safe to use
	 * in inline <scripts>.
	 *
	 * @return int
	 */
	public static function jsonEncodeOptions()
	{
		return JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT;
	}

	/**
	 * Only raw json_decode call for consistency with jsonEncode.
	 *
	 * @param $string
	 *
	 * @return mixed
	 */
	public static function jsonDecode(string $string)
	{
		return json_decode($string);
	}

	/**
	 * Translate all HTML control characters (<, >, &, ", a ') to entities.
	 * Resulting string is safe to use inline in a HTML document as well as a
	 * part of a HTML tag attribute. Single- or double-quoted, both are OK.
	 *
	 * @param $value
	 *
	 * @return string
	 */
	public static function htmlEntityEncode(string $value)
	{
		return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', TRUE);
	}

	/**
	 * Translates all HTML &…; entities to plain-text, including &#039 (').
	 *
	 * @param $value
	 *
	 * @return string
	 */
	public static function htmlEntityDecode(string $value)
	{
		return html_entity_decode($value, ENT_QUOTES, 'UTF-8');
	}
}
