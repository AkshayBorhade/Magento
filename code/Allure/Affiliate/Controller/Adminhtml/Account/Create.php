<?php

namespace Allure\Affiliate\Controller\Adminhtml\Account;

/**
 * Class Create
 * @package Allure\Affiliate\Controller\Adminhtml\Account
 */
class Create extends \Allure\Affiliate\Controller\Adminhtml\Account
{
	/**
	 * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\View\Result\Page
	 */
	public function execute()
	{
		/** @var \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page $resultPage */
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->setActiveMenu('Allure_Affiliate::account');
		$resultPage->getConfig()->getTitle()->set(__('Account'));

		$account = $this->_initAccount();
		$data    = $this->_getSession()->getData('affiliate_account_data', true);
		if (!empty($data)) {
			$account->setData($data);
		}
		$this->_coreRegistry->register('current_account', $account);

		$resultPage->getConfig()->getTitle()->prepend(__('New Account'));

		return $resultPage;
	}
}
