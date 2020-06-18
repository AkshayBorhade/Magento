<?php

namespace Allure\Affiliate\Controller\Adminhtml\Account;

/**
 * Class Index
 * @package Allure\Affiliate\Controller\Adminhtml\Account
 */
class Index extends \Allure\Affiliate\Controller\Adminhtml\Account
{
	/**
	 * execute the action
	 *
	 * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page
	 */
	public function execute()
	{
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->setActiveMenu('Allure_Affiliate::account');
		$resultPage->getConfig()->getTitle()->prepend((__('Accounts')));

		return $resultPage;
	}
}
