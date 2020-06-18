<?php

namespace Allure\Affiliate\Controller\Adminhtml;

/**
 * Class Banner
 * @package Allure\Affiliate\Controller\Adminhtml
 */
abstract class Banner extends \Allure\Affiliate\Controller\Adminhtml\AbstractAction
{
	/**
	 * Init Banner
	 *
	 * @return \Allure\Affiliate\Model\Banner
	 */
	protected function _initBanner()
	{
		$bannerId = (int)$this->getRequest()->getParam('id');
		/** @var \Allure\Affiliate\Model\Banner $banner */
		$banner = $this->_objectManager->create('Allure\Affiliate\Model\Banner');
		if ($bannerId) {
			$banner->load($bannerId);
		}
		if (!$this->_coreRegistry->registry('current_banner')) {
			$this->_coreRegistry->register('current_banner', $banner);
		}

		return $banner;
	}

	/**
	 * is action allowed
	 *
	 * @return bool
	 */
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Allure_Affiliate::banner');
	}
}
