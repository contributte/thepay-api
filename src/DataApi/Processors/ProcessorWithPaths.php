<?php

namespace Tp\DataApi\Processors;

abstract class ProcessorWithPaths extends Processor
{

	/**
	 * @var array[]
	 */
	protected $paths = [];

	/**
	 * Tp\DataApi\Processors\ProcessorWithPaths constructor.
	 *
	 * @param array[] $paths
	 */
	protected function __construct(array $paths)
	{
		$this->paths = $paths;
	}

	/**
	 * @param array   $input
	 * @param array[] $paths
	 *
	 * @return array
	 */
	public static function processWithPaths(array $input, array $paths)
	{
		$instance = new static($paths);
		// Starting with an empty path [].
		$processed = $instance->processHash($input, []);

		return $processed;
	}

	/**
	 * @param string[] $itemPath
	 *
	 * @return bool
	 */
	protected function onPath(array $itemPath)
	{
		$onPath = in_array($itemPath, $this->paths, TRUE /* strict */);

		return $onPath;
	}

}
