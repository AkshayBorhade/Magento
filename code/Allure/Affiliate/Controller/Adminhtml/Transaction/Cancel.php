<?php

namespace Allure\Affiliate\Controller\Adminhtml\Transaction;

/**
 * Class Cancel
 * @package Allure\Affiliate\Controller\Adminhtml\Transaction
 */
class Cancel extends \Allure\Affiliate\Controller\Adminhtml\Transaction
{
	/**
	 * execute the action
	 *
	 * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page
	 */
	public function execute()
	{
		$resultRedirect = $this->resultRedirectFactory->create();
		$transactionId  = $this->getRequest()->getParam('id');
		if ($transactionId) {
			$transaction = $this->_transactionFactory->create()->load($transactionId);
			if ($transaction->getId()) {
				try {
					$transaction->cancel();
					$this->messageManager->addSuccess(__('The Transaction has been canceled.'));
				} catch (\Exception $e) {
					$this->messageManager->addError($e->getMessage());
				}
			}
		}
		$resultRedirect->setPath('affiliate/*/');

		return $resultRedirect;
	}
}
