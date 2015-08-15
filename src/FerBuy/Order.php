<?php

namespace Tp\FerBuy;

use Tp;

/**
 * Class TpFerBuyOrder represents order.
 */
class Order {

	/**
	 * @var Cart
	 */
	private $cart;

	/**
	 * @var Customer
	 */
	private $customer;

	/**
	 * @param Customer $customer Customer object.
	 * @param Cart $cart User cart
	 */
	public function __construct(Customer $customer, Cart $cart) {
		$this->cart = $cart;
		$this->customer = $customer;
	}

	/**
	 * Get previously set cart.
	 * @return Cart
	 */
	public function getCart(){
		return $this->cart;
	}

	/**
	 * Returns object as JSON.
	 * Note that numeric values are without decimal point, ie 12.34 will be written as 1234.
	 * @return string
	 */
	public function toJSON() {
		$result = '{';
		$result .= '"first_name": ' . Tp\Escaper::jsonEncode($this->customer->getFirstName()) . ', ';
		$result .= '"last_name": ' . Tp\Escaper::jsonEncode($this->customer->getLastName()) . ', ';
		$result .= '"currency": ' . Tp\Escaper::jsonEncode($this->cart->getCurrency()) . ', ';
		$result .= '"amount": ' . Tp\Escaper::jsonEncode($this->cart->getTotalAmountWithoutDecimal()) . ', ';

		$mobilePhone = $this->customer->getMobilePhone();
		if (!is_null($mobilePhone) && $mobilePhone != "") {
			$result .= '"mobile_phone": ' . Tp\Escaper::jsonEncode($mobilePhone) . ', ';
		}

		$result .= '"city": ' . Tp\Escaper::jsonEncode($this->customer->getCity()) . ', ';
		$result .= '"postal_code": ' . Tp\Escaper::jsonEncode($this->customer->getPostalCode()) . ', ';
		$result .= '"address": ' . Tp\Escaper::jsonEncode($this->customer->getAddress()) . ', ';
		$result .= '"email": ' . Tp\Escaper::jsonEncode($this->customer->getEmail()) . ',';
		$result .= '"shopping_cart": ' . $this->cart->toJSON() . '}';
		return $result;
	}
}
