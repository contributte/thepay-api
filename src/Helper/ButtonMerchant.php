<?php declare(strict_types = 1);

namespace Tp\Helper;

use Tp\Escaper;

/**
 * Button helper, that generates simple text button that points to the
 * ThePay page, where rest of the functionality occurs.
 */
class ButtonMerchant extends Merchant
{

	/**
	 * Button visual style. If left blank, only simple text link will be
	 * created. Otherwise, one of button styles specified in ThePay API
	 * documentation can be used.
	 */
	protected $buttonStyle = 'fullsize';

	/**
	 * Button text. This text is displayed if button image cannot be loaded
	 * or when simple text style (empty buttonStyle property) is used.
	 */
	protected $buttonText = 'Donate!';

	/**
	 * Sets the buttonStyle property.
	 *
	 * @param string|null $buttonStyle String specifying the button style. Can be null
	 *                                 for default text button, or one of button styles specified in the
	 *                                 ThePay API documentation.
	 * @param string      $buttonText  Optional argument specifying the text that should
	 *                                 be displayed on the button.
	 */
	public function setButtonStyle(
		?string $buttonStyle,
		?string $buttonText = null
	): void
	{
		if (empty($buttonStyle)) {
			$buttonStyle = null;
		}

		$this->buttonStyle = $buttonStyle;

		if ($buttonText !== null) {
			$this->buttonText = $buttonText;
		}
	}

	public function setButtonText(string $buttonText): void
	{
		$this->buttonText = $buttonText;
	}

	public function getButtonStyle(): ?string
	{
		return $this->buttonStyle;
	}

	public function getButtonText(): string
	{
		return $this->buttonText;
	}

	public function buildUrl(): string
	{
		$gateUrl = $this->payment->getMerchantConfig()->gateUrl;
		$query = $this->buildQuery();
		if ($this->payment->getMethodId() === null) {
			$query .= '&methodSelectionAllowed';
		}

		return $gateUrl . '?' . $query;
	}

	/**
	 * Return the HTML code for the button.
	 */
	public function render(): string
	{
		$targetUrl = Escaper::htmlEntityEncode(self::buildUrl());

		if ($this->buttonStyle === null) {
			return "<a href=\"{$targetUrl}\">{$this->buttonText}</a>";
		}
		$gateUrl = $this->payment->getMerchantConfig()->gateUrl;

		$buttonStyle = rawurlencode($this->buttonStyle);
		$src = Escaper::htmlEntityEncode($gateUrl . 'buttons/' . $buttonStyle . '.png');
		$title = Escaper::htmlEntityEncode($this->buttonText);

		return "<a href=\"{$targetUrl}\"><img src=\"{$src}\" alt=\"{$title}\" title=\"{$title}\" /></a>";
	}

}
