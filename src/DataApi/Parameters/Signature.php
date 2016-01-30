<?php

namespace Tp\DataApi\Parameters;

use Tp\DataApi\Processors\Digester;
use Tp\InvalidSignatureException;
use Tp\MissingParameterException;

class Signature
{

	/**
	 * Tp\DataApi\Parameters\Signature constructor.
	 */
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
	public static function compute(array $data, $password = NULL)
	{
		unset($data['signature']);

		$passwordIsNull = is_null($password);
		if ( !$passwordIsNull) {
			$data['password'] = $password;
		}

		$dataPasswordKeyExists = array_key_exists('password', $data);
		if ( !$dataPasswordKeyExists) {
			throw new MissingParameterException('password');
		}

		$dataPasswordIsNull = is_null($data['password']);
		if ($dataPasswordIsNull || $data['password'] === '') {
			throw new MissingParameterException('password');
		}

		$processed = Digester::process($data);

		return $processed;
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
	public static function validate(array $data, $password, $signature = NULL)
	{
		$signatureIsNull = is_null($signature);
		if ($signatureIsNull) {
			$dataSignatureKeyExists = array_key_exists('signature', $data);
			if ( !$dataSignatureKeyExists || $dataSignatureKeyExists === '') {
				throw new MissingParameterException('signature');
			}

			$signature = $data['signature'];
		}

		$computed = static::compute($data, $password);
		if ($computed != $signature) {
			throw new InvalidSignatureException;
		}
	}

}
