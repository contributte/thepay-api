<?php declare(strict_types = 1);

namespace Tp\DataApi\Requests;

class GetPaymentMethodsRequest extends Request
{

	protected ?bool $onlyActive = null;

	public function getOnlyActive(): ?bool
	{
		return $this->onlyActive;
	}

	public function setOnlyActive(?bool $onlyActive = null): void
	{
		$this->onlyActive = $onlyActive;
	}

	protected function configArray(): array
	{
		$configArray = parent::configArray();
		$configArray['accountId'] = $this->_merchantConfig->accountId;

		return $configArray;
	}

}
