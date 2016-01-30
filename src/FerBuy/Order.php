<?php
namespace Tp\FerBuy;

use Tp\Escaper;

/**
 * Class Tp\FerBuy\TpFerBuyOrder represents order.
 */
class Order
{

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
	 * @param Cart     $cart     User cart
	 */
	public function __construct(Customer $customer, Cart $cart)
	{
		$this->cart = $cart;
		$this->customer = $customer;
	}

	/**
	 * Get previously set cart.
	 *
	 * @return Cart
	 */
	public function getCart()
	{
		return $this->cart;
	}

	/**
	 * Returns object as JSON.
	 * Note that numeric values are without decimal point, ie 12.34 will be written as 1234.
	 *
	 * @return string
	 */
	public function toJSON()
	{
		$result = '{';
		$result .= '"first_name": ' . Escaper::jsonEncode($this->customer->getFirstName()) . ', ';
		$result .= '"last_name": ' . Escaper::jsonEncode($this->customer->getLastName()) . ', ';
		$result .= '"currency": ' . Escaper::jsonEncode($this->cart->getCurrency()) . ', ';
		$result .= '"amount": ' . Escaper::jsonEncode($this->cart->getTotalAmountWithoutDecimal()) . ', ';

		$mobilePhone = $this->customer->getMobilePhone();
		if ( !is_null($mobilePhone) && $mobilePhone != "") {
			$result .= '"mobile_phone": ' . Escaper::jsonEncode($mobilePhone) . ', ';
		}

		$result .= '"city": ' . Escaper::jsonEncode($this->customer->getCity()) . ', ';
		$result .= '"postal_code": ' . Escaper::jsonEncode($this->customer->getPostalCode()) . ', ';
		$result .= '"address": ' . Escaper::jsonEncode($this->customer->getAddress()) . ', ';
		$result .= '"email": ' . Escaper::jsonEncode($this->customer->getEmail()) . ',';
		$result .= '"shopping_cart": ' . $this->cart->toJSON() . '}';

		return $result;
	}

}