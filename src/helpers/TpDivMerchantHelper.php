<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'TpUtils.php'));

// …everything else can be loaded using TpUtils::requirePaths.
TpUtils::requirePaths(array(
	array('helpers', 'TpMerchantHelper.php'),
	array('TpEscaper.php')
));

/**
 * Helper that generates payment button in div.
 */
class TpDivMerchantHelper extends TpMerchantHelper {

	/**
	 * Optional CSS argument, that can contain URL to custom stylesheet,
	 * that allows to customize the layout of the div content.
	 */
	protected $cssUrl;

	/**
	 * @var string payment button skin
	 */
	protected $skin;

	/**
	 * Disable default CSS styling for payment button.
	 * User have to create his own style for button.
	 */
	protected $disableButtonCss = false;

	/**
	 * Disable default CSS styling for popup div with payment instructions for offline methods.
	 * User have to create his own style for popup.
	 */
	protected $disablePopupCss = false;

	/**
	 * @return string
	 */
	public function getSkin() {
		return $this->skin;
	}

	/**
	 * Set visual skin used for payment buttons.
	 *
	 * @param string $skin
	 */
	public function setSkin($skin) {
		$this->skin = $skin;
	}

	/**
	 * Disable thepay css for button
	 */
	public function disableButtonCss(){
		$this->disableButtonCss = true;
	}

	/**
	 * Enable thepay css for button
	 */
	public function enableButtonCss(){
		$this->disableButtonCss = false;
	}

	/**
	 * Disable thepay css for offline payment popup box
	 */
	public function disablePopupCss(){
		$this->disablePopupCss = true;
	}

	/**
	 * Enable thepay css for offline payment popup box
	 */
	public function enablePopupCss(){
		$this->disablePopupCss = false;
	}

	/**
	 * Return the HTML code for the div.
	 */
	function render() {
		$url = $this->payment->getMerchantConfig()->gateUrl;
		$queryArgs = array_filter(array(
			'skin' => $this->skin
		));

		$out = "";
		if(!$this->disableButtonCss) {
			$skin = $this->skin == "" ? "" : "/$this->skin";
			$href = "{$url}div/style$skin/div.css?v=" . time();
			$href = TpEscaper::htmlEntityEncode($href);
			$out .= "<link href=\"$href\" type=\"text/css\" rel=\"stylesheet\" />\n";
		}

		$thepayGateUrl = $url.'div/index.php?'.$this->buildQuery($queryArgs);
		$thepayGateUrl = TpEscaper::jsonEncode($thepayGateUrl);
		$disableThepayPopupCss = TpEscaper::jsonEncode($this->disablePopupCss);
		$out .= "<script type=\"text/javascript\">";
		$out .= "\tvar thepayGateUrl = $thepayGateUrl,\n";
		$out .= "\t\tdisableThepayPopupCss = $disableThepayPopupCss;\n";
		$out .= "</script>\n";

		$src = "{$url}div/js/jquery.js?v=" . time();
		$src = TpEscaper::htmlEntityEncode($src);
		$out .= "<script type=\"text/javascript\" src=\"$src\" async=\"async\"></script>\n";

		$src = "{$url}div/js/div.js?v=" . time();
		$src = TpEscaper::htmlEntityEncode($src);
		$out .= "<script type=\"text/javascript\" src=\"$src\" async=\"async\"></script>\n";

		$out .= "<div id=\"thepay-method-box\" style=\"border: 0;\"></div>\n";
		return $out;
	}
}