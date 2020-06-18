<?php

namespace Allure\Affiliate\Controller\Adminhtml\Withdraw;

/**
 * Class Index
 * @package Allure\Affiliate\Controller\Adminhtml\Withdraw
 */
class Index extends \Allure\Affiliate\Controller\Adminhtml\Withdraw
{
	/**
	 * execute the action
	 *
	 * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page
	 */
	public function execute()
	{
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->setActiveMenu('Allure_Affiliate::withdraw');
		$resultPage->getConfig()->getTitle()->prepend((__('Withdraws')));

		return $resultPage;
	}
}
