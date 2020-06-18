<?php

namespace Allure\Affiliate\Controller\Adminhtml\Banner;

class Save extends \Allure\Affiliate\Controller\Adminhtml\Banner
{
	/**
	 * run the action
	 *
	 * @return \Magento\Backend\Model\View\Result\Redirect
	 */
	public function execute()
	{
		$redirectBack = $this->getRequest()->getParam('back', false);
		/** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
		$resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
		$data           = $this->getRequest()->getPost('banner');
		if (!$data) {
			return $resultRedirect->setPath('affiliate/*/');
		}

		/** @var \Allure\Affiliate\Model\Banner $banner */
		$banner = $this->_initBanner();
		if (!$this->isBannerExist($banner)) {
			$this->messageManager->addErrorMessage(__('This banner does not exist.'));

			return $resultRedirect->setPath('affiliate/*/');
		}

		if (!empty($data)) {
			$banner->addData($data);
			$this->_getSession()->setData('affiliate_banner_data', $data);
		}

		try {
			$banner->save();
			$this->_getSession()->setData('affiliate_banner_data', false);

			$this->messageManager->addSuccessMessage(__('You saved the banner.'));
		} catch (\Magento\Framework\Exception\LocalizedException $e) {
			$redirectBack = true;
			$this->messageManager->addErrorMessage($e->getMessage());
		} catch (\Exception $e) {
			$redirectBack = true;
			$this->messageManager->addErrorMessage(__('We cannot save the banner.'));
			$this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
		}

		return ($redirectBack)
			? $resultRedirect->setPath('affiliate/*/edit', ['id' => $banner->getId()])
			: $resultRedirect->setPath('affiliate/*/');
	}

	protected function isBannerExist(\Allure\Affiliate\Model\Banner $model)
	{
		$bannerId = $this->getRequest()->getParam('id');

		return (!$model->getId() && $bannerId) ? false : true;
	}
}
