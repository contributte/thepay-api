<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, "TpDataApiSignature.php"));
class TpDataApiSignedArray {

	/**
	 * @var array
	 */
	private $value = array();
	private $password;
	private $arrayPaths = array();

	public function __construct(array $value, $password = null, $arrayPaths = array()) {
		$this->value = $value;
		$this->password = $password;
		$this->arrayPaths = $arrayPaths;
	}

	public static function createFromArgs(array $value, $password = null, $arrayPaths = array()) {
		$value = self::formatForApi($value);
		return new TpDataApiSignedArray($value, $password, $arrayPaths);
	}

	/**
	 * @param stdClass $value
	 * @param string $password
	 * @param array $arrayPaths
	 * @return TpDataApiSignedArray
	 */
	public static function createFromStdClass(stdClass $value, $password = null, $arrayPaths = array()) {
		return new TpDataApiSignedArray(
			self::stdClassToArrayRecursive($value),
			$password,
			$arrayPaths
		);
	}

	/**
	 * Rekurzivně převede veškeré objekty na skaláry Využívá metody toArray,
	 * kterou musí jednotlivé objekty implementovat. Časová
	 * razítka jsou převedena na řetězec podle ISO 8601.
	 *
	 * @return array
	 */
	public static function formatForApi($value) {
		if(is_array($value)) {
			return array_map(array(__CLASS__, __FUNCTION__), $value);
		} elseif($value instanceof TpIDataApiModel) {
			return self::formatForApi($value->toArray());
		} elseif($value instanceof DateTime) {
			return $value->format('c');
		} else {
			return $value;
		}
	}

	public function value() {
		return $this->value;
	}

	public function password() {
		return $this->password;
	}

	/**
	 * @return array
	 */
	public function signed() {
		return $this->signedValue();
	}

	/**
	 * @return array
	 */
	public function signedValue() {
		return array_merge(
			$this->value,
			array('signature' => $this->signature())
		);
	}

	public function signature() {
		return TpDataApiSignature::compute(
			$this->value,
			$this->password,
			$this->arrayPaths);
	}

	public function valid() {
		return $this->value['signature'] == $this->signature();
	}


	/**
	 * @param stdClass $value
	 * @return array
	 */
	private static function stdClassToArrayRecursive(stdClass $value) {
		$array = array();
		foreach($value as $k => $v) {
			$array[$k] = is_array($v) || $v instanceof stdClass ?
				self::stdClassToArrayRecursive((object) $v) :
				$v;
		}
		return $array;
	}

}
