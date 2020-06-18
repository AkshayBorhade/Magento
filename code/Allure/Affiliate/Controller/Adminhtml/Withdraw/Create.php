<?php

namespace Allure\Affiliate\Controller\Adminhtml\Withdraw;

/**
 * Class Create
 * @package Allure\Affiliate\Controller\Adminhtml\Transaction
 */
class Create extends \Allure\Affiliate\Controller\Adminhtml\Withdraw
{
	/**
	 * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\View\Result\Page
	 */
	public function execute()
	{
		/** @var \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page $resultPage */
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->setActiveMenu('Allure_Affiliate::withdraw');
		$resultPage->getConfig()->getTitle()->set(__('Withdraws'));

		$withdraw = $this->_initWithdraw();

		$data = $this->_getSession()->getData('affiliate_withdraw_data', true);
		if (!empty($data)) {
			$withdraw->setData($data);
		}
		$this->_coreRegistry->register('current_withdraw', $withdraw);

		$title = $withdraw->getId() ? __('Edit Withdraw "%1"', $withdraw->getId()) : __('New Withdraw');
		$resultPage->getConfig()->getTitle()->prepend($title);

		return $resultPage;
	}
}
