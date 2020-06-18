<?php

namespace Allure\Affiliate\Controller\Adminhtml\Group;

class Create extends \Allure\Affiliate\Controller\Adminhtml\Group
{
	/**
	 * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page
	 */
	public function execute()
	{
		/** @var \Allure\Affiliate\Model\Group $group */
		$group = $this->_initGroup();
		$data  = $this->_getSession()->getData('affiliate_group_data', true);
		if (!empty($data)) {
			$group->setData($data);
		}
		$this->_coreRegistry->register('current_group', $group);

		/** @var \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page $resultPage */
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->setActiveMenu('Allure_Affiliate::group');
		$resultPage->getConfig()->getTitle()->set(__('Groups'));

		$resultPage->getConfig()->getTitle()->prepend(__('New Group'));

		return $resultPage;
	}
}
