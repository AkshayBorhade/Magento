<?php

namespace Allure\Affiliate\Block\Adminhtml\Banner\Edit\Tab;

class Banner extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
	/**
	 * @type \Magento\Config\Model\Config\Source\Yesno
	 */
	protected $_yesno;

	/**
	 * @type \Allure\Affiliate\Model\Banner\Status
	 */
	protected $_status;

	/**
	 * @type \Allure\Affiliate\Model\Banner\Campaign
	 */
	protected $_campaign;

	/**
	 * @type \Magento\Cms\Model\Wysiwyg\Config
	 */
	protected $_wysiwygConfigModel;

	/**
	 * @param \Magento\Config\Model\Config\Source\Yesno $yesno
	 * @param \Allure\Affiliate\Model\Banner\Status $status
	 * @param \Allure\Affiliate\Model\Banner\Campaign $campaign
	 * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
	 * @param \Magento\Backend\Block\Template\Context $context
	 * @param \Magento\Framework\Registry $registry
	 * @param \Magento\Framework\Data\FormFactory $formFactory
	 * @param array $data
	 */
	public function __construct(
		\Magento\Config\Model\Config\Source\Yesno $yesno,
		\Allure\Affiliate\Model\Banner\Status $status,
		\Allure\Affiliate\Model\Banner\Campaign $campaign,
		\Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
		\Magento\Backend\Block\Template\Context $context,
		\Magento\Framework\Registry $registry,
		\Magento\Framework\Data\FormFactory $formFactory,
		array $data = []
	)
	{
		$this->_yesno              = $yesno;
		$this->_status             = $status;
		$this->_campaign           = $campaign;
		$this->_wysiwygConfigModel = $wysiwygConfig;
		parent::__construct($context, $registry, $formFactory, $data);
	}

	/**
	 * Prepare form
	 *
	 * @return $this
	 */
	protected function _prepareForm()
	{
		/** @var \Allure\Affiliate\Model\Banner $banner */
		$banner = $this->_coreRegistry->registry('current_banner');
		$form   = $this->_formFactory->create();
		$form->setHtmlIdPrefix('banner_');
		$form->setFieldNameSuffix('banner');

		$fieldset = $form->addFieldset('base_fieldset', [
			'legend' => __('Banner Information'),
			'class'  => 'fieldset-wide'
		]);

		$fieldset->addField('title', 'text', [
			'name'     => 'title',
			'label'    => __('Title'),
			'title'    => __('Title'),
			'required' => true,
		]);
		$fieldset->addField('content', 'editor', [
			'name'         => 'content',
			'label'        => __('Content'),
			'title'        => __('Content'),
			'config'       => $this->_wysiwygConfigModel->getConfig(['add_variables' => false])->addData(['add_widgets' => false]),
			'wysiwyg'      => false,
			'container_id' => 'content',
		]);
		$fieldset->addField('link', 'text', [
			'name'  => 'link',
			'label' => __('Url'),
			'title' => __('Url'),
			'note'  => __('If empty, home page will be used.')
		]);
		$fieldset->addField('campaign_id', 'select', [
			'name'     => 'campaign_id',
			'label'    => __('Related Campaign'),
			'title'    => __('Related Campaign'),
			'required' => true,
			'values'   => $this->_campaign->toOptionArray(),
			'note'     => __('Only affiliates who are in above campaign can see this banner.')
		]);
		$fieldset->addField('rel_nofollow', 'select', [
			'name'     => 'rel_nofollow',
			'label'    => __('Rel Nofollow'),
			'title'    => __('Rel Nofollow'),
			'required' => true,
			'values'   => $this->_yesno->toOptionArray(),
			'note'     => __('Put the rel="nofollow" attribute on the link.')
		]);
		$fieldset->addField('status', 'select', [
			'name'     => 'status',
			'label'    => __('Status'),
			'title'    => __('Status'),
			'required' => true,
			'values'   => $this->_status->toOptionArray()
		]);

		$form->addValues($banner->getData());
		$this->setForm($form);

		return parent::_prepareForm();
	}

	/**
	 * Prepare label for tab
	 *
	 * @return string
	 */
	public function getTabLabel()
	{
		return __('Banner Information');
	}

	/**
	 * Prepare title for tab
	 *
	 * @return string
	 */
	public function getTabTitle()
	{
		return $this->getTabLabel();
	}

	/**
	 * Can show tab in tabs
	 *
	 * @return boolean
	 */
	public function canShowTab()
	{
		return true;
	}

	/**
	 * Tab is hidden
	 *
	 * @return boolean
	 */
	public function isHidden()
	{
		return false;
	}
}
