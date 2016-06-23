<?php
/**
 * Class TpFerBuyCartItem represents one item in users cart.
 */
class TpFerBuyCartItem {

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string
	 */
	private $description = '';

	/**
	 * @var int
	 */
	private $quantity;

	/**
	 * @var int
	 */
	private $price;

	/**
	 * @param string $name
	 * @param int|float $price
	 * @param int $quantity
	 * @throws TpInvalidArgumentException
	 */
	public function __construct($name, $price, $quantity=1) {
		$intQuantity = intval($quantity);
		if($intQuantity != $quantity) {
			throw new TpInvalidArgumentException("Quantity has to be integer");
		}
		$this->quantity = $intQuantity;

		$this->name = strval($name);
		$this->setPrice($price);
	}

	/**
	 * Get previously set item name.
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Set long description for item.
	 * @param string $description
	 */
	public function setDescription($description){
		$this->description = strval($description);
	}

	/**
	 * Get previously set description.
	 * @return string
	 */
	public function getDescription(){
		return $this->description;
	}

	/**
	 * Get previously set quantity.
	 * @return int
	 */
	public function getQuantity() {
		return $this->quantity;
	}

	/**
	 * Set product price.
	 * @param int|float $price
	 * @throws TpInvalidArgumentException If price parameter is not numeric.
	 */
	protected function setPrice($price) {
		if (!is_numeric($price)) {
			throw new TpInvalidArgumentException('Price has to be numeric');
		}
		$price = round($price, 2);
		$this->price = intval($price * 100);
	}

	/**
	 * Get previously set price.
	 * @return float
	 */
	public function getPrice() {
		return $this->price / 100;
	}

	/**
	 * Get price without decimal, ie for price 12.34 will return 1234.
	 * @return int
	 */
	public function getPriceWithoutDecimal() {
		return $this->price;
	}

	/**
	 * Returns object as JSON.
	 * Note that numeric values are without decimal point, ie 12.34 will be written as 1234.
	 * @return string
	 */
	public function toJSON() {
		return TpEscaper::jsonEncode(array(
			'name' => $this->name,
			'description' => $this->description,
			'quantity' => $this->quantity,
			'price' => $this->price,
		));
	}
} 