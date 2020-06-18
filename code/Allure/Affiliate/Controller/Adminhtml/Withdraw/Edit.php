<?php

namespace Allure\Affiliate\Controller\Adminhtml\Withdraw;

/**
 * Class Edit
 * @package Allure\Affiliate\Controller\Adminhtml\Withdraw
 */
class Edit extends \Allure\Affiliate\Controller\Adminhtml\Withdraw
{
	/**
	 * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\View\Result\Page
	 */
	public function execute()
	{
		/** @var \Allure\Affiliate\Model\Campaign $campaign */
		$withdraw = $this->_initWithdraw();

		/** @var \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page $resultPage */
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->setActiveMenu('Allure_Affiliate::withdraw');
		$resultPage->getConfig()->getTitle()->set(__('Withdraws'));

		$title = $withdraw->getId() ? __('Edit Withdraw "#%1"', $withdraw->getId()) : __('New Withdraw');
		$resultPage->getConfig()->getTitle()->prepend($title);

		$data = $this->_getSession()->getData('affiliate_withdraw_data', true);
		if (!empty($data)) {
			$withdraw->setData($data);
		}
		$this->_coreRegistry->register('current_withdraw', $withdraw);

		return $resultPage;
	}
}
