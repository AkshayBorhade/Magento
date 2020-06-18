<?php

namespace Allure\Affiliate\Block\Adminhtml\Banner;

/**
 * Class Edit
 * @package Allure\Affiliate\Block\Adminhtml\Banner
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
	 * Initialize Banner edit block
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_blockGroup = 'Allure_Affiliate';
		$this->_controller = 'adminhtml_banner';
		parent::_construct();
		$this->buttonList->update('save', 'label', __('Save Banner'));
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
	 * Retrieve text for header element depending on loaded Banner
	 *
	 * @return string
	 */
	public function getHeaderText()
	{
		/** @var \Allure\Affiliate\Model\Banner $banner */
		$banner = $this->_coreRegistry->registry('current_banner');
		if ($banner->getId()) {
			return __('Edit Banner "%1"', $this->escapeHtml($banner->getName()));
		}

		return __('New Banner');
	}
}
