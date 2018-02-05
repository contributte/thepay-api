<?php
declare(strict_types=1);

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
	 * @var float|null value indicating the amount of money that should be paid.
	 */
	protected $value = NULL;

	/**
	 * @var string|null Currency identifier.
	 */
	protected $currency = NULL;

	/**
	 * @var string|null Payment description that should be visible to the customer.
	 */
	protected $description = NULL;

	/**
	 * Any merchant-specific data, that will be returned to the site after
	 * the payment has been completed.
	 *
	 * @var string|null
	 */
	protected $merchantData = NULL;

	/**
	 * URL where to redirect the user after the payment has been completed.
	 * It defaults to value configured in administration interface, but
	 * can be overwritten using this property.
	 *
	 * @var string|null
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
	 * @var int|null
	 */
	protected $methodId = NULL;

	/**
	 * @deprecated
	 * @var string|null
	 */
	protected $customerData = NULL;

	/**
	 * @var string|null Customer’s e-mail address. Used to send payment info and payment link from the payment info
	 *      page.
	 */
	protected $customerEmail = NULL;

	/**
	 * @var bool|null If card payment will be charged immediately or only blocked and charged later by paymentDeposit
	 *      operation.
	 */
	protected $deposit = NULL;

	/**
	 * @var bool|null If card payment is recurring.
	 */
	protected $isRecurring = NULL;

	/**
	 * @var string|null numerical specific symbol (used only if payment method supports it).
	 */
	protected $merchantSpecificSymbol = NULL;

	/**
	 * @var EetDph|null VAT decomposition for EET
	 */
	protected $eetDph = NULL;

	/**
	 * Constructor. Create the payment.
	 *
	 * @param MerchantConfig $config containing merchant's access credentials to the ThePay system.
	 */
	public function __construct(MerchantConfig $config)
	{
		$this->config = $config;

		if (is_null($this->returnUrl) && isset($_SERVER['HTTP_HOST']) && isset($_SERVER['REQUEST_URI'])) {
			$this->returnUrl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		}
	}

	/**
	 * Sets the value property.
	 *
	 * @param float $value
	 *
	 * @throws InvalidParameterException
	 */
	public function setValue(float $value) : void
	{
		// Only positive numbers allowed.
		if ($value < 0) {
			throw new InvalidParameterException('value');
		}
		else {
			$this->value = $value;
		}
	}

	public function setCurrency(string $currency) : void
	{
		$this->currency = $currency;
	}

	/**
	 * Sets the description property.
	 *
	 * @param string $description
	 */
	public function setDescription(string $description) : void
	{
		$this->description = $description;
	}

	/**
	 * Sets the merchantData property.
	 *
	 * @param string $data
	 */
	public function setMerchantData(string $data) : void
	{
		$this->merchantData = $data;
	}

	/**
	 * Sets the returnUrl property.
	 *
	 * @param string $returnUrl
	 */
	public function setReturnUrl(string $returnUrl) : void
	{
		$this->returnUrl = $returnUrl;
	}

	public function setBackToEshopUrl(string $backToEshopUrl = NULL) : void
	{
		$this->backToEshopUrl = $backToEshopUrl;
	}

	/**
	 * Sets the methodId property.
	 *
	 * @param int $methodId
	 */
	public function setMethodId(int $methodId) : void
	{
		$this->methodId = $methodId;
	}

	/**
	 * Return MerchantConfig associated with this payment.
	 *
	 * @return MerchantConfig
	 */
	public function getMerchantConfig() : MerchantConfig
	{
		return $this->config;
	}

	/**
	 * Returns the value property. If value was not specified using
	 * setValue() method, NULL is returned.
	 *
	 * @return float
	 */
	public function getValue() : ?float
	{
		return $this->value;
	}

	/**
	 * Returns the currency property. If currency was not specified using
	 * setCurrency() method, NULL is returned.
	 *
	 * @return string
	 */
	public function getCurrency() : ?string
	{
		return $this->currency;
	}

	/**
	 * Returns the description property. If description was not specified
	 * using setDescription() method, NULL is returned.
	 *
	 * @return string
	 */
	public function getDescription() : ?string
	{
		return $this->description;
	}

	/**
	 * Returns the merchantData property. If merchantData was not specified
	 * using setMerchantData() method, NULL is returned.
	 *
	 * @return string
	 */
	public function getMerchantData() : ?string
	{
		return $this->merchantData;
	}

	/**
	 * Returns the returnUrl property. If returnUrl was not specified using
	 * setReturnUrl() method, NULL is returned.
	 *
	 * @return string
	 */
	public function getReturnUrl() : ?string
	{
		return $this->returnUrl;
	}

	/**
	 * @return string|null
	 */
	public function getBackToEshopUrl() : ?string
	{
		return $this->backToEshopUrl;
	}

	/**
	 * Returns the methodId property. If methodId was not specified using
	 * setMethodId() property, NULL is returned.
	 *
	 * @return int
	 */
	public function getMethodId() : ?int
	{
		return $this->methodId;
	}

	public function setCustomerData(string $data) : void
	{
		$this->customerData = $data;
	}

	/**
	 * @deprecated
	 * @return string previously set customer data
	 */
	public function getCustomerData() : ?string
	{
		return $this->customerData;
	}

	public function setCustomerEmail(?string $customerEmail)
	{
		$this->customerEmail = $customerEmail;
	}

	public function getCustomerEmail() : ?string
	{
		return $this->customerEmail;
	}

	/**
	 * @return bool If card payment will be charged immediately or only blocked and charged later by paymentDeposit
	 *                 operation.
	 */
	public function getDeposit() : ?bool
	{
		return $this->deposit;
	}

	/**
	 * Set if card payment will be charged immediately or only blocked and charged later by paymentDeposit operation.
	 *
	 * @param bool $deposit
	 */
	public function setDeposit(bool $deposit) : void
	{
		$this->deposit = $deposit;
	}

	/**
	 * If card payment is recurring.
	 *
	 * @return bool
	 */
	public function getIsRecurring() : ?bool
	{
		return $this->isRecurring;
	}

	/**
	 * Set if card payment is recurring.
	 *
	 * @param bool $isRecurring
	 */
	public function setIsRecurring(bool $isRecurring) : void
	{
		$this->isRecurring = $isRecurring;
	}

	/**
	 * Numerical specific symbol (used only if payment method supports it).
	 *
	 * @return string
	 */
	function getMerchantSpecificSymbol() : ?string
	{
		return $this->merchantSpecificSymbol;
	}

	/**
	 * Numerical specific symbol (used only if payment method supports it).
	 *
	 * @param string $merchantSpecificSymbol
	 */
	function setMerchantSpecificSymbol(string $merchantSpecificSymbol) : void
	{
		$this->merchantSpecificSymbol = $merchantSpecificSymbol;
	}


	/**
	 * @return EetDph VAT decomposition for EET
	 */
	function getEetDph() : ?EetDph
	{
		return $this->eetDph;
	}

	/**
	 * @param EetDph $eetDph VAT decomposition for EET
	 */
	function setEetDph(EetDph $eetDph = NULL) : void
	{
		$this->eetDph = $eetDph;
	}

	/**
	 * List arguments to put into the URL. Returns associative array of
	 * arguments that should be contained in the ThePay gate call.
	 *
	 * @return array
	 */
	public function getArgs() : array
	{
		$input = [];

		$input['merchantId'] = $this->config->merchantId;
		$input['accountId'] = $this->config->accountId;

		if ( !is_null($this->value)) {
			$input['value'] = number_format($this->getValue(), 2, '.', '');
		}

		if ( !is_null($this->currency)) {
			$input['currency'] = $this->currency;
		}

		if ( !is_null($this->description)) {
			$input['description'] = $this->description;
		}

		if ( !is_null($this->merchantData)) {
			$input['merchantData'] = $this->merchantData;
		}

		if ( !is_null($this->customerData)) {
			$input['customerData'] = $this->customerData;
		}

		if ( !is_null($this->customerEmail)) {
			$input['customerEmail'] = $this->customerEmail;
		}

		if ( !is_null($this->returnUrl)) {
			$input['returnUrl'] = $this->returnUrl;
		}

		if ( !is_null($this->backToEshopUrl)) {
			$input['backToEshopUrl'] = $this->backToEshopUrl;
		}

		if ( !is_null($this->methodId)) {
			$input['methodId'] = $this->methodId;
		}

		if ( !is_null($this->deposit)) {
			$input['deposit'] = $this->getDeposit() ? '1' : '0';
		}
		if ( !is_null($this->isRecurring)) {
			$input['isRecurring'] = $this->getIsRecurring() ? '1' : '0';
		}

		if ( !is_null($this->merchantSpecificSymbol)) {
			$input['merchantSpecificSymbol'] = $this->merchantSpecificSymbol;
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
	public function getSignature() : string
	{
		$input = $this->getArgs();

		$str = '';
		foreach ($input as $key => $val) {
			$str .= $key . '=' . $val . '&';
		}

		$str .= 'password=' . $this->getMerchantConfig()->password;

		return self::hashFunction($str);
	}

	/**
	 * Function that calculates hash.
	 *
	 * @param string $str
	 *
	 * @return string
	 */
	public static function hashFunction(string $str) : string
	{
		return md5($str);
	}

	public function __toString() : string
	{
		return "TpGatePayment[value: {$this->value}; currency: {$this->currency}; description: {$this->description}; merchantData: {$this->merchantData}; returnUrl: {$this->returnUrl}; methodId: {$this->methodId}; deposit: {$this->deposit}; isRecurring: {$this->isRecurring}; merchantSpecificSymbol: {$this->merchantSpecificSymbol}]";
	}
}
