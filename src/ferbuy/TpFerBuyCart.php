<?php
TpUtils::requirePaths(array(
	array('exceptions', 'TpInvalidArgumentException.php'),
	array('ferbuy', 'TpFerBuyCartItem.php')
));

/**
 * Class TpFerBuyCart represents user cart.
 */
class TpFerBuyCart {

	/**
	 * @var TpFerBuyCartItem[]
	 */
	private $items = array();

	/**
	 * @var int
	 */
	private $subTotal = 0;

	/**
	 * @var int
	 */
	private $discount = 0;

	/**
	 * @var int
	 */
	private $tax = 0;

	/**
	 * @var int
	 */
	private $shipping = 0;

	/**
	 * @var string
	 */
	private $currency = 'CZK';

	/**
	 * The ISO-4217 code of the transaction currency.
	 * This value is exactly three characters, for example ‘EUR’ for Euro’s.
	 * Method is private because only CZK is currently supported.
	 * @param $currency
	 * @throws TpInvalidArgumentException
	 */
	private function setCurrency($currency) {
		if (strlen($currency) == 3){
			$this->currency = $currency;
		} else {
			throw new TpInvalidArgumentException('Currency must be exactly 3 characters long');
		}
	}

	/**
	 * Get previously set currency.
	 * @return string
	 */
	public function getCurrency() {
		return $this->currency;
	}

	/**
	 * Set any tax applied to order.
	 * @param $tax
	 * @throws TpInvalidArgumentException
	 */
	public function setTax($tax) {
		if (!is_numeric($tax)) {
			throw new TpInvalidArgumentException('Tax has to be numeric.');
		}
		$this->tax = $this->getNumberWithoutDecimals($tax);
	}

	/**
	 * Get previously set tax.
	 * @return float
	 */
	public function getTax() {
		return $this->tax / 100;
	}

	/**
	 * Sets discounts applied to order.
	 * @param $discount
	 * @throws TpInvalidArgumentException
	 */
	public function setDiscount($discount) {
		if (!is_numeric($discount)) {
			throw new TpInvalidArgumentException('Discount has to be numeric.');
		}
		$this->discount = $this->getNumberWithoutDecimals($discount);
		if ($this->discount > 0) {
			$this->discount = $this->discount * -1;
		}
	}

	/**
	 * Get previously set discount.
	 * @return float
	 */
	public function getDiscount() {
		return $this->discount / 100;
	}

	/**
	 * Set shipping costs.
	 * @param $shipping
	 * @throws TpInvalidArgumentException
	 */
	public function setShipping($shipping) {
		if (!is_numeric($shipping)) {
			throw new TpInvalidArgumentException('Shipping has to be numeric.');
		}
		$this->shipping = $this->getNumberWithoutDecimals($shipping);
	}

	/**
	 * Get previously set shipping
	 * @return float
	 */
	public function getShipping(){
		return $this->shipping / 100;
	}

	/**
	 * Get decimal number without the decimal character, ie for 12.34 will return 1234
	 * @param $number
	 * @return int
	 * @throws TpInvalidArgumentException
	 */
	private function getNumberWithoutDecimals($number) {
		if(!is_numeric($number)) {
			throw new TpInvalidArgumentException("Number has to be numeric");
		}
		$number = round($number, 2);
		return (int)($number * 100);
	}

	/**
	 * Add item to the cart.
	 * @param TpFerBuyCartItem $item
	 */
	public function add(TpFerBuyCartItem $item){
		$this->subTotal += $item->getPriceWithoutDecimal() * $item->getQuantity();
		$this->items[] = $item;
	}

	/**
	 * Get total amount of cart. With taxes, shipping and discount.
	 * @return float
	 */
	public function getTotalAmount() {
		return $this->getTotalAmountWithoutDecimal() / 100;
	}

	/**
	 * @return int
	 */
	public function getTotalAmountWithoutDecimal() {
		return ($this->subTotal + $this->tax + $this->discount + $this->shipping);
	}

	/**
	 * Returns subtotal amount of order. Without taxes, shipping and discount.
	 * @return float
	 */
	public function getSubTotalAmount() {
		return $this->subTotal / 100;
	}

	/**
	 * Returns object as JSON.
	 * Note that numeric values are without decimal point, ie 12.34 will be written as 1234.
	 * @return string
	 */
	public function toJSON() {
		$items = '[';
		for ($i = 0; $i < count($this->items); $i++) {
			$items .= $this->items[$i]->toJSON();
			if (($i+1) < count($this->items)){
				$items .= ', ';
			}
		}
		$items .= ']';
		$result = '{"subtotal":' . $this->subTotal .
			', "total":'.$this->getTotalAmountWithoutDecimal().
			', "shipping": ' . $this->shipping .
			', "tax":' . $this->tax .
			', "discount":' . $this->discount .
			', "items": ' . $items . '}';
		return $result;
	}
}
