<?php

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
	 * @var int[]|null
	 */
	protected $paymentMethods = NULL;

	/**
	 * @return string
	 */
	function getType()
	{
		return $this->type;
	}
	/**
	 * @param string $type one of TYPE_* constants
	 */
	function setType($type)
	{
		$this->type = $type;
	}

	/**
	 * @return int[]
	 */
	function getPaymentMethods()
	{
		return $this->paymentMethods;
	}

	/**
	 * Payment methods which should be available to merchant account
	 * @param int[] $paymentMethods id's of payment methods
	 */
	function setPaymentMethods(array $paymentMethods = NULL)
	{
		if ($paymentMethods) {
			$this->paymentMethods = ValueFormatter::formatList('int', $paymentMethods);
		}
	}


	/**
	 * @return array
	 */
	protected function configArray()
	{
		$configArray = parent::configArray();
		$configArray['accountId'] = $this->_config->accountId;

		return $configArray;
	}
}
