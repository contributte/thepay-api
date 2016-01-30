<?php

namespace Tp\DataApi;

use Tp\InvalidSignatureException;
use Tp\Utils;

class Response extends Object
{

	/**
	 * @var array[]
	 */
	protected static $listPaths = [];

	/**
	 * @var array[]
	 */
	protected static $dateTimePaths = [];

	/**
	 * @var int
	 */
	protected $merchantId;

	/**
	 * @param array $response
	 *
	 * @return Response
	 * @throws InvalidSignatureException
	 */
	public static function createFromResponse(array $response)
	{
		$keys = ['merchantId'];
		$data = Utils::filterKeys($response, $keys);
		$instance = new static($data);

		return $instance;
	}

	/**
	 * @return array[]
	 */
	public static function listPaths()
	{
		return static::$listPaths;
	}

	/**
	 * @return array[]
	 */
	public static function dateTimePaths()
	{
		return static::$dateTimePaths;
	}

	/**
	 * @return int
	 */
	public function getMerchantId()
	{
		return $this->merchantId;
	}

	/**
	 * @param int $merchantId
	 */
	public function setMerchantId($merchantId)
	{
		$this->merchantId = ValueFormatter::format('int', $merchantId);
	}

}
