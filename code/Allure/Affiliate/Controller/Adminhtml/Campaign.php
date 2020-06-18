<?php

namespace Allure\Affiliate\Controller\Adminhtml;

/**
 * Class Campaign
 * @package Allure\Affiliate\Controller\Adminhtml
 */
abstract class Campaign extends \Allure\Affiliate\Controller\Adminhtml\AbstractAction
{
	/**
	 * @type \Allure\Affiliate\Model\CampaignFactory
	 */
	protected $_campaignFactory;

	/**
	 * @param \Magento\Backend\App\Action\Context $context
	 * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
	 * @param \Magento\Framework\Registry $coreRegistry
	 * @param \Allure\Affiliate\Model\CampaignFactory $campaignFactory
	 */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Magento\Framework\Registry $coreRegistry,
		\Allure\Affiliate\Model\CampaignFactory $campaignFactory
	)
	{
		$this->_campaignFactory = $campaignFactory;

		parent::__construct($context, $resultPageFactory, $coreRegistry);
	}

	/**
	 * Init Campaign
	 *
	 * @return \Allure\Affiliate\Model\Campaign
	 */
	protected function _initCampaign()
	{
		$campaignId = (int)$this->getRequest()->getParam('id');
		/** @var \Allure\Affiliate\Model\Account $account */
		$campaign = $this->_campaignFactory->create();
		if ($campaignId) {
			$campaign->load($campaignId);
			if (!$campaign->getId()) {
				$this->messageManager->addError(__('This campaign no longer exists.'));
				$resultRedirect = $this->resultRedirectFactory->create();
				$resultRedirect->setPath('affiliate/campaign/index');

				return $resultRedirect;
			}
		}

		return $campaign;
	}

	/**
	 * is action allowed
	 *
	 * @return bool
	 */
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Allure_Affiliate::campaign');
	}
}
