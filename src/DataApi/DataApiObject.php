<?php declare(strict_types = 1);

namespace Tp\DataApi;

use ArrayAccess;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;
use Tp\Utils;

abstract class DataApiObject implements ArrayAccess
{

	public function __construct(array $data = [])
	{
		$keys = static::keys();
		$filtered = Utils::filterKeys($data, $keys);

		foreach ($filtered as $key => $value) {
			$this[$key] = $value;
		}
	}

	public function toArray(): array
	{
		$data = [];
		$keys = self::keys();
		foreach ($keys as $name) {
			$data[$name] = static::demodelizeRecursive($this->{$name}); /* @phpstan-ignore-line */
		}

		return $data;
	}

	/**
	 * @return string[]
	 */
	public static function keys(): array
	{
		$calledClass = static::class;
		$reflection = new ReflectionClass($calledClass);

		// Filter out static properties and those beginning with an underscore.
		$allProperties = $reflection->getProperties();
		$dataProperties = array_filter(
			$allProperties,
			static function (ReflectionProperty $property): bool {
				return self::filterDataProperties($property);
			}
		);
		$sortedDataProperties = static::sortDataProperties($dataProperties);

		$propertyNames = [];
		foreach ($sortedDataProperties as $property) {
			$propertyNames[] = $property->getName();
		}

		return $propertyNames;
	}

	private static function filterDataProperties(
		ReflectionProperty $property
	): bool
	{
		$underscored = strpos($property->getName(), '_') === 0;

		return !$underscored && !$property->isStatic();
	}

	/**
	 * Prepend inherited properties.
	 *
	 * @param ReflectionProperty[] $dataProperties
	 * @return ReflectionProperty[]
	 */
	private static function sortDataProperties(array $dataProperties): array
	{
		$inherited = [];
		$own = [];

		$calledClassName = static::class;

		foreach ($dataProperties as $property) {
			$propertyClass = $property->getDeclaringClass();
			$propertyClassName = $propertyClass->getName();

			if ($propertyClassName === $calledClassName) {
				$own[] = $property;
			} else {
				$inherited[] = $property;
			}
		}

		return array_merge($inherited, $own);
	}

	protected static function demodelizeRecursive($value)
	{
		if ($value instanceof self) {
			$demodelized = $value->toArray();
		} else {
			if (is_array($value)) {
				$demodelized = [];
				foreach ($value as $k => $v) {
					$demodelized[$k] = static::demodelizeRecursive($v);
				}
			} else {
				$demodelized = $value;
			}
		}

		return $demodelized;
	}

	/* *** ArrayAccess *** */

	/**
	 * @param string $offset
	 * @return bool
	 */
	public function offsetExists($offset): bool
	{
		$keys = static::keys();
		return in_array($offset, $keys, true);
	}

	/**
	 * @param string $offset
	 * @return mixed
	 */
	#[\ReturnTypeWillChange]
	public function offsetGet($offset)
	{
		$getterName = 'get' . ucfirst($offset);

		return $this->{$getterName}(); /* @phpstan-ignore-line */
	}

	/**
	 * @param string $offset
	 * @param mixed  $value
	 */
	public function offsetSet($offset, $value): void
	{
		$setterName = 'set' . ucfirst($offset);

		if ($value !== null && is_string($value)) {
			$reflectionMethod = new ReflectionMethod($this, $setterName);
			$parameterType = $reflectionMethod->getParameters()[0]->getType();

			assert($parameterType !== null);

			switch ($parameterType->getName()) {
				case 'int':
					$value = intval($value);

					break;
				case 'float':
					$value = floatval($value);

					break;
				case 'bool':
					$value = $value === '1';

					break;
			}
		}

		$this->{$setterName}($value); /* @phpstan-ignore-line */
	}

	/**
	 * @param string $offset
	 */
	public function offsetUnset($offset): void
	{
		$this->offsetSet($offset, null);
	}

}
