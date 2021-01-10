<?php declare(strict_types = 1);

namespace Tp\DataApi\Requests;

use Tp\DataApi\ValueFormatter;

class SetPaymentMethodsRequest extends Request
{

	public const TYPE_ALL       = 'all';
	public const TYPE_WHITELIST = 'whitelist';

	/** @var string */
	protected $type = self::TYPE_WHITELIST;

	/** @var int[] */
	protected $paymentMethods = [];

	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @param string $type one of TYPE_* constants
	 */
	public function setType(string $type): void
	{
		$this->type = $type;
	}

	/**
	 * @return int[]
	 */
	public function getPaymentMethods(): array
	{
		return $this->paymentMethods;
	}

	/**
	 * Payment methods which should be available to merchant account
	 *
	 * @param int[] $paymentMethods id's of payment methods
	 */
	public function setPaymentMethods(array $paymentMethods): void
	{
		$this->paymentMethods = ValueFormatter::formatList('int', $paymentMethods);
	}

	protected function configArray(): array
	{
		$configArray = parent::configArray();
		$configArray['accountId'] = $this->merchantConfig->accountId;

		return $configArray;
	}

}
