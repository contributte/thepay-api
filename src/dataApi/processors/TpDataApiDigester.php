<?php
TpUtils::requirePaths(array(
	array('dataApi', 'processors', 'TpDataApiProcessor.php')
));

class TpDataApiDigester extends TpDataApiProcessor {

	/**
	 * Hashes are converted to a SHA256 digest of its string representation
	 * consisting of &-concatenated “key=value” parts. Nested hashes are
	 * digested without a password.
	 *
	 * @param array $data
	 * @param string[] $currentPath
	 * @return string
	 */
	protected function processHash(array $data, array $currentPath) {
		$processed = parent::processHash($data, $currentPath);
		$stringParts = array();
		foreach($processed as $key => $value) {
			if($value == '') {
				// Empty values are not part of the digest. Not even its key.
				continue;
			}
			$stringParts[] = $key . '=' . $value;
		}
		unset($key, $value);

		$string = implode('&', $stringParts);
		$digest = hash('sha256', $string);
		return $digest;
	}

	/**
	 * Lists are |-concatenated digested values: Booleans converted to integers,
	 * hashes digested, strings left as they are.
	 *
	 * @param array $list
	 * @param string[] $currentPath
	 * @return string
	 */
	protected function processList(array $list, array $currentPath) {
		$processedArray = parent::processList($list, $currentPath);
		$processedString = implode('|', $processedArray);

		return $processedString;
	}

	/**
	 * Hashes, lists and booleans are treated specially. Other values are simply
	 * converted to strings, strings are left untouched.
	 *
	 * @param mixed $value
	 * @param string[] $currentPath
	 * @return string
	 */
	protected function processItem($value, array $currentPath) {
		$processed = parent::processItem($value, $currentPath);
		$isBool = is_bool($processed);
		if($isBool) {
			// Hodnota pravda/nepravda se převede na číslo 0/1.
			$processedInt = (int) $value;
			$processedString = (string) $processedInt;
		} else {
			// Zbytek na řetězec. Prázdné řetězce se následně vyřadí.
			$processedString = (string) $processed;
		}

		return $processedString;
	}

}
