<?php

namespace Allure\Affiliate\Block\Adminhtml\Campaign;

/**
 * Class Edit
 * @package Allure\Affiliate\Block\Adminhtml\Campaign
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
	/**
	 * Core registry
	 *
	 * @var \Magento\Framework\Registry
	 */
	protected $_coreRegistry;

	/**
	 * constructor
	 *
	 * @param \Magento\Framework\Registry $coreRegistry
	 * @param \Magento\Backend\Block\Widget\Context $context
	 * @param array $data
	 */
	public function __construct(
		\Magento\Framework\Registry $coreRegistry,
		\Magento\Backend\Block\Widget\Context $context,
		array $data = []
	)
	{
		$this->_coreRegistry = $coreRegistry;
		parent::__construct($context, $data);
	}

	/**
	 * Initialize Campaign edit block
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_blockGroup = 'Allure_Affiliate';
		$this->_controller = 'adminhtml_campaign';
		parent::_construct();
		$this->buttonList->update('save', 'label', __('Save Campaign'));
		$this->buttonList->add(
			'save-and-continue',
			[
				'label'          => __('Save and Continue Edit'),
				'class'          => 'save',
				'data_attribute' => [
					'mage-init' => [
						'button' => [
							'event'  => 'saveAndContinueEdit',
							'target' => '#edit_form'
						]
					]
				]
			],
			-100
		);
	}

	/**
	 * Retrieve text for header element depending on loaded Campaign
	 *
	 * @return string
	 */
	public function getHeaderText()
	{
		/** @var \Allure\Affiliate\Model\Campaign $campaign */
		$campaign = $this->_coreRegistry->registry('current_campaign');
		if ($campaign->getId()) {
			return __('Edit Campaign "%1"', $this->escapeHtml($campaign->getName()));
		}

		return __('New Campaign');
	}
}
