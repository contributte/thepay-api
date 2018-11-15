<?php declare(strict_types = 1);

namespace Tp\DataApi\Parameters;

use Tp\DataApi\Processors\Digester;
use Tp\InvalidSignatureException;
use Tp\MissingParameterException;

class Signature
{

	protected function __construct()
	{
		// Hidden.
	}

	/**
	 * Signature is always computed from a hash. If there is a 'signature' key
	 * already present, it is removed. Password can be provided either as a hash
	 * key 'password', or as a method argument $password.
	 *
	 * @throws MissingParameterException
	 */
	public static function compute(array $data, ?string $password = null): string
	{
		unset($data['signature']);

		if ($password !== null) {
			$data['password'] = $password;
		}

		if (!array_key_exists('password', $data)) {
			throw new MissingParameterException('password');
		}

		if (
			$data['password'] === null
			|| $data['password'] === ''
		) {
			throw new MissingParameterException('password');
		}

		return Digester::process($data);
	}

	/**
	 * Validates given $data hash. The signature can be provided either as its
	 * key 'signature', or as a method argument $signature. If the computed
	 * signature differs from the provided one, Tp\TpInvalidSignatureException is
	 * thrown.
	 *
	 * @throws InvalidSignatureException
	 * @throws MissingParameterException
	 */
	public static function validate(array $data, string $password, ?string $signature = null): void
	{
		if ($signature === null) {
			if (
				!array_key_exists('signature', $data)
				|| $data['signature'] === ''
			) {
				throw new MissingParameterException('signature');
			}

			$signature = $data['signature'];
		}

		$computed = static::compute($data, $password);

		if ($computed !== $signature) {
			throw new InvalidSignatureException();
		}
	}

}
