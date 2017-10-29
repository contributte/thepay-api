<?php

namespace Tp\DataApi\Responses;

use Tp\DataApi\Parameters\MerchantAccountMethod;
use Tp\DataApi\ValueFormatter;

class GetPaymentMethodsResponse extends Response
{

	protected static $listPaths = [
		['methods', 'method'],
	];

	/**
	 * @var int|null
	 */
	protected $accountId;

	/**
	 * @var MerchantAccountMethod[]
	 */
	protected $methods = [];

	/**
	 * @param array $response
	 *
	 * @return GetPaymentMethodsResponse
	 */
	public static function createFromResponse(array $response)
	{
		/** @var GetPaymentMethodsResponse $instance */
		$instance = parent::createFromResponse($response);
		$instance->setAccountId($response['accountId']);

		$methods = [];
		foreach ($response['methods'] as $method) {
			$methods[] = new MerchantAccountMethod($method);
		}
		unset($method);
		$instance->setMethods($methods);

		return $instance;
	}

	/**
	 * @return int
	 */
	public function getAccountId()
	{
		return $this->accountId;
	}

	/**
	 * @param int|null $accountId
	 */
	public function setAccountId($accountId = NULL)
	{
		$this->accountId = ValueFormatter::format('int', $accountId);
	}

	/**
	 * @return MerchantAccountMethod[]
	 */
	public function getMethods()
	{
		return $this->methods;
	}

	/**
	 * @param \Tp\DataApi\Parameters\MerchantAccountMethod[] $methods
	 */
	public function setMethods(array $methods = [])
	{
		$this->methods = ValueFormatter::formatList(
			'Tp\DataApi\Parameters\MerchantAccountMethod', $methods
		);
	}

}
