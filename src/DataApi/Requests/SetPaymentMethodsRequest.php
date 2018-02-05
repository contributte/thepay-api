<?php
declare(strict_types=1);

namespace Tp\DataApi\Requests;

use Tp\DataApi\ValueFormatter;

class SetPaymentMethodsRequest extends Request
{
	const TYPE_ALL       = 'all';
	const TYPE_WHITELIST = 'whitelist';

	/**
	 * @var string
	 */
	protected $type = self::TYPE_WHITELIST;
	/**
	 * @var int[]
	 */
	protected $paymentMethods = [];

	function getType() : string
	{
		return $this->type;
	}

	/**
	 * @param string $type one of TYPE_* constants
	 */
	function setType(string $type)
	{
		$this->type = $type;
	}

	/**
	 * @return int[]
	 */
	function getPaymentMethods() : array
	{
		return $this->paymentMethods;
	}

	/**
	 * Payment methods which should be available to merchant account
	 *
	 * @param int[] $paymentMethods id's of payment methods
	 */
	function setPaymentMethods(array $paymentMethods) : void
	{
		$this->paymentMethods = ValueFormatter::formatList('int', $paymentMethods);

	}

	protected function configArray() : array
	{
		$configArray = parent::configArray();
		$configArray['accountId'] = $this->_config->accountId;

		return $configArray;
	}
}
