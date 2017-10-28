<?php

namespace Tp\DataApi\Responses;

use Tp\DataApi\Response;
use Tp\DataApi\ValueFormatter;
use Tp\Utils;

class SetPaymentMethodsResponse extends Response
{
	const STATUS_OK    = 'OK';
	const STATUS_ERROR = 'ERROR';

	/**
	 * @var int
	 */
	protected $accountId;
	/**
	 * @var string
	 */
	protected $status;

	/**
	 * @param array $response
	 * @return SetPaymentMethodsResponse
	 */
	public static function createFromResponse(array $response)
	{
		$keys = array('merchantId', 'accountId', 'status');
		$data = Utils::filterKeys($response, $keys);
		$instance = new static($data);

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
	 * @param int $accountId
	 */
	public function setAccountId($accountId)
	{
		$this->accountId = ValueFormatter::format('int', $accountId);
	}

	/**
	 * @return string
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * @param string $status
	 */
	public function setStatus($status = NULL)
	{
		$this->status = ValueFormatter::formatString($status);
	}
}
