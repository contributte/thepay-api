<?php

namespace Tp\Helper;

use Tp;

/**
 * Helper that generates payment iframe.
 */
class IframeMerchant extends Merchant {
	/**
	 * Optional CSS argument, that can contain URL to custom stylesheet,
	 * that allows to customize the layout of the iframe content.
	 */
	protected $cssUrl;

	/**
	 * @var string payment button skin
	 */
	protected $skin;

	/**
	 * Sets the cssUrl property.
	 */
	function setCssUrl($url) {
		$this->cssUrl = $url;
	}

	/**
	 * Gets the cssUrl property. If the property is not set, NULL is
	 * returned.
	 */
	function getCssUrl() {
		return $this->cssUrl;
	}

	public function getSkin(){
		return $this->skin;
	}

	public function setSkin($skin){
		$this->skin = $skin;
	}

	/**
	 * Return the HTML code for the iframe.
	 */
	function render() {
		$url = Tp\Escaper::htmlEntityEncode($this->payment->getMerchantConfig()->gateUrl.'iframe/');
		$queryArgs = array_filter(array(
			'css' => $this->cssUrl,
			'skin' => $this->skin,
		));
		$ret = '<script type="text/javascript" src="'.$url.'js/jquery.js?v='.time().'" async="async"></script>
		<script type="text/javascript" src="'.$url.'js/iframe.js?v='.time().'" async="async"></script>';
		// The iframe is auto-sized to fit the height of the content, because the content height can change.
		$ret .= '<iframe src="'.$url.'?'.$this->buildQuery($queryArgs).'" style="border: 0; width: 374px; height: 150px;" class="thepay-iframe"></iframe>';
		$ret .= '<p>Rychlý bankovní převod zajišťuje společnost <a href="http://www.thepay.cz/" target="_blank">ThePay&nbsp;s.r.o.</a></p>';
		return $ret;
	}
}
