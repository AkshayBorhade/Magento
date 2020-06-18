<?php

namespace Allure\Affiliate\Controller\Adminhtml;

/**
 * Class Transaction
 * @package Allure\Affiliate\Controller\Adminhtml
 */
abstract class Transaction extends \Allure\Affiliate\Controller\Adminhtml\AbstractAction
{
	/**
	 * @type \Allure\Affiliate\Model\TransactionFactory
	 */
	protected $_transactionFactory;

	/**
	 * @param \Allure\Affiliate\Model\TransactionFactory $transactionFactory
	 * @param \Magento\Framework\Registry $coreRegistry
	 * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
	 * @param \Magento\Backend\App\Action\Context $context
	 */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Allure\Affiliate\Model\TransactionFactory $transactionFactory,
		\Magento\Framework\Registry $coreRegistry,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		$this->_transactionFactory = $transactionFactory;

		parent::__construct($context, $resultPageFactory, $coreRegistry);
	}

	/**
	 * is action allowed
	 *
	 * @return bool
	 */
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Allure_Affiliate::transaction');
	}
}
