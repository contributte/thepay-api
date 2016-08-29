<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'TpUtils.php'));

// …everything else can be loaded using TpUtils::requirePaths.
TpUtils::requirePaths(array(
	array('helpers', 'TpMerchantHelper.php'),
	array('TpEscaper.php')
));

/**
 * Button helper, that generates simple text button that points to the
 * ThePay page, where rest of the functionality occurs.
 */
class TpButtonMerchantHelper extends TpMerchantHelper {
	/**
	 * Button visual style. If left blank, only simple text link will be
	 * created. Otherwise, one of button styles specified in ThePay API
	 * documentation can be used.
	 */
	protected $buttonStyle = "fullsize";

	/**
	 * Button text. This text is displayed if button image cannot be loaded
	 * or when simple text style (empty buttonStyle property) is used.
	 */
	protected $buttonText = "Donate!";

	/**
	 * Sets the buttonStyle property.
	 * @param buttonStyle String specifying the button style. Can be empty
	 *   for default text button, or one of button styles specified in the
	 *   ThePay API documentation.
	 * @param buttonText Optional argument specifying the text that should
	 *   be displayed on the button.
	 */
	public function setButtonStyle($buttonStyle, $buttonText = NULL) {
		$this->buttonStyle = $buttonStyle;
		if (!is_null($buttonText)) {
			$this->buttonText = $buttonText;
		}
	}

	/**
	 * Sets the buttonText property.
	 */
	public function setButtonText($buttonText) {
		$this->buttonText = $buttonText;
	}

	/**
	 * Returns the buttonStyle property.
	 */
	public function getButtonStyle() {
		return $this->buttonStyle;
	}

	/**
	 * Returns the buttonText property.
	 */
	public function getButtonText() {
		return $this->buttonText;
	}

	/**
	 * Button link target URL.
	 *
	 * @return string
	 */
	public function buildUrl() {
		$gateUrl = $this->payment->getMerchantConfig()->gateUrl;
		$query   = $this->buildQuery();
		if(is_null($this->payment->getMethodId())) {
			$query .= '&methodSelectionAllowed';
		}
		return $gateUrl . '?' . $query;
	}

	/**
	 * Return the HTML code for the button.
	 */
	public function render() {
		$targetUrl = TpEscaper::htmlEntityEncode(self::buildUrl());

		switch ($this->buttonStyle) {
			case "":
				return "<a href=\"$targetUrl\">$this->buttonText</a>";
				break;

			default:
				$gateUrl = $this->payment->getMerchantConfig()->gateUrl;
				$buttonStyle = rawurlencode($this->buttonStyle);
				$src = TpEscaper::htmlEntityEncode(
					$gateUrl . 'buttons/' . $buttonStyle . '.png'
				);

				$title = TpEscaper::htmlEntityEncode($this->buttonText);
				return "<a href=\"".$targetUrl."\"><img src=\"$src\" alt=\"$title\" title=\"$title\" /></a>";
				break;
		}
	}
}
