<?php

namespace Allure\Affiliate\Model\Withdraw;

use Allure\Affiliate\Helper\Payment;

class Method implements \Magento\Framework\Option\ArrayInterface
{
	protected $_paymentHelper;

	public function __construct(Payment $helper)
	{
		$this->_paymentHelper = $helper;
	}

	/**
	 * to option array
	 *
	 * @return array
	 */
	public function toOptionArray()
	{
		$options = [];

		foreach ($this->getOptionHash() as $value => $label) {
			$options[] = [
				'value' => $value,
				'label' => $label
			];
		}

		return $options;
	}

	public function getOptionHash()
	{
		$options        = [];
		$paymentMethods = $this->_paymentHelper->getActiveMethods();
		foreach ($paymentMethods as $key => $method) {
			$options[$key] = $method['label'];
		}

		return $options;
	}
}
