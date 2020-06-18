<?php

namespace Allure\Affiliate\Controller\Adminhtml\Campaign;

/**
 * Class Create
 * @package Allure\Affiliate\Controller\Adminhtml\Campaign
 */
class Create extends \Allure\Affiliate\Controller\Adminhtml\Campaign
{
	/**
	 * Create new campaign
	 *
	 * @return void
	 */
	public function execute()
	{
		$this->_forward('edit');
	}
}
