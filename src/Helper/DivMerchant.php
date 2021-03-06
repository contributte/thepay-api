<?php declare(strict_types = 1);

namespace Tp\Helper;

use Tp\Escaper;

/**
 * Helper that generates payment button in div.
 */
class DivMerchant extends Merchant
{

	/**
	 * Optional CSS argument, that can contain URL to custom stylesheet,
	 * that allows to customize the layout of the div content.
	 */
	protected $cssUrl;

	/** @var string payment button skin */
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

	public function getSkin(): string
	{
		return $this->skin;
	}

	/**
	 * Set visual skin used for payment buttons.
	 */
	public function setSkin(string $skin): void
	{
		$this->skin = $skin;
	}

	/**
	 * Disable thepay css for button
	 */
	public function disableButtonCss(): void
	{
		$this->disableButtonCss = true;
	}

	/**
	 * Enable thepay css for button
	 */
	public function enableButtonCss(): void
	{
		$this->disableButtonCss = false;
	}

	/**
	 * Disable thepay css for offline payment popup box
	 */
	public function disablePopupCss(): void
	{
		$this->disablePopupCss = true;
	}

	/**
	 * Enable thepay css for offline payment popup box
	 */
	public function enablePopupCss(): void
	{
		$this->disablePopupCss = false;
	}

	public function render(): string
	{
		$url = $this->payment->getMerchantConfig()->gateUrl;
		$queryArgs = array_filter(
			[
				'skin' => $this->skin,
			]
		);

		$out = '';
		if (!$this->disableButtonCss) {
			$skin = $this->skin === '' ? '' : "/{$this->skin}";
			$href = "{$url}div/style{$skin}/div.css?v=" . time();
			$href = Escaper::htmlEntityEncode($href);
			$out .= "<link href=\"{$href}\" type=\"text/css\" rel=\"stylesheet\" />\n";
		}

		$thepayGateUrl = $url . 'div/index.php?' . $this->buildQuery($queryArgs);
		$thepayGateUrl = Escaper::jsonEncode($thepayGateUrl);
		$disableThepayPopupCss = Escaper::jsonEncode($this->disablePopupCss);
		$out .= '<script type="text/javascript">';
		$out .= "\tvar thepayGateUrl = {$thepayGateUrl},\n";
		$out .= "\t\tdisableThepayPopupCss = {$disableThepayPopupCss};\n";
		$out .= "</script>\n";

		$src = "{$url}div/js/jquery.js?v=" . time();
		$src = Escaper::htmlEntityEncode($src);
		$out .= "<script type=\"text/javascript\" src=\"{$src}\" async=\"async\"></script>\n";

		$src = "{$url}div/js/div.js?v=" . time();
		$src = Escaper::htmlEntityEncode($src);
		$out .= "<script type=\"text/javascript\" src=\"{$src}\" async=\"async\"></script>\n";

		$out .= "<div id=\"thepay-method-box\" style=\"border: 0;\"></div>\n";

		return $out;
	}

}
