<?php

namespace Allure\Affiliate\Ui\Component\Listing\Column;

class Campaign extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var \Allure\Affiliate\Model\CampaignFactory
     */
    protected $campaignFactory;

    /**
     * constructor
     *
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param \Allure\Affiliate\Model\CampaignFactory $campaignFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Allure\Affiliate\Model\CampaignFactory $campaignFactory,
        array $components = [],
        array $data = []
        )
    {
        $this->campaignFactory = $campaignFactory->create();
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }


    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $campaignName = [];
                $campaignIds = explode(',', $item['campaign_id']);
                foreach ($campaignIds as $campaignId) {
                    $campaignName[] = $this->campaignFactory->load($campaignId)->getName();
                }
                $item[$this->getData('name')] = implode(', ', $campaignName);
            }
        }
        return $dataSource;
    }
}
