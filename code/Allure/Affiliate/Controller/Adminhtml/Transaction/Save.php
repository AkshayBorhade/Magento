<?php

namespace Allure\Affiliate\Controller\Adminhtml\Transaction;

use \Magento\Framework\Exception\LocalizedException;

/**
 * Class Save
 * @package Allure\Affiliate\Controller\Adminhtml\Transaction
 */
class Save extends \Allure\Affiliate\Controller\Adminhtml\Transaction
{
	/**
	 * @type \Allure\Affiliate\Model\Account
	 */
	protected $_accountFactory;

	/**
	 * Constructor
	 *
	 * @param \Magento\Backend\App\Action\Context $context
	 * @param \Allure\Affiliate\Model\AccountFactory $accountFactory
	 * @param \Allure\Affiliate\Model\TransactionFactory $transactionFactory
	 * @param \Magento\Framework\Registry $coreRegistry
	 * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
	 */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Allure\Affiliate\Model\AccountFactory $accountFactory,
		\Allure\Affiliate\Model\TransactionFactory $transactionFactory,
		\Magento\Framework\Registry $coreRegistry,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		$this->_accountFactory = $accountFactory;
		parent::__construct($context, $transactionFactory, $coreRegistry, $resultPageFactory);
	}

	/**
	 * run the action
	 *
	 * @return \Magento\Backend\Model\View\Result\Redirect
	 */
	public function execute()
	{
		$resultRedirect = $this->resultRedirectFactory->create();
		if ($data = $this->getRequest()->getPost('transaction')) {
			try {
				$affiliateAccount = $this->_accountFactory->create()->load($data['customer_id'], 'customer_id');
				if (!$affiliateAccount->getId()) {
					throw new LocalizedException(__('Account balance is not enough to create this transaction.'));
				}

				$transaction = $this->_transactionFactory->create()->createTransaction(
					'admin',
					$affiliateAccount,
					new \Magento\Framework\DataObject($data),
					array('admin_id' => $this->_auth->getUser()->getId())
				);
				$this->_getSession()->unsetData('transaction_customer_id');
				$this->messageManager->addSuccess(__('The Transaction has been created.'));
				$this->_getSession()->setAffiliateTransactionData(false);
				if ($this->getRequest()->getParam('back')) {
					$resultRedirect->setPath('affiliate/transaction/view', ['id' => $transaction->getId(),]);

					return $resultRedirect;
				}

				$resultRedirect->setPath('affiliate/*/');

				return $resultRedirect;
			} catch (\Magento\Framework\Exception\LocalizedException $e) {
				$this->messageManager->addError($e->getMessage());
			} catch (\RuntimeException $e) {
				$this->messageManager->addError($e->getMessage());
			} catch (\Exception $e) {
				$this->messageManager->addException($e, __('Something went wrong while saving the Transaction.'));
			}
			$this->_getSession()->setAffiliateTransactionData($data);
			$resultRedirect->setPath('affiliate/transaction/create');

			return $resultRedirect;
		}

		$resultRedirect->setPath('affiliate/*/');

		return $resultRedirect;
	}
}
