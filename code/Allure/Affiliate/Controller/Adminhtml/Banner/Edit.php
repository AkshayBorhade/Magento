<?php

namespace Allure\Affiliate\Controller\Adminhtml\Banner;

class Edit extends \Allure\Affiliate\Controller\Adminhtml\Banner
{
	public function execute()
	{
		$bannerId = $this->getRequest()->getParam('id');
		$banner = $this->_initBanner();

		if (!$banner->getId() && $bannerId) {
			$this->messageManager->addError(__('This banner no longer exists.'));
			$this->_redirect('affiliate/*/');
			return;
		}

		$data = $this->_getSession()->getData('affiliate_banner_data', true);
		if (!empty($data)) {
			$banner->addData($data);
		}

		$this->_view->loadLayout();
		$this->_setActiveMenu('Allure_Affiliate::banner');
		$this->_view->getPage()->getConfig()->getTitle()->prepend(__('Banners'));
		$this->_view->getPage()->getConfig()->getTitle()->prepend(
			$banner->getId() ? $banner->getTitle() : __('New Banner')
		);

		$this->_addBreadcrumb(
			$bannerId ? __('Edit Banner') : __('New Banner'),
			$bannerId ? __('Edit Banner') : __('New Banner')
		);
		$this->_view->renderLayout();
	}
}
