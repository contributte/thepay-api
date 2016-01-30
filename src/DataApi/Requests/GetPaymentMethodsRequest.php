<?php

namespace Tp\DataApi\Requests;

use Tp\DataApi\ValueFormatter;

class GetPaymentMethodsRequest extends Request
{

	/**
	 * @var bool|null
	 */
	protected $onlyActive;

	/**
	 * @return bool|null
	 */
	public function getOnlyActive()
	{
		return $this->onlyActive;
	}

	/**
	 * @param bool|null $onlyActive
	 */
	public function setOnlyActive($onlyActive = NULL)
	{
		$this->onlyActive = ValueFormatter::format('bool', $onlyActive);
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
