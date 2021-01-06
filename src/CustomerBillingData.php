<?php

namespace Tp;

/**
 * Billing information/address of customer.
 */
class CustomerBillingData
{
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

	function getFullName() : ?string
	{
		return $this->fullName;
	}

	function getCountry() : ?string
	{
		return $this->country;
	}

	function getCity() : ?string
	{
		return $this->city;
	}

	function getPostcode() : ?string
	{
		return $this->postcode;
	}

	function getStreet() : ?string
	{
		return $this->street;
	}

	function getEmail() : ?string
	{
		return $this->email;
	}

	/**
	 * @param string|null $fullName full name of customer
	 */
	function setFullName(?string $fullName) : void
	{
		$this->fullName = $fullName;
	}

	/**
	 * @param string|null $country ISO 3166-1 country code
	 */
	function setCountry(?string $country) : void
	{
		if ($country !== null && (!is_string($country) || strlen($country) != 2)) {
			throw new InvalidParameterException("country");
		}
		$this->country = $country;
	}

	/**
	 * @param string|null $city name of city
	 */
	function setCity(?string $city) : void
	{
		$this->city = $city;
	}

	/**
	 * @param string|null $postcode postal code
	 */
	function setPostcode(?string $postcode) : void
	{
		$this->postcode = $postcode;
	}

	/**
	 * @param string|null $street street name and number
	 */
	function setStreet(?string $street) : void
	{
		$this->street = $street;
	}

	/**
	 * @param string|null $email customer's email
	 */
	function setEmail(?string $email) : void
	{
		$this->email = $email;
	}
}
