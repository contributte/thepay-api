<?php declare(strict_types = 1);

namespace Tp\DataApi\Responses;

use Tp\DataApi\DataApiObject;
use Tp\Utils;

class Response extends DataApiObject
{

	/** @var array[] */
	protected static $listPaths = [];

	/** @var array[] */
	protected static $dateTimePaths = [];

	/** @var int */
	protected $merchantId;

	public static function createFromResponse(
		array $response
	)
	{
		$keys = ['merchantId'];
		$data = Utils::filterKeys($response, $keys);

		return new static($data);
	}

	/**
	 * @return array[]
	 */
	public static function listPaths(): array
	{
		return static::$listPaths;
	}

	/**
	 * @return array[]
	 */
	public static function dateTimePaths(): array
	{
		return static::$dateTimePaths;
	}

	public function getMerchantId(): int
	{
		return $this->merchantId;
	}

	public function setMerchantId(int $merchantId): void
	{
		$this->merchantId = $merchantId;
	}

}
