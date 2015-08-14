<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . "TpMerchantHelper.php";
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', "TpEscaper.php"));

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
	function setButtonStyle($buttonStyle, $buttonText = NULL) {
		$this->buttonStyle = $buttonStyle;
		if (!is_null($buttonText)) {
			$this->buttonText = $buttonText;
		}
	}

	/**
	 * Sets the buttonText property.
	 */
	function setButtonText($buttonText) {
		$this->buttonText = $buttonText;
	}

	/**
	 * Returns the buttonStyle property.
	 */
	function getButtonStyle() {
		return $this->buttonStyle;
	}

	/**
	 * Returns the buttonText property.
	 */
	function getButtonText() {
		return $this->buttonText;
	}

	/**
	 * Return the HTML code for the button.
	 */
	function render() {
		$gateUrl = $this->payment->getMerchantConfig()->gateUrl;

		$targetUrl = TpEscaper::htmlEntityEncode("{$gateUrl}iframe/");
		$targetUrl = "$targetUrl?" . $this->buildQuery();

		switch ($this->buttonStyle) {
			case "":
				return "<a href=\"$targetUrl\">$this->buttonText</a>";
				break;

			default:
				$buttonStyle = rawurlencode($this->buttonStyle);
				$src = "{$gateUrl}buttons/$buttonStyle.png";
				$src = TpEscaper::htmlEntityEncode($src);

				$title = TpEscaper::htmlEntityEncode($this->buttonText);
				return "<a href=\"".$targetUrl."\"><img src=\"$src\" alt=\"$title\" title=\"$title\" /></a>";
				break;
		}
	}
}
