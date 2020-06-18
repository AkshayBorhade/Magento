<?php

namespace Allure\Affiliate\Controller\Adminhtml;

abstract class Withdraw extends \Allure\Affiliate\Controller\Adminhtml\AbstractAction
{
	/**
	 * Withdraw Factory
	 *
	 * @var \Allure\Affiliate\Model\WithdrawFactory
	 */
	protected $_withdrawFactory;

	/**
	 * @param \Magento\Backend\App\Action\Context $context
	 * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
	 * @param \Magento\Framework\Registry $coreRegistry
	 * @param \Allure\Affiliate\Model\WithdrawFactory $withdrawFactory
	 */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Magento\Framework\Registry $coreRegistry,
		\Allure\Affiliate\Model\WithdrawFactory $withdrawFactory
	)
	{
		$this->_withdrawFactory = $withdrawFactory;
		parent::__construct($context, $resultPageFactory, $coreRegistry);
	}

	/**
	 * Init Withdraw
	 *
	 * @return \Allure\Affiliate\Model\Withdraw
	 */
	protected function _initWithdraw()
	{
		$withdrawId = (int)$this->getRequest()->getParam('id');
		/** @var \Allure\Affiliate\Model\Account $account */
		$withdraw = $this->_withdrawFactory->create();
		if ($withdrawId) {
			$withdraw->load($withdrawId);
			if (!$withdraw->getId()) {
				$this->messageManager->addErrorMessage(__('This withdrawal no longer exists.'));
				$resultRedirect = $this->resultRedirectFactory->create();
				$resultRedirect->setPath('affiliate/withdraw/index');

				return $resultRedirect;
			}
		}

		return $withdraw;
	}

	/**
	 * is action allowed
	 *
	 * @return bool
	 */
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Allure_Affiliate::withdraw');
	}
}
