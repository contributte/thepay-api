<?php
/**
 * Informations about customer's card from getCardInfoRequest.
 */
class TpCardInfoResponse extends TpCardPaymentResponse {
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

	function __construct(stdClass $data) {
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
	function getCardNumberMasked() {
		return $this->cardNumberMasked;
	}
	
	/**
	 * @return string Brand of card, e.g. MC or VISA
	 */
	function getCardBrand() {
		return $this->cardBrand;
	}
	
	/**
	 * @return string country code in ISO 3166-1 alpha-2, e.g. CZ
	 */
	function getCountryCode() {
		return $this->countryCode;
	}

	/**
	 * @return string name of issuing bank, e.g. RAIFFEISENBANK A.S.
	 */
	function getBankName() {
		return $this->bankName;
	}

	/**
	 * @return string card type, e.g. DEBIT, CREDIT
	 */
	function getCardType() {
		return $this->cardType;
	}

	/**
	 * 
	 * @return string card level, e.g. BUSINESS, CLASSIC, PREPAID
	 */
	function getCardLevel() {
		return $this->cardLevel;
	}
}
