<?php
TpUtils::requirePaths(array(
	array('dataApi', 'processors', 'TpDataApiProcessor.php')
));

abstract class TpDataApiProcessorWithPaths extends TpDataApiProcessor {

	/**
	* @var array[]
	*/
	protected $paths = array();

	/**
	 * TpDataApiProcessorWithPaths constructor.
	 * @param array[] $paths
	 */
	protected function __construct(array $paths) {
		$this->paths = $paths;
	}

	/**
	 * @param array $input
	 * @param array[] $paths
	 * @return array
	 */
	public static function processWithPaths(array $input, array $paths) {
		$instance = new static($paths);
		// Starting with an empty path [].
		$processed = $instance->processHash($input, array());
		return $processed;
	}

	/**
	 * @param string[] $itemPath
	 * @return bool
	 */
	protected function onPath(array $itemPath) {
		$onPath = in_array($itemPath, $this->paths, true /* strict */);
		return $onPath;
	}

}
