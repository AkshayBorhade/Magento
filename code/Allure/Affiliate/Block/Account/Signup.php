<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Allure\Affiliate\Block\Account;

/**
 * Dashboard Customer Info
 */
class Signup extends \Allure\Affiliate\Block\Account
{

	protected function _prepareLayout()
	{
		$this->pageConfig->getTitle()->set(__('Signup Affiliate'));

		return parent::_prepareLayout();
	}

	public function getSignupUrl()
	{
		return $this->getUrl('affiliate/account/signuppost');
	}
}
