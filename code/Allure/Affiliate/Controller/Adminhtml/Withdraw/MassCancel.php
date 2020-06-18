<?php

namespace Allure\Affiliate\Controller\Adminhtml\Withdraw;

/**
 * Class MassCancel
 * @package Allure\Affiliate\Controller\Adminhtml\Withdraw
 */
class MassCancel extends \Magento\Backend\App\Action
{
	/**
	 * Mass Action Filter
	 *
	 * @var \Magento\Ui\Component\MassAction\Filter
	 */
	protected $_filter;

	/**
	 * Collection Factory
	 *
	 * @var \Allure\Affiliate\Model\ResourceModel\Withdraw\CollectionFactory
	 */
	protected $_collectionFactory;

	/**
	 * constructor
	 *
	 * @param \Magento\Ui\Component\MassAction\Filter $filter
	 * @param \Allure\Affiliate\Model\ResourceModel\Withdraw\CollectionFactory $collectionFactory
	 * @param \Magento\Backend\App\Action\Context $context
	 */
	public function __construct(
		\Magento\Ui\Component\MassAction\Filter $filter,
		\Allure\Affiliate\Model\ResourceModel\Withdraw\CollectionFactory $collectionFactory,
		\Magento\Backend\App\Action\Context $context
	)
	{
		$this->_filter            = $filter;
		$this->_collectionFactory = $collectionFactory;
		parent::__construct($context);
	}


	/**
	 * execute action
	 *
	 * @return \Magento\Backend\Model\View\Result\Redirect
	 */
	public function execute()
	{
		$collection = $this->_filter->getCollection($this->_collectionFactory->create());

		$cancel = 0;
		foreach ($collection as $item) {
			/** @var \Allure\Affiliate\Model\Withdraw $item */
			try {
				$item->cancel();
				$cancel++;
			} catch (\Exception $e) {
				$this->messageManager->addError(
					__($e->getMessage())
				);
			}

		}
		$this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been cancelled.', $cancel));
		/** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
		$resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);

		return $resultRedirect->setPath('*/*/');
	}
}
