<?php

namespace Allure\Affiliate\Controller\Adminhtml\Banner;

/**
 * Class Create
 * @package Allure\Affiliate\Controller\Adminhtml\Banner
 */
class Create extends \Allure\Affiliate\Controller\Adminhtml\Banner
{
	/**
	 * Create new banner
	 *
	 * @return void
	 */
	public function execute()
	{
		$this->_forward('edit');
	}
}
