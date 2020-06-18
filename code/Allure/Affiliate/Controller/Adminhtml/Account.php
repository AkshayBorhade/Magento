<?php

namespace Allure\Affiliate\Controller\Adminhtml;

/**
 * Class Account
 * @package Allure\Affiliate\Controller\Adminhtml
 */
abstract class Account extends \Allure\Affiliate\Controller\Adminhtml\AbstractAction
{
	/**
	 * @type \Allure\Affiliate\Model\AccountFactory
	 */
	protected $_accountFactory;

	/**
	 * @param \Allure\Affiliate\Model\AccountFactory $accountFactory
	 * @param \Magento\Framework\Registry $coreRegistry
	 * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
	 * @param \Magento\Backend\App\Action\Context $context
	 */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Allure\Affiliate\Model\AccountFactory $accountFactory,
		\Magento\Framework\Registry $coreRegistry,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		$this->_accountFactory = $accountFactory;

		parent::__construct($context, $resultPageFactory, $coreRegistry);
	}

	/**
	 * Init Account
	 *
	 * @return \Allure\Affiliate\Model\Account
	 */
	protected function _initAccount()
	{
		$accountId = (int)$this->getRequest()->getParam('id');
		/** @var \Allure\Affiliate\Model\Account $account */
		$account = $this->_accountFactory->create();
		if ($accountId) {
			$account->load($accountId);
			if (!$account->getId()) {
				$this->messageManager->addError(__('This account no longer exists.'));
				$resultRedirect = $this->resultRedirectFactory->create();
				$resultRedirect->setPath('affiliate/account/index');

				return $resultRedirect;
			}
		}

		return $account;
	}

	/**
	 * is action allowed
	 *
	 * @return bool
	 */
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Allure_Affiliate::account');
	}
}
