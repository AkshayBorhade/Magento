<?php
/**
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Allure\Affiliate\Controller\Adminhtml\Account\Create;

/**
 * Class Cancel
 * @package Allure\Affiliate\Controller\Adminhtml\Account\Create
 */
class Cancel extends \Magento\Backend\App\Action
{
	/**
	 * Cancel account create
	 *
	 * @return \Magento\Backend\Model\View\Result\Redirect
	 */
	public function execute()
	{
		/** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
		$resultRedirect = $this->resultRedirectFactory->create();

		$this->_getSession()->unsetData('account_customer_id');
		$resultRedirect->setPath('affiliate/account/create');

		return $resultRedirect;
	}
}
