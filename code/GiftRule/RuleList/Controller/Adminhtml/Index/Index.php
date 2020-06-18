<?php
/**
* @author Dhirajkumar Deore    
* Copyright © 2018 Magento. All rights reserved.
* See COPYING.txt for license details.
*/
namespace GiftRule\RuleList\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    /**
     * Check the permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('GiftRule_RuleList::giftrule_rulelist');
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('GiftRule_RuleList::giftrule_rulelist');
        $resultPage->addBreadcrumb(__('Items'), __('Items'));
        $resultPage->addBreadcrumb(__('Manage Items'), __('Manage Items'));
        $resultPage->getConfig()->getTitle()->prepend(__('Gift Coupon Rules'));

        return $resultPage;
    }
}
