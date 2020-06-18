<?php

namespace Allure\Affiliate\Controller\Adminhtml;

abstract class Group extends \Allure\Affiliate\Controller\Adminhtml\AbstractAction
{
	/**
	 * Group Factory
	 *
	 * @var \Allure\Affiliate\Model\GroupFactory
	 */
	protected $_groupFactory;

	/**
	 * Core registry
	 *
	 * @var \Magento\Framework\Registry
	 */
	protected $_coreRegistry;

	/**
	 * @param \Magento\Backend\App\Action\Context $context
	 * @param \Allure\Affiliate\Model\GroupFactory $groupFactory
	 * @param \Magento\Framework\Registry $coreRegistry
	 * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
	 */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Allure\Affiliate\Model\GroupFactory $groupFactory,
		\Magento\Framework\Registry $coreRegistry,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		$this->_groupFactory = $groupFactory;
		$this->_coreRegistry = $coreRegistry;
		parent::__construct($context, $resultPageFactory, $coreRegistry);
	}

	/**
	 * @return \Magento\Framework\Controller\Result\Redirect
	 */
	protected function _initGroup()
	{
		$groupId = (int)$this->getRequest()->getParam('id');
		/** @var \Allure\Affiliate\Model\Group $account */
		$group = $this->_groupFactory->create();
		if ($groupId) {
			$group->load($groupId);
			if (!$group->getId()) {
				$this->messageManager->addError(__('This account no longer exists.'));
				$resultRedirect = $this->resultRedirectFactory->create();
				$resultRedirect->setPath('affiliate/account/index');

				return $resultRedirect;
			}
		}

		return $group;
	}

	/**
	 * is action allowed
	 *
	 * @return bool
	 */
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Allure_Affiliate::group');
	}
}
