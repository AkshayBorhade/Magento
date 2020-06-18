<?php

namespace Allure\Affiliate\Controller\Adminhtml\Group;

/**
 * Class Index
 * @package Allure\Affiliate\Controller\Adminhtml\Group
 */
class Index extends \Allure\Affiliate\Controller\Adminhtml\Group
{
    /**
     * execute the action
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Allure_Affiliate::group');
        $resultPage->getConfig()->getTitle()->prepend((__('Group')));

        return $resultPage;
    }
}
