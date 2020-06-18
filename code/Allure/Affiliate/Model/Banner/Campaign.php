<?php
 
namespace Allure\Affiliate\Model\Banner;

class Campaign implements \Magento\Framework\Option\ArrayInterface
{
	const CAMPAIGN_COLLECTION = 1;
	protected $campaign;

	public function __construct(
		\Allure\Affiliate\Model\CampaignFactory $campaignFactory
	)
	{
		$this->campaign = $campaignFactory;
	}

	protected function getCampaignCollection()
	{
		$campaignModel = $this->campaign->create();

		return $campaignModel->getCollection();
	}

	/**
	 * to option array
	 *
	 * @return array
	 */
	public function toOptionArray()
	{
		$campaigns = $this->getCampaignCollection();
		$options   = array();
		foreach ($campaigns as $campaign) {
			$options[] = array('value' => $campaign->getId(), 'label' => $campaign->getName());
		}

		return $options;
	}
}
