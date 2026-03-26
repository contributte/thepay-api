<?php declare(strict_types = 1);

namespace Tp\DataApi\Responses;

use Tp\Utils;

class SetPaymentMethodsResponse extends Response
{

	public const STATUS_OK = 'OK';
	public const STATUS_ERROR = 'ERROR';

	protected int $accountId;

	protected ?string $status = null;

	public static function createFromResponse(
		array $response
	): self
	{
		$keys = ['merchantId', 'accountId', 'status'];
		$data = Utils::filterKeys($response, $keys);

		return new static($data);
	}

	public function getAccountId(): int
	{
		return $this->accountId;
	}

	public function setAccountId(int $accountId): void
	{
		$this->accountId = $accountId;
	}

	public function getStatus(): ?string
	{
		return $this->status;
	}

	public function setStatus(?string $status = null): void
	{
		$this->status = $status;
	}

}
