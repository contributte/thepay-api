<?php declare(strict_types = 1);

namespace Tp\DataApi\Processors;

abstract class ProcessorWithPaths extends Processor
{

	/** @var array[] */
	protected $paths = [];

	/**
	 * @param array[] $paths
	 */
	final protected function __construct(array $paths)
	{
		$this->paths = $paths;
	}

	/**
	 * @param array[] $paths
	 */
	public static function processWithPaths(array $input, array $paths): array
	{
		$instance = new static($paths);

		// Starting with an empty path [].
		return $instance->processHash($input, []);
	}

	/**
	 * @param string[]|int[] $itemPath
	 */
	protected function onPath(array $itemPath): bool
	{
		return in_array($itemPath, $this->paths, true);
	}

}
