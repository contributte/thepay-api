<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'TpUtils.php'));

// …everything else can be loaded using TpUtils::requirePaths.
TpUtils::requirePaths(array(
	array('helpers', 'TpMerchantHelper.php'),
	array('exceptions', 'TpException.php'),
	array('TpEscaper.php')
));

/**
 * Helper for payment component with radio buttons method selection.
 * @author Michal Kandr
 */
class TpRadioMerchantHelper {
	/**
	 * @var TpMerchantConfig merchant configuration
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
	protected $disablePopupCss = false;

	/**
	 * @param TpMerchantConfig $config merchant configuration
	 * @param string $name name of original radio buttons with payment methods
	 * @param string $value value of radio button that originally represents ThePay payment method
	 * @param boolean $showIcon if payment method graphical icon should be rendered in radiobutton's label
	 * @param boolean $disablePopupCss disable default CSS styling for popup div with payment instructions
	 * @param string $currency payment's currency. Null for default currency
	 */
	function __construct(TpMerchantConfig $config, $name=null, $value=null, $showIcon = true, $disablePopupCss = false, $currency = null) {
		$this->config = $config;
		$this->name = $name;
		$this->value = $value;
		$this->showIcon = $showIcon;
		$this->disablePopupCss = $disablePopupCss;
		$this->currency = $currency;
	}

	/**
	 * @return TpMerchantConfig merchant configuration
	 */
	public function getConfig() {
		return $this->config;
	}

	/**
	 * @param TpMerchantConfig $config merchant configuration
	 */
	public function setConfig(TpMerchantConfig $config) {
		$this->config = $config;
	}

	/**
	 * @return string name of original radio buttons with payment methods;
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name name of original radio buttons with payment methods
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return string|integer value of radio button that originally represents ThePay payment method
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @param string|integer $value value of radio button that originally represents ThePay payment method
	 */
	public function setValue($value) {
		$this->value = $value;
	}

	/**
	 * @param boolean $showIcon if payment method graphical icon should be rendered in radiobutton's label
	 */
	public function setShowIcon($showIcon) {
		$this->showIcon = $showIcon;
	}

	/**
	 * @return boolean if payment method graphical icon should be rendered in radiobutton's label
	 */
	public function getShowIcon() {
		return $this->showIcon;
	}

	public function getAppendCode() {
		return $this->appendCode;
	}

	public function setAppendCode($appendCode) {
		$this->appendCode = $appendCode;
	}

	public function getDisablePopupCss() {
		return $this->disablePopupCss;
	}

	/**
	 * Disable/enable thepay css for offline payment popup box
	 */
	public function setDisablePopupCss($disablePopupCss) {
		$this->disablePopupCss = $disablePopupCss;
	}
	
	public function getCurrency() {
		return $this->currency;
	}

	private function createSignature(array $params){
		$str = http_build_query(array_filter(array_merge($params, array('password' => $this->config->password))));
		return md5($str);
	}

	/**
	 * Generate HTML code for payment component.
	 * @return string HTML code
	 */
	public function renderRadio(){
		$gateUrl = $this->config->gateUrl;
		$queryArgs = array(
			'merchantId' => $this->config->merchantId,
			'accountId' => $this->config->accountId,
			'name' => $this->name,
			'value' => $this->value,
			'showIcon' => $this->showIcon,
			'selected' => ! empty($_REQUEST['tp_radio_value']) ? (int)$_REQUEST['tp_radio_value'] : '',
		);
		// Currency is an optional argument. For compatibility reasons, it is
		// not present in the query at all if its value is empty.
		if($this->currency) {
			$queryArgs['currency'] = $this->currency;
		}
		$queryArgs['signature'] = $this->createSignature($queryArgs);

		$queryArgs = http_build_query($queryArgs);
		$thepayGateUrl = "{$gateUrl}radiobuttons/index.php?$queryArgs";
		$thepayGateUrl = TpEscaper::jsonEncode($thepayGateUrl);

		$href = "{$gateUrl}radiobuttons/style/radiobuttons.css?v=" . time();
		$out = "<link href=\"$href\" type=\"text/css\" rel=\"stylesheet\" />\n";
		$out .= "<script type=\"text/javascript\">\n";
		$out .= "\tvar thepayGateUrl = $thepayGateUrl;\n";
		if($this->appendCode) {
			$thepayAppendCode = TpEscaper::jsonEncode($this->appendCode);
			$out .= "\tvar thepayAppendCode = $thepayAppendCode;\n";
		}
		$out .= "</script>\n";

		$src = "{$gateUrl}radiobuttons/js/jquery.js?v=" . time();
		$out .= "<script type=\"text/javascript\" src=\"$src\" async=\"async\"></script>\n";

		$src = "{$gateUrl}radiobuttons/js/radiobuttons.js?v=" . time();
		$out .= "<script type=\"text/javascript\" src=\"$src\" async=\"async\"></script>\n";

		$out .= "<div id=\"thepay-method-box\"></div>\n";
		return $out;
	}

	/**
	 * @return boolean true if some of ThePay payment methods was selected
	 */
	public function isTpMethodChosen(){
		return ! empty($_REQUEST['tp_radio_value']);
	}

	protected function clearCookies(){
		setcookie('tp_selected_val', '', 1);
	}

	/**
	 * Redirect user to payment gate if ThePay payment method is selected and this method is online.
	 * Don't send output before calling this method (or use enable output buffering)
	 *
	 * @param TpPayment $payment data of payment
	 * @param callable $redirectFunc if you use some framework with own redirect mechanism, provide redirect function with one argument - destination url
	 * @param bool $dieAfterRedirect In case of successful redirect, exit (die) instead of just returning true.
	 * @param integer $forcedValue allowes you to explicitly set selected payment method id (when you need it to by set differently then from request variable)
	 * @throws TpException if headers was already sent
	 */
	public function redirectOnlinePayment(TpPayment $payment, $redirectFunc = null, $dieAfterRedirect = false, $forcedValue = null) {
		if((!empty($_REQUEST['tp_radio_value']) || $forcedValue > 0) && empty($_REQUEST['tp_radio_is_offline'])){
			if(headers_sent()){
				throw new TpException('Redirect error - headers have been already sent');
			}
			$this->clearCookies();

			// Output buffer must be empty for the redirect to be successful.
			$obCleaned = false;
			while(ob_get_level()) {
				ob_end_clean();
				$obCleaned = true;
			}
			if($obCleaned) {
				// If the output buffer was being used, start buffering again.
				// Makes function’s behavior more consistent and predictable.
				ob_start();
			}

			$payment->setMethodId((int)(isset($_REQUEST['tp_radio_value']) ? $_REQUEST['tp_radio_value'] : $forcedValue));
			$queryArgs = $payment->getArgs();
			$queryArgs['signature'] = $payment->getSignature();
			$url = $this->config->gateUrl.'?'.http_build_query($queryArgs);

			if($redirectFunc && is_callable($redirectFunc)){
				$returnedValue = call_user_func($redirectFunc, $url);
			} else {
				header('Location:'.$url);
				$returnedValue = true;
			}
		} else {
			$returnedValue = false;
		}

		if($returnedValue && $dieAfterRedirect) {
			die;
		}

		return $returnedValue;
	}
	/**
	 * @deprecated
	 */
	public function redirectOfflinePayment(TpPayment $payment, $redirecFunc = null){
		$this->redirectOnlinePayment($payment, $redirecFunc);
	}

	/**
	 * Show instruction for offline payment if ThePay payment method is selected and this method is offline.
	 * Show output of this method somewhere on page with order confirmation.
	 *
	 * @param TpPayment $payment
	 * @return string HTML code with component
	 */
	public function showPaymentInstructions(TpPayment $payment){
		if(empty($_REQUEST['tp_radio_value']) || empty($_REQUEST['tp_radio_is_offline'])){
			return '';
		}

		$this->clearCookies();

		$href = "{$this->config->gateUrl}radiobuttons/style/radiobuttons.css?v=" . time();
		$href = TpEscaper::htmlEntityEncode($href);
		$out = "<link href=\"$href\" type=\"text/css\" rel=\"stylesheet\" />\n";

		$out .= "<script type=\"text/javascript\">\n";

		$payment->setMethodId(intval($_REQUEST['tp_radio_value']));
		$queryArgs = $payment->getArgs();
		$queryArgs['signature'] = $payment->getSignature();
		$thepayGateUrl = "{$this->config->gateUrl}?" . http_build_query($queryArgs);
		$thepayGateUrl = TpEscaper::jsonEncode($thepayGateUrl);
		$out .= "\tvar thepayGateUrl = $thepayGateUrl,\n";

		$thepayDisablePopupCss = TpEscaper::jsonEncode($this->disablePopupCss);
		$out .= "\tthepayDisablePopupCss = $thepayDisablePopupCss;\n";

		$out .= "</script>\n";

		$src = "{$this->config->gateUrl}radiobuttons/js/jquery.js?v=" . time();
		$src = TpEscaper::htmlEntityEncode($src);
		$out .= "<script type=\"text/javascript\" src=\"$src\" async=\"async\"></script>";

		$src = "{$this->config->gateUrl}radiobuttons/js/radiobuttons.js?v=" . time();
		$src = TpEscaper::htmlEntityEncode($src);
		$out .= "<script type=\"text/javascript\" src=\"$src\" async=\"async\"></script>";

		$out .= "<div id=\"thepay-method-result\"></div>";

		return $out;
	}
}
