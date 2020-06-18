<?php

namespace Allure\Affiliate\Controller\Adminhtml\Campaign;

class Edit extends \Allure\Affiliate\Controller\Adminhtml\Campaign
{
	/**
	 * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\View\Result\Page
	 */
	public function execute()
	{
		/** @var \Allure\Affiliate\Model\Campaign $campaign */
		$campaign = $this->_initCampaign();
		/** @var \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page $resultPage */
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->setActiveMenu('Allure_Affiliate::campaign');
		$resultPage->getConfig()->getTitle()->set(__('Campaigns'));

		$title = $campaign->getId() ? __('Edit Campaign "%1"', $campaign->getName()) : __('New Campaign');
		$resultPage->getConfig()->getTitle()->prepend($title);

		$data = $this->_getSession()->getData('affiliate_campaign_data', true);
		if (!empty($data)) {
			$campaign->setData($data);
		}
		$this->_coreRegistry->register('current_campaign', $campaign);

		$model = $this->_objectManager->create('Magento\SalesRule\Model\Rule');
		if (!empty($campaign->getData())) {
			$model->addData($campaign->getData());
		}
		$model->getConditions()->setJsFormObject('rule_conditions_fieldset');
		$model->getActions()->setJsFormObject('rule_actions_fieldset');

		$this->_coreRegistry->register('current_campaign_rule', $model);

		return $resultPage;
	}
}
