<?php
/**
 * Billing information/address of customer.
 */
class TpCustomerBillingData {
	/**
	 * @var string|null full name of customer
	 */
	protected $fullName;
	/**
	 * @var string|null ISO 3166-1 country code
	 */
	protected $country;
	/**
	 * @var string|null name of city
	 */
	protected $city;
	/**
	 * @var string|null postal code
	 */
	protected $postcode;
	/**
	 * @var string|null street name and number
	 */
	protected $street;
	/**
	 * @var string|null customer's email
	 */
	protected $email;

	/**
	 * @return string|null
	 */
	function getFullName() {
		return $this->fullName;
	}
	/**
	 * @return string|null
	 */
	function getCountry() {
		return $this->country;
	}
	/**
	 * @return string|null
	 */
	function getCity() {
		return $this->city;
	}
	/**
	 * @return string|null
	 */
	function getPostcode() {
		return $this->postcode;
	}
	/**
	 * @return string|null
	 */
	function getStreet() {
		return $this->street;
	}
	/**
	 * @return string|null
	 */
	function getEmail() {
		return $this->email;
	}

	/**
	 * @param string|null $fullName full name of customer
	 */
	function setFullName($fullName) {
		$this->fullName = $fullName;
	}
	/**
	 * @param string|null $country ISO 3166-1 country code
	 */
	function setCountry($country) {
		if($country !== null && (!is_string($country) || strlen($country) != 2)) {
			throw new TpInvalidParameterException("country");
		}
		$this->country = $country;
	}
	/**
	 * @param string|null $city name of city
	 */
	function setCity($city) {
		$this->city = $city;
	}
	/**
	 * @param string|null $postcode postal code
	 */
	function setPostcode($postcode) {
		$this->postcode = $postcode;
	}
	/**
	 * @param string|null $street street name and number
	 */
	function setStreet($street) {
		$this->street = $street;
	}
	/**
	 * @param string|null $email customer's email
	 */
	function setEmail($email) {
		$this->email = $email;
	}
}