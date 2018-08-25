<?php declare(strict_types = 1);

namespace Tp;

/**
 * Configuration class for the ThePay component.
 * Modify properties in this class to contain valid data for your
 * account. This data you can find in the ThePay administration interface.
 */
class MerchantConfig
{

	/**
	 * URL where the ThePay gate is located.
	 * Use for switch between development and production environment.
	 *
	 * @var string
	 */
	public $gateUrl = 'https://www.thepay.cz/demo-gate/';

	/**
	 * ID of your account in the ThePay system.
	 *
	 * @var int
	 */
	public $merchantId = 1;

	/**
	 * ID of your account, which you can create in the ThePay
	 * administration interface. You can have multiple accounts under
	 * your login.
	 *
	 * @var int
	 */
	public $accountId = 1;

	/**
	 * Password for external communication that you can fill in for the
	 * account. This password should not be the same that you use to
	 * log-in to the administration.
	 *
	 * @var string
	 */
	public $password        = 'my$up3rsecr3tp4$$word';

	/** @var string */
	public $dataApiPassword = 'my$up3rsecr3tp4$$word';

	/**
	 * URL of WSDL document for webservices API.
	 * Web services are used for automatic comunications with gate. For example
	 * for creating permanent payments.
	 *
	 * @var string
	 */
	public $webServicesWsdl = 'https://www.thepay.cz/demo-gate/api/gate-api-demo.wsdl';

	/** @var string */
	public $dataWebServicesWsdl = 'https://www.thepay.cz/demo-gate/api/data-demo.wsdl';

}
