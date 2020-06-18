<?php

namespace Allure\Affiliate\Controller\Adminhtml\Transaction;

/**
 * Class View
 * @package Allure\Affiliate\Controller\Adminhtml\Transaction
 */
class View extends \Allure\Affiliate\Controller\Adminhtml\Transaction
{
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
			if ($transaction->getId()) {
				$this->_coreRegistry->register('current_transaction', $transaction);

				return $transaction;
			}
		}
		$this->messageManager->addError(__('This Transaction no longer exists.'));
		$resultRedirect = $this->_resultRedirectFactory->create();
		$resultRedirect->setPath('affiliate/transaction/index');

		return $resultRedirect;
	}

	/**
	 * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page
	 */
	public function execute()
	{
		$transaction = $this->_initTransaction();

		/** @var \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page $resultPage */
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->setActiveMenu('Allure_Affiliate::transaction');
		$resultPage->getConfig()->getTitle()->set(__('Transactions'));

		$title = __('View Transaction "%1"', $transaction->getId());
		$resultPage->getConfig()->getTitle()->prepend($title);

		return $resultPage;
	}
}
