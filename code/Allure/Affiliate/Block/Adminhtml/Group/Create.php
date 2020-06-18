<?php

namespace Allure\Affiliate\Block\Adminhtml\Group;

class Create extends \Magento\Backend\Block\Widget\Form\Container
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
	 * Initialize Group edit block
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_blockGroup = 'Allure_Affiliate';
		$this->_controller = 'adminhtml_group';
		$this->_mode       = 'create';
		parent::_construct();
		$this->buttonList->update('save', 'label', __('Save Group'));
		$this->buttonList->remove('delete');
		$this->buttonList->remove('reset');
	}

	/**
	 * Retrieve text for header element depending on loaded Group
	 *
	 * @return string
	 */
	public function getHeaderText()
	{
		return __('New Group');
	}
}
