<?php

namespace Tp\DataApi\Responses;

use Tp\DataApi\Response;
use Tp\DataApi\ValueFormatter;

class GetPaymentStateResponse extends Response
{

	/**
	 * @var int|null
	 */
	protected $state;

	/**
	 * @param array $response
	 *
	 * @return GetPaymentStateResponse
	 */
	public static function createFromResponse(array $response)
	{
		/** @var GetPaymentStateResponse $instance */
		$instance = parent::createFromResponse($response);
		$instance->setState($response['state']);

		return $instance;
	}

	/**
	 * @return int|null
	 */
	public function getState()
	{
		return $this->state;
	}

	/**
	 * @param int|null $state
	 */
	public function setState($state = NULL)
	{
		$this->state = ValueFormatter::format('int', $state);
	}

}
