<?php
declare(strict_types=1);

namespace Tp;

use Nette;

class Escaper
{
	/**
	 * JSON-encode with all hex options enabled. Results in values insertable
	 * into inline <scripts>. Note that if used in a HTML attribute (e. g.
	 * onclick), the JSON string must be encoded to HTML entities as well.
	 *
	 * @param mixed $value
	 *
	 * @return string
	 */
	public static function jsonEncode($value) : string
	{
		return Nette\Utils\Json::encode($value, self::jsonEncodeOptions());
	}

	/**
	 * Every HTML special characters converted to \u entities. Thus safe to use
	 * in inline <scripts>.
	 *
	 * @return int
	 */
	public static function jsonEncodeOptions() : int
	{
		return JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT;
	}

	public static function jsonDecode(string $json)
	{
		return Nette\Utils\Json::decode($json);
	}

	/**
	 * Translate all HTML control characters (<, >, &, ", a ') to entities.
	 * Resulting string is safe to use inline in a HTML document as well as a
	 * part of a HTML tag attribute. Single- or double-quoted, both are OK.
	 *
	 * @param string $value
	 *
	 * @return string
	 */
	public static function htmlEntityEncode(string $value) : string
	{
		return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', TRUE);
	}

	/**
	 * Translates all HTML &…; entities to plain-text, including &#039 (').
	 *
	 * @param string $value
	 *
	 * @return string
	 */
	public static function htmlEntityDecode(string $value) : string
	{
		return html_entity_decode($value, ENT_QUOTES, 'UTF-8');
	}
}
