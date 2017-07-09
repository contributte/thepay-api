<?php

namespace Tp;

/**
 * Class representing one payment instance.
 */
class Payment
{
	/**
	 * Config containing merchant-specific configuration options.
	 * Instance of Tp\TpMerchantConfig, passed to the Tp\TpPayment constructor.
	 *
	 * @var MerchantConfig
	 */
	protected $config;

	/**
	 * @var float value indicating the amount of money that should be paid.
	 */
	protected $value = NULL;

	/**
	 * @var string Currency identifier.
	 */
	protected $currency = NULL;

	/**
	 * @var string Payment description that should be visible to the customer.
	 */
	protected $description = NULL;

	/**
	 * Any merchant-specific data, that will be returned to the site after
	 * the payment has been completed.
	 *
	 * @var string
	 */
	protected $merchantData = NULL;

	/**
	 * URL where to redirect the user after the payment has been completed.
	 * It defaults to value configured in administration interface, but
	 * can be overwritten using this property.
	 *
	 * @var string
	 */
	protected $returnUrl = NULL;

	/**
	 * Target of the “Back to e-shop” button on the offline payment info page.
	 * If not set, defaults to the account URL. Must be a valid HTTP or HTTPS
	 * URL.
	 *
	 * @var string|null
	 */
	protected $backToEshopUrl = NULL;

	/**
	 * ID of payment method to use for paying. Setting this argument should
	 * be result of user's selection, not merchant's selection.
	 *
	 * @var integer
	 */
	protected $methodId = NULL;

	/**
	 * @deprecated
	 * @var string
	 */
	protected $customerData = NULL;

	/**
	 * @var string|null Customer’s e-mail address. Used to send payment info and payment link from the payment info
	 *      page.
	 */
	protected $customerEmail = NULL;

	/**
	 * @var boolean If card payment will be charged immediately or only blocked and charged later by paymentDeposit
	 *      operation.
	 */
	protected $deposit = NULL;

	/**
	 * @var boolean If card payment is recurring.
	 */
	protected $isRecurring = NULL;

	/**
	 * @var string numerical specific symbol (used only if payment method supports it).
	 */
	protected $merchantSpecificSymbol = NULL;

	/**
	 * @var EetDph VAT decomposition for EET
	 */

	protected $eetDph = NULL;

	/**
	 * Constructor. Create the payment.
	 *
	 * @param config MerchantConfig containing merchant's access credentials to the ThePay system.
	 */
	public function __construct(MerchantConfig $config = NULL)
	{
		$this->config = $config;

		if (is_null($this->returnUrl) && isset($_SERVER["HTTP_HOST"]) && isset($_SERVER["REQUEST_URI"])) {
			$this->returnUrl = ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"]) ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
		}
	}

	/**
	 * Sets the value property.
	 *
	 * @param float $value
	 *
	 * @throws InvalidParameterException
	 */
	public function setValue($value)
	{
		// Only positive numbers allowed.
		if ( !is_numeric($value) || (double)$value < 0) {
			throw new InvalidParameterException("value");
		}
		else {
			$this->value = (double)$value;
		}
	}

	/**
	 * @param string $currency
	 */
	public function setCurrency($currency)
	{
		$this->currency = $currency;
	}

	/**
	 * Sets the description property.
	 *
	 * @param string $description
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}

	/**
	 * Sets the merchantData property.
	 *
	 * @param string $data
	 */
	public function setMerchantData($data)
	{
		$this->merchantData = $data;
	}

	/**
	 * Sets the returnUrl property.
	 *
	 * @param string $returnUrl
	 */
	public function setReturnUrl($returnUrl)
	{
		$this->returnUrl = $returnUrl;
	}

	/**
	 * @param string|null $backToEshopUrl
	 */
	public function setBackToEshopUrl($backToEshopUrl = NULL)
	{
		$this->backToEshopUrl = $backToEshopUrl;
	}

	/**
	 * Sets the methodId property.
	 *
	 * @param integer $methodId
	 */
	public function setMethodId($methodId)
	{
		$this->methodId = $methodId;
	}

	/**
	 * Return MerchantConfig associated with this payment.
	 *
	 * @return MerchantConfig
	 */
	public function getMerchantConfig()
	{
		return $this->config;
	}

	/**
	 * Returns the value property. If value was not specified using
	 * setValue() method, NULL is returned.
	 *
	 * @return float
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Returns the currency property. If currency was not specified using
	 * setCurrency() method, NULL is returned.
	 *
	 * @return string
	 */
	public function getCurrency()
	{
		return $this->currency;
	}

	/**
	 * Returns the description property. If description was not specified
	 * using setDescription() method, NULL is returned.
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Returns the merchantData property. If merchantData was not specified
	 * using setMerchantData() method, NULL is returned.
	 *
	 * @return string
	 */
	public function getMerchantData()
	{
		return $this->merchantData;
	}

	/**
	 * Returns the returnUrl property. If returnUrl was not specified using
	 * setReturnUrl() method, NULL is returned.
	 *
	 * @return string
	 */
	public function getReturnUrl()
	{
		return $this->returnUrl;
	}

	/**
	 * @return string|null
	 */
	public function getBackToEshopUrl()
	{
		return $this->backToEshopUrl;
	}

	/**
	 * Returns the methodId property. If methodId was not specified using
	 * setMethodId() property, NULL is returned.
	 *
	 * @return integer
	 */
	public function getMethodId()
	{
		return $this->methodId;
	}

	/**
	 * Set customer data.
	 *
	 * @param string $data
	 */
	public function setCustomerData($data)
	{
		$this->customerData = $data;
	}

	/**
	 * @deprecated
	 * @return string previously set customer data
	 */
	public function getCustomerData()
	{
		return $this->customerData;
	}

	/**
	 * @param null|string $customerEmail
	 */
	public function setCustomerEmail($customerEmail)
	{
		$this->customerEmail = $customerEmail;
	}

	/**
	 * @return null|string
	 */
	public function getCustomerEmail()
	{
		return $this->customerEmail;
	}

	/**
	 * @return boolean If card payment will be charged immediately or only blocked and charged later by paymentDeposit
	 *                 operation.
	 */
	public function getDeposit()
	{
		return $this->deposit;
	}

	/**
	 * Set if card payment will be charged immediately or only blocked and charged later by paymentDeposit operation.
	 *
	 * @param boolean $deposit
	 */
	public function setDeposit($deposit)
	{
		$this->deposit = $deposit;
	}

	/**
	 * If card payment is recurring.
	 *
	 * @return boolean
	 */
	public function getIsRecurring()
	{
		return $this->isRecurring;
	}

	/**
	 * Set if card payment is recurring.
	 *
	 * @param boolean $isRecurring
	 */
	public function setIsRecurring($isRecurring)
	{
		$this->isRecurring = $isRecurring;
	}

	/**
	 * Numerical specific symbol (used only if payment method supports it).
	 *
	 * @return string
	 */
	function getMerchantSpecificSymbol()
	{
		return $this->merchantSpecificSymbol;
	}

	/**
	 * Numerical specific symbol (used only if payment method supports it).
	 *
	 * @return string
	 */
	function setMerchantSpecificSymbol($merchantSpecificSymbol)
	{
		$this->merchantSpecificSymbol = $merchantSpecificSymbol;
	}


	/**
	 * @return EetDph VAT decomposition for EET
	 */
	function getEetDph()
	{
		return $this->eetDph;
	}

	/**
	 * @param EetDph $eetDph VAT decomposition for EET
	 */
	function setEetDph(EetDph $eetDph = NULL)
	{
		$this->eetDph = $eetDph;
	}

	/**
	 * List arguments to put into the URL. Returns associative array of
	 * arguments that should be contained in the ThePay gate call.
	 *
	 * @return array
	 */
	public function getArgs()
	{
		$input = [];

		$input["merchantId"] = $this->config->merchantId;
		$input["accountId"] = $this->config->accountId;

		if ( !is_null($this->value)) {
			$input["value"] = number_format($this->value, 2, '.', '');
		}

		if ( !is_null($this->currency)) {
			$input["currency"] = $this->currency;
		}

		if ( !is_null($this->description)) {
			$input["description"] = $this->description;
		}

		if ( !is_null($this->merchantData)) {
			$input["merchantData"] = $this->merchantData;
		}

		if ( !is_null($this->customerData)) {
			$input["customerData"] = $this->customerData;
		}

		if ( !is_null($this->customerEmail)) {
			$input["customerEmail"] = $this->customerEmail;
		}

		if ( !is_null($this->returnUrl)) {
			$input["returnUrl"] = $this->returnUrl;
		}

		$backToEshopUrlIsNull = is_null($this->backToEshopUrl);
		if ( !$backToEshopUrlIsNull) {
			$input['backToEshopUrl'] = $this->backToEshopUrl;
		}

		if ( !is_null($this->methodId)) {
			$input["methodId"] = $this->methodId;
		}

		if ( !is_null($this->deposit)) {
			$input["deposit"] = $this->deposit ? '1' : '0';
		}
		if ( !is_null($this->isRecurring)) {
			$input["isRecurring"] = $this->isRecurring;
		}

		if ( !is_null($this->merchantSpecificSymbol)) {
			$input["merchantSpecificSymbol"] = $this->merchantSpecificSymbol;
		}

		if ( !is_null($this->eetDph) && !$this->eetDph->isEmpty()) {
			$input = array_merge($input, $this->eetDph->toArray());
		}

		return $input;
	}

	/**
	 * Returns signature to authenticate the payment. The signature
	 * consists of hash of all specified parameters and the merchant
	 * password specified in the configuration. So no one can alter the
	 * payment, because the password is not known.
	 *
	 * @return string
	 */
	public function getSignature()
	{
		$input = $this->getArgs();

		$str = "";
		foreach ($input as $key => $val) {
			$str .= $key . "=" . $val . "&";
		}

		$str .= "password=" . $this->config->password;

		return $this->hashFunction($str);
	}

	/**
	 * Function that calculates hash.
	 *
	 * @param string $str
	 *
	 * @return string
	 */
	public static function hashFunction($str)
	{
		return md5($str);
	}

	public function __toString()
	{
		return 'TpGatePayment[value: ' . $this->value . '; currency: ' . $this->currency . '; description: ' . $this->description . '; merchantData: ' . $this->merchantData . '; returnUrl: ' . $this->returnUrl . '; methodId: ' . $this->methodId . '; deposit: ' . $this->deposit . '; isRecurring: ' . $this->isRecurring . '; merchantSpecificSymbol: ' . $this->merchantSpecificSymbol . ']';
	}
}
