<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Allure\Affiliate\Block;


/**
 * Dashboard Customer Info
 */
class Dashboard extends \Allure\Affiliate\Block\Account
{
	public function getCampaigns()
	{
		$affiliateGroupId = $this->_affiliateHelper->getCurrentAffiliate()->getGroupId();
		$campaigns        = $this->campaignFactory->create()->getCollection()
			->getAvailableCampaign($affiliateGroupId, $this->_storeManager->getWebsite()->getId());

		return $campaigns;
	}

	public function showForGuest($collection)
	{
		foreach ($collection as $item) {
			if ($item->getDisplay() == \Allure\Affiliate\Model\Campaign\Display::ALLOW_GUEST) {
				return true;
			}
		}

		return false;
	}

	public function isAffiliateLogin()
	{
		if ($this->customerSession->getCustomerId()) {
			$affAccount = $this->accountFactory->create()->load($this->customerSession->getCustomerId(), 'customer_id');
			if ($affAccount && $affAccount->getId()) {
				return true;
			}
		}

		return false;
	}

	public function getCampaignForGuest()
	{
		$campaigns = $this->campaignFactory->create()->getCollection()
			->getAvailableCampaign(null, $this->_storeManager->getWebsite()->getId())
			->addFieldToFilter('display', \Allure\Affiliate\Model\Campaign\Display::ALLOW_GUEST);

		return $campaigns;
	}

	public function getCampaignRowSpan($rowSpan, $campaign)
	{
		$container = new \Magento\Framework\DataObject(array('row_span' => $rowSpan + 2, 'campaign' => $campaign));
		$this->_eventManager->dispatch('Allure_affiliate_dashboard_campaign_row_span', array(
			'container' => $container
		));

		return $container->getRowSpan();
	}

	public function getCommissionCampaignAddition($name, $campaign)
	{
		$child = $this->getChild($name);
		if ($child) {
			$child->setCampaign($campaign);
			if (!$this->hasData('commission_campaign_addition_' . $campaign->getId())) {
				$this->setData('commission_campaign_addition_' . $campaign->getId(), $child->toHtml());

				return $this->getData('commission_campaign_addition_' . $campaign->getId());
			}
		}

		return '';
	}
}
