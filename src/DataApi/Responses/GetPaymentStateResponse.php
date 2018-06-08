<?php
declare(strict_types=1);

namespace Tp\DataApi\Responses;

class GetPaymentStateResponse extends Response
{

	/**
	 * @var int|null
	 */
	protected $state;

	public static function createFromResponse(
		array $response
	) : self {
		/** @var GetPaymentStateResponse $instance */
		$instance = parent::createFromResponse($response);
		$instance->setState($response['state']);

		return $instance;
	}

	public function getState() : ?int
	{
		return $this->state;
	}

	public function setState(?int $state = null) : void
	{
		$this->state = $state;
	}
}
