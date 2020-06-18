<?php

namespace Allure\Affiliate\Block\Adminhtml\Transaction\View;

/**
 * Class Tabs
 * @package Allure\Affiliate\Block\Adminhtml\Transaction\View
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
	/**
	 * constructor
	 *
	 * @return void
	 */
	protected function _construct()
	{
		parent::_construct();
		$this->setId('transaction_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(__('Transaction Information'));
	}
}
