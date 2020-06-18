<?php

namespace Allure\Affiliate\Controller\Adminhtml\Account;

/**
 * Class Edit
 * @package Allure\Affiliate\Controller\Adminhtml\Account
 */
class Edit extends \Allure\Affiliate\Controller\Adminhtml\Account
{
	/**
	 * Result JSON factory
	 *
	 * @var \Magento\Framework\Controller\Result\JsonFactory
	 */
	protected $_resultJsonFactory;

	/**
	 * Constructor
	 *
	 * @param \Magento\Backend\App\Action\Context $context
	 * @param \Allure\Affiliate\Model\AccountFactory $accountFactory
	 * @param \Magento\Framework\Registry $coreRegistry
	 * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
	 * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
	 */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Allure\Affiliate\Model\AccountFactory $accountFactory,
		\Magento\Framework\Registry $coreRegistry,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
	)
	{
		$this->_resultJsonFactory = $resultJsonFactory;

		parent::__construct($context, $accountFactory, $coreRegistry, $resultPageFactory);
	}

	/**
	 * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\View\Result\Page
	 */
	public function execute()
	{
		/** @var \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page $resultPage */
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->setActiveMenu('Allure_Affiliate::account');
		$resultPage->getConfig()->getTitle()->set(__('Accounts'));

		/** @var \Allure\Affiliate\Model\Account $account */
		$account = $this->_initAccount();

		$data = $this->_getSession()->getData('affiliate_account_data', true);
		if (!empty($data)) {
			$account->setData($data);
		}
		$this->_coreRegistry->register('current_account', $account);

		$title = $account->getId() ? __('Edit Account "%1"', $account->getId()) : __('New Account');
		$resultPage->getConfig()->getTitle()->prepend($title);

		return $resultPage;
	}
}
