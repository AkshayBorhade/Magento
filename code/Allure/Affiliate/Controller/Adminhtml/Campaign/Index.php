<?php

namespace Allure\Affiliate\Controller\Adminhtml\Campaign;

/**
 * Class Index
 * @package Allure\Affiliate\Controller\Adminhtml\Campaign
 */
class Index extends \Allure\Affiliate\Controller\Adminhtml\Campaign
{
	/**
	 * execute the action
	 *
	 * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page
	 */
	public function execute()
	{
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->setActiveMenu('Allure_Affiliate::campaign');
		$resultPage->getConfig()->getTitle()->prepend((__('Campaigns')));

		return $resultPage;
	}
}
