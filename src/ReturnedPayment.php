<?php
declare(strict_types=1);

namespace Tp;

/**
 * Class to handle returned payment callback from ThePay gate.
 */
class ReturnedPayment extends Payment
{
	/**
	 * @var int merchantId from request
	 */
	protected $requestMerchantId = NULL;
	/**
	 * @var int accountId from request
	 */
	protected $requestAccountId = NULL;

	/**
	 * @var int Payment status. One of enum values specified in the ThePay API documentation.
	 */
	protected $status;

	/**
	 * @var int Unique payment ID in the ThePay system.
	 */
	protected $paymentId;

	/**
	 * Threat rating of the IP address that sent the payment.
	 */
	protected $ipRating;

	/**
	 * @var string For offline payments, variable symbol (or equivalent) that identifies the payment.
	 */
	protected $variableSymbol;

	/**
	 * @var string Signature specified in arguments by ThePay gate.
	 */
	protected $signature;

	/**
	 * @var bool if payment method is offline or online
	 */
	protected $isOffline;

	/**
	 * @var bool if payment needs additional confirmation about it's state - for online methods with additional
	 *      confirmation
	 */
	protected $needConfirm;

	/**
	 * @var bool if actual action is confirmation about payment state - for online methods with additional
	 *      confirmation
	 */
	protected $isConfirm;

	/**
	 * @var string specific symbol from bank transaction. Used only for permanent payments.
	 */
	protected $specificSymbol = NULL;

	/**
	 * Number of customer's account in full format including bank code.
	 * Is set only if merchant has turned on this functionality and account number is available for used payment method.
	 *
	 * @var string
	 */
	protected $customerAccountNumber = NULL;

	/**
	 * Name of customer's account. Usually name and surname of customer, but it could be arbitrary name
	 * which he set for his account in internet banking of his bank.
	 * Is filled only for some payment methods.
	 *
	 * @var string
	 */
	protected $customerAccountName = NULL;

	/**
	 * Correctly paid.
	 */
	public const STATUS_OK = 2;
	/**
	 * Canceled by customer.
	 */
	public const STATUS_CANCELED = 3;
	/**
	 * Some error occurred during payment process.
	 * Probably not payed.
	 */
	public const STATUS_ERROR = 4;

	/**
	 * Payment was underpaid
	 */
	public const STATUS_UNDERPAID = 6;

	/**
	 * Payment was paid, but waiting for confirmation from payment system.
	 */
	public const STATUS_WAITING = 7;

	/**
	 * Payment amount is blocked on customer's account. Money is charged after sending paymentDeposit request through
	 * API. Used only for card payments.
	 */
	public const STATUS_CARD_DEPOSIT = 9;

	/**
	 * @var array required arguments of incoming request.
	 */
	protected static $REQUIRED_ARGS = [
		'value', 'currency', 'methodId', 'description', 'merchantData',
		'status', 'paymentId', 'ipRating', 'isOffline', 'needConfirm',
	];

	/**
	 * @var array optional arguments of incoming request.
	 */
	protected static $OPTIONAL_ARGS = [
		'isConfirm', 'variableSymbol', 'specificSymbol',
		'deposit', 'isRecurring', 'customerAccountNumber',
		'customerAccountName',
	];
	/**
	 * @var array default values for optional args
	 */
	protected static $OPTIONAL_ARGS_DEFAULT = [
		'isConfirm'             => NULL, 'variableSymbol' => NULL, 'specificSymbol' => NULL,
		'deposit'               => NULL, 'isRecurring' => NULL,
		'customerAccountNumber' => NULL, 'customerAccountName' => NULL,
	];

	/**
	 * @param MerchantConfig $config
	 * @param array          $args array Optional arguments parameter, that can specify the
	 *                             arguments of the returned payment. If not specified, it is taken
	 *                             from the $_REQUEST superglobal array.
	 *
	 * @throws MissingParameterException
	 */
	function __construct(MerchantConfig $config, array $args = NULL)
	{
		parent::__construct($config);

		if (is_null($args)) {
			$args = &$_REQUEST;
		}

		if ( !empty($args['merchantId'])) {
			$this->requestMerchantId = $args['merchantId'];
		}
		if ( !empty($args['accountId'])) {
			$this->requestAccountId = $args['accountId'];
		}
		foreach (self::$REQUIRED_ARGS as $arg) {
			if ( !isset($args[$arg])) {
				throw new MissingParameterException($arg);
			}

			$this->{$arg} = $args[$arg];
		}

		foreach (self::$OPTIONAL_ARGS_DEFAULT as $arg => $defaultValue) {
			if ( !isset($args[$arg])) {
				$this->{$arg} = $defaultValue;
			}
			else {
				$this->{$arg} = $args[$arg];
			}
		}

		$this->signature = $args['signature'];
	}

	/**
	 * Use this call to verify signature of the payment.
	 * this method is called automatically.
	 *
	 * @return true if signature is valid, otherwise throws
	 *   a Tp\TpInvalidSignatureException.
	 * @throws InvalidSignatureException, when signature is invalid.
	 */
	function verifySignature(string $signature = NULL) : bool
	{
		// check merchantId and accountId from request
		if ($this->getRequestMerchantId() !== $this->getMerchantConfig()->merchantId
			|| $this->getRequestAccountId() !== $this->getMerchantConfig()->accountId
		) {
			throw new InvalidSignatureException;
		}

		if ($signature === NULL) {
			$signature = $this->signature;
		}
		// Compute the signature for arguments specified, and compare
		// it to the specified signature.

		$out = [];
		$out[] = 'merchantId=' . $this->getRequestMerchantId();
		$out[] = 'accountId=' . $this->getRequestAccountId();
		foreach (array_merge(self::$REQUIRED_ARGS, self::$OPTIONAL_ARGS) as $arg) {
			if ( !is_null($this->{$arg})) {
				$out[] = $arg . '=' . $this->{$arg};
			}
		}
		$out[] = 'password=' . $this->getMerchantConfig()->password;

		$sig = $this->hashFunction(implode('&', $out));
		if ($sig == $signature) {
			return TRUE;
		}
		else {
			throw new InvalidSignatureException;
		}
	}

	public function getRequestMerchantId() : int
	{
		return intval($this->requestMerchantId);
	}

	public function getRequestAccountId() : int
	{
		return intval($this->requestAccountId);
	}

	/**
	 * Overridden to provide default value if no currency is specified in
	 * the callback, so that merchant application can count with different
	 * currencies right now, even when ThePay does not support multiple
	 * currencies so far.
	 *
	 * @return string
	 */
	function getCurrency() : string
	{
		if (is_null($this->currency)) {
			return 'CZK';
		}
		else {
			return parent::getCurrency();
		}
	}

	/**
	 * Overwrites getSignature() method from Tp\TpPayment to return the valid
	 * signature specified by ThePay gate, not the signature computed
	 * by the class for sending the payment (mainly because sent payment
	 * does not contain all fields that are used to generate returned
	 * payment signature).
	 *
	 * @return string
	 */
	function getSignature() : string
	{
		return $this->signature;
	}

	/**
	 * Gets status of the payment.
	 *
	 * @return int one of STATUS_* constants.
	 */
	function getStatus() : int
	{
		return intval($this->status);
	}

	/**
	 * @return int Gets unique ID of the payment in the ThePay system.
	 */
	function getPaymentId() : int
	{
		return intval($this->paymentId);
	}

	/**
	 * Returns the IP rating of the IP that sent the payment.
	 */
	function getIpRating() : int
	{
		return intval($this->ipRating);
	}

	/**
	 * @return string Returns the variable symbol, if valid, for offline payment method.
	 */
	function getVariableSymbol() : ?string
	{
		return $this->variableSymbol;
	}

	/**
	 * @return bool true if payment method is offline
	 */
	function isOffline() : bool
	{
		return $this->getIsOffline();
	}

	/**
	 * @return bool if payment needs additional confirmation about it's state - for online methods with additional
	 *                 confirmation
	 */
	public function getNeedConfirm() : bool
	{
		return $this->needConfirm !== '0';
	}

	/**
	 * @return bool if actual action is confirmation about payment state - for online methods with additional
	 *                 confirmation
	 */
	public function getIsConfirm() : ?bool
	{
		return is_null($this->isConfirm) ? NULL : $this->isConfirm !== '0';
	}

	/**
	 * @return string specific symbol from bank transaction. Used only for permanent payments.
	 */
	public function getSpecificSymbol() : ?string
	{
		return $this->specificSymbol;
	}

	/**
	 * @return bool if payment method is offline or online
	 */
	public function getIsOffline() : bool
	{
		return $this->isOffline !== '0';
	}

	/**
	 * @return string Number of customer's account in full format including bank code.
	 */
	public function getCustomerAccountNumber() : ?string
	{
		return $this->customerAccountNumber;
	}

	/**
	 * @return string Name of customer's account.
	 */
	public function getCustomerAccountName() : ?string
	{
		return $this->customerAccountName;
	}
}
