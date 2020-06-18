<?php

namespace Allure\Affiliate\Controller\Adminhtml\Campaign;

/**
 * Class Delete
 * @package Allure\Affiliate\Controller\Adminhtml\Campaign
 */
class Delete extends \Allure\Affiliate\Controller\Adminhtml\Campaign
{
	/**
	 * execute action
	 *
	 * @return \Magento\Backend\Model\View\Result\Redirect
	 */
	public function execute()
	{
		$resultRedirect = $this->resultRedirectFactory->create();
		$id             = $this->getRequest()->getParam('campaign_id');
		if ($id) {
			try {
				/** @var \Allure\Affiliate\Model\Campaign $campaign */
				$campaign = $this->_campaignFactory->create();
				$campaign->load($id);
				$campaign->delete();

				$this->messageManager->addSuccess(__('The Campaign has been deleted.'));
				$resultRedirect->setPath('affiliate/*/');

				return $resultRedirect;
			} catch (\Exception $e) {
				$this->messageManager->addError($e->getMessage());

				// go back to edit form
				$resultRedirect->setPath('affiliate/*/edit', ['id' => $id]);

				return $resultRedirect;
			}
		}
		// display error message
		$this->messageManager->addError(__('Campaign to delete was not found.'));

		$resultRedirect->setPath('affiliate/*/');

		return $resultRedirect;
	}
}
