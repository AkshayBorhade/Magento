<?php

namespace Allure\Affiliate\Controller\Adminhtml\Transaction;

/**
 * Class Index
 * @package Allure\Affiliate\Controller\Adminhtml\Transaction
 */
class Index extends \Allure\Affiliate\Controller\Adminhtml\Transaction
{
	/**
	 * execute the action
	 *
	 * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page
	 */
	public function execute()
	{
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->setActiveMenu('Allure_Affiliate::transaction');
		$resultPage->getConfig()->getTitle()->prepend((__('Transactions')));

		return $resultPage;
	}
}
