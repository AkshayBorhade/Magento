<?php

namespace Allure\Affiliate\Controller\Adminhtml\Campaign;

class InlineEdit extends \Magento\Backend\App\Action
{
	/**
	 * JSON Factory
	 *
	 * @var \Magento\Framework\Controller\Result\JsonFactory
	 */
	protected $_jsonFactory;

	/**
	 * Campaign Factory
	 *
	 * @var \Allure\Affiliate\Model\CampaignFactory
	 */
	protected $_campaignFactory;

	/**
	 * constructor
	 *
	 * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
	 * @param \Allure\Affiliate\Model\CampaignFactory $campaignFactory
	 * @param \Magento\Backend\App\Action\Context $context
	 */
	public function __construct(
		\Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
		\Allure\Affiliate\Model\CampaignFactory $campaignFactory,
		\Magento\Backend\App\Action\Context $context
	)
	{
		$this->_jsonFactory     = $jsonFactory;
		$this->_campaignFactory = $campaignFactory;
		parent::__construct($context);
	}

	/**
	 * @return \Magento\Framework\Controller\ResultInterface
	 */
	public function execute()
	{
		/** @var \Magento\Framework\Controller\Result\Json $resultJson */
		$resultJson = $this->_jsonFactory->create();
		$error      = false;
		$messages   = [];
		$postItems  = $this->getRequest()->getParam('items', []);
		if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
			return $resultJson->setData([
				'messages' => [__('Please correct the data sent.')],
				'error'    => true,
			]);
		}
		foreach (array_keys($postItems) as $campaignId) {
			/** @var \Allure\Affiliate\Model\Campaign $campaign */
			$campaign = $this->_campaignFactory->create()->load($campaignId);
			try {
				$campaignData = $postItems[$campaignId];//todo: handle dates
				$campaign->addData($campaignData);
				$campaign->save();
			} catch (\Magento\Framework\Exception\LocalizedException $e) {
				$messages[] = $this->getErrorWithCampaignId($campaign, $e->getMessage());
				$error      = true;
			} catch (\RuntimeException $e) {
				$messages[] = $this->getErrorWithCampaignId($campaign, $e->getMessage());
				$error      = true;
			} catch (\Exception $e) {
				$messages[] = $this->getErrorWithCampaignId(
					$campaign,
					__('Something went wrong while saving the Campaign.')
				);
				$error      = true;
			}
		}

		return $resultJson->setData([
			'messages' => $messages,
			'error'    => $error
		]);
	}

	/**
	 * Add Campaign id to error message
	 *
	 * @param \Allure\Affiliate\Model\Campaign $campaign
	 * @param string $errorText
	 * @return string
	 */
	protected function getErrorWithCampaignId(\Allure\Affiliate\Model\Campaign $campaign, $errorText)
	{
		return '[Campaign ID: ' . $campaign->getId() . '] ' . $errorText;
	}
}
