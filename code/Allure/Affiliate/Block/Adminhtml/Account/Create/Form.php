<?php

namespace Allure\Affiliate\Block\Adminhtml\Account\Create;

/**
 * Class Form
 * @package Allure\Affiliate\Block\Adminhtml\Transaction\Create
 */
class Form extends \Magento\Backend\Block\Widget
{
	/**
	 * Retrieve saving url
	 *
	 * @return string
	 */
	public function getSaveUrl()
	{
		return $this->getUrl('affiliate/*/save');
	}

	/**
	 * Retrieve url for loading blocks
	 *
	 * @return string
	 */
	public function getLoadBlockUrl()
	{
		return $this->getUrl('affiliate/account_create/loadBlock');
	}

	/**
	 * Get customer selector display
	 *
	 * @return string
	 */
	public function getCustomerSelectorDisplay()
	{
		$customerId = $this->getCustomerId();
		if ($customerId === null) {
			return 'block';
		}

		return 'none';
	}

	/**
	 * Get data selector display
	 *
	 * @return string
	 */
	public function getDataSelectorDisplay()
	{
		$customerId = $this->getCustomerId();
		if ($customerId !== null) {
			return 'block';
		}

		return 'none';
	}

	/**
	 * @return mixed
	 */
	public function getCustomerId()
	{
		return $this->_backendSession->getData('account_customer_id');
	}
}
