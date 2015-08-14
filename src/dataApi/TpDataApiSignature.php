<?php
/**
 * Oddělená třída počítající podpis. Volána pouze staticky jako
 * TpDataApiSignature::compute
 *
 * Class TpDataApiSignature
 */
class TpDataApiSignature {

	private $arrayPaths = array();
	private $data = array();

	private $_path = array();

	private function __construct(array $data, $password, array $arrayPaths) {
		$this->setData($data, $password);
		$this->setArrayPaths($arrayPaths);
	}

	public static function compute(array $data, $password, array $arrayPaths) {
		$signature = new TpDataApiSignature($data, $password, $arrayPaths);
		return $signature->dataSignature();
	}

	private function setArrayPaths(array $arrayPaths) {
		$this->arrayPaths = $arrayPaths;
	}

	private function setData(array $data, $password = null) {
		unset($data['signature']);

		if(!is_null($password)) {
			$data['password'] = $password;
		}

		if(!array_key_exists('password', $data) || is_null($data['password']) || $data['password'] === "") {
			throw new TpMissingParameterException('password');
		}

		$this->data = $data;
	}

	private function dataSignature() {
		$this->_path = array(); // Technicky vzato zbytečné. Jen pro pořádek.
		return $this->keyValuePairsSignature($this->data);
	}

	private function keyValuePairsSignature(array $data) {
		$stringified = array();
		foreach($data as $key => $value) {
			$this->_path[] = $key;
			$value = $this->stringify($value);
			if($value !== "") {
				$stringified[$key] = $value;
			}
			$this->_path = array_slice($this->_path, 0, -1);
		}
		unset($value);

		$flattened = array();
		array_walk($stringified, function($value, $name) use(&$flattened) {
			$flattened[] = "$name=$value";
		});
		$flattened = implode('&', $flattened);

		return hash('sha256', $flattened);
	}

	private function sequenceSignature(array $sequence) {
		foreach($sequence as &$value) {
			$value = $this->stringify($value);
		};
		unset($value);
		return implode("|", $sequence);
	}

	private function stringify($value) {
		if(is_array($value)) {
			if(!$value || $this->isSequence($value)) {
				return $this->sequenceSignature($value);
			} else {
				if($this->isArrayPath($value)) {
					list($value) = array_values($value);
					return $this->stringify($value);
				} else {
					return $this->keyValuePairsSignature($value);
				}
			}
		} elseif(is_bool($value)) {
			$intval = intval($value);
			return "$intval";
		} else {
			return "$value";
		}
	}

	private function isArrayPath(array $value) {
		return in_array(
			array_merge($this->_path, array_keys($value)),
			$this->arrayPaths
		);
	}

	/**
	 * Rozpozná pole s pouze číselnými klíči bez děr počínajícími nulou. Pro
	 * prázdná pole vrací nepravdu.
	 *
	 * @param array $array
	 * @return bool
	 */
	private static function isSequence(array $array) {
		return array_keys($array) === range(0, count($array) - 1);
	}

}
