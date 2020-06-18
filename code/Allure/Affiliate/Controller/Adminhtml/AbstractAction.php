<?php

namespace Allure\Affiliate\Controller\Adminhtml;

abstract class AbstractAction extends \Magento\Backend\App\Action
{
    /**
     * @type \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @type \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $coreRegistry
    )
    {
        $this->_coreRegistry          = $coreRegistry;
        $this->_resultPageFactory          = $resultPageFactory;
        parent::__construct($context);
    }
}
