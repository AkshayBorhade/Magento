<?php

namespace Allure\Affiliate\Observer;

use Magento\Framework\Event\ObserverInterface;
use Allure\Affiliate\Helper\Data;
use Allure\Affiliate\Model\AccountFactory;
use Allure\Affiliate\Model\TransactionFactory;

class InvoiceSaveAfter implements ObserverInterface
{
	protected $_accountFactory;
	protected $_transactionFactory;
	protected $_helper;

	public function __construct(
		AccountFactory $accountFactory,
		TransactionFactory $transactionFactory,
		Data $data
	)
	{
		$this->_accountFactory     = $accountFactory;
		$this->_transactionFactory = $transactionFactory;
		$this->_helper             = $data;
	}

	public function execute(\Magento\Framework\Event\Observer $observer)
	{
		if (!$this->_helper->getAffiliateConfig('commission/process/order_invoice')) {
			return $this;
		}

		$invoice = $observer->getEvent()->getInvoice();

		$commission = $invoice->getAffiliateCommission();
		if (is_array($commission) && sizeof($commission)) {
			foreach ($commission as $id => $com) {
				$account = $this->_accountFactory->create()->load($id);
				if ($account->getId()) {
					$invoice->setCommissionAmount($com);
					try {
						$this->_transactionFactory->create()->createTransaction('order/invoice', $account, $invoice);
					} catch (\Exception $e) {
						$this->messageManager->addError(
							__($e->getMessage())
						);
					}
				}
			}
		}

		return $this;
	}
}
