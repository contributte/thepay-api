<?php
declare(strict_types=1);

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

	public static function createFromResponse(
		array $response
	) : self {
		/** @var GetPaymentMethodsResponse $instance */
		$instance = parent::createFromResponse($response);
		$instance->setAccountId($response['accountId']);

		$methods = [];
		foreach ($response['methods'] as $method) {
			$methods[] = new MerchantAccountMethod($method);
		}
		$instance->setMethods($methods);

		return $instance;
	}

	public function getAccountId() : ?int
	{
		return $this->accountId;
	}

	public function setAccountId(?int $accountId = null) : void
	{
		$this->accountId = $accountId;
	}

	/**
	 * @return MerchantAccountMethod[]
	 */
	public function getMethods() : array
	{
		return $this->methods;
	}

	/**
	 * @param \Tp\DataApi\Parameters\MerchantAccountMethod[] $methods
	 */
	public function setMethods(array $methods = []) : void
	{
		$this->methods = ValueFormatter::formatList(
			'Tp\DataApi\Parameters\MerchantAccountMethod',
			$methods
		);
	}
}
