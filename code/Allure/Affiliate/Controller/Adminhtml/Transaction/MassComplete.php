<?php

namespace Allure\Affiliate\Controller\Adminhtml\Transaction;

/**
 * Class MassComplete
 * @package Allure\Affiliate\Controller\Adminhtml\Transaction
 */
class MassComplete extends \Magento\Backend\App\Action
{
	/**
	 * @type \Allure\Affiliate\Model\ResourceModel\Transaction\CollectionFactory
	 */
	protected $_transactionFactory;

	/**
	 * @type \Magento\Ui\Component\MassAction\Filter
	 */
	protected $_filter;

	/**
	 * Constructor
	 *
	 * @param \Allure\Affiliate\Model\ResourceModel\Transaction\CollectionFactory $transactionFactory
	 * @param \Magento\Backend\App\Action\Context $context
	 * @param \Magento\Ui\Component\MassAction\Filter $filter
	 */
	public function __construct(
		\Allure\Affiliate\Model\ResourceModel\Transaction\CollectionFactory $transactionFactory,
		\Magento\Backend\App\Action\Context $context,
		\Magento\Ui\Component\MassAction\Filter $filter
	)
	{
		$this->_transactionFactory = $transactionFactory;
		$this->_filter             = $filter;
		parent::__construct($context);
	}

	/**
	 * execute the action
	 *
	 * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page
	 */
	public function execute()
	{
		$collection           = $this->_filter->getCollection($this->_transactionFactory->create());
		$transactionCompleted = 0;

		foreach ($collection->getItems() as $transaction) {
			try {
				$transaction->complete();
				$transactionCompleted++;
			} catch (\Exception $e) {
				$this->messageManager->addError(
					__($e->getMessage())
				);
			}
		}

		$this->messageManager->addSuccess(
			__('A total of %1 record(s) have been completed.', $transactionCompleted)
		);

		return $this->resultRedirectFactory->create()->setPath('affiliate/*/');
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
