<?php
class TpFerBuyCustomer {

	/**
	 * @var string
	 */
	private $firstName;

	/**
	 * @var string
	 */
	private $lastName;

	/**
	 * @var string
	 */
	private $address;

	/**
	 * @var string
	 */
	private $postalCode;

	/**
	 * @var string
	 */
	private $city;

	/**
	 * @var string
	 */
	private $mobilePhone;

	/**
	 * @var string
	 */
	private $email;

	/**
	 * All parameters except $mobilePhone are required.
	 * @param string $firstName Customer first name.
	 * @param string $lastName Customer last name.
	 * @param string $email Customer email.
	 * @param string $city Customer city.
	 * @param string $address Customer address.
	 * @param string $postalCode Customer postal code.
	 * @param string $mobilePhone Customer mobile phone number (Optional).
	 * @throws TpInvalidArgumentException If one of parameters is empty or null.
	 */
	public function __construct($firstName, $lastName, $email, $city, $address, $postalCode, $mobilePhone = null) {
		$firstName = strval($firstName);
		if($firstName === "") {
			throw new TpInvalidArgumentException("First name cannot be empty.");
		}

		$lastName = strval($lastName);
		if($lastName === "") {
			throw new TpInvalidArgumentException("Last name cannot be empty.");
		}

		$email = strval($email);
		if($email === "") {
			throw new TpInvalidArgumentException("Email cannot be empty.");
		}

		$city = strval($city);
		if($city === "") {
			throw new TpInvalidArgumentException("City cannot be empty.");
		}

		$address = strval($address);
		if($address == "") {
			throw new TpInvalidArgumentException("Address cannot be empty.");
		}

		$postalCode = strval($postalCode);
		if($postalCode === "") {
			throw new TpInvalidArgumentException("Postal code cannot be empty.");
		}

		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->setEmail($email);
		$this->setCity($city);
		$this->setAddress($address);
		$this->setPostalCode($postalCode);

		$this->setMobilePhone($mobilePhone);
	}

	/**
	 * Get previously set first name.
	 * @return string
	 */
	public function getFirstName(){
		return $this->firstName;
	}

	/**
	 * Get previously set last name.
	 * @return string
	 */
	public function getLastName(){
		return $this->lastName;
	}

	/**
	 * Set user address.
	 * @param $address
	 */
	public function setAddress($address){
		$this->address = $address;
	}

	/**
	 * Get previously set user address.
	 * @return string
	 */
	public function getAddress(){
		return $this->address;
	}

	/**
	 * Set user postal code.
	 * @param $postalCode
	 */
	private function setPostalCode($postalCode) {
		$this->postalCode = $postalCode;
	}

	/**
	 * Get previously set postal code.
	 * @return string
	 */
	public function getPostalCode() {
		return $this->postalCode;
	}

	/**
	 * Set user city.
	 * @param $city
	 */
	private function setCity($city) {
		$this->city = $city;
	}

	/**
	 * Get previously set city.
	 * @return string
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Set user mobile phone number.
	 * @param $mobilePhone
	 */
	public function setMobilePhone($mobilePhone) {
		if(!is_null($mobilePhone)) {
			$mobilePhone = strval($mobilePhone);
		}
		$this->mobilePhone = $mobilePhone;
	}

	/**
	 * Get previously set mobile phone number.
	 * @return string
	 */
	public function getMobilePhone() {
		return $this->mobilePhone;
	}

	/**
	 * Set user email.
	 * @param $email
	 */
	private function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Get previously set user email.
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

}
