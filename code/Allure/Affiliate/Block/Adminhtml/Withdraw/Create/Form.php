<?php

namespace Allure\Affiliate\Block\Adminhtml\Withdraw\Create;

/**
 * Class Form
 * @package Allure\Affiliate\Block\Adminhtml\Withdraw\Create
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
		return $this->getUrl('affiliate/withdraw_create/loadBlock');
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
		return $this->_backendSession->getData('withdraw_customer_id');
	}
}
