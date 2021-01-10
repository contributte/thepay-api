<?php declare(strict_types = 1);

namespace Tp;

use Tp\Exceptions\InvalidParameterException;

/**
 * Billing information/address of customer.
 */
class CustomerBillingData
{

	/** @var string|null full name of customer */
	protected $fullName;

	/** @var string|null ISO 3166-1 country code */
	protected $country;

	/** @var string|null name of city */
	protected $city;

	/** @var string|null postal code */
	protected $postcode;

	/** @var string|null street name and number */
	protected $street;

	/** @var string|null customer's email */
	protected $email;

	public function getFullName(): ?string
	{
		return $this->fullName;
	}

	public function getCountry(): ?string
	{
		return $this->country;
	}

	public function getCity(): ?string
	{
		return $this->city;
	}

	public function getPostcode(): ?string
	{
		return $this->postcode;
	}

	public function getStreet(): ?string
	{
		return $this->street;
	}

	public function getEmail(): ?string
	{
		return $this->email;
	}

	/**
	 * @param string|null $fullName full name of customer
	 */
	public function setFullName(?string $fullName): void
	{
		$this->fullName = $fullName;
	}

	/**
	 * @param string|null $country ISO 3166-1 country code
	 */
	public function setCountry(?string $country): void
	{
		if ($country !== null && strlen($country) !== 2) {
			throw new InvalidParameterException('country');
		}

		$this->country = $country;
	}

	/**
	 * @param string|null $city name of city
	 */
	public function setCity(?string $city): void
	{
		$this->city = $city;
	}

	/**
	 * @param string|null $postcode postal code
	 */
	public function setPostcode(?string $postcode): void
	{
		$this->postcode = $postcode;
	}

	/**
	 * @param string|null $street street name and number
	 */
	public function setStreet(?string $street): void
	{
		$this->street = $street;
	}

	/**
	 * @param string|null $email customer's email
	 */
	public function setEmail(?string $email): void
	{
		$this->email = $email;
	}

}
