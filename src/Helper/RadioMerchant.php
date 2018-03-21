<?php
declare(strict_types=1);

namespace Tp\Helper;

use Tp\Exception;
use Tp\Escaper;
use Tp\MerchantConfig;
use Tp\Payment;

/**
 * Helper for payment component with radio buttons method selection.
 *
 * @author Michal Kandr
 */
class RadioMerchant
{
	/**
	 * @var MerchantConfig merchant configuration
	 */
	protected $config;
	protected $name;
	protected $value;
	protected $showIcon;
	protected $appendCode;
	protected $currency; // Optional, defaults to CZK.

	/**
	 * Disable default CSS styling for popup div with payment instructions for offline methods.
	 * User have to create his own style for popup.
	 */
	protected $disablePopupCss = FALSE;

	/**
	 * @param MerchantConfig $config              merchant configuration
	 * @param string         $name                name of original radio buttons with payment methods
	 * @param string         $value               value of radio button that originally represents ThePay payment method
	 * @param bool           $showIcon            if payment method graphical icon should be rendered in radiobutton's
	 *                                            label
	 * @param bool           $disablePopupCss     disable default CSS styling for popup div with payment instructions
	 * @param string         $currency            payment's currency. Null for default currency
	 */
	function __construct(
		MerchantConfig $config,
		string $name = NULL,
		$value = NULL,
		bool $showIcon = TRUE,
		bool $disablePopupCss = FALSE,
		string $currency = NULL
	) {
		$this->config = $config;
		$this->name = $name;
		$this->value = $value;
		$this->showIcon = $showIcon;
		$this->disablePopupCss = $disablePopupCss;
		$this->currency = $currency;
	}

	/**
	 * @return MerchantConfig merchant configuration
	 */
	public function getConfig() : MerchantConfig
	{
		return $this->config;
	}

	/**
	 * @param MerchantConfig $config merchant configuration
	 */
	public function setConfig(MerchantConfig $config) : void
	{
		$this->config = $config;
	}

	/**
	 * @return string name of original radio buttons with payment methods;
	 */
	public function getName() : string
	{
		return $this->name;
	}

	/**
	 * @param string $name name of original radio buttons with payment methods
	 */
	public function setName(string $name) : void
	{
		$this->name = $name;
	}

	/**
	 * @return string|int value of radio button that originally represents ThePay payment method
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @param string|int $value value of radio button that originally represents ThePay payment method
	 */
	public function setValue($value) : void
	{
		$this->value = $value;
	}

	/**
	 * @param bool $showIcon if payment method graphical icon should be rendered in radiobutton's label
	 */
	public function setShowIcon(bool $showIcon) : void
	{
		$this->showIcon = $showIcon;
	}

	/**
	 * @return bool if payment method graphical icon should be rendered in radiobutton's label
	 */
	public function getShowIcon() : bool
	{
		return $this->showIcon;
	}

	public function getAppendCode()
	{
		return $this->appendCode;
	}

	public function setAppendCode($appendCode) : void
	{
		$this->appendCode = $appendCode;
	}

	public function getDisablePopupCss()
	{
		return $this->disablePopupCss;
	}

	/**
	 * Disable/enable thepay css for offline payment popup box
	 */
	public function setDisablePopupCss(bool $disablePopupCss) : void
	{
		$this->disablePopupCss = $disablePopupCss;
	}

	public function getCurrency()
	{
		return $this->currency;
	}

	private function createSignature(array $params) : string
	{
		$str = http_build_query(array_filter(array_merge($params, ['password' => $this->config->password])));

		return md5($str);
	}

	/**
	 * Generate HTML code for payment component.
	 *
	 * @return string HTML code
	 */
	public function renderRadio() : string
	{
		$gateUrl = $this->config->gateUrl;
		$queryArgs = [
			'merchantId' => $this->config->merchantId,
			'accountId'  => $this->config->accountId,
			'name'       => $this->name,
			'value'      => $this->value,
			'showIcon'   => $this->showIcon,
			'selected'   => !empty($_REQUEST['tp_radio_value']) ? (int)$_REQUEST['tp_radio_value'] : '',
		];
		// Currency is an optional argument. For compatibility reasons, it is
		// not present in the query at all if its value is empty.
		if ($this->currency) {
			$queryArgs['currency'] = $this->currency;
		}
		$queryArgs['signature'] = $this->createSignature($queryArgs);

		$queryArgs = http_build_query($queryArgs);
		$thepayGateUrl = "{$gateUrl}radiobuttons/index.php?{$queryArgs}";
		$thepayGateUrl = Escaper::jsonEncode($thepayGateUrl);

		$href = "{$gateUrl}radiobuttons/style/radiobuttons.css?v=" . time();
		$out = "<link href=\"{$href}\" type=\"text/css\" rel=\"stylesheet\" />\n";
		$out .= "<script type=\"text/javascript\">\n";
		$out .= "\tvar thepayGateUrl = {$thepayGateUrl};\n";
		if ($this->appendCode) {
			$thepayAppendCode = Escaper::jsonEncode($this->appendCode);
			$out .= "\tvar thepayAppendCode = {$thepayAppendCode};\n";
		}
		$out .= "</script>\n";

		$src = "{$gateUrl}radiobuttons/js/jquery.js?v=" . time();
		$out .= "<script type=\"text/javascript\" src=\"{$src}\" async=\"async\"></script>\n";

		$src = "{$gateUrl}radiobuttons/js/radiobuttons.js?v=" . time();
		$out .= "<script type=\"text/javascript\" src=\"{$src}\" async=\"async\"></script>\n";

		$out .= "<div id=\"thepay-method-box\"></div>\n";

		return $out;
	}

	/**
	 * @return bool true if some of ThePay payment methods was selected
	 */
	public function isTpMethodChosen() : bool
	{
		return !empty($_REQUEST['tp_radio_value']);
	}

	protected function clearCookies() : void
	{
		setcookie('tp_selected_val', '', 1);
	}

	/**
	 * Redirect user to payment gate if ThePay payment method is selected and this method is online.
	 * Don't send output before calling this method (or use enable output buffering)
	 *
	 * @param Payment  $payment           data of payment
	 * @param callable $redirectFunc      if you use some framework with own redirect mechanism, provide redirect
	 *                                    function with one argument - destination url
	 * @param bool     $dieAfterRedirect  In case of successful redirect, exit (die) instead of just returning true.
	 * @param int      $forcedValue       allowes you to explicitly set selected payment method id (when you need it to
	 *                                    by set differently then from request variable)
	 *
	 * @throws Exception if headers was already sent
	 */
	public function redirectOnlinePayment(
		Payment $payment,
		callable $redirectFunc = NULL,
		bool $dieAfterRedirect = FALSE,
		int $forcedValue = NULL
	) : bool {
		if (( !empty($_REQUEST['tp_radio_value']) || $forcedValue > 0) && empty($_REQUEST['tp_radio_is_offline'])) {
			if (headers_sent()) {
				throw new Exception('Redirect error - headers have been already sent');
			}
			$this->clearCookies();

			// Output buffer must be empty for the redirect to be successful.
			$obCleaned = FALSE;
			while (ob_get_level()) {
				ob_end_clean();
				$obCleaned = TRUE;
			}
			if ($obCleaned) {
				// If the output buffer was being used, start buffering again.
				// Makes function’s behavior more consistent and predictable.
				ob_start();
			}

			$payment->setMethodId((isset($_REQUEST['tp_radio_value']) ? intval($_REQUEST['tp_radio_value']) : $forcedValue));
			$queryArgs = $payment->getArgs();
			$queryArgs['signature'] = $payment->getSignature();
			$url = $this->config->gateUrl . '?' . http_build_query($queryArgs);

			if ($redirectFunc && is_callable($redirectFunc)) {
				$returnedValue = call_user_func($redirectFunc, $url);
			}
			else {
				header('Location:' . $url);
				$returnedValue = TRUE;
			}
		}
		else {
			$returnedValue = FALSE;
		}

		if ($returnedValue && $dieAfterRedirect) {
			die;
		}

		return $returnedValue;
	}

	/**
	 * @deprecated
	 */
	public function redirectOfflinePayment(Payment $payment, callable $redirecFunc = NULL) : void
	{
		$this->redirectOnlinePayment($payment, $redirecFunc);
	}

	/**
	 * Show instruction for offline payment if ThePay payment method is selected and this method is offline.
	 * Show output of this method somewhere on page with order confirmation.
	 *
	 * @param Payment $payment
	 *
	 * @return string HTML code with component
	 */
	public function showPaymentInstructions(Payment $payment) : string
	{
		if (empty($_REQUEST['tp_radio_value']) || empty($_REQUEST['tp_radio_is_offline'])) {
			return '';
		}

		$this->clearCookies();

		$href = "{$this->config->gateUrl}radiobuttons/style/radiobuttons.css?v=" . time();
		$href = Escaper::htmlEntityEncode($href);
		$out = "<link href=\"{$href}\" type=\"text/css\" rel=\"stylesheet\" />\n";

		$out .= "<script type=\"text/javascript\">\n";

		$payment->setMethodId(intval($_REQUEST['tp_radio_value']));
		$queryArgs = $payment->getArgs();
		$queryArgs['signature'] = $payment->getSignature();
		$thepayGateUrl = "{$this->config->gateUrl}?" . http_build_query($queryArgs);
		$thepayGateUrl = Escaper::jsonEncode($thepayGateUrl);
		$out .= "\tvar thepayGateUrl = {$thepayGateUrl},\n";

		$thepayDisablePopupCss = Escaper::jsonEncode($this->disablePopupCss);
		$out .= "\tthepayDisablePopupCss = {$thepayDisablePopupCss};\n";

		$out .= "</script>\n";

		$src = "{$this->config->gateUrl}radiobuttons/js/jquery.js?v=" . time();
		$src = Escaper::htmlEntityEncode($src);
		$out .= "<script type=\"text/javascript\" src=\"{$src}\" async=\"async\"></script>";

		$src = "{$this->config->gateUrl}radiobuttons/js/radiobuttons.js?v=" . time();
		$src = Escaper::htmlEntityEncode($src);
		$out .= "<script type=\"text/javascript\" src=\"{$src}\" async=\"async\"></script>";

		$out .= "<div id=\"thepay-method-result\"></div>";

		return $out;
	}
}
