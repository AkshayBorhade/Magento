<?php

namespace Allure\Affiliate\Controller\Adminhtml\Banner;

/**
 * Class Index
 * @package Allure\Affiliate\Controller\Adminhtml\Banner
 */
class Index extends \Allure\Affiliate\Controller\Adminhtml\Banner
{
	/**
	 * execute the action
	 *
	 * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page
	 */
	public function execute()
	{
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->setActiveMenu('Allure_Affiliate::banner');
		$resultPage->getConfig()->getTitle()->prepend((__('Banners')));

		return $resultPage;
	}
}
