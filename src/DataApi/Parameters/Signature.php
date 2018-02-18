<?php
declare(strict_types=1);

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
	 * @param array  $data
	 * @param string $password
	 *
	 * @return string
	 * @throws MissingParameterException
	 */
	public static function compute(array $data, string $password = NULL) : string
	{
		unset($data['signature']);

		if ( !is_null($password)) {
			$data['password'] = $password;
		}

		if ( !array_key_exists('password', $data)) {
			throw new MissingParameterException('password');
		}

		if (
			is_null($data['password'])
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
	 * @param array       $data
	 * @param string      $password
	 * @param string|null $signature
	 *
	 * @throws InvalidSignatureException
	 * @throws MissingParameterException
	 */
	public static function validate(array $data, string $password, string $signature = NULL) : void
	{
		if (is_null($signature)) {
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
			throw new InvalidSignatureException;
		}
	}
}
