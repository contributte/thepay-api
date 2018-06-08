<?php
declare(strict_types=1);

namespace Tp\Card;

use stdClass;

/**
 * Information about customer's card from getCardInfoRequest.
 */
class InfoResponse extends PaymentResponse
{
	/**
	 * @var string
	 */
	protected $cardNumberMasked;
	/**
	 * @var string
	 */
	protected $cardBrand;
	/**
	 * @var string
	 */
	protected $countryCode;
	/**
	 * @var string
	 */
	protected $bankName;
	/**
	 * @var string
	 */
	protected $cardType;
	/**
	 * @var string
	 */
	protected $cardLevel;

	public function __construct(stdClass $data)
	{
		parent::__construct($data);

		$this->cardNumberMasked = $data->cardNumberMasked;
		$this->cardBrand = $data->cardBrand;
		$this->countryCode = $data->countryCode;
		$this->bankName = $data->bankName;
		$this->cardType = $data->cardType;
		$this->cardLevel = $data->cardLevel;
	}

	/**
	 * @return string Masked number of card. E.g. 123456******1234
	 */
	public function getCardNumberMasked() : string
	{
		return $this->cardNumberMasked;
	}

	/**
	 * @return string Brand of card, e.g. MC or VISA
	 */
	public function getCardBrand() : string
	{
		return $this->cardBrand;
	}

	/**
	 * @return string country code in ISO 3166-1 alpha-2, e.g. CZ
	 */
	public function getCountryCode() : string
	{
		return $this->countryCode;
	}

	/**
	 * @return string name of issuing bank, e.g. RAIFFEISENBANK A.S.
	 */
	public function getBankName() : string
	{
		return $this->bankName;
	}

	/**
	 * @return string card type, e.g. DEBIT, CREDIT
	 */
	public function getCardType() : string
	{
		return $this->cardType;
	}

	/**
	 * @return string card level, e.g. BUSINESS, CLASSIC, PREPAID
	 */
	public function getCardLevel() : string
	{
		return $this->cardLevel;
	}
}
