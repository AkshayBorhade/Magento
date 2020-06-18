<?php

namespace Allure\Affiliate\Controller\Adminhtml\Transaction;

/**
 * Class Create
 * @package Allure\Affiliate\Controller\Adminhtml\Transaction
 */
class Create extends \Allure\Affiliate\Controller\Adminhtml\Transaction
{
	/**
	 * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\View\Result\Page
	 */
	public function execute()
	{
		/** @var \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page $resultPage */
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->setActiveMenu('Allure_Affiliate::transaction');
		$resultPage->getConfig()->getTitle()->set(__('Transactions'));

		$transaction = $this->_initTransaction();

		$title = $transaction->getId() ? __('View Transaction "%1"', $transaction->getId()) : __('New Transaction');
		$resultPage->getConfig()->getTitle()->prepend($title);

		return $resultPage;
	}

	/**
	 * Init Transaction
	 *
	 * @return \Allure\Affiliate\Model\Transaction
	 */
	protected function _initTransaction()
	{
		$transactionId = (int)$this->getRequest()->getParam('id');
		/** @var \Allure\Affiliate\Model\Transaction $transaction */
		$transaction = $this->_transactionFactory->create();
		if ($transactionId) {
			$transaction->load($transactionId);
			if (!$transaction->getId()) {
				$this->messageManager->addError(__('This Transaction no longer exists.'));
				$resultRedirect = $this->resultRedirectFactory->create();
				$resultRedirect->setPath('affiliate/transaction/index');

				return $resultRedirect;
			}
		}

		$data = $this->_getSession()->getData('affiliate_transaction_data', true);
		if (!empty($data)) {
			$transaction->setData($data);
		}
		$this->_coreRegistry->register('current_transaction', $transaction);

		return $transaction;
	}
}
